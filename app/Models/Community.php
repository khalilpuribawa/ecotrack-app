<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'created_by',
    ];
    
    // Setiap komunitas dibuat oleh satu user
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    
    // Relasi many-to-many ke User sebagai anggota
    public function members()
    {
        return $this->belongsToMany(User::class, 'community_members')
                    ->withPivot('role')
                    ->withTimestamps();
    }
}