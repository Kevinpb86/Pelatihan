<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'location', 'price_per_hour', 'status'];

    /**
     * Relasi one-to-many dengan bookings
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Relasi many-to-many dengan categories melalui pivot table unit_category
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'unit_category')
                    ->withTimestamps();
    }
}
