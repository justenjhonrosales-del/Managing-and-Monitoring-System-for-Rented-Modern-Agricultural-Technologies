@if (session('welcome_dashboard_logged_in') && session('welcome_dashboard_role') === 'staff')
    <style>
        .nav-settings {
            border: 0;
            padding: 0;
            background: transparent;
            color: inherit;
            font: inherit;
            font-weight: 500;
            cursor: pointer;
        }

        .nav-settings:hover { color: #2e7d32; }

        .settings-modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 10000;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: rgba(15, 23, 42, 0.45);
        }

        .settings-modal-overlay.show { display: flex; }

        .settings-modal {
            width: 100%;
            max-width: 440px;
            padding: 28px;
            border-radius: 12px;
            background: #ffffff;
            box-shadow: 0 20px 45px rgba(15, 23, 42, 0.2);
            color: #1a1a1a;
        }

        .settings-modal h2 {
            margin: 0 0 22px;
            color: #1b5e20;
            font-family: 'Playfair Display', serif;
            font-size: 1.7rem;
        }

        .settings-modal h3 { margin: 0 0 16px; font-size: 1.1rem; }
        .settings-modal .form-group { margin-bottom: 16px; }
        .settings-modal label { display: block; margin-bottom: 6px; font-weight: 600; }
        .settings-modal input { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font: inherit; }
        .settings-modal-error { margin-top: 5px; color: #dc2626; font-size: 0.82rem; }
        .settings-modal-success { margin-bottom: 16px; padding: 10px 12px; border-radius: 6px; background: #d4edda; color: #155724; }
        .settings-modal-actions { display: flex; gap: 10px; justify-content: flex-end; margin-top: 22px; }
        .settings-modal-actions button { padding: 10px 16px; border: 0; border-radius: 6px; font: inherit; font-weight: 600; cursor: pointer; }
        .settings-modal-submit { background: #2e7d32; color: #ffffff; }
        .settings-modal-cancel { background: #e5e7eb; color: #1a1a1a; }

        @media (max-width: 480px) {
            .settings-modal { padding: 22px; }
            .settings-modal-actions { flex-direction: column-reverse; }
            .settings-modal-actions button { width: 100%; }
        }
    </style>

    <div class="settings-modal-overlay {{ session('staff_password_changed') || $errors->staffPassword->any() ? 'show' : '' }}" id="settingsModal" aria-hidden="{{ session('staff_password_changed') || $errors->staffPassword->any() ? 'false' : 'true' }}">
        <div class="settings-modal" role="dialog" aria-modal="true" aria-labelledby="settingsModalTitle">
            <h2 id="settingsModalTitle">Settings</h2>

            @if (session('staff_password_changed'))
                <div class="settings-modal-success">{{ session('staff_password_changed') }}</div>
            @endif

            <h3>Change Password</h3>
            <form method="POST" action="{{ route('staff.password.update') }}">
                @csrf
                <div class="form-group">
                    <label for="staffCurrentPassword">Current Password</label>
                    <input id="staffCurrentPassword" type="password" name="current_password" autocomplete="current-password" required>
                    @error('current_password', 'staffPassword')
                        <div class="settings-modal-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="staffNewPassword">New Password</label>
                    <input id="staffNewPassword" type="password" name="new_password" autocomplete="new-password" required>
                    @error('new_password', 'staffPassword')
                        <div class="settings-modal-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="staffNewPasswordConfirmation">Confirm New Password</label>
                    <input id="staffNewPasswordConfirmation" type="password" name="new_password_confirmation" autocomplete="new-password" required>
                    @error('new_password_confirmation', 'staffPassword')
                        <div class="settings-modal-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="settings-modal-actions">
                    <button type="button" class="settings-modal-cancel" id="closeSettingsModal">Cancel</button>
                    <button type="submit" class="settings-modal-submit">Change Password</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const settingsModal = document.getElementById('settingsModal');
        const openSettingsModal = document.getElementById('openSettingsModal');
        const closeSettingsModal = document.getElementById('closeSettingsModal');

        openSettingsModal?.addEventListener('click', function() {
            settingsModal.classList.add('show');
            settingsModal.setAttribute('aria-hidden', 'false');
        });

        closeSettingsModal?.addEventListener('click', function() {
            settingsModal.classList.remove('show');
            settingsModal.setAttribute('aria-hidden', 'true');
        });

        settingsModal?.addEventListener('click', function(event) {
            if (event.target === settingsModal) {
                closeSettingsModal.click();
            }
        });
    </script>
@endif
