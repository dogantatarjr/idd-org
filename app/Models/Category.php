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

    // Category & Article ilişkisi (Popular Categories Algoritması için)
    public function articles()
    {
        return $this->hasMany(Article::class, 'category_id');
    }

    // Category & User ilişkisi
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
