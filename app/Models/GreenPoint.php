<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GreenPoint extends Model
{
    use HasFactory;
    
    protected $table = 'green_points';

    protected $fillable = [
        'type', 'name', 'description', 'latitude', 'longitude', 'added_by', 'verified',
    ];

    // Setiap titik hijau ditambahkan oleh satu user
    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }
}