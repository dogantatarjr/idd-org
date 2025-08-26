<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\AuthController;
use Spatie\Permission\Middleware\RoleMiddleware;
use App\Http\Controllers\ArticleController;

Route::get('/', [TemplateController::class, 'index'])->name('home');
Route::get('/book', [TemplateController::class, 'book'])->name('book');
Route::get('/podcast', [TemplateController::class, 'podcast'])->name('podcast');
Route::get('/campaings', [TemplateController::class, 'campaings'])->name('campaings');
Route::get('/events', [TemplateController::class,  'events'])->name('events');
Route::get('/about', [TemplateController::class, 'about'])->name('about');
Route::get('/contact', [TemplateController::class, 'contact'])->name('contact');

Route::get('/blog', [TemplateController::class, 'blog'])->name('blog');

Route::get('/login', [AuthController::class, 'authLogin'])->name('auth.login');
Route::get('/register', [AuthController::class, 'authRegister'])->name('auth.register');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/blog/articles/{id}', [ArticleController::class, 'show'])->middleware('auth')->name('blog.show');
