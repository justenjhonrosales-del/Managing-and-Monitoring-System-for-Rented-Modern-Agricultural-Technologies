<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('system_settings', function (Blueprint $table) {
            $table->id();
            $table->string('setting_key')->unique();
            $table->longText('setting_value')->nullable();
            $table->string('description')->nullable();
            $table->string('category')->default('general'); // general, equipment, security, account
            $table->timestamps();
        });

        // Insert default settings
        \DB::table('system_settings')->insert([
            [
                'setting_key' => 'session_timeout_minutes',
                'setting_value' => '30',
                'description' => 'Session timeout in minutes',
                'category' => 'security',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'setting_key' => 'max_login_attempts',
                'setting_value' => '5',
                'description' => 'Maximum login attempts before lockout',
                'category' => 'security',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'setting_key' => 'lockout_duration_minutes',
                'setting_value' => '15',
                'description' => 'Duration of account lockout in minutes',
                'category' => 'security',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'setting_key' => 'auto_mark_unavailable',
                'setting_value' => '1',
                'description' => 'Automatically mark equipment unavailable when rented',
                'category' => 'equipment',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'setting_key' => 'enable_login_rules',
                'setting_value' => '1',
                'description' => 'Enable enhanced login authentication rules',
                'category' => 'security',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_settings');
    }
};
