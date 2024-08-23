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

    // Category
    Route::controller('ManageCategoryController')->group(function () {
        Route::get('all-category', 'category')->name('all.category');
        Route::get('add-category', 'addCategory')->name('add.category');
        Route::post('category/store', 'categoryStore')->name('category.store');
        Route::get('edit/category/{id}', 'editCategory')->name('edit.category');
        Route::post('update/category', 'updateCategory')->name('update.category');
        Route::get('delete/category/{id}', 'deleteCategory')->name('delete.category');    
    });


    //Sub-Category
    Route::controller('ManageSubCategoryController')->group(function () {
        Route::get('all/sub-category', 'subCategory')->name('all.sub.category');
        Route::get('add/sub-category', 'AddsubCategory')->name('add.sub.category');
        Route::post('subCategory/store', 'subCategoryStore')->name('subCategory.store');
        Route::get('edit/subcategory/{slug}', 'editsubCategory')->name('edit.subcategory');
        Route::post('update/subcategory/{slug}', 'updateSubCategory')->name('update.sub.category');
        Route::get('delete/subcategory/{slug}', 'deleteSubCategory')->name('delete.category');     
    });


    //Instructoradmin.user.status
    Route::controller('ManageInstructorController')->group(function () {
        Route::get('all/instructor', 'instructor')->name('instructor');
        Route::post('update/user/status', 'updateUserStatus')->name('update.user.status');
    });


    //Manage Courses
    Route::controller('ManageCourseController')->group(function () {

        Route::get('all/course', 'allCourse')->name('all.course');
        Route::post('update-course-status', 'updateCourseStatus')->name('update.course.status');
        Route::get('course-details/{id}', 'courseDetails')->name('course.details');
    });

    //Manage Coupon
    Route::controller('ManageCouponController')->group(function () {

        Route::get('all/coupon', 'allCoupon')->name('all.coupon');
        Route::get('add/coupon', 'addCoupon')->name('add.coupon');
        Route::post('store-coupon', 'storeCoupon')->name('store.coupon');
        Route::get('edit-coupon/{id}', 'editCoupon')->name('edit.coupon');
        Route::post('update-coupon', 'updateCoupon')->name('update.coupon');
        Route::get('delete-coupon/{id}', 'deleteCoupon')->name('delete.coupon');
        
    });

    //Manage SMTP Setting
    Route::controller('ManageEmailController')->group(function () {

        Route::get('smtp-setting', 'smtpSetting')->name('smtp.setting');
        Route::post('smtp-setting-update', 'smtpSettingUpdate')->name('smtp.setting.update');
        
    });


});//end admin group middleware
