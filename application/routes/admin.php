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


});//end admin group middleware
