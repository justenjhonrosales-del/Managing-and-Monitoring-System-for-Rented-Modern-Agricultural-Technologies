<?php

namespace App\Console\Commands;

use App\Models\SystemSetting;
use App\Services\BackupService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AutomaticBackupCommand extends Command
{
    protected $signature = 'app:automatic-backup';

    protected $description = 'Create automatic system backups when enabled and scheduled.';

    public function handle(BackupService $backupService): int
    {
        $enabled = filter_var(SystemSetting::get('automatic_backup_enabled', 0), FILTER_VALIDATE_BOOLEAN);

        if (!$enabled) {
            return self::SUCCESS;
        }

        $frequency = SystemSetting::get('backup_frequency', 'daily');
        $time = SystemSetting::get('backup_time', '03:00');
        $now = Carbon::now();

        $shouldRun = false;
        $lastRun = SystemSetting::get('last_automatic_backup_date');

        if ($now->format('H:i') !== Carbon::parse($time)->format('H:i')) {
            return self::SUCCESS;
        }

        if ($frequency === 'daily') {
            $shouldRun = true;
        }

        if ($frequency === 'weekly') {
            $shouldRun = !$lastRun || Carbon::parse($lastRun)->diffInDays($now) >= 7;
        }

        if ($frequency === 'monthly') {
            $shouldRun = !$lastRun || Carbon::parse($lastRun)->diffInDays($now) >= 28;
        }

        if (!$shouldRun) {
            return self::SUCCESS;
        }

        if ($lastRun && Carbon::parse($lastRun)->isSameDay($now)) {
            return self::SUCCESS;
        }

        $backupService->createBackup('automatic');
        SystemSetting::set('last_automatic_backup_date', $now->toIso8601String());

        return self::SUCCESS;
    }
}
