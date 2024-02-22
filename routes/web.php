<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeminjamanController;

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
Route::get('/logout', [AuthController::class, 'logout']);
Route::middleware(['guest'])->group(function () {
    Route::get('/register', [AuthController::class, 'register']);
    Route::post('/register', [AuthController::class, 'store']);
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'check']);
    

});

Route::middleware(['auth'])->group(function () {
    Route::get('/pinjam-buku/{id}', [PeminjamanController::class, 'pinjam']);
    Route::get('/daftar-pinjam', [UserController::class, 'listPinjam']);
});

Route::middleware(['auth','only-admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
});

Route::middleware(['auth', 'only-petugas'])->group(function () {
    
});

Route::middleware(['auth', 'admin-petugas'])->group(function () {
    Route::get('/category', [CategoryController::class, 'index']);
    Route::get('/category-tambah', [CategoryController::class, 'create']);
    Route::post('/category', [CategoryController::class, 'store']);
    Route::get('/category-edit/{id}', [CategoryController::class, 'edit']);
    Route::put('/category-update', [CategoryController::class, 'update']);
    Route::delete('/category-hapus', [CategoryController::class, 'destroy']);



    Route::get('/buku', [BookController::class, 'index']);
    Route::get('/buku-tambah', [BookController::class, 'create']);
    Route::post('/buku', [BookController::class, 'store']);
    Route::get('/buku-edit/{id}', [BookController::class, 'edit']);
    Route::put('/buku-update', [BookController::class, 'update']);
    Route::delete('/buku-hapus', [BookController::class, 'destroy']);

    Route::get('/user', [UserController::class, 'index']);
    Route::post('/user', [UserController::class, 'store']);
    Route::get('/user-tambah', [UserController::class, 'create']);
    Route::get('/user-acc/{id}', [UserController::class, 'acc']);
    Route::get('/user-down/{id}', [UserController::class, 'down']);

});

    Route::get('/home', [HomeController::class, 'index']);
