<?php

use App\Http\Controllers\Admin\KriteriaController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {

    Route::controller(KriteriaController::class)->group(function(){
        Route::get('kriteria', [KriteriaController::class, 'index'])->name('kriteria');
        Route::get('kriteria/tambah', [KriteriaController::class, 'create'])->name('kriteria.tambah');
        Route::get('kriteria/detail/{id}', [KriteriaController::class, 'show'])->name('kriteria.detail');
        Route::delete('kriteria/{id}', [KriteriaController::class, 'destroy'])->name('kriteria.hapus');
        Route::post('kriteria/store', [KriteriaController::class, 'store'])->name('kriteria.store');
        Route::get('kriteria/{id}/ubah', [KriteriaController::class, 'edit'])->name('kriteria.ubah');
        Route::put('kriteria/{id}', [KriteriaController::class, 'update'])->name('kriteria.update');
    });
});
