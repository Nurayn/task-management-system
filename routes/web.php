<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('users/all', [App\Http\Controllers\UserController::class, 'all'])->middleware('permission:manage users')->name('users.all');
        Route::delete('tasks/{task}', [App\Http\Controllers\TaskController::class, 'destroy'])->middleware('permission:delete tasks')->name('tasks.destroy');
        Route::get('get-task-data', [App\Http\Controllers\TaskController::class, 'getTaskData'])->name('tasks.data');
    });
    Route::group(['middleware' => ['role:user']], function () {
        Route::get('tasks/user', [App\Http\Controllers\TaskController::class, 'getUserTasks'])->name('tasks.get');
        Route::post('tasks', [App\Http\Controllers\TaskController::class, 'store'])->middleware('permission:create tasks')->name('tasks.store');
        Route::put('tasks/{task}', [App\Http\Controllers\TaskController::class, 'update'])->middleware('permission:edit tasks')->name('tasks.update');
    });
    Route::get('users/{user}', [App\Http\Controllers\UserController::class, 'profile'])->name('users.profile');
    Route::get('tasks', [App\Http\Controllers\TaskController::class, 'index'])->name('tasks.index');
    Route::get('tasks/{task}', [App\Http\Controllers\TaskController::class, 'show'])->name('tasks.show');
    Route::get('get-weather-information/{coordinates}', [App\Http\Controllers\TaskController::class, 'getWeatherInformation'])->name('tasks.weather');
});
