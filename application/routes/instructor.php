<?php

use Illuminate\Support\Facades\Route;


Route::controller('InstructorController')->group(function () {

    Route::get('login', 'login')->name('login');
    Route::get('become/register', 'register')->name('become.register');
    Route::post('register.store', 'registerStore')->name('register.store');
});

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
