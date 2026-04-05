<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $fillable = [
        'rental_number',
        'customer_name',
        'age',
        'field_area',
        'primary_address',
        'notes',
        'delivery_notes',
        'equipment',
        'status',
        'rental_from',
        'rental_to',
        'total_amount',
        'rental_duration_hours',
    ];

    protected $casts = [
        'equipment' => 'json',
        'rental_from' => 'date',
        'rental_to' => 'date',
    ];

    public static function generateRentalNumber()
    {
        // Get the highest number from existing rentals
        $lastRental = self::select('rental_number')
            ->orderBy('id', 'desc')
            ->first();
        
        if (!$lastRental) {
            return '#R001';
        }
        
        // Extract number from rental_number like "#R001"
        $lastNumber = intval(substr($lastRental->rental_number, 2));
        $nextNumber = $lastNumber + 1;
        
        return '#R' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
    }
}
