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

    // Scope Definitions

    public function scopeLatestArticles($query, $limit=3)
    {
        return $query->latest()->limit($limit);
    }

    public function scopeMostLiked($query, $limit = 3)
    {
        return $query->orderBy('likes', 'desc')->limit($limit);
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Sadece aktif yazılar
    // $articles_active = Article::with('user')->status('active')->get();

    // Pasif yazılar
    // $articles_passive = Article::with('user')->status('passive')->get();

    // Beklemede olanlar
    // $articles_waiting = Article::with('user')->status('waiting')->get();

}
