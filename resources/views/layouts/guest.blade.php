<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root {
                --primary-color: #2e7d32;
                --primary-dark: #1b5e20;
                --primary-light: #4caf50;
                --text-dark: #1a1a1a;
                --text-light: #6b7280;
            }

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'DM Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
                background: linear-gradient(135deg, #d4f1de 0%, #c8e6d7 50%, #b8dccf 100%);
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 20px;
            }

            .login-container {
                width: 100%;
                max-width: 380px;
            }

            .login-form-card {
                background: rgba(255, 255, 255, 0.98);
                padding: 40px;
                border-radius: 12px;
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.12);
                position: relative;
            }

            .btn-back {
                position: absolute;
                top: 20px;
                left: 20px;
                background: none;
                border: none;
                cursor: pointer;
                font-size: 1.5rem;
                color: var(--primary-color);
                width: 40px;
                height: 40px;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.3s ease;
                border-radius: 50%;
            }

            .btn-back:hover {
                background: rgba(46, 125, 50, 0.1);
                color: var(--primary-dark);
            }

            .login-form-header {
                margin-bottom: 30px;
                text-align: center;
                padding-top: 10px;
            }

            .login-form-header h1 {
                font-family: 'Playfair Display', serif;
                font-size: 1.6rem;
                color: var(--primary-dark);
                margin-bottom: 8px;
                font-weight: 700;
            }

            .login-form-header p {
                color: var(--text-light);
                font-size: 0.85rem;
            }

            .login-form {
                display: flex;
                flex-direction: column;
                gap: 16px;
                width: 100%;
            }

            .form-group {
                display: flex;
                flex-direction: column;
                margin-bottom: 0;
            }

            .form-group label {
                display: none;
            }

            .form-group input {
                padding: 12px 14px;
                border: 2px solid #e0e0e0;
                border-radius: 6px;
                font-family: inherit;
                font-size: 0.9rem;
                transition: all 0.3s ease;
                background: #f9f9f9;
            }

            .form-group input:focus {
                outline: none;
                border-color: var(--primary-color);
                background: #ffffff;
                box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.1);
            }

            .form-group input::placeholder {
                color: #999;
            }

            .form-error {
                color: #dc2626;
                font-size: 0.8rem;
                margin-top: 4px;
            }

            .form-checkbox {
                display: none;
            }

            .form-forgot {
                text-align: right;
                margin-top: -8px;
                margin-bottom: 8px;
            }

            .form-forgot a {
                color: var(--primary-color);
                text-decoration: none;
                font-size: 0.8rem;
                font-weight: 600;
                transition: color 0.2s;
            }

            .form-forgot a:hover {
                color: var(--primary-dark);
            }

            .btn-login {
                padding: 12px 28px;
                background: var(--primary-color);
                color: white;
                border: none;
                border-radius: 50px;
                font-size: 0.9rem;
                font-weight: 700;
                cursor: pointer;
                transition: all 0.3s ease;
                letter-spacing: 0.05em;
                text-transform: uppercase;
                white-space: nowrap;
                margin-top: 8px;
            }

            .btn-login:hover {
                background: var(--primary-dark);
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(46, 125, 50, 0.3);
            }

            .auth-session-status {
                background: #d4edda;
                border: 1px solid #c3e6cb;
                color: #155724;
                padding: 12px 14px;
                border-radius: 8px;
                margin-bottom: 18px;
                font-size: 0.85rem;
                width: 100%;
            }

            @media (max-width: 480px) {
                .login-form-card {
                    padding: 30px 25px;
                }

                .login-form-header h1 {
                    font-size: 1.4rem;
                }

                .btn-login {
                    width: 100%;
                }
            }
        </style>
    </head>
    <body>
        <div class="login-container">
            <div class="login-form-card">
                <a href="/" class="btn-back" title="Go back">
                    ← 
                </a>
                
                <div class="login-form-header">
                    <h1>Admin Login</h1>
                    <p>Enter your credentials</p>
                </div>

                {{ $slot }}
            </div>
        </div>
    </body>
</html>
