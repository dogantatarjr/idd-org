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

        $articles = Article::with('user')->latest()->paginate(3);
        $articles_like = Article::with('user')->orderBy('likes', 'desc')->paginate(3);

        $categories = Category::all();

        return view('frontend.blog', compact('articles', 'articles_like', 'categories'));

    }
}
