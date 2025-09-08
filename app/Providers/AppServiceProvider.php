<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\Category;

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
            $categories_popular = Category::withCount('articles')
                ->withSum('articles', 'likes')
                ->get()
                ->map(function ($category) {
                    $category->likePerArticle = $category->articles_count > 0
                        ? $category->articles_sum_likes / $category->articles_count
                        : 0;
                    return $category;
                })
                ->sortByDesc('likePerArticle')
                ->take(5)
                ->values();

            $view->with('categories_popular', $categories_popular);
        });
    }
}
