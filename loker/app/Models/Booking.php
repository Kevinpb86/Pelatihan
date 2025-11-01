<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'unit_id',
        'start_time',
        'end_time',
        'total_price',
        'status',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    /**
     * Relasi one-to-one dengan fine
     * Catatan: Jika satu booking bisa memiliki banyak fine, ubah ke hasMany
     */
    public function fine(){
        return $this->hasOne(Fine::class);
    }

    /**
     * Alternatif: Relasi one-to-many dengan fines (jika booking bisa punya banyak fine)
     * Uncomment jika diperlukan:
     */
    // public function fines(){
    //     return $this->hasMany(Fine::class);
    // }
}
