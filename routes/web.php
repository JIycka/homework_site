<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\AdsController::class, 'index'])->name('index');
Route::get('/{id}', [\App\Http\Controllers\AdsController::class, 'view'])->name('view')
    ->where('id', '[0-9]+');

Route::name('ads.')->prefix('/')->group(function () {
    Route::get('/', [\App\Http\Controllers\AdsController::class, 'index'])->name('index');
    Route::get('/{id}', [\App\Http\Controllers\AdsController::class, 'view'])->name('view')
        ->where('id', '[0-9]+');
    Route::get('/create', [\App\Http\Controllers\AdsController::class, 'create'])->name('create');
    Route::post('/', [\App\Http\Controllers\AdsController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [\App\Http\Controllers\AdsController::class, 'edit'])->name('edit');
    Route::put('/{ad}', [\App\Http\Controllers\AdsController::class, 'update'])
        ->can('update', 'ad')
        ->middleware('auth')
        ->name('update');
    Route::delete('/{id}', [\App\Http\Controllers\AdsController::class, 'destroy'])
        ->can('delete', 'ad')
        ->middleware('auth')
        ->name('destroy');
});

Route::name('users.')->prefix('users')->group(function () {
    Route::get('/', [\App\Http\Controllers\UsersController::class, 'index'])->name('index');
    Route::get('/create', [\App\Http\Controllers\UsersController::class, 'create'])->name('create');
    Route::post('/', [\App\Http\Controllers\UsersController::class, 'store'])->name('store');
    Route::get('/{id}', [\App\Http\Controllers\UsersController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [\App\Http\Controllers\UsersController::class, 'edit'])->name('edit');
    Route::put('/{id}', [\App\Http\Controllers\UsersController::class, 'update'])->name('update');
    Route::delete('/{id}', [\App\Http\Controllers\UsersController::class, 'destroy'])->name('destroy');
});

Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])
    ->middleware('guest')
    ->name('login');
Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');
Route::get('/callback', [\App\Http\Controllers\GoogleController::class, 'callback'])
    ->middleware('guest');
