<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'amount',
        'paid',
    ];

    /**
     * Relasi many-to-one dengan booking
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
