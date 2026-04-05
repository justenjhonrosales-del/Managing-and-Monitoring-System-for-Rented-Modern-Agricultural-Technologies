<x-guest-layout>
    <style>
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
            border-color: #2e7d32;
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
            margin-bottom: 6px;
        }

        .form-forgot a {
            color: #2e7d32;
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: 600;
            transition: color 0.2s;
        }

        .form-forgot a:hover {
            color: #1b5e20;
        }

        .btn-login {
            padding: 12px 28px;
            background: #2e7d32;
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
            margin-top: 6px;
            width: 100%;
        }

        .btn-login:hover {
            background: #1b5e20;
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
    </style>

    <!-- Session Status -->
    @if (session('status'))
        <div class="auth-session-status">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="login-form">
        @csrf

        <!-- Email Address -->
        <div class="form-group">
            <label for="email">Email</label>
            <input 
                id="email" 
                type="email" 
                name="email" 
                value="{{ old('email') }}" 
                placeholder="Admin@gmail.com"
                required 
                autofocus 
                autocomplete="username" 
            />
            @error('email')
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
                placeholder="••••••••"
                required 
                autocomplete="current-password" 
            />
            @error('password')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>

        <!-- Forgot Password Link -->
        @if (Route::has('password.request'))
            <div class="form-forgot">
                <a href="{{ route('password.request') }}">
                    Forgot password?
                </a>
            </div>
        @endif

        <!-- Login Button -->
        <button type="submit" class="btn-login">LOGIN</button>
    </form>
</x-guest-layout>
