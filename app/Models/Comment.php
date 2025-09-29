<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['content', 'article_id', 'parent_comment_id', 'user_id'];

    // Comment & User ilişkisi
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Comment & Article ilişkisi
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    // Parent Comments ilişkisi
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_comment_id');
    }

    // Child Comments ilişkisi
    public function children()
    {
        return $this->hasMany(Comment::class, 'parent_comment_id')
            ->whereHas('user', function ($q) {
                $q->where('status', 'active'); // Burada filtreyi koyduk
            });
    }
}
