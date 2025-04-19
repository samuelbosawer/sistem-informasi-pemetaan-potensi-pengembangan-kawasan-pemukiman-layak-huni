<?php

use App\Http\Controllers\Admin\JenisKriteriaController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {

    Route::controller(JenisKriteriaController::class)->group(function(){
        Route::get('jenis-kriteria', [JenisKriteriaController::class, 'index'])->name('jenis-kriteria');
        Route::get('jenis-kriteria/tambah', [JenisKriteriaController::class, 'create'])->name('jenis-kriteria.tambah');
        Route::get('jenis-kriteria/detail/{id}', [JenisKriteriaController::class, 'show'])->name('jenis-kriteria.detail');
        Route::delete('jenis-kriteria/{id}', [JenisKriteriaController::class, 'destroy'])->name('jenis-kriteria.hapus');
        Route::post('jenis-kriteria/store', [JenisKriteriaController::class, 'store'])->name('jenis-kriteria.store');
        Route::get('jenis-kriteria/{id}/ubah', [JenisKriteriaController::class, 'edit'])->name('jenis-kriteria.ubah');
        Route::put('jenis-kriteria/{id}', [JenisKriteriaController::class, 'update'])->name('jenis-kriteria.update');
    });
});
