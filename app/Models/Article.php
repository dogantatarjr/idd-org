<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;
use App\Models\Comment;

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

    // Article & Comment ilişkisi
    public function articleComments()
    {
        return $this->hasMany(Comment::class, 'article_id')
        ->whereNull('parent_comment_id')
        ->whereHas('user', function ($query) {
            $query->where('status', 'active');
        })
        ->with(['children.user', 'user']);
    }

    // Article & Like ilişkisi
    public function likes()
    {
        return $this->hasMany(ArticleLike::class);
    }

    // Hangi kullanıcıların beğendiği
    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'article_likes');
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

    // Sadece aktif kategoriler
    // $articles_active = Article::with('user')->status('active')->get();

    // Pasif kategoriler
    // $articles_passive = Article::with('user')->status('passive')->get();

}
