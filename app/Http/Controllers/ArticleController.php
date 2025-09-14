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
        $article = Article::with('category')->with('user')->findOrFail($id);

        if ($article->status != 'active') {
            return redirect()->route('blog')->with('error-inactive', 'Bu yazı şu anda aktif değil.');
        }

        return view('frontend.blog.show-article', compact('article'));
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

        return redirect()->route('blog')->with('success-article-add', 'Yazı başarıyla yüklendi! Yönetici yazınızı onayladığında sayfada yayınlanacaktır.');;
    }

    public function edit(Article $article)
    {
        $categories = Category::all();
        return view('frontend.admin.blog.edit-article', compact('categories', 'article'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title'    => 'required|string|max:255',
            'content'  => 'required|string',
            'image'    => 'nullable|url',
            'category' => 'required|exists:categories,id',
            'status'   => 'required|in:active,passive,waiting',
        ]);

        $article->title       = $validated['title'];
        $article->content     = $validated['content'];
        $article->image       = $validated['image'];
        $article->category_id = $validated['category'];
        $article->status      = $validated['status'];
        $article->save();

        return redirect()->route('dashboard.blog')->with('success-article', 'Yazı başarıyla güncellendi.');
    }


}
