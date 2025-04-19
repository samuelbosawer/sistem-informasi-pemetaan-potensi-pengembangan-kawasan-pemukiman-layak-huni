<?php

use App\Http\Controllers\Admin\KeluhanController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {

    Route::controller(KeluhanController::class)->group(function(){
        Route::get('keluhan', [KeluhanController::class, 'index'])->name('keluhan');
        Route::get('keluhan/tambah', [KeluhanController::class, 'create'])->name('keluhan.tambah');
        Route::get('keluhan/detail/{id}', [KeluhanController::class, 'show'])->name('keluhan.detail');
        Route::delete('keluhan/{id}', [KeluhanController::class, 'destroy'])->name('keluhan.hapus');
        Route::post('keluhan/store', [KeluhanController::class, 'store'])->name('keluhan.store');
        Route::get('keluhan/{id}/ubah', [KeluhanController::class, 'edit'])->name('keluhan.ubah');
        Route::put('keluhan/{id}', [KeluhanController::class, 'update'])->name('keluhan.update');
    });
});
