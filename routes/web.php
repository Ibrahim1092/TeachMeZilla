<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StageController;
use App\Http\Controllers\dashboardController;
try {


Auth::routes();



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth']
    ], function(){ 
        //Dashboard Rutes
        Route::get('/', [DashboardController::class,'index'])->name('dashboard.index');
        // School Stages Routes
        Route::get('/stages/index' ,[StageController::class, 'index'])->name('stage.index');
        Route::post('/stages/store' ,[StageController::class, 'store'])->name('stage.store');
        Route::post('/stages/update' ,[StageController::class, 'update'])->name('stage.update');
        Route::get('/stages/delete' ,[StageController::class, 'destroy'])->name('stage.delete');


    });
// routes/web.php



// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
}
catch (Exception $e) {
    return $e->getMessage();
}
