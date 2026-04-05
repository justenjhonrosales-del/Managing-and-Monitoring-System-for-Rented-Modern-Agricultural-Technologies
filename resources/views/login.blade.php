<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgriTech Rent - Welcome Dashboard Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2e7d32;
            --primary-dark: #1b5e20;
            --accent-color: #f9a825;
            --text-dark: #1a1a1a;
            --text-light: #6b7280;
            --white: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DM Sans', 'Segoe UI', Roboto, sans-serif;
            
           background-color: #4caf50;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            background: var(--white);
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 450px;
            padding: 60px 40px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .login-logo {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 10px;
            font-family: 'Playfair Display', serif;
        }

        .login-title {
            font-size: 1.3rem;
            color: var(--text-dark);
            margin-bottom: 8px;
            font-weight: 600;
        }

        .login-subtitle {
            font-size: 0.85rem;
            color: var(--text-light);
        }

        .login-form {
            display: flex;
            flex-direction: column;
            gap: 14px;
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
            background: var(--white);
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

        .alert-error {
            background: #fee2e2;
            border: 1px solid #fecaca;
            color: #dc2626;
            padding: 12px 14px;
            border-radius: 8px;
            margin-bottom: 18px;
            font-size: 0.85rem;
            width: 100%;
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
            width: 100%;
            margin-top: 6px;
        }

        .btn-login:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(46, 125, 50, 0.3);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 40px 24px;
            }

            .login-logo {
                font-size: 2rem;
            }

            .login-title {
                font-size: 1.1rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <div class="login-logo">AgriTech</div>
            <div class="login-title">Welcome Dashboard</div>
            <div class="login-subtitle">Please login to continue</div>
        </div>

        @if ($errors->any())
            <div class="alert-error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('welcome.login') }}" class="login-form">
            @csrf

            <!-- Username -->
            <div class="form-group">
                <label for="username">Username</label>
                <input 
                    id="username" 
                    type="text" 
                    name="username" 
                    value="{{ old('username') }}" 
                    placeholder="Enter username"
                    required 
                    autofocus 
                    autocomplete="username" 
                />
                @error('username')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>
                <input 
                    id="password" 
                    type="password" 
                    name="password" 
                    placeholder="Enter password"
                    required 
                    autocomplete="current-password" 
                />
                @error('password')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Login Button -->
            <button type="submit" class="btn-login">LOGIN</button>
        </form>
    </div>
</body>
</html>

