<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StageController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\ClassRoomController;
try {


Auth::routes();



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth']
    ], function(){ 
        //Dashboard Routes
        Route::get('/', [DashboardController::class,'index'])->name('dashboard.index');
        // Educational Stages Routes
        Route::get('/stages/index' ,[StageController::class, 'index'])->name('stage.index');
        Route::post('/stages/store' ,[StageController::class, 'store'])->name('stage.store');
        Route::post('/stages/update' ,[StageController::class, 'update'])->name('stage.update');
        Route::get('/stages/delete' ,[StageController::class, 'destroy'])->name('stage.delete');
        Route::get('/stages/deleteall' ,[StageController::class, 'deleteAll'])->name('stage.deleteall');
      
        //ClassRooms Routes
        Route::get('/classroom/index',[ClassRoomController::class, 'index'])->name('classroom.index');
        Route::post('/classroom/store',[ClassRoomController::class, 'store'])->name('classroom.store');
        Route::post('/classroom/update',[ClassRoomController::class, 'update'])->name('classroom.update');
        Route::get('/classroom/delete',[ClassRoomController::class, 'destroy'])->name('classroom.delete');
        Route::get('/classroom/deleteall' ,[ClassRoomController::class, 'deleteAll'])->name('classroom.deleteall');
        Route::get('/classroom/specificsearch/{id}' ,[ClassRoomController::class, 'specificSearch'])->name('classroom.specificSearch');

    });
// routes/web.php



// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
}
catch (Exception $e) {
    return $e->getMessage();
}
