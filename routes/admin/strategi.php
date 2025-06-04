<?php

use App\Http\Controllers\Admin\StrategiController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {

    Route::controller(StrategiController::class)->group(function(){
        Route::get('strategi', [StrategiController::class, 'index'])->name('strategi');
        Route::get('strategi/tambah', [StrategiController::class, 'create'])->name('strategi.tambah');
        Route::get('strategi/detail/{id}', [StrategiController::class, 'show'])->name('strategi.detail');
        Route::delete('strategi/{id}', [StrategiController::class, 'destroy'])->name('strategi.hapus');
        Route::post('strategi/store', [StrategiController::class, 'store'])->name('strategi.store');
        Route::get('strategi/{id}/ubah', [StrategiController::class, 'edit'])->name('strategi.ubah');
        Route::put('strategi/{id}', [StrategiController::class, 'update'])->name('strategi.update');
    });
});
