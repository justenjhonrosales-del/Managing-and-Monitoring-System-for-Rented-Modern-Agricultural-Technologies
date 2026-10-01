<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Settings - Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin-sidebar.css') }}">
    <style>
        body {
            margin: 0;
            background: #eef0ed;
            font-family: 'DM Sans', sans-serif;
            color: #1a2a28;
        }

        .settings-page {
            padding: 30px;
        }

        .settings-panel {
            width: min(100%, 1280px);
            margin: 0 auto;
            padding: 22px 22px 28px;
            border: 2px solid #c4a76d;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.08);
            box-shadow: inset 0 0 0 1px rgba(196, 167, 109, 0.08);
        }

        .settings-page h2 {
            margin: 0 0 18px;
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.2rem, 3vw, 3rem);
            font-weight: 700;
            color: #0f3a2b;
            text-align: left;
        }

        .backup-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 28px;
            margin-top: 10px;
        }

        .backup-section {
            display: grid;
            gap: 14px;
        }

        .backup-section h3 {
            margin: 0;
            font-size: 1.2rem;
            color: #0f3a2b;
            font-weight: 700;
        }

        .backup-section p {
            margin: 0;
            color: #2e4a45;
            font-size: 0.92rem;
        }

        .backup-card {
            background: transparent;
            border-radius: 12px;
            padding: 0;
        }

        .manual-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            min-height: 52px;
            padding: 14px 16px;
            border: 0;
            border-radius: 10px;
            background: linear-gradient(135deg, #0d7a52, #1da15d);
            color: #ffffff;
            font-size: 1.05rem;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 8px 18px rgba(13, 122, 82, 0.18);
        }

        .backup-meta {
            font-size: 0.96rem;
            color: #1c2b29;
            line-height: 1.5;
        }

        .toggle-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-top: 8px;
        }

        .toggle-row .label {
            font-size: 1rem;
            font-weight: 700;
            color: #1c2b29;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 54px;
            height: 32px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            inset: 0;
            border-radius: 999px;
            background: #dfe5df;
            transition: 0.2s ease;
            cursor: pointer;
        }

        .slider::before {
            content: "";
            position: absolute;
            width: 22px;
            height: 22px;
            left: 5px;
            top: 5px;
            border-radius: 50%;
            background: #ffffff;
            transition: 0.2s ease;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .switch input:checked + .slider {
            background: #2aa561;
        }

        .switch input:checked + .slider::before {
            transform: translateX(22px);
        }

        .field-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
            margin-top: 12px;
        }

        .field-box label {
            display: block;
            margin-bottom: 8px;
            font-size: 0.96rem;
            font-weight: 600;
            color: #1d2c2a;
        }

        .field-box select {
            width: 100%;
            min-height: 42px;
            border: 1px solid #bac7c0;
            border-radius: 8px;
            background: #fff;
            padding: 10px 12px;
            font-size: 1rem;
            color: #1b2b29;
        }

        .settings-note {
            margin: 0;
            color: #374c48;
            line-height: 1.5;
            font-size: 0.94rem;
        }

        .settings-form-submit {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 50px;
            padding: 0 22px;
            border: 0;
            border-radius: 10px;
            background: linear-gradient(135deg, #0d7a52, #1da15d);
            color: white;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 12px 24px rgba(13, 122, 82, 0.18);
        }

        .backup-history,
        .backup-recovery {
            margin-top: 30px;
            padding-top: 10px;
        }

        .backup-box {
            margin-top: 18px;
            padding: 18px 20px;
            border: 1px solid rgba(30, 68, 58, 0.18);
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.16);
        }

        .backup-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            padding: 14px 0;
            border-bottom: 1px solid rgba(32, 54, 47, 0.12);
        }

        .backup-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .backup-item-main {
            display: flex;
            flex-direction: column;
            gap: 4px;
            min-width: 0;
        }

        .backup-item-name {
            font-weight: 700;
            color: #1d2b29;
            word-break: break-word;
        }

        .backup-item-sub {
            font-size: 0.9rem;
            color: #405a55;
        }

        .backup-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .btn-download,
        .btn-restore {
            border: 0;
            border-radius: 8px;
            padding: 9px 14px;
            font-size: 0.9rem;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-download {
            background: #dfe7e2;
            color: #123e34;
        }

        .btn-restore {
            background: #0d7a52;
            color: white;
        }

        .restore-select {
            width: 100%;
            min-height: 42px;
            border: 1px solid #c9d1cd;
            border-radius: 8px;
            padding: 10px 12px;
            background: #fff;
        }

        .alert {
            padding: 12px 14px;
            border-radius: 8px;
            margin-bottom: 16px;
            font-weight: 600;
        }

        .alert-success {
            background: #dff7ea;
            border: 1px solid #bcecc9;
            color: #0e5a3a;
        }

        @media (max-width: 980px) {
            .backup-layout {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        @include('admin.partials.sidebar')

        <main class="main-content settings-page">
            <div class="settings-panel">
                <h2>Backup &amp; Recovery</h2>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="backup-layout">
                    <section class="backup-section">
                        <h3>Manual Backup</h3>
                        <p>Admin clicks button</p>

                        <form method="POST" action="{{ route('settings.backup.manual') }}" class="backup-card">
                            @csrf
                            <button type="submit" class="manual-button">
                                <i class="fa-solid fa-download"></i>
                                Generate and Download Manual Backup Now
                            </button>
                        </form>

                        <div class="backup-meta">
                            <strong>Last manual backup:</strong>
                            {{ $lastManualBackup ? \Carbon\Carbon::parse($lastManualBackup)->format('d F Y, h:i A') : 'No backup created yet.' }}
                        </div>
                    </section>

                    <section class="backup-section">
                        <h3>Automatic Backup</h3>
                        <p>Scheduler runs in background</p>

                        <form method="POST" action="{{ route('settings.backup.save') }}">
                            @csrf

                            <div class="toggle-row">
                                <span class="label">Automatic Backup</span>
                                <label class="switch">
                                    <input type="checkbox" name="automatic_backup_enabled" value="1" {{ old('automatic_backup_enabled', $systemSettings['automatic_backup_enabled']) ? 'checked' : '' }}>
                                    <span class="slider"></span>
                                </label>
                            </div>

                            <div class="field-grid">
                                <div class="field-box">
                                    <label for="backup_frequency">Frequency</label>
                                    <select id="backup_frequency" name="backup_frequency">
                                        <option value="daily" {{ old('backup_frequency', $systemSettings['backup_frequency']) === 'daily' ? 'selected' : '' }}>Daily</option>
                                        <option value="weekly" {{ old('backup_frequency', $systemSettings['backup_frequency']) === 'weekly' ? 'selected' : '' }}>Weekly</option>
                                        <option value="monthly" {{ old('backup_frequency', $systemSettings['backup_frequency']) === 'monthly' ? 'selected' : '' }}>Monthly</option>
                                    </select>
                                </div>

                                <div class="field-box">
                                    <label for="backup_time">Time Picker</label>
                                    <select id="backup_time" name="backup_time">
                                        @for ($hour = 0; $hour < 24; $hour++)
                                            @for ($minute = 0; $minute < 60; $minute += 30)
                                                @php
                                                    $timeValue = sprintf('%02d:%02d', $hour, $minute);
                                                    $label = \Carbon\Carbon::createFromFormat('H:i', $timeValue)->format('h:i A');
                                                @endphp
                                                <option value="{{ $timeValue }}" {{ old('backup_time', $systemSettings['backup_time']) === $timeValue ? 'selected' : '' }}>{{ $label }}</option>
                                            @endfor
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <p class="settings-note" style="margin-top:13px;">
                                Configure the automated, behind-the-scenes system scheduler for secure backups. Next run: {{ \Carbon\Carbon::parse($systemSettings['backup_time'] ?? '03:00')->format('h:i A') }}.
                            </p>

                            <div style="margin-top:16px;">
                                <button type="submit" class="settings-form-submit">Save Backup Settings</button>
                            </div>
                        </form>
                    </section>
                </div>

                <section class="backup-history">
                    <h3 style="margin:0 0 8px; font-size:1.15rem; color:#0f3a2b;">Backup History</h3>

                    <div class="backup-box">
                        @if (!empty($backupHistory))
                            @foreach ($backupHistory as $backup)
                                <div class="backup-item">
                                    <div class="backup-item-main">
                                        <span class="backup-item-name">{{ $backup['filename'] }}</span>
                                        <span class="backup-item-sub">{{ ucfirst($backup['type']) }} Backup • {{ $backup['created_at'] }} • {{ $backup['size'] }}</span>
                                    </div>
                                    <div class="backup-actions">
                                        <a href="{{ route('settings.backup.download', ['filename' => basename($backup['filename'])]) }}" class="btn-download">Download</a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="backup-item-sub">No backups have been created yet.</div>
                        @endif
                    </div>
                </section>

                <section class="backup-recovery">
                    <h3 style="margin:0 0 8px; font-size:1.15rem; color:#0f3a2b;">Recovery</h3>

                    <div class="backup-box">
                        <form method="POST" action="{{ route('settings.backup.restore') }}" onsubmit="return confirm('Are you sure you want to restore this backup? Current data may be replaced.');">
                            @csrf
                            <div style="display:grid; gap:12px;">
                                <label for="backup_file" style="font-weight:600; color:#1d2c2a;">Select Backup File:</label>
                                <select id="backup_file" name="backup_file" class="restore-select">
                                    @if (!empty($backupHistory))
                                        @foreach ($backupHistory as $backup)
                                            <option value="{{ $backup['filename'] }}">{{ $backup['filename'] }}</option>
                                        @endforeach
                                    @else
                                        <option value="">No backups available</option>
                                    @endif
                                </select>
                                <button type="submit" class="btn-restore" {{ empty($backupHistory) ? 'disabled' : '' }}>
                                    Restore Backup
                                </button>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </main>
    </div>
</body>
</html>
