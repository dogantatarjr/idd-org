<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function show($id)
    {

        // Yazılan yazılar
        $article = Article::with('user')->findOrFail($id);
        $articles_latest = Article::with(relations: 'user')->latest()->limit(3)->get();
        $articles_like = Article::with('user')->orderBy('likes', 'desc')->limit(3)->get();

        // Kategoriler
        $categories = Category::all();

        return view('frontend.blog.show-article', compact('article', 'articles_latest', 'articles_like', 'categories'));
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|url',
            'category' => 'required|exists:categories,id',
        ]);

        $article = new Article();
        $article->title = $validated['title'];
        $article->content = $validated['content'];
        $article->image = $validated['image'];
        $article->category_id = $validated['category'];
        $article->user_id = Auth::id();
        $article->likes = 0;
        $article->save();

        return redirect()->route('blog');
    }

}
