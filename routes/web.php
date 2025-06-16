<?php

use Illuminate\Support\Facades\Route;



Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/swot', [App\Http\Controllers\HomeController::class, 'swot'])->name('swot');
Route::get('/topsis', [App\Http\Controllers\HomeController::class, 'topsis'])->name('topsis');
Route::get('/rekomendasi', [App\Http\Controllers\HomeController::class, 'rekomendasi'])->name('rekomendasi');
Route::get('/tentang', [App\Http\Controllers\HomeController::class, 'tentang'])->name('tentang');
Route::get('/kontak', [App\Http\Controllers\HomeController::class, 'kontak'])->name('kontak');
Route::get('/daftar', [App\Http\Controllers\HomeController::class, 'daftar'])->name('daftar');
Route::post('/daftar-simpan', [App\Http\Controllers\HomeController::class, 'daftar_store'])->name('daftarStore');
require_once 'admin.php';
