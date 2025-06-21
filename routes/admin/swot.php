<?php

use App\Http\Controllers\Admin\HasilSwotController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'role:admin']], function () {

    Route::controller(HasilSwotController::class)->group(function(){
        Route::get('swot', [HasilSwotController::class, 'index'])->name('swot');
        Route::get('swot/tambah', [HasilSwotController::class, 'create'])->name('swot.tambah');
        Route::get('swot/detail/{id}', [HasilSwotController::class, 'show'])->name('swot.detail');
        Route::delete('swot/{id}', [HasilSwotController::class, 'destroy'])->name('swot.hapus');
        Route::post('swot/store', [HasilSwotController::class, 'store'])->name('swot.store');
        Route::get('swot/{id}/ubah', [HasilSwotController::class, 'edit'])->name('swot.ubah');
        Route::put('swot/{id}', [HasilSwotController::class, 'update'])->name('swot.update');
    });
});
