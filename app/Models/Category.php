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
    public function Categorys()
    {
        return $this->hasMany(Category::class, 'category_id');
    }

    // Category & User ilişkisi
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scope Definition

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Sadece aktif yazılar
    // $categories_active = Category::with('user')->status('active')->get();

    // Pasif yazılar
    // $categories_passive = Category::with('user')->status('passive')->get();

    // Beklemede olanlar
    // $categories_waiting = Category::with('user')->status('waiting')->get();
}
