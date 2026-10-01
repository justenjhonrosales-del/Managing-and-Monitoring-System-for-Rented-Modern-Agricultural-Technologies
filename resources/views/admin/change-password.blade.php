<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $pageTitle }} - Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin-sidebar.css') }}">
    <style>
        body {
            margin: 0;
            background: #edf1ee;
            font-family: 'DM Sans', sans-serif;
        }

        .admin-change-password-main {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 40px 20px;
            background: rgba(15, 20, 24, 0.12);
        }

        .admin-change-password-card {
            position: relative;
            width: min(100%, 760px);
            padding: 30px 30px 28px;
            border-radius: 18px;
            background: #ffffff;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
        }

        .admin-change-password-close {
            position: absolute;
            top: 16px;
            right: 18px;
            width: 32px;
            height: 32px;
            border: 0;
            border-radius: 50%;
            background: transparent;
            color: #1b2d28;
            font-size: 1.8rem;
            line-height: 1;
            cursor: pointer;
        }

        .admin-change-password-title {
            margin: 0 0 22px;
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.1rem, 3vw, 3rem);
            font-weight: 700;
            line-height: 1.1;
            color: #0e352d;
            text-align: center;
        }

        .admin-change-password-form {
            display: grid;
            gap: 18px;
        }

        .admin-form-group {
            display: grid;
            gap: 8px;
        }

        .admin-form-label {
            font-size: 0.98rem;
            font-weight: 600;
            color: #183f37;
        }

        .admin-form-input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #c7d0cb;
            border-radius: 8px;
            background: #fff;
            font-size: 1rem;
            color: #1a302b;
            box-sizing: border-box;
        }

        .admin-form-input:focus {
            border-color: #1a7f59;
            box-shadow: 0 0 0 3px rgba(26, 127, 89, 0.12);
            outline: none;
        }

        .admin-form-actions {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }

        .admin-form-submit {
            border: none;
            border-radius: 8px;
            background: linear-gradient(135deg, #0a7d52, #1ba35d);
            color: #ffffff;
            font-size: 1.05rem;
            font-weight: 700;
            padding: 14px 26px;
            min-width: 210px;
            cursor: pointer;
            box-shadow: 0 12px 24px rgba(10, 125, 82, 0.18);
        }

        .admin-form-submit:hover {
            opacity: 0.96;
        }

        .admin-form-error {
            color: #b42318;
            font-size: 0.88rem;
            font-weight: 500;
        }

        .admin-success-message {
            margin-bottom: 16px;
            padding: 10px 12px;
            border-radius: 8px;
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #065f46;
            font-size: 0.94rem;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .admin-change-password-card {
                padding: 26px 18px 22px;
            }

            .admin-form-submit {
                width: 100%;
                min-width: 0;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        @include('admin.partials.sidebar')

        <main class="main-content admin-change-password-main">
            <div class="admin-change-password-card" role="dialog" aria-modal="true" aria-labelledby="change-password-title">
                <h1 id="change-password-title" class="admin-change-password-title">Settings</h1>

                @if (session('success'))
                    <div class="admin-success-message" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('settings.password.update') }}" class="admin-change-password-form">
                    @csrf
                    @method('PUT')

                    <div class="admin-form-group">
                        <label for="current_password" class="admin-form-label">Current Password</label>
                        <input id="current_password" name="current_password" type="password" class="admin-form-input" autocomplete="current-password" required>
                        @error('current_password')
                            <span class="admin-form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="admin-form-group">
                        <label for="new_password" class="admin-form-label">New Password</label>
                        <input id="new_password" name="new_password" type="password" class="admin-form-input" autocomplete="new-password" required>
                        @error('new_password')
                            <span class="admin-form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="admin-form-group">
                        <label for="new_password_confirmation" class="admin-form-label">Confirm New Password</label>
                        <input id="new_password_confirmation" name="new_password_confirmation" type="password" class="admin-form-input" autocomplete="new-password" required>
                    </div>

                    <div class="admin-form-actions">
                        <button type="submit" class="admin-form-submit">Change Password</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
