<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'category', 'description', 'latitude', 'longitude', 'image', 'status'
    ];

    // Setiap laporan dimiliki oleh satu user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}