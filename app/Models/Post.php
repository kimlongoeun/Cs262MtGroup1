<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'body',
        'user_id',
        'featured_image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}