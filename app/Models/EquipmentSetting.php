<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EquipmentSetting extends Model
{
    protected $table = 'equipment_settings';
    protected $fillable = ['equipment_name', 'status', 'is_available', 'notes', 'total_quantity', 'default_hours', 'hourly_rate'];

    protected $casts = [
        'is_available' => 'boolean',
        'total_quantity' => 'integer',
        'default_hours' => 'decimal:2',
        'hourly_rate' => 'decimal:2',
    ];

    /**
     * Check if equipment is available
     */
    public function isAccessible(): bool
    {
        return $this->is_available && $this->status === 'available';
    }

    /**
     * Get equipment status color
     */
    public function getStatusColor(): string
    {
        return match($this->status) {
            'available' => '#2e7d32',
            'unavailable' => '#d32f2f',
            'under_maintenance' => '#f57c00',
            default => '#757575',
        };
    }
}
