<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'location', 'price_per_hour', 'status'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
