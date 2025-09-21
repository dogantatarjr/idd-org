<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Article;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        // Share popular categories with all views includes sidebar

        View::composer('frontend.blog.sidebar', function ($view) {
            $categories_popular = Category::status('active')->withCount('articles')
                ->withSum('articles', 'likes')
                ->get()
                ->map(function ($category) {
                    $category->likePerArticle = $category->articles_count > 0
                        ? $category->articles_sum_likes / $category->articles_count
                        : 0;
                    return $category;
                })
                ->sortByDesc('likePerArticle')
                ->take(3)
                ->values();

            $articles_latest = Article::status('active')->latestArticles(3)->get();
            $articles_like = Article::status('active')->mostLiked(3)->get();

            $categories = Category::status('active')->get();

            $view->with('categories_popular', $categories_popular)->with('articles_latest', $articles_latest)->with('articles_like', $articles_like)->with('categories', $categories);
        });

        View::composer('frontend.blog.create-article', function ($view) {
            $categories = Category::status('active')->get();

            $view->with('categories', $categories);
        });
    }
}
