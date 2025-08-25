<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function show($id)
    {
        $article = Article::with('user')->findOrFail($id);
        return view('frontend.blog.show-article', compact('article'));
    }
}
