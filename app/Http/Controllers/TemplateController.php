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
        $articles = Article::with(relations: 'user')->latestArticles()->paginate(3);
        $articles_latest = Article::with('user')->latestArticles(3)->get();
        $articles_like = Article::with('user')->mostLiked(3)->get();

        // Kategoriler
        $categories = Category::all();

        $categories_popular = Category::withCount('articles')->withSum('articles', 'likes')->get();

        $categories_popular->map(function ($category) {
            $category->likePerArticle = $category->articles_count > 0
                ? $category->articles_sum_likes / $category->articles_count
                : 0;
            return $category;
        });

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
