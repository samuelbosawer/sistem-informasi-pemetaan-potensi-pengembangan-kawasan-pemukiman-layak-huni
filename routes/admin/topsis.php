<?php

use App\Http\Controllers\Admin\TopsisController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {

    Route::controller(TopsisController::class)->group(function(){
        Route::get('topsis', [TopsisController::class, 'index'])->name('topsis');
    });
});
