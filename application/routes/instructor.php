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

    Route::controller('ManageCourseController')->group(function() {
        Route::get('all-course', 'allCourse')->name('course');
        Route::get('add-course', 'addCourse')->name('add.course');

        Route::get('subcategory/ajax/{category_id}', 'getSubCategory');

        Route::post('store/course', 'storeCourse')->name('store.course');
        Route::get('edit/course/{course_name_slug}', 'editCourse')->name('edit.course');
        Route::post('update/course/{course_name_slug}', 'updateCourse')->name('update.course');
        Route::post('update/course/image/{course_name_slug}', 'updateCourseImage')->name('update.course.image');
        Route::get('delete/course/{course_name_slug}', 'deleteCourse')->name('delete.course');

    });


    
  
   
    
}); //end instrutor group middleware
