<?php

use App\Http\Controllers\Admin\RekomendasiWilayahController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {

    Route::controller(RekomendasiWilayahController::class)->group(function(){
        Route::get('rekomendasi', [RekomendasiWilayahController::class, 'index'])->name('rekomendasi');
        Route::get('rekomendasi/tambah', [RekomendasiWilayahController::class, 'create'])->name('rekomendasi.tambah');
        Route::get('rekomendasi/detail/{id}', [RekomendasiWilayahController::class, 'show'])->name('rekomendasi.detail');
        Route::delete('rekomendasi/{id}', [RekomendasiWilayahController::class, 'destroy'])->name('rekomendasi.hapus');
        Route::post('rekomendasi/store', [RekomendasiWilayahController::class, 'store'])->name('rekomendasi.store');
        Route::get('rekomendasi/{id}/ubah', [RekomendasiWilayahController::class, 'edit'])->name('rekomendasi.ubah');
        Route::put('rekomendasi/{id}', [RekomendasiWilayahController::class, 'update'])->name('rekomendasi.update');


        Route::get('rekomendasi/pdf', [RekomendasiWilayahController::class, 'pdf'])->name('rekomendasi.pdf');

    });
});
