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
use App\Models\Category;

// Site Sayfaları

Route::get('/', [TemplateController::class, 'index'])->name('home');
Route::get('/book', [TemplateController::class, 'book'])->name('book');
Route::get('/podcast', [TemplateController::class, 'podcast'])->name('podcast');
Route::get('/campaings', [TemplateController::class, 'campaings'])->name('campaings');
Route::get('/events', [TemplateController::class,  'events'])->name('events');
Route::get('/about', [TemplateController::class, 'about'])->name('about');
Route::get('/contact', [TemplateController::class, 'contact'])->name('contact');
Route::get('/blog', [TemplateController::class, 'blog'])->name('blog');

// Authentication Sayfaları

Route::get('/login', [AuthController::class, 'authLogin'])->name('auth.login');
Route::get('/register', [AuthController::class, 'authRegister'])->name('auth.register');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Profil Sayfaları

Route::get('/blog/profile', [TemplateController::class, 'profile'])->middleware('auth')->name('blog.profile');
Route::get('/blog/profile/likes', [TemplateController::class, 'likedArticles'])->middleware('auth')->name('blog.profile.likes');
Route::get('/blog/profile/comments', [TemplateController::class, 'commentsMade'])->middleware('auth')->name('blog.profile.comments');
Route::get('/blog/profile/articles', [TemplateController::class, 'myArticles'])->middleware('role:writer|admin')->name('blog.profile.articles');

Route::put('/profile/update-name', [ProfileController::class, 'updateName'])->name('profile.update.name');
Route::put('/profile/update-email', [ProfileController::class, 'updateEmail'])->name('profile.update.email');
Route::put('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');

Route::post('/profile/deactivate', [ProfileController::class, 'deactivate'])->name('profile.deactivate');

// Blog Sayfaları

Route::get('/blog/articles/{id}', [ArticleController::class, 'show'])->middleware('auth')->name('blog.show');
Route::get('/blog/categories/{id}', [CategoryController::class, 'show'])->name('blog.category');

Route::post('/comments/add/{article}', [CommentController::class, 'add'])->middleware('auth')->name('comments.add');
Route::put('/comments/{comment}', [CommentController::class, 'update'])->middleware('auth')->name('comments.update');
Route::delete('/comments/delete/{comment}', [CommentController::class, 'delete'])->middleware('auth')->name('comments.delete');

Route::post('/addLike', [ArticleController::class, 'addLike'])->middleware('auth')->name('addLike');

Route::get('/dashboard', function () {
    return view('frontend.admin.dashboard');
})->middleware(['role:admin'])->name('admin.dashboard');

Route::post('/blog/create', [ArticleController::class, 'create'])->middleware('role:writer|admin')->name('blog.create-article');

// Admin Paneli Sayfaları

Route::get('/dashboard', [TemplateController::class, 'dashboard'])->middleware('role:admin')->name('dashboard');
Route::get('/dashboard/podcasts', [TemplateController::class, 'adminPodcasts'])->middleware('role:admin')->name('dashboard.podcasts');
Route::get('/dashboard/campaigns', [TemplateController::class, 'adminCampaigns'])->middleware('role:admin')->name('dashboard.campaigns');
Route::get('/dashboard/events', [TemplateController::class, 'adminEvents'])->middleware('role:admin')->name('dashboard.events');
Route::get('/dashboard/messages', [TemplateController::class, 'adminMessages'])->middleware('role:admin')->name('dashboard.messages');

// Admin Blog Management Page

Route::get('/dashboard/blog', [TemplateController::class, 'adminBlog'])->middleware('role:admin')->name('dashboard.blog');
Route::get('/dashboard/blog/pending', [TemplateController::class, 'adminBlogPending'])->middleware('role:admin')->name('dashboard.blog.pending');
Route::get('/dashboard/blog/passive', [TemplateController::class, 'adminBlogPassive'])->middleware('role:admin')->name('dashboard.blog.passive');

Route::get('/dashboard/comments', [TemplateController::class, 'adminComments'])->middleware('role:admin')->name('dashboard.comments');
Route::get('/dashboard/categories', [TemplateController::class, 'adminCategories'])->middleware('role:admin')->name('dashboard.blog.categories');

Route::post('/dashboard/categories', [CategoryController::class, 'add'])->middleware('role:admin')->name('dashboard.categories.add');
Route::put('/dashboard/categories/{category}', [CategoryController::class, 'update'])->middleware('role:admin')->name('dashboard.categories.update');
Route::get('/dashboard/articles/{article}/edit', [ArticleController::class, 'edit'])->middleware('role:admin|writer')->name('dashboard.articles.edit');
Route::put('/dashboard/articles/{article}', [ArticleController::class, 'update'])->middleware('role:admin|writer')->name('dashboard.articles.update');
Route::put('/dashboard/articles/{article}/approve', [ArticleController::class, 'approve'])->middleware('role:admin')->name('dashboard.articles.approve');

// Admin User Page

Route::get('/dashboard/users', [UserController::class, 'show'])->middleware('role:admin')->name('dashboard.users');
Route::put('/dashboard/users/{user}', [UserController::class, 'update'])->middleware('role:admin')->name('dashboard.users.update');
