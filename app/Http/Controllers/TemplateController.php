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
        $articles_like = Article::with('user')->orderBy('likes', 'desc')->paginate(3);

        // Kategoriler
        $categories = Category::all();

        return view('frontend.blog', compact('articles', 'articles_like', 'categories'));

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

        $articles = Article::with(relations: 'user')->latest()->get();
        $categories = Category::all();

        return view('frontend.admin.blog', compact('articles', 'categories'));
    }

    public function adminMessages() {
        return view('frontend.admin.messages');
    }

    public function adminSettings() {
        return view('frontend.admin.settings');
    }
}
