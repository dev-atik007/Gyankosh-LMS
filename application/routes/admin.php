<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;



Route::get('login', [AdminController::class, 'login'])->name('login');

//admin group middleware
Route::middleware(['auth', 'roles:admin'])->group(function () {

	Route::controller('AdminController')->group(function () {
		Route::get('dashboard', 'dashboard')->name('dashboard');
		Route::get('logout', 'logout')->name('logout');
		Route::get('profile', 'profile')->name('profile');
		Route::post('profile/update', 'profileUpdate')->name('profile.update');
		Route::get('password', 'password')->name('password');
		Route::post('password/update', 'passwordUpdate')->name('password.update');
	});


});//end admin group middleware




