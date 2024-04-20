<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('task', [TodoController::class, 'task']);
    Route::post('task', [TodoController::class, 'newTask']);
    Route::get('task', [TodoController::class, 'show'])->name('home');

    Route::post('finished/{id}', [TodoController::class, 'finishedTask'])->name('task.finish');
    Route::delete('delete/{id}', [TodoController::class, 'destroy'])->name('task.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
