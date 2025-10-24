<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name',
        'description',
        'link',
        'image',
        'time',
        'place'
    ];

    protected $casts = [
        'time' => 'datetime',
    ];
}
