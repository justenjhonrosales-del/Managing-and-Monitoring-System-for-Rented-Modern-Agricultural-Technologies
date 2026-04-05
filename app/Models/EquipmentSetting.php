<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EquipmentSetting extends Model
{
    protected $table = 'equipment_settings';
    protected $fillable = ['equipment_name', 'status', 'is_available', 'notes'];

    protected $casts = [
        'is_available' => 'boolean',
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
