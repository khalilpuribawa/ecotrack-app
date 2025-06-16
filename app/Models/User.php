<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role','points', 'avatar',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Satu user bisa membuat banyak laporan
    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    // Satu user bisa menulis banyak artikel
    public function articles()
    {
        return $this->hasMany(Article::class, 'created_by');
    }
    
    // Satu user bisa menambahkan banyak titik hijau
    public function greenPoints()
    {
        return $this->hasMany(GreenPoint::class, 'added_by');
    }
    
    
    
    // Relasi many-to-many ke Challenges melalui tabel challenge_participants
    public function challenges()
    {
        return $this->belongsToMany(Challenge::class, 'challenge_participants')
                    ->withPivot('status', 'submitted_proof')
                    ->withTimestamps();
    }
    
    // Relasi many-to-many ke Communities melalui tabel community_members
    public function communities()
    {
        return $this->belongsToMany(Community::class, 'community_members')
                    ->withPivot('role')
                    ->withTimestamps();
    }
    // File: app/Models/User.php




}