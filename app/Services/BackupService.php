<?php

namespace App\Services;

use App\Models\SystemSetting;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ZipArchive;

class BackupService
{
    protected string $backupDirectory;

    public function __construct()
    {
        $this->backupDirectory = storage_path('app/backups');
        if (!is_dir($this->backupDirectory)) {
            mkdir($this->backupDirectory, 0775, true);
        }
    }

    public function createBackup(string $type = 'manual'): array
    {
        $timestamp = now()->format('Y_m_d_H_i_s');
        $filename = 'backup_' . $timestamp . '.zip';
        $zipPath = $this->backupDirectory . DIRECTORY_SEPARATOR . $filename;

        $zip = new ZipArchive();
        $opened = $zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        if ($opened !== true) {
            throw new \RuntimeException('Unable to create backup archive.');
        }

        $manifest = [
            'type' => $type,
            'created_at' => now()->toIso8601String(),
            'application' => config('app.name'),
            'database_tables' => [
                'users',
                'rentals',
                'equipment_settings',
                'system_settings',
                'login_attempts',
            ],
        ];

        $zip->addFromString('manifest.json', json_encode($manifest, JSON_PRETTY_PRINT));

        foreach ($manifest['database_tables'] as $table) {
            $rows = DB::table($table)->get()->map(fn ($row) => (array) $row)->all();
            $zip->addFromString('database/' . $table . '.json', json_encode($rows, JSON_PRETTY_PRINT));
        }

        $this->addStorageFilesToZip($zip, 'storage');
        $zip->close();

        $metadata = [
            'type' => $type,
            'created_at' => $manifest['created_at'],
            'filename' => $filename,
            'size' => filesize($zipPath),
        ];

        file_put_contents($zipPath . '.meta.json', json_encode($metadata, JSON_PRETTY_PRINT));

        SystemSetting::set('last_backup_date', $manifest['created_at']);

        if ($type === 'manual') {
            SystemSetting::set('last_manual_backup_date', $manifest['created_at']);
        }

        return [
            'path' => $zipPath,
            'filename' => $filename,
            'metadata' => $metadata,
        ];
    }

    public function listBackups(): array
    {
        $backs = [];
        $files = glob($this->backupDirectory . DIRECTORY_SEPARATOR . '*.zip');

        if ($files === false) {
            return $backs;
        }

        foreach ($files as $file) {
            $metaFile = $file . '.meta.json';
            $meta = file_exists($metaFile) ? json_decode(file_get_contents($metaFile), true) : [];
            $filename = basename($file);

            $created = !empty($meta['created_at']) ? Carbon::parse($meta['created_at']) : Carbon::createFromTimestamp(filemtime($file));

            $backs[] = [
                'filename' => $filename,
                'type' => $meta['type'] ?? 'Manual',
                'created_at' => $created->format('F j, Y'),
                'created_at_full' => $created->format('F j, Y, h:i A'),
                'size' => $this->formatBytes(filesize($file)),
                'path' => $file,
            ];
        }

        usort($backs, fn ($a, $b) => strcmp($b['created_at_full'], $a['created_at_full']));

        return $backs;
    }

    public function restoreBackup(string $filename): void
    {
        $filePath = $this->backupDirectory . DIRECTORY_SEPARATOR . $filename;

        if (!file_exists($filePath)) {
            throw new \RuntimeException('Backup file not found.');
        }

        $zip = new ZipArchive();
        if ($zip->open($filePath) !== true) {
            throw new \RuntimeException('Unable to open backup archive.');
        }

        $manifest = json_decode($zip->getFromName('manifest.json'), true);
        $tables = $manifest['database_tables'] ?? [
            'users',
            'rentals',
            'equipment_settings',
            'system_settings',
            'login_attempts',
        ];

        foreach ($tables as $table) {
            $payload = $zip->getFromName('database/' . $table . '.json');
            if ($payload === false) {
                continue;
            }

            $rows = json_decode($payload, true);
            DB::table($table)->delete();

            if (!empty($rows)) {
                foreach ($rows as $row) {
                    DB::table($table)->insert($row);
                }
            }
        }

        $restoreRoot = base_path('storage/app');
        for ($i = 0; $i < $zip->numFiles; $i++) {
            $entry = $zip->getNameIndex($i);

            if (str_starts_with($entry, 'storage/') && !str_ends_with($entry, '/')) {
                $relative = str_replace('storage/', '', $entry);
                $target = $restoreRoot . DIRECTORY_SEPARATOR . $relative;
                $directory = dirname($target);

                if (!is_dir($directory)) {
                    mkdir($directory, 0775, true);
                }

                $content = $zip->getFromName($entry);
                if ($content !== false) {
                    file_put_contents($target, $content);
                }
            }
        }

        $zip->close();
        SystemSetting::set('last_backup_date', now()->toIso8601String());
    }

    protected function addStorageFilesToZip(ZipArchive $zip, string $prefix): void
    {
        $root = storage_path('app');
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($root, \FilesystemIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($iterator as $file) {
            $filePath = $file->getPathname();
            if (str_contains($filePath, DIRECTORY_SEPARATOR . 'backups' . DIRECTORY_SEPARATOR)) {
                continue;
            }

            if (is_dir($filePath)) {
                continue;
            }

            $relative = str_replace($root . DIRECTORY_SEPARATOR, '', $filePath);
            $zip->addFile($filePath, $prefix . '/' . $relative);
        }
    }

    protected function formatBytes(int $bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $value = $bytes;
        $unitIndex = 0;

        while ($value >= 1024 && $unitIndex < count($units) - 1) {
            $value /= 1024;
            $unitIndex++;
        }

        return number_format($value, 2) . ' ' . $units[$unitIndex];
    }
}
