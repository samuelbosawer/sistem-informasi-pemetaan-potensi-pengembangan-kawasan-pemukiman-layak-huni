<?php

use App\Http\Controllers\Admin\RekomendasiWilayahController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {

    Route::controller(RekomendasiWilayahController::class)->group(function(){
        Route::get('wilayah', [RekomendasiWilayahController::class, 'index'])->name('wilayah');
        Route::get('wilayah/tambah', [RekomendasiWilayahController::class, 'create'])->name('wilayah.tambah');
        Route::get('wilayah/detail/{id}', [RekomendasiWilayahController::class, 'show'])->name('wilayah.detail');
        Route::delete('wilayah/{id}', [RekomendasiWilayahController::class, 'destroy'])->name('wilayah.hapus');
        Route::post('wilayah/store', [RekomendasiWilayahController::class, 'store'])->name('wilayah.store');
        Route::get('wilayah/{id}/ubah', [RekomendasiWilayahController::class, 'edit'])->name('wilayah.ubah');
        Route::put('wilayah/{id}', [RekomendasiWilayahController::class, 'update'])->name('wilayah.update');
    });
});
