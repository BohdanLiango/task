<?php

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

Route::get('/', [TasksController::class, 'showAll'])->name('show');
Route::get('/show-hide', [TasksController::class, 'showHide'])->name('show-hide');

Route::post('/save', [TasksController::class, 'save'])->name('save');
Route::post('/finish/{id}', [TasksController::class, 'changeStatusToFinish'])->name('finish');
Route::post('/start-again/{id}', [TasksController::class, 'changeStatusToStartAgain'])->name('start-again');
Route::post('/delete/{id}}', [TasksController::class, 'destroy'])->name('tasks.destroy');
