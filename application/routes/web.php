<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [SiteController::class, 'templates'])->name('templates');


Route::get('/dashboard', function () {
    return view('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('user/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('logout', [UserController::class, 'logout'])->name('user.logout');
    Route::post('user/profile/update', [UserController::class, 'profileUpdate'])->name('user.profile.update');
});


// Route::middleware(['auth', 'roles:user'])->group(function () {

//     Route::controller('User/UserController')->group(function () {
//         Route::get('user/dashboard', 'dashboard')->name('user.dashboard');


//     });

// });




require __DIR__.'/auth.php';
