<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Article;
use App\Models\Category;

class ArticleController extends Controller
{
    public function show($id)
    {
        $user = Auth::user();

        $article = Article::with(['user', 'category', 'articleComments.user', 'articleComments.children'])
            ->findOrFail($id);

        if ($article->status != 'active' && $user->isAdmin()) {
            return view('frontend.blog.show-article', compact('article', 'user'));
        } else if ($article->status != 'active') {
            return redirect()->route('blog')->with('error-inactive', 'Bu yazı şu anda aktif değil.');
        }

        return view('frontend.blog.show-article', compact('article', 'user'));
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'title'    => 'required|string|max:255',
            'content'  => 'required|string',
            'image'    => 'nullable|image|max:5120',
            'category' => 'required|exists:categories,id',
        ]);

        $article = new Article();
        $article->title       = $validated['title'];
        $article->content     = $validated['content'];
        $article->category_id = $validated['category'];
        $article->user_id     = Auth::id();
        $article->likes       = 0;

        // Dosya varsa kaydet
        if ($request->hasFile('image')) {
            try {
                $image = $request->file('image');

                // Benzersiz dosya adı oluştur
                $fileName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

                // storeAs ile kaydet
                $stored = $image->storeAs('article-photos', $fileName, 'public');

                if ($stored) {
                    $article->image = $stored; // "article-photos/123456_abc.jpg"
                    Log::info('Image stored successfully', ['path' => $stored]);
                } else {
                    Log::error('Failed to store image');
                }

            } catch (\Exception $e) {
                Log::error('Image upload error: ' . $e->getMessage());
            }
        }

        $article->save();

        return redirect()->route('blog')->with(
            'success-article-add',
            'Yazı başarıyla yüklendi! Yönetici yazınızı onayladığında sayfada yayınlanacaktır.'
        );
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
            'image'    => 'nullable|image|max:5120',
            'category' => 'required|exists:categories,id',
            'status'   => 'required|in:active,passive,waiting',
        ]);

        $article->title       = $validated['title'];
        $article->content     = $validated['content'];
        $article->category_id = $validated['category'];
        $article->status      = Auth::user()->isAdmin() ? $validated['status'] : 'waiting';

        if ($request->hasFile('image')) {
            try {
                // Eski görseli sil
                if ($article->image && Storage::disk('public')->exists($article->image)) {
                    Storage::disk('public')->delete($article->image);
                }

                $image = $request->file('image');

                // Benzersiz dosya adı oluştur
                $fileName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

                // storeAs ile kaydet
                $stored = $image->storeAs('article-photos', $fileName, 'public');

                if ($stored) {
                    $article->image = $stored; // "article-photos/123456_abc.jpg"
                    Log::info('Image updated successfully', ['path' => $stored]);
                } else {
                    Log::error('Failed to update image');
                }

            } catch (\Exception $e) {
                Log::error('Image update error: ' . $e->getMessage());
            }
        }

        $article->save();

        if (Auth::user()->isAdmin()) {
            return redirect()->route('dashboard.blog')->with('success-article', 'Yazı başarıyla güncellendi.');
        } else {
            return redirect()->route('blog.profile.articles')->with('success-article', 'Yazı başarıyla güncellendi ve tekrar onay sürecine alındı.');
        }
    }

    public function approve(Article $article)
    {
        $article->status = 'active';
        $article->save();

        return redirect()->route('dashboard.blog')->with('success-article', 'Yazı başarıyla aktive edildi.');
    }
}
