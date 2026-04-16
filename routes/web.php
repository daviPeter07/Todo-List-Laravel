<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Auth::check()
        ? to_route('task.index')
        : to_route('login');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    // rota fora do padrao crud
    Route::patch('task/reorder', [TaskController::class, 'reorder'])
        ->name('task.reorder');

    // resource dos metodos CRUD
    Route::resource('task', TaskController::class)
        ->only(['index', 'store', 'update', 'destroy']);
});
