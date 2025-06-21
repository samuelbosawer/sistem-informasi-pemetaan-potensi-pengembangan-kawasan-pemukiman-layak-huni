<?php

use App\Http\Controllers\Admin\DistrikController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'role:admin']], function () {

    Route::controller(DistrikController::class)->group(function(){
        Route::get('distrik', [DistrikController::class, 'index'])->name('distrik');
        Route::get('distrik/tambah', [DistrikController::class, 'create'])->name('distrik.tambah');
        Route::get('distrik/detail/{id}', [DistrikController::class, 'show'])->name('distrik.detail');
        Route::delete('distrik/{id}', [DistrikController::class, 'destroy'])->name('distrik.hapus');
        Route::post('distrik/store', [DistrikController::class, 'store'])->name('distrik.store');
        Route::get('distrik/{id}/ubah', [DistrikController::class, 'edit'])->name('distrik.ubah');
        Route::put('distrik/{id}', [DistrikController::class, 'update'])->name('distrik.update');
    });
});
