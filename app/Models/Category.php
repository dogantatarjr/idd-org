<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'id',
        'status',
    ];

    // Category & User ilişkisi
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
