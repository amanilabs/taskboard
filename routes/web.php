<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{BoardController, TaskController, AuthController};


// PUBLIC
Route::get('/login',    [AuthController::class, 'showLogin']);
Route::post('/login',   [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register',[AuthController::class, 'register']);

// AUTHENTICATED
 Route::middleware('auth')->group(function () {
    Route::get('/', [BoardController::class, 'dashboard']);
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::post('/Task',                [TaskController::class, 'store'])->name('task.store');
    Route::post('/Task/{lane}/addtask', [TaskController::class, 'addtask'])->name('task.addtask');
    Route::delete('/Task/{task?}/destroy',  [TaskController::class, 'destroy'])->name('task.destroy');
    Route::post('/Task/{task}/move',    [TaskController::class, 'move'])->name('task.move');
    Route::post('/lanes/{lane}/reorder', [TaskController::class, 'reorder'])->name('lanes.reorder');
    Route::get('/Task/{task}/attachment', [TaskController::class, 'download'])->name('task.attachment');
    Route::get('/boards/{id}',           [BoardController::class, 'show']);
    Route::get('/Task/form/{task?}', [TaskController::class, 'form'])->name('task.form'); 
});