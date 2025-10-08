<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use App\Models\Comment;

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

        $user = Auth::user();

        // Yazılan yazılar
        $articles = Article::with('category')->status('active')->latestArticles()->paginate(3);

        return view('frontend.blog', compact('articles'));
    }

    // Profil Paneli Sayfaları

    public function profile()
    {
        $user = Auth::user();

        return view('frontend.blog.profile-details.profile', compact('user'));
    }

    public function account()
    {
        return view('frontend.blog.profile-details.account');
    }

    public function likedArticles()
    {
        return view('frontend.blog.profile-details.liked-articles');
    }

    public function commentsMade()
    {
        return view('frontend.blog.profile-details.comments-made');
    }

    public function myArticles()
    {
        return view('frontend.blog.profile-details.my-articles');
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

        Category::articleActivity();

        $user = Auth::user();

        $articles = Article::with('user')->status('active')->latest()->paginate(6);
        $categories = Category::all();

        return view('frontend.admin.blog.blog', compact('articles', 'categories'));
    }

    public function adminBlogPending() {
        Category::articleActivity();

        $user = Auth::user();

        $pendingArticles = [];

        if ($user->isAdmin()) {
            $pendingArticles = Article::with(['category', 'user'])->where('status', 'waiting')->latest()->paginate(6);
        }

        $categories = Category::all();

        return view('frontend.admin.blog.pending-articles', compact('pendingArticles', 'categories'));
    }

    public function adminBlogPassive() {
        Category::articleActivity();

        $user = Auth::user();

        $passiveArticles = Article::with('category')->where('status', 'passive')->latestArticles()->paginate(6);

        $categories = Category::all();

        return view('frontend.admin.blog.passive-articles', compact('passiveArticles', 'categories'));
    }

    public function adminMessages() {
        return view('frontend.admin.messages');
    }

    public function adminCategories() {
        Category::articleActivity();

        $categories = Category::all();

        return view('frontend.admin.blog.categories', compact('categories'));
    }

    public function adminComments() {

        $comments = Comment::with('user')->latest()->paginate(10);

        return view('frontend.admin.comments.comments', compact('comments'));
    }
}
