<?php

use App\Http\Controllers\articleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//Controller User
Route::get('/',[UserController::class,'showHome'])->name('article.home');
Route::get('/article/{id}', [UserController::class, 'show'])->name('article.detail');
Route::get('/artikel',[UserController::class, 'showdetail']);

//Controller Admin
Route::get('/admin/dashboard',[articleController::class, 'showDashboard'])->name('article.dashboard')->middleware('auth');// Halaman di dalam grup ini TIDAK BISA diakses publik

Route::get('/admin/new-article',[articleController::class, 'showNewArticle'])->name('article.NewArticle');

Route::get('/daftar-admin',[AuthController::class, 'showDaftarAdmin'])->name('article.DaftarAdmin')->middleware('auth');
Route::delete('/daftar-admin/{id}',[AuthController::class, 'deleteAdmin'])->name('admin.delete')->middleware('auth');

//Controller Autentikasi admin
Route::get('/login',[AuthController::class,'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/registrasi', [AuthController::class, 'showRegistrasi'])->name('registrasi')->middleware('auth');
Route::post('/registrasi', [AuthController::class, 'registrasi'])->name('registrasi.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



//Controller store,update,destroy
Route::post('/admin/new-article',[articleController::class, 'store'])->name('article.store');
Route::get('/admin/new-article/edit/{id}',[articleController::class, 'edit'])->name('article.edit');
Route::put('/admin/dashboard/{id}',[articleController::class, 'update'])->name('article.update');
Route::delete('/admin/dashboard/{id}', [articleController::class, 'delete'])->name('article.delete');
