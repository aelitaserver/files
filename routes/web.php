<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/files', FileController::class)->only('index', 'create', 'store');

    Route::post('/files/{id}', [FileController::class, 'download'])->name('files.download');

    Route::get('/', function () {
        return view('home');
    })->name('home');

});

require __DIR__.'/auth.php';
