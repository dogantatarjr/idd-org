<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\AuthController;
use Spatie\Permission\Middleware\RoleMiddleware;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MessageController;

// Verify middleware eklenebilir ileride.

Route::group(['middleware' => ['role:admin']], function () {

    Route::get('/dashboard', [TemplateController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard/podcasts', [TemplateController::class, 'adminPodcasts'])->name('dashboard.podcasts');
    Route::get('/dashboard/campaigns', [TemplateController::class, 'adminCampaigns'])->name('dashboard.campaigns');
    Route::get('/dashboard/events', [TemplateController::class, 'adminEvents'])->name('dashboard.events');
    Route::get('/dashboard/messages', [TemplateController::class, 'adminMessages'])->name('dashboard.messages');
    Route::post('/dashboard/messages/{message}/mark-read', [MessageController::class, 'markRead'])->name('dashboard.messages.mark-read');
    Route::post('/dashboard/messages/{message}/mark-unread', [MessageController::class, 'markUnread'])->name('dashboard.messages.mark-unread');
    Route::get('/dashboard/blog', [TemplateController::class, 'adminBlog'])->name('dashboard.blog');
    Route::get('/dashboard/blog/pending', [TemplateController::class, 'adminBlogPending'])->name('dashboard.blog.pending');
    Route::get('/dashboard/blog/passive', [TemplateController::class, 'adminBlogPassive'])->name('dashboard.blog.passive');
    Route::get('/dashboard/comments', [TemplateController::class, 'adminComments'])->name('dashboard.comments');
    Route::get('/dashboard/categories', [TemplateController::class, 'adminCategories'])->name('dashboard.blog.categories');
    Route::post('/dashboard/categories', [CategoryController::class, 'add'])->name('dashboard.categories.add');
    Route::put('/dashboard/categories/{category}', [CategoryController::class, 'update'])->name('dashboard.categories.update');
    Route::put('/dashboard/articles/{article}/approve', [ArticleController::class, 'approve'])->name('dashboard.articles.approve');
    Route::get('/dashboard/users', [UserController::class, 'show'])->name('dashboard.users');
    Route::put('/dashboard/users/{user}', [UserController::class, 'update'])->name('dashboard.users.update');

});

Route::group(['middleware' => ['writer|admin']], function () {

    Route::get('/blog/profile/articles', [TemplateController::class, 'myArticles'])->name('blog.profile.articles');
    Route::get('/dashboard/articles/{article}/edit', [ArticleController::class, 'edit'])->name('dashboard.articles.edit');
    Route::put('/dashboard/articles/{article}', [ArticleController::class, 'update'])->name('dashboard.articles.update');
    Route::post('/blog/create', [ArticleController::class, 'create'])->name('blog.create-article');

});

Route::group(['middleware' => ['auth']], function () {

    Route::get('/blog/profile', [TemplateController::class, 'profile'])->name('blog.profile');
    Route::get('/blog/profile/likes', [TemplateController::class, 'likedArticles'])->name('blog.profile.likes');
    Route::get('/blog/profile/comments', [TemplateController::class, 'commentsMade'])->name('blog.profile.comments');
    Route::get('/blog/articles/{id}', [ArticleController::class, 'show'])->name('blog.show');
    Route::post('/comments/add/{article}', [CommentController::class, 'add'])->name('comments.add');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/delete/{comment}', [CommentController::class, 'delete'])->name('comments.delete');
    Route::post('/articles/like', [LikeController::class, 'likeArticle'])->name('articles.like');

});

Route::get('/', [TemplateController::class, 'index'])->name('home');
Route::get('/book', [TemplateController::class, 'book'])->name('book');
Route::get('/podcast', [TemplateController::class, 'podcast'])->name('podcast');
Route::get('/campaings', [TemplateController::class, 'campaings'])->name('campaings');
Route::get('/events', [TemplateController::class,  'events'])->name('events');
Route::get('/about', [TemplateController::class, 'about'])->name('about');
Route::get('/contact', [TemplateController::class, 'contact'])->name('contact');
Route::post('/contact', [MessageController::class, 'submit'])->name('contact.submit');
Route::get('/blog', [TemplateController::class, 'blog'])->name('blog');
Route::get('/login', [AuthController::class, 'authLogin'])->name('auth.login');
Route::get('/register', [AuthController::class, 'authRegister'])->name('auth.register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::put('/profile/update-name', [ProfileController::class, 'updateName'])->name('profile.update.name');
Route::put('/profile/update-email', [ProfileController::class, 'updateEmail'])->name('profile.update.email');
Route::put('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');
Route::post('/profile/deactivate', [ProfileController::class, 'deactivate'])->name('profile.deactivate');
Route::get('/blog/categories/{id}', [CategoryController::class, 'show'])->name('blog.category');
Route::get('/search', [TemplateController::class, 'search'])->name('blog.search');
