<?php

use App\Http\Controllers\Admin\TopsisController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'role:admin']], function () {

    Route::controller(TopsisController::class)->group(function(){
        Route::get('topsis', [TopsisController::class, 'index'])->name('topsis');
        Route::get('topsis/tambah', [TopsisController::class, 'create'])->name('topsis.tambah');
        Route::delete('topsis/{id}', [TopsisController::class, 'destroy'])->name('topsis.hapus');
        Route::post('topsis/store', [TopsisController::class, 'store'])->name('topsis.store');
        Route::get('topsis/{id}/ubah', [TopsisController::class, 'edit'])->name('topsis.ubah');
        Route::put('topsis/{id}', [TopsisController::class, 'update'])->name('topsis.update');
    });
});
