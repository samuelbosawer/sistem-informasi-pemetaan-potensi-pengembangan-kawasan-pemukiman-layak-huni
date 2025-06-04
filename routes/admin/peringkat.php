<?php

use App\Http\Controllers\Admin\PeringkatController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {

    Route::controller(PeringkatController::class)->group(function(){
        Route::get('peringkat', [PeringkatController::class, 'index'])->name('peringkat');
        Route::get('peringkat/tambah', [PeringkatController::class, 'create'])->name('peringkat.tambah');
        Route::get('peringkat/detail/{id}', [PeringkatController::class, 'show'])->name('peringkat.detail');
        Route::delete('peringkat/{id}', [PeringkatController::class, 'destroy'])->name('peringkat.hapus');
        Route::post('peringkat/store', [PeringkatController::class, 'store'])->name('peringkat.store');
        Route::get('peringkat/{id}/ubah', [PeringkatController::class, 'edit'])->name('peringkat.ubah');
        Route::put('peringkat/{id}', [PeringkatController::class, 'update'])->name('peringkat.update');
    });
});
