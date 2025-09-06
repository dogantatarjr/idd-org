<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\AuthController;
use Spatie\Permission\Middleware\RoleMiddleware;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
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

// Blog Sayfaları

Route::get('/blog/articles/{id}', [ArticleController::class, 'show'])->middleware('auth')->name('blog.show');
Route::get('/blog/categories/{id}', [CategoryController::class, 'show'])->name('blog.category');

Route::get('/dashboard', function () {
    return view('frontend.admin.dashboard');
})->middleware(['role:admin'])->name('admin.dashboard');

Route::post('/blog/create', [ArticleController::class, 'create'])->middleware('role:writer|admin')->name('blog.create-article');

// Admin Paneli Sayfaları

Route::get('/dashboard', [TemplateController::class, 'dashboard'])->name('dashboard');
Route::get('/dashboard/podcasts', [TemplateController::class, 'adminPodcasts'])->name('dashboard.podcasts');
Route::get('/dashboard/campaigns', [TemplateController::class, 'adminCampaigns'])->name('dashboard.campaigns');
Route::get('/dashboard/events', [TemplateController::class, 'adminEvents'])->name('dashboard.events');

// Admin Blog Management Page

Route::get('/dashboard/blog', [TemplateController::class, 'adminBlog'])->name('dashboard.blog');
Route::post('/dashboard/categories', [CategoryController::class, 'add'])->name('dashboard.categories.add');
Route::put('/dashboard/categories/{category}', [CategoryController::class, 'update'])->name('dashboard.categories.update');

// Admin User Page

Route::get('/dashboard/users', [UserController::class, 'show'])->name('dashboard.users');
Route::put('/dashboard/users/{user}', [UserController::class, 'update'])->name('dashboard.users.update');

Route::get('/dashboard/messages', [TemplateController::class, 'adminMessages'])->name('dashboard.messages');
Route::get('/dashboard/settings', [TemplateController::class, 'adminSettings'])->name('dashboard.settings');
