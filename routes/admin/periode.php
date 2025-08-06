<?php

use App\Http\Controllers\Admin\PeriodeController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'role:admin']], function () {

    Route::controller(PeriodeController::class)->group(function(){
        Route::get('periode', [PeriodeController::class, 'index'])->name('periode');
        Route::get('periode/simpan', [PeriodeController::class, 'index'])->name('periode.simpan');
        Route::get('periode/tambah', [PeriodeController::class, 'create'])->name('periode.tambah');
        Route::get('periode/detail/{id}', [PeriodeController::class, 'show'])->name('periode.detail');
        Route::delete('periode/{id}', [PeriodeController::class, 'destroy'])->name('periode.hapus');
        Route::post('periode/store', [PeriodeController::class, 'store'])->name('periode.store');
        Route::get('periode/{id}/ubah', [PeriodeController::class, 'edit'])->name('periode.ubah');
        Route::put('periode/{id}', [PeriodeController::class, 'update'])->name('periode.update');
    });
});
