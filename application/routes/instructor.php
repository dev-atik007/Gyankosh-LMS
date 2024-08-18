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

    //Manage Course
    Route::controller('ManageCourseController')->group(function() {
        Route::get('all-course', 'allCourse')->name('course');
        Route::get('add-course', 'addCourse')->name('add.course');

        Route::get('subcategory/ajax/{category_id}', 'getSubCategory');

        Route::post('store/course', 'storeCourse')->name('store.course');
        Route::get('edit/course/{course_name_slug}', 'editCourse')->name('edit.course');
        Route::post('update/course/{course_name_slug}', 'updateCourse')->name('update.course');
        Route::post('update/course/image/{course_name_slug}', 'updateCourseImage')->name('update.course.image');
        Route::post('update/course/video/{course_name_slug}', 'updateCourseVideo')->name('update.course.video');
        Route::post('update/course/goal/{course_name_slug}', 'updateCourseGoal')->name('update.course.goal');

        Route::get('delete/course/{course_name_slug}', 'deleteCourse')->name('delete.course');
    });

    //Course Section and Lecture All Route
    Route::controller('ManageLectureController')->name('course.')->group(function() {
        Route::get('all-course/lecture/{course_name_slug}', 'courseLecture')->name('lecture');
        Route::post('add-course/section', 'AddcourseSection')->name('section');
        Route::get('course/section/delete/{course_name_slug}', 'deleteSection')->name('delete.section');

        Route::post('save/lecture', 'SaveLecture')->name('save-lecture');

        Route::get('edit/lecture/{id}', 'editLecture')->name('edit.lecture');
        Route::post('update/lecture', 'updateLecture')->name('update.lecture');
        Route::get('delete/lecture/{id}', 'deleteLecture')->name('delete.lecture');

    });


}); //end instrutor group middleware
