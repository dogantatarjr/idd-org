<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'user_id',
    ];

    // Article & User ilişkisi
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Article & Category ilişkisi
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
