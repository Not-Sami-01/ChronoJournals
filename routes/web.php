<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FrontEndController;
use App\Http\Middleware\AuthMiddleware;
use App\Livewire\Home;
use App\Livewire\Journal;
use App\Livewire\Login;
use App\Livewire\Signup;
use App\Livewire\Testing;
use Illuminate\Support\Facades\Route;


Route::post('api/auth/login', [AuthController::class, 'login']);
Route::post('api/auth/signup', [AuthController::class, 'signup']);

Route::get('/login', Login::class);
Route::get('/signup', Signup::class);
Route::get('/testing', Testing::class);
Route::get('/new', Journal::class)->middleware(AuthMiddleware::class);
Route::get('/', Home::class)->middleware(AuthMiddleware::class);