<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/list/{user}', [ChatController::class, 'conversation'])->name('chat.list');
    Route::get('/chat/list/{user}/messages', [ChatController::class, 'messages'])->name('chat.messages');
    Route::post('/chat/send/{user}', [ChatController::class, 'send'])->name('chat.send');
});

require __DIR__.'/auth.php';
