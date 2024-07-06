<?php

use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'roles:user'])->group(function () {
    // user group middleware
    Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard');

});//end user group middleware