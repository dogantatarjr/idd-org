<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;

class ArticleController extends Controller
{
    public function show($id)
    {

        // Yazılan yazılar
        $article = Article::with('user')->findOrFail($id);
        $articles = Article::with('user')->latest()->paginate(3);
        $articles_like = Article::with('user')->orderBy('likes', 'desc')->paginate(3);

        // Kategoriler
        $categories = Category::all();

        return view('frontend.blog.show-article', compact('article', 'articles', 'articles_like', 'categories'));
    }

}
