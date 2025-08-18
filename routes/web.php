<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\AuthController;

Route::get('/', [TemplateController::class, 'index']);
Route::get('/book', [TemplateController::class, 'book']);
Route::get('/podcast', [TemplateController::class, 'podcast']);
Route::get('/campaings', [TemplateController::class, 'campaings']);
Route::get('/about', [TemplateController::class, 'about']);
Route::get('/contact', [TemplateController::class, 'contact']);

Route::get('/blog', [TemplateController::class, 'blog']);
Route::get('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'register']);
