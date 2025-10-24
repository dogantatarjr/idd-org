<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    protected $fillable = [
        'name',
        'description',
        'time',
        'link',
        'image',
    ];

    protected $casts = [
        'time' => 'datetime',
    ];
}
