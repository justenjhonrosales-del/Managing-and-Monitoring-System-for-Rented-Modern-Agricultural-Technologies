<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\WelcomeLoginController;
use Illuminate\Support\Facades\Route;

Route::get('/welcome-login', [WelcomeLoginController::class, 'showLoginForm'])->name('welcome.login.show');
Route::post('/welcome-login', [WelcomeLoginController::class, 'login'])->name('welcome.login');

Route::get('/', function () {
    if (!session('welcome_dashboard_logged_in')) {
        return redirect('/welcome-login');
    }
    return view('welcome');
});

Route::get('/rental', [RentalController::class, 'index'])->name('rental');
Route::post('/rental', [RentalController::class, 'store'])->name('rental.store');
Route::post('/rental/check-duplicate-name', [RentalController::class, 'checkDuplicateName'])->name('rental.checkDuplicateName');

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin/dashboard', function () {
    $rentals = \App\Models\Rental::latest()->get();
    $totalPayment = \App\Models\Rental::where('status', 'completed')
        ->whereNotNull('total_amount')
        ->where('total_amount', '>', 0)
        ->sum('total_amount');
    return view('admin.welcome', compact('rentals', 'totalPayment'));
})->middleware(['auth', 'verified', 'is.admin'])->name('admin.dashboard');

Route::get('/admin/rentals', [RentalController::class, 'manage'])->middleware(['auth', 'verified', 'is.admin'])->name('admin.rentals');
Route::get('/admin/reports', [RentalController::class, 'reports'])->middleware(['auth', 'verified', 'is.admin'])->name('admin.reports');
Route::get('/admin/payments', [RentalController::class, 'payments'])->middleware(['auth', 'verified', 'is.admin'])->name('admin.payments');
Route::get('/admin/payments/export-pdf', [RentalController::class, 'exportPaymentsPdf'])->middleware(['auth', 'verified', 'is.admin'])->name('admin.payments.export');
Route::patch('/admin/rentals/{id}/status', [RentalController::class, 'updateStatus'])->middleware(['auth', 'verified', 'is.admin'])->name('rental.updateStatus');
Route::delete('/admin/rentals/{id}', [RentalController::class, 'destroy'])->middleware(['auth', 'verified', 'is.admin'])->name('rental.destroy');

// Settings routes
Route::get('/admin/settings', [SettingsController::class, 'index'])->middleware(['auth', 'verified', 'is.admin'])->name('admin.settings');
Route::put('/admin/settings/equipment', [SettingsController::class, 'updateEquipmentSettings'])->middleware(['auth', 'verified', 'is.admin'])->name('settings.equipment.update');
Route::put('/admin/settings/security', [SettingsController::class, 'updateSecuritySettings'])->middleware(['auth', 'verified', 'is.admin'])->name('settings.security.update');
Route::put('/admin/settings/account', [SettingsController::class, 'updateAccountSettings'])->middleware(['auth', 'verified', 'is.admin'])->name('settings.account.update');
Route::put('/admin/settings/password', [SettingsController::class, 'updatePassword'])->middleware(['auth', 'verified', 'is.admin'])->name('settings.password.update');
Route::post('/admin/settings/toggle/automark', [SettingsController::class, 'toggleAutoMarkUnavailable'])->middleware(['auth', 'verified', 'is.admin'])->name('settings.toggle.automark');
Route::post('/admin/settings/toggle/loginrules', [SettingsController::class, 'toggleLoginRules'])->middleware(['auth', 'verified', 'is.admin'])->name('settings.toggle.loginrules');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
