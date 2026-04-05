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
        Schema::create('equipment_settings', function (Blueprint $table) {
            $table->id();
            $table->string('equipment_name')->unique(); // Tractor, Reaper/Thresher, Kuliglig
            $table->enum('status', ['available', 'unavailable', 'under_maintenance'])->default('available');
            $table->boolean('is_available')->default(true);
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // Insert default equipment settings
        \DB::table('equipment_settings')->insert([
            [
                'equipment_name' => 'Tractor',
                'status' => 'available',
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'equipment_name' => 'Reaper or Thresher',
                'status' => 'available',
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'equipment_name' => 'Kuliglig',
                'status' => 'available',
                'is_available' => true,
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
        Schema::dropIfExists('equipment_settings');
    }
};
