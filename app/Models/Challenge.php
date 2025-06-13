<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'start_date', 'end_date', 'point_reward', 'badge',
    ];

     protected $casts = [
        'start_date' => 'datetime',
        'end_date'   => 'datetime',
    ];

    // Relasi many-to-many ke User melalui tabel challenge_participants
    public function user()
    {
        return $this->belongsToMany(User::class, 'challenge_participants')
                    ->withPivot('status', 'submitted_proof')
                    ->withTimestamps();
    }
}