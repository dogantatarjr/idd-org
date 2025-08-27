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
        'number_of_articles',
    ];

    // Category & User ilişkisi
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
