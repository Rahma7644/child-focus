<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/', function () {
        return view('pages.home');
    })->name('home');

    //users
    Route::get('/users/archive', [UserController::class, 'archive'])->name('users.archive');
    Route::get('/users/{role}', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/users/{id}/restore', [UserController::class, 'restore'])->name('users.restore');
    Route::post('/users/{id}/status', [UserController::class, 'toggleStatus'])->name('users.status');


});


require __DIR__ . '/auth.php';
