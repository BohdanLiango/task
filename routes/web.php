<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('/')->name('tasks.')->group(static function() {

    Route::prefix('/')->group(static function() {
        Route::get('/', [TasksController::class, 'showActive'])->name('show-active');
        Route::get('/show-all', [TasksController::class, 'showAll'])->name('show-all');
        Route::get('/show-hide', [TasksController::class, 'showHide'])->name('show-hide');
        Route::get('/show-deleted', [TasksController::class, 'showDeleted'])->name('show-deleted');

        Route::post('/save', [TasksController::class, 'save'])->name('save');
        Route::post('/finish/{id}', [TasksController::class, 'changeStatusToFinish'])->name('finish');
        Route::post('/start-again/{id}', [TasksController::class, 'changeStatusToStartAgain'])->name('start-again');
        Route::post('/delete/{id}', [TasksController::class, 'destroy'])->name('destroy');
        Route::post('/force-delete/{id}', [TasksController::class, 'forceDelete'])->name('force-delete');
        Route::post('/restore/{id}', [TasksController::class, 'restore'])->name('restore');
    });

    Route::prefix('/categories')->name('category.')->group(static function() {
        Route::get('/', [CategoriesController::class, 'showAll'])->name('show-all');
        Route::get('/show-deleted', [CategoriesController::class, 'showDeleted'])->name('show-deleted');

        Route::post('/save', [CategoriesController::class, 'save'])->name('save');
        Route::post('/update/{id}', [CategoriesController::class, 'update'])->name('update');
        Route::post('/delete/{id}', [CategoriesController::class, 'delete'])->name('delete');
        Route::post('/restore/{id}', [CategoriesController::class, 'restore'])->name('restore');
        Route::post('/force-delete/{id}', [CategoriesController::class, 'forceDelete'])->name('force-delete');
    });

});
