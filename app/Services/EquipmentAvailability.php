<?php

namespace App\Services;

use App\Models\Rental;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;

class EquipmentAvailability
{
    private const MAINTENANCE_HOURS = 2;
    private const RENTAL_TIMEZONE = 'Asia/Manila';

    public function summarize(int $totalQuantity, string $equipmentName, iterable $rentals, CarbonInterface $now): array
    {
        $counts = $this->rentalCounts($equipmentName, $rentals, $now);

        return [
            'available' => max($totalQuantity - $counts['pending'] - $counts['maintenance'], 0),
            'pending' => $counts['pending'],
            'maintenance' => $counts['maintenance'],
        ];
    }

    public function rentalCounts(string $equipmentName, iterable $rentals, CarbonInterface $now): array
    {
        $counts = ['pending' => 0, 'maintenance' => 0];
        $equipmentKey = $this->equipmentKey($equipmentName);
        $now = CarbonImmutable::instance($now)->setTimezone(self::RENTAL_TIMEZONE);

        foreach ($rentals as $rental) {
            if (!$rental instanceof Rental) {
                continue;
            }

            $status = strtolower(trim((string) $rental->status));
            if (in_array($status, ['cancelled', 'canceled', 'rejected', 'declined'], true)) {
                continue;
            }

            $items = $rental->equipment;
            if (is_string($items)) {
                $items = json_decode($items, true);
            }

            if (!is_array($items)) {
                continue;
            }

            foreach ($items as $item) {
                if (!is_array($item) || $this->equipmentKey((string) ($item['name'] ?? '')) !== $equipmentKey) {
                    continue;
                }

                $quantity = max((int) ($item['quantity'] ?? 1), 0);
                if ($quantity === 0) {
                    continue;
                }

                $phase = $this->rentalPhase($rental, $equipmentKey, $item, $now);
                if ($phase !== null) {
                    $counts[$phase] += $quantity;
                }
            }
        }

        return $counts;
    }

    private function rentalPhase(Rental $rental, string $equipmentKey, array $item, CarbonImmutable $now): ?string
    {
        $start = $this->rentalStart($rental);
        if ($start === null) {
            return 'pending';
        }

        $durationHours = (float) ($rental->rental_duration_hours ?? 0);
        if ($equipmentKey === 'kuliglig') {
            $days = (float) data_get($item, 'meta.days', $durationHours);
            $durationHours = $days * 24;
        }

        $end = $start->addMinutes((int) round(max($durationHours, 0) * 60));
        $maintenanceEnds = $end->addHours(self::MAINTENANCE_HOURS);

        if ($now->greaterThanOrEqualTo($end) && $now->lessThan($maintenanceEnds)) {
            return 'maintenance';
        }

        if ($now->lessThan($end)) {
            return 'pending';
        }

        return null;
    }

    private function rentalStart(Rental $rental): ?CarbonImmutable
    {
        $date = $rental->rental_from;
        $time = trim((string) $rental->start_time);

        if (!$date || $time === '') {
            return null;
        }

        $date = $date instanceof CarbonInterface ? $date->format('Y-m-d') : trim((string) $date);

        try {
            return CarbonImmutable::parse($date . ' ' . $time, self::RENTAL_TIMEZONE);
        } catch (\Throwable) {
            return null;
        }
    }

    private function equipmentKey(string $name): string
    {
        $key = strtolower((string) preg_replace('/[^a-z0-9]/i', '', trim($name)));

        return in_array($key, ['reaper', 'thresher', 'reaperthresher', 'reaperorthresher'], true)
            ? 'reaperorthresher'
            : $key;
    }
}