<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Settings - Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .settings-container {
            display: grid;
            grid-template-columns: 250px 1fr;
            gap: 30px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .sidebar {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            height: fit-content;
            position: sticky;
            top: 20px;
        }

        .sidebar-title {
            font-size: 14px;
            font-weight: 700;
            color: #1b5e20;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 15px;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .sidebar-nav button {
            background: none;
            border: none;
            padding: 12px 15px;
            cursor: pointer;
            text-align: left;
            font-size: 14px;
            color: #666;
            border-radius: 8px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 500;
        }

        .sidebar-nav button:hover {
            background: #f5f5f5;
            color: #2e7d32;
        }

        .sidebar-nav button.active {
            background: #e8f5e9;
            color: #2e7d32;
            border-left: 3px solid #2e7d32;
            padding-left: 12px;
        }

        .main-content {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .content-section {
            display: none;
        }

        .content-section.active {
            display: block;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .section-header {
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 24px;
            font-weight: 700;
            color: #1b5e20;
            margin-bottom: 8px;
        }

        .section-subtitle {
            font-size: 14px;
            color: #999;
        }

        .settings-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .setting-card {
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 20px;
            background: #fafafa;
            transition: all 0.3s ease;
        }

        .setting-card:hover {
            border-color: #2e7d32;
            box-shadow: 0 4px 12px rgba(46, 125, 50, 0.1);
        }

        .setting-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
            color: #333;
            margin-bottom: 12px;
            font-size: 15px;
        }

        .setting-label i {
            color: #2e7d32;
            font-size: 18px;
        }

        .setting-value {
            color: #666;
            font-size: 13px;
            margin-bottom: 12px;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-available {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .status-unavailable {
            background: #ffebee;
            color: #d32f2f;
        }

        .status-maintenance {
            background: #fff3e0;
            color: #f57c00;
        }

        form {
            display: grid;
            gap: 20px;
        }

        .form-group {
            display: grid;
            gap: 8px;
        }

        .form-group label {
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #2e7d32;
            box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.1);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-section-title {
            font-size: 16px;
            font-weight: 700;
            color: #1b5e20;
            margin-top: 20px;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e8f5e9;
        }

        .toggle-group {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            background: #f5f5f5;
            border-radius: 8px;
        }

        .toggle-label {
            flex: 1;
        }

        .toggle-label-title {
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }

        .toggle-label-desc {
            font-size: 12px;
            color: #999;
            margin-top: 4px;
        }

        .toggle-switch {
            position: relative;
            width: 60px;
            height: 32px;
            background: #ccc;
            border-radius: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .toggle-switch.active {
            background: #2e7d32;
        }

        .toggle-switch::after {
            content: '';
            position: absolute;
            width: 28px;
            height: 28px;
            background: white;
            border-radius: 50%;
            top: 2px;
            left: 2px;
            transition: left 0.3s ease;
        }

        .toggle-switch.active::after {
            left: 30px;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background: #e8f5e9;
            color: #2e7d32;
            border: 1px solid #c8e6c9;
        }

        .alert-error {
            background: #ffebee;
            color: #d32f2f;
            border: 1px solid #ffcdd2;
        }

        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: #2e7d32;
            color: white;
        }

        .btn-primary:hover {
            background: #1b5e20;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(46, 125, 50, 0.3);
        }

        .btn-secondary {
            background: #e0e0e0;
            color: #333;
        }

        .btn-secondary:hover {
            background: #d0d0d0;
        }

        .btn-small {
            padding: 8px 12px;
            font-size: 12px;
        }

        .equipment-list {
            display: grid;
            gap: 15px;
        }

        .equipment-item {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 15px;
            background: #f9f9f9;
            transition: all 0.3s ease;
        }

        .equipment-item:hover {
            border-color: #2e7d32;
            background: #f0f8f0;
        }

        .equipment-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .equipment-name {
            font-weight: 600;
            color: #333;
            font-size: 15px;
        }

        .equipment-controls {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-top: 12px;
        }

        .equipment-controls select,
        .equipment-controls textarea {
            width: 100%;
        }

        .table-responsive {
            overflow-x: auto;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table thead {
            background: #f5f5f5;
            border-bottom: 2px solid #e0e0e0;
        }

        table th {
            padding: 12px;
            text-align: left;
            font-weight: 600;
            color: #333;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        table td {
            padding: 12px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 13px;
        }

        table tr:hover {
            background: #f9f9f9;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #2e7d32;
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            gap: 12px;
        }

        .password-requirements {
            background: #f5f5f5;
            border-left: 3px solid #2e7d32;
            padding: 12px;
            border-radius: 4px;
            margin-top: 10px;
            font-size: 12px;
            color: #666;
        }

        .password-requirements ul {
            margin-left: 20px;
            margin-top: 8px;
        }

        .password-requirements li {
            margin-bottom: 4px;
        }

        @media (max-width: 768px) {
            .settings-container {
                grid-template-columns: 1fr;
            }

            .sidebar {
                position: static;
            }

            .main-content {
                padding: 20px;
            }

            .settings-grid {
                grid-template-columns: 1fr;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="settings-container">
        <!-- Sidebar Navigation -->
        <div class="sidebar">
            <div class="sidebar-title">
                <i class="fas fa-cog"></i> Settings
            </div>
            <div class="sidebar-nav">
                <button type="button" class="nav-btn active" data-section="equipment">
                    <i class="fas fa-tools"></i> Equipment
                </button>
                <button type="button" class="nav-btn" data-section="account">
                    <i class="fas fa-user"></i> Account
                </button>
                <button type="button" class="nav-btn" data-section="security">
                    <i class="fas fa-shield-alt"></i> Security
                </button>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <a href="{{ route('admin.dashboard') }}" class="back-link">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>

            <!-- Account Settings -->
            <div id="account-section" class="content-section">
                <div class="section-header">
                    <div class="section-title">
                        <i class="fas fa-user"></i> Account Settings
                    </div>
                    <div class="section-subtitle">Manage your account information and password</div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        <div>{{ session('success') }}</div>
                    </div>
                @endif

                <!-- Account Information Form -->
                <form action="{{ route('settings.account.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-section-title">Profile Information</div>

                    @if ($errors->has('email'))
                        <div class="alert alert-error">
                            <i class="fas fa-exclamation-circle"></i>
                            <div>{{ $errors->first('email') }}</div>
                        </div>
                    @endif

                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $currentUser->name) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $currentUser->email) }}" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone', $currentUser->phone) }}">
                        </div>

                        <div class="form-group">
                            <label for="bio">Bio</label>
                            <input type="text" id="bio" name="bio" value="{{ old('bio', $currentUser->bio) }}" placeholder="Brief bio">
                        </div>
                    </div>

                    <div class="button-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Profile
                        </button>
                    </div>
                </form>

                <!-- Change Password Form -->
                <form action="{{ route('settings.password.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-section-title">Change Password</div>

                    @if ($errors->has('current_password') || $errors->has('new_password'))
                        <div class="alert alert-error">
                            <i class="fas fa-exclamation-circle"></i>
                            <div>
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <input type="password" id="current_password" name="current_password" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="new_password">New Password</label>
                            <input type="password" id="new_password" name="new_password" required>
                        </div>

                        <div class="form-group">
                            <label for="new_password_confirmation">Confirm Password</label>
                            <input type="password" id="new_password_confirmation" name="new_password_confirmation" required>
                        </div>
                    </div>

                    <div class="password-requirements">
                        <strong>Password Requirements:</strong>
                        <ul>
                            <li>Minimum 8 characters</li>
                            <li>At least one uppercase letter (A-Z)</li>
                            <li>At least one lowercase letter (a-z)</li>
                            <li>At least one digit (0-9)</li>
                            <li>At least one special character (@$!%*?&)</li>
                        </ul>
                    </div>

                    <div class="button-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-lock"></i> Change Password
                        </button>
                    </div>
                </form>
            </div>

            <!-- Security Settings -->
            <div id="security-section" class="content-section">
                <div class="section-header">
                    <div class="section-title">
                        <i class="fas fa-shield-alt"></i> Security Settings
                    </div>
                    <div class="section-subtitle">Enhance the security of your system</div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        <div>{{ session('success') }}</div>
                    </div>
                @endif

                <form action="{{ route('settings.security.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-section-title">Login Security</div>

                    <div class="toggle-group">
                        <div class="toggle-label">
                            <div class="toggle-label-title">Enable Login Rules</div>
                            <div class="toggle-label-desc">Enable brute force protection and login attempt limiting</div>
                        </div>
                        <div class="toggle-switch" id="loginRulesToggle" data-setting="enable_login_rules" onclick="toggleSetting(this, '{{ route('settings.toggle.loginrules') }}')">
                        </div>
                    </div>

                    @if ($errors->has('max_login_attempts'))
                        <div class="alert alert-error">
                            <i class="fas fa-exclamation-circle"></i>
                            <div>{{ $errors->first('max_login_attempts') }}</div>
                        </div>
                    @endif

                    <div class="form-row">
                        <div class="form-group">
                            <label for="max_login_attempts">Max Login Attempts</label>
                            <input type="number" id="max_login_attempts" name="max_login_attempts" 
                                   value="{{ old('max_login_attempts', $systemSettings['max_login_attempts']) }}"
                                   min="3" max="20" required>
                            <small style="color: #999; margin-top: 5px; display: block;">
                                Number of failed attempts before lockout (3-20)
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="lockout_duration_minutes">Lockout Duration (minutes)</label>
                            <input type="number" id="lockout_duration_minutes" name="lockout_duration_minutes" 
                                   value="{{ old('lockout_duration_minutes', $systemSettings['lockout_duration_minutes']) }}"
                                   min="5" max="1440" required>
                            <small style="color: #999; margin-top: 5px; display: block;">
                                How long to lock the account (5-1440 minutes)
                            </small>
                        </div>
                    </div>

                    <div class="form-section-title">Session Management</div>

                    <div class="form-group">
                        <label for="session_timeout_minutes">Session Timeout (minutes)</label>
                        <input type="number" id="session_timeout_minutes" name="session_timeout_minutes" 
                               value="{{ old('session_timeout_minutes', $systemSettings['session_timeout_minutes']) }}"
                               min="5" max="1440" required>
                        <small style="color: #999; margin-top: 5px; display: block;">
                            Automatically log out after idle period (5-1440 minutes)
                        </small>
                    </div>

                    <div class="button-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Security Settings
                        </button>
                    </div>
                </form>

                <!-- Recent Login Attempts -->
                <div class="form-section-title" style="margin-top: 40px;">Recent Login Activity</div>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Date & Time</th>
                                <th>IP Address</th>
                                <th>Status</th>
                                <th>Reason</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentLoginAttempts as $attempt)
                                <tr>
                                    <td>{{ $attempt->attempted_at->format('M d, Y H:i:s') }}</td>
                                    <td>{{ $attempt->ip_address }}</td>
                                    <td>
                                        @if ($attempt->success)
                                            <span class="status-badge status-available">Success</span>
                                        @else
                                            <span class="status-badge status-unavailable">Failed</span>
                                        @endif
                                    </td>
                                    <td>{{ $attempt->reason ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" style="text-align: center; color: #999;">No login attempts yet</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Tab navigation
        document.querySelectorAll('.nav-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const section = btn.dataset.section;
                
                // Remove active class from all sections and buttons
                document.querySelectorAll('.content-section').forEach(s => s.classList.remove('active'));
                document.querySelectorAll('.nav-btn').forEach(b => b.classList.remove('active'));
                
                // Add active class to selected section and button
                document.getElementById(section + '-section').classList.add('active');
                btn.classList.add('active');
            });
        });

        // Toggle switch functionality
        function toggleSetting(element, url) {
            const isActive = element.classList.toggle('active');
            const settingKey = element.dataset.setting;
            
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify({
                    [settingKey]: isActive
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success notification
                    const alert = document.createElement('div');
                    alert.className = 'alert alert-success';
                    alert.innerHTML = `<i class="fas fa-check-circle"></i><div>${data.message}</div>`;
                    
                    const mainContent = document.querySelector('.main-content');
                    mainContent.insertBefore(alert, mainContent.firstChild);
                    
                    setTimeout(() => alert.remove(), 3000);
                }
            })
            .catch(error => console.error('Error:', error));
        }

        // Initialize toggles based on current values
        window.addEventListener('DOMContentLoaded', function() {
            const autoMarkValue = {{ $systemSettings['auto_mark_unavailable'] ? 'true' : 'false' }};
            const loginRulesValue = {{ $systemSettings['enable_login_rules'] ? 'true' : 'false' }};
            
            if (autoMarkValue) {
                document.getElementById('autoMarkToggle').classList.add('active');
            }
            
            if (loginRulesValue) {
                document.getElementById('loginRulesToggle').classList.add('active');
            }
        });
    </script>
</body>
</html>
