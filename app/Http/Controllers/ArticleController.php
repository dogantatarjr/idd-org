<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function show($id)
    {
        $article = Article::with('user')->findOrFail($id);
        $articles = Article::with('user')->latest()->paginate(3);
        $articles_like = Article::with('user')->orderBy('likes', 'desc')->paginate(3);
        return view('frontend.blog.show-article', compact('article', 'articles', 'articles_like'));
    }

}
