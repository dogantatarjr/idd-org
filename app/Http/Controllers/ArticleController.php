<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;

class ArticleController extends Controller
{
    public function show($id)
    {

        $user = Auth::user();

        // Yazılan yazılar
        $article = Article::with(['user', 'category', 'articleComments.user', 'articleComments.children'])->findOrFail($id);

        if($article->status != 'active' && $user->isAdmin()){
            return view('frontend.blog.show-article', compact('article', 'user'));
        } else if ($article->status != 'active') {
            return redirect()->route('blog')->with('error-inactive', 'Bu yazı şu anda aktif değil.');
        }

        return view('frontend.blog.show-article', compact('article', 'user'));
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

        if (Auth::user()->isAdmin()) {
            return redirect()->route('dashboard.blog')->with('success-article', 'Yazı başarıyla güncellendi.');
        } else {

            $article->status = 'waiting';
            $article->save();

            return redirect()->route('blog.profile.articles')->with('success-article', 'Yazı başarıyla güncellendi ve tekrar onay sürecine alındı.');
        }
    }

    public function approve(Article $article)
    {
        $article->status = 'active';
        $article->save();

        return redirect()->route('dashboard.blog')->with('success-article', 'Yazı başarıyla aktive edildi.');
    }

    public function addLike(Request $request)
    {
        $articleId = $request->article_id;
        $article = Article::findOrFail($articleId);

        $likedArticles = session()->get('liked_articles', []);

        if (in_array($articleId, $likedArticles)) {
            $article->decrement('likes');

            $likedArticles = array_diff($likedArticles, [$articleId]);
            session()->put('liked_articles', array_values($likedArticles));

            $status = 'unliked';
        } else {
            $article->increment('likes');

            $likedArticles[] = $articleId;
            session()->put('liked_articles', $likedArticles);

            $status = 'liked';
        }

        return response()->json([
            'success' => true,
            'status' => $status,
            'likes' => $article->likes
        ]);
    }

}
