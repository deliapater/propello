<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskTagController;
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
Route::get('/', function () {
    return redirect()->route('login');
});


Route::middleware(['auth', 'verified'])
    ->name('tasks.')
    ->controller(TaskController::class)
    ->group(function() {
        Route::get('', 'index')->name('home');
        Route::get('create', 'create')->name('create');
        Route::post('create', 'store')->name('store');
        Route::get('edit/{task}', 'edit')->name('edit');
        Route::put('edit/{task}', 'update')->name('update');
        Route::get('delete/{task}', 'destroy')->name('destroy');
        Route::get('complete/{task}', 'complete')->name('complete');

        Route::get('{task}/tags', [TaskTagController::class, 'edit'])->name('tags.edit');
        Route::post('{task}/tags', [TaskTagController::class, 'update'])->name('tags.update');
        Route::delete('{task}/tags/{tag}', [TaskTagController::class, 'remove'])->name('tags.remove');
    });

    Route::middleware(['auth', 'verified'])
    ->prefix('tags')
    ->name('tags.')
    ->controller(TagController::class)
    ->group(function() {
        Route::get('', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('', 'store')->name('store');
        Route::get('{tag}/edit', 'edit')->name('edit');
        Route::put('{tag}', 'update')->name('update');
        Route::delete('{tag}', 'destroy')->name('destroy');
    });


Route::middleware('auth')
    ->prefix('profile')
    ->name('profile.')
    ->controller(ProfileController::class)
    ->group(function () {
        Route::get('', 'edit')->name('edit');
        Route::patch('', 'update')->name('update');
        Route::delete('', 'destroy')->name('destroy');
    });

require __DIR__.'/auth.php';
