<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'content', 'type', 'url_media', 'created_by',
    ];

    // Setiap artikel ditulis oleh satu user
    public function author()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}