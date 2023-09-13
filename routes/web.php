<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\UkerController;
use App\Http\Controllers\TutupMenuController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('dashboard.index');
})->name('dashboard.index')->middleware('auth');

Route::group(['prefix' => 'auth', ['middleware' => ['guest']]] , function () {
    Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('auth.login.post');
    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout')->excludedMiddleware();
});

Route::group(['prefix' => 'users', 'middleware' => ['auth']], function () {
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::get('/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/{user}/update', [UserController::class, 'update'])->name('users.update');
    Route::get('/{user}/delete', [UserController::class, 'destroy'])->name('users.destroy');
});

Route::group(['prefix' => 'tutup', 'middleware' => ['auth']], function () {
    Route::get('/edit', [TutupMenuController::class, 'edit'])->name('tutup.edit'); 
});

Route::group(['prefix' => 'uker', 'middleware' => ['auth']], function () {
    Route::get('/edit', [UkerController::class, 'edit'])->name('uker.edit');

    Route::prefix('history')->group(function () {
        Route::post('/store', [HistoryController::class, 'store'])->name('uker.history.store');
    });
});