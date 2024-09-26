<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\FrontEndController;
use App\Http\Middleware\AuthMiddleware;
use App\Livewire\Admin;
use App\Livewire\FileDownload;
use App\Livewire\Home;
use App\Livewire\Journal;
use App\Livewire\Login;
use App\Livewire\Signup;
use App\Livewire\MyRecycleBin;
use Illuminate\Support\Facades\Route;

Route::post('/destroy-session', function () {
    session()->flush();
    return response()->json(['status' => 'Session destroyed']);
});

Route::post('api/auth/login', [AuthController::class, 'login']);
Route::post('api/auth/signup', [AuthController::class, 'signup']);

Route::get('/login', Login::class);
Route::get('/signup', Signup::class);
Route::get('/journal/{id?}', Journal::class)->middleware(AuthMiddleware::class)->name('journal');
Route::get('/recyclebin', MyRecycleBin::class)->middleware(AuthMiddleware::class);
Route::get('/', Home::class)->middleware(AuthMiddleware::class);
Route::get('/all', Home::class)->middleware(AuthMiddleware::class);
Route::get('/download', action: FileDownload::class)->middleware(AuthMiddleware::class)->name('download');

// Route::get('/admin', Admin::class);