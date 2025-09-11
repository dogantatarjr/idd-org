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

    // Scope Definition

    public function scopeArticleActivity($query)
    {
        $query->get()->each(function ($category) {
            if ($category->articles()->where('status', 'active')->count() === 0) {
                $category->status = 'passive';
                $category->save();
            }
        });
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Sadece aktif kategoriler
    // $categories_active = Article::with('user')->status('active')->get();

    // Pasif kategoriler
    // $categories_passive = Article::with('user')->status('passive')->get();

}
