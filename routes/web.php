<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TemplateController;

Route::get('/', [TemplateController::class, 'index']);
Route::get('/book', [TemplateController::class, 'book']);
Route::get('/podcast', [TemplateController::class, 'podcast']);
Route::get('/campaings', [TemplateController::class, 'campaings']);
Route::get('/about', [TemplateController::class, 'about']);
Route::get('/contact', [TemplateController::class, 'contact']);
Route::get('/blog', [TemplateController::class, 'blog']);
