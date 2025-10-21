<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['name', 'email', 'subject', 'message'];

    public function scopeVisibleMessages($query)
    {
        return $query->where('created_at', '>=', now()->subDays(30))->orderBy('status')->latest();
    }

}
