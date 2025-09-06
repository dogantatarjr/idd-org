<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;

class TemplateController extends Controller
{
    public function index()
    {
        return view('frontend.home');
    }

    public function book()
    {
        return view('frontend.book');
    }

    public function podcast()
    {
        return view('frontend.podcast');
    }

    public function campaings()
    {
        return view('frontend.campaigns');
    }

    public function events()
    {
        return view('frontend.events');
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function blog()
    {

        // Yazılan yazılar
        $articles = Article::with(relations: 'user')->latest()->paginate(3);
        $articles_latest = Article::with(relations: 'user')->latest()->limit(3)->get();
        $articles_like = Article::with('user')->orderBy('likes', 'desc')->limit(3)->get();

        // Kategoriler
        $categories = Category::all();

        $categories_popular = $categories->map(function($category) {
            $articleCount = Article::where('category_id', $category->id)->count();
            $totalLikes = Article::where('category_id', $category->id)->sum('likes');

            $category->likePerArticle = $articleCount > 0 ? $totalLikes / $articleCount : 0;

            return $category;
        });

        $categories_popular = $categories->sortByDesc('likePerArticle')->take(3);

        return view('frontend.blog', compact('articles', 'articles_latest', 'articles_like', 'categories', 'categories_popular'));

    }

    // Admin Paneli Sayfaları

    public function dashboard(){
        return view('frontend.admin.dashboard');
    }

    public function adminPodcasts() {
        return view('frontend.admin.podcasts');
    }

    public function adminCampaigns() {
        return view('frontend.admin.campaigns');
    }

    public function adminEvents() {
        return view('frontend.admin.events');
    }

    public function adminBlog() {

        $articles = Article::with(relations: 'user')->latest()->paginate(6);
        $categories = Category::all();

        return view('frontend.admin.blog.blog', compact('articles', 'categories'));
    }

    public function adminMessages() {
        return view('frontend.admin.messages');
    }

    public function adminSettings() {
        return view('frontend.admin.settings');
    }
}
