<?php

use App\Http\Controllers\ConfirmController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/admin');
});

Route::get('/confirm', [ConfirmController::class, 'show'])->name('confirm.show');
Route::post('/confirm', [ConfirmController::class, 'respond'])->name('confirm.respond');
