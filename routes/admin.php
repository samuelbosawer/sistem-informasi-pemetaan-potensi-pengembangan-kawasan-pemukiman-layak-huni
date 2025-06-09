<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

Route::group(['middleware' => ['auth']], function () {
    Route::prefix('dashboard')->name('dashboard.')->group(function () {

        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('home');

        require_once 'admin/distrik.php';
        require_once 'admin/jenisKriteria.php';
        require_once 'admin/keluhan.php';
        // require_once 'admin/kriteria.php';
        require_once 'admin/swot.php';
        require_once 'admin/wilayah.php';
        require_once 'admin/topsis.php';
        require_once 'admin/strategi.php';
        require_once 'admin/rekomendasi.php';
 });
});
