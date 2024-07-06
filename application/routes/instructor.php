<?php

use App\Http\Controllers\Instructor\InstructorController;
use Illuminate\Support\Facades\Route;


Route::get('login', [InstructorController::class, 'login'])->name('login');

// Instrutor group middleware
Route::middleware(['auth', 'roles:instructor'])->group(function () {
    
    Route::controller('InstructorController')->group(function () {

        Route::get('dashboard', 'dashboard')->name('dashboard');
        Route::get('logout', 'logout')->name('logout');
        Route::get('profile', 'profile')->name('profile');
		Route::post('profile/update', 'profileUpdate')->name('profile.update');
        Route::get('password', 'password')->name('password');
        Route::post('password/update', 'passwordUpdate')->name('password.update');

    });


    
  
   
    
}); //end instrutor group middleware
