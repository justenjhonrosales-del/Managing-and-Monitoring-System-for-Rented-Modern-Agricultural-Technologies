<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('equipment_settings', function (Blueprint $table) {
            $table->decimal('default_hours', 5, 2)->default(1)->after('total_quantity');
            $table->decimal('hourly_rate', 10, 2)->default(0)->after('default_hours');
        });

        $equipmentRates = [
            'Tractor' => 500,
            'Kuliglig' => 300,
            'Parang' => 100,
            'Harvester' => 1000,
            'Rototiller' => 400,
            'Brush Cutter' => 250,
        ];

        foreach ($equipmentRates as $name => $rate) {
            $existing = DB::table('equipment_settings')->where('equipment_name', $name)->first();
            $values = ['hourly_rate' => $rate, 'updated_at' => now()];

            if ($existing) {
                DB::table('equipment_settings')->where('id', $existing->id)->update($values);
            } else {
                DB::table('equipment_settings')->insert($values + [
                    'equipment_name' => $name,
                    'status' => 'available',
                    'is_available' => true,
                    'total_quantity' => 1,
                    'default_hours' => 1,
                    'created_at' => now(),
                ]);
            }
        }
    }

    public function down(): void
    {
        Schema::table('equipment_settings', function (Blueprint $table) {
            $table->dropColumn(['default_hours', 'hourly_rate']);
        });
    }
};