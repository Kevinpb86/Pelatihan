<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Relasi many-to-many dengan units melalui pivot table unit_category
     */
    public function units()
    {
        return $this->belongsToMany(Unit::class, 'unit_category')
                    ->withTimestamps();
    }
}
