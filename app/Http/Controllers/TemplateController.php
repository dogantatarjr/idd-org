<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Message;
use App\Models\Campaign;
use App\Models\Event;
use App\Models\Podcast;
use App\Models\Carousel;

class TemplateController extends Controller
{
    public function index()
    {
        $carousels = Carousel::all();

        return view('frontend.home', compact('carousels'));
    }

    public function book()
    {
        return view('frontend.book');
    }

    public function podcast()
    {
        $podcasts = Podcast::all();

        return view('frontend.podcast', compact('podcasts'));
    }

    public function campaings()
    {
        $campaigns = Campaign::all();

        return view('frontend.campaigns', compact('campaigns'));
    }

    public function events()
    {
        $events = Event::all();

        return view('frontend.events', compact('events'));
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

    public function search(Request $request)
    {
        $query = $request->input('query');

        $articles = Article::where('title', 'like', '%' . $query . '%')->orWhere('content', 'like', '%' . $query . '%')->status('active')->latestArticles()->paginate(3);

        $articles->appends(['query' => $query]);

        return view('frontend.blog.search-results', compact('articles', 'query'));
    }

    // Profil Paneli Sayfaları

    public function profile()
    {
        $user = Auth::user();

        return view('frontend.blog.profile-details.profile', compact('user'));
    }

    public function likedArticles()
    {
        $user = Auth::user();
        $likedArticles = Like::where('user_id', $user->id)->with('article')->get()->pluck('article');

        return view('frontend.blog.profile-details.liked-articles', compact("likedArticles"));
    }

    public function commentsMade()
    {

        $comments = Comment::where('user_id', Auth::id())->latest()->paginate(10);

        return view('frontend.blog.profile-details.comments-made', compact('comments'));
    }

    public function myArticles()
    {

        $articles = Article::where('user_id', Auth::id())->latest()->paginate(10);

        return view('frontend.blog.profile-details.my-articles', compact('articles'));
    }

    // Admin Paneli Sayfaları

    public function dashboard(){
        return view('frontend.admin.dashboard');
    }

    public function adminPodcasts() {

        $podcasts = Podcast::orderBy('created_at', 'desc')->paginate(9);

        return view('frontend.admin.podcasts.podcasts', compact('podcasts'));
    }

    public function adminCampaigns() {

        $campaigns = Campaign::orderBy('created_at', 'desc')->paginate(9);

        return view('frontend.admin.campaigns.campaigns', compact('campaigns'));
    }

    public function adminEvents() {
        $events = Event::orderBy('time', 'desc')->paginate(9);

        return view('frontend.admin.events.events', compact('events'));
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
        $messages = Message::visibleMessages()->paginate(10);

        return view('frontend.admin.messages', compact('messages'));
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
