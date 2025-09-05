<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;

class CategoryController extends Controller
{
    public function show($id)
    {
        // Seçilen kategori
        $category = Category::findOrFail($id);

        // O kategoriye ait yazılar
        $articles = Article::with('user')
            ->where('category_id', $id)
            ->latest()
            ->paginate(3);

        // Tüm kategoriler
        $categories = Category::all();

        return view(
            'frontend.blog.show-category-articles',
            compact('category', 'articles', 'articles_like', 'categories')
        );
    }
}
