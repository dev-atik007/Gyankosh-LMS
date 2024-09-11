<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;


Route::get('login', [AdminController::class, 'login'])->middleware(RedirectIfAuthenticated::class)->name('login');

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
        Route::get('delete/subcategory/{slug}', 'deleteSubCategory')->name('delete.sub.category');     
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

    //Manage Order
    Route::controller('ManageOrderController')->group(function () {
        Route::get('pending-order', 'pendingOrder')->name('pending.order');
        Route::get('order-details/{id}', 'orderDetails')->name('order.details');
        Route::get('pending-confirm/{id}', 'pendingToConfirm')->name('pending.confirm');
        Route::get('confirm-order', 'confirmOrder')->name('confirm.order');
    });

    //Manage Report
    Route::controller('ManageReportController')->group(function () {
        Route::get('report-view', 'reportView')->name('report.view');
        Route::post('search-by-date', 'searchDate')->name('search.by.date');
        Route::post('search-by-month', 'searchMonth')->name('search.by.month');
        Route::post('search-by-year', 'searchYear')->name('search.by.year');
    });

    //Manage Review
    Route::controller('ManageReviewController')->group(function () {
        Route::get('pending-review', 'pendingReview')->name('pending.review');
        Route::post('update-review-status', 'pendingUpdate')->name('update.review.status');
        Route::get('active-review', 'activeReview')->name('active.review');

    });

    //Manage All Student And Instructor
    Route::controller('ActiveUserController')->group(function () {
        Route::get('all-student', 'student')->name('all.student');

        Route::get('all-instructor', 'instructorAll')->name('all.instructor');
    });

    //Manage Blog Category
    Route::controller('ManageBlogController')->group(function () {
        Route::get('blog-category', 'blogCategory')->name('blog.category');
        Route::post('blog-category-store', 'blogStore')->name('blog.category.store');
        Route::get('blog-category-edit/{id}', 'categoryEdit')->name('edit.blog.category');
        Route::post('blog-category-update', 'categoryUpdate')->name('blog.category.update');
        Route::get('blog-category-delete/{id}', 'categoryDelete')->name('blog.category.delete');

    });

    //Manage Blog Category
    Route::controller('BlogPostController')->group(function () {
        Route::get('blog-post', 'blogPost')->name('blog.post');
        Route::get('add-blog-post', 'addPost')->name('add.blog.post');
        Route::post('blog-post-store', 'postStore')->name('blog.post.store');
        Route::get('blog-post-edit/{id}', 'editPost')->name('blog.post.edit');
        Route::post('blog-post-update', 'postUpdate')->name('blog.post.update');
        Route::get('blog-post-delete/{id}', 'editDelete')->name('blog.post.delete');
    });

    //Manage Site Setting
    Route::controller('SiteSettingController')->group(function () {
        Route::get('site-setting', 'siteSetting')->name('site.setting');
        Route::post('site-setting-update', 'settingUpdate')->name('site.setting.update');
    });

    //Role & Permission
    Route::controller('RolePermissionController')->group(function () {
        Route::get('all-permission', 'allPermission')->name('all.permission');
        Route::get('add-permission', 'addPermission')->name('add.permission');
        Route::post('store-permission', 'storePermission')->name('store.permission');
        Route::get('edit-permission/{id}', 'editPermission')->name('edit.permission');
        Route::post('update-permission', 'updatePermission')->name('update.permission');
        Route::get('delete-permission/{id}', 'deletePermission')->name('delete.permission');

        Route::get('import-permission', 'importPermission')->name('import.permission');
        Route::get('permission-export', 'export')->name('export');
        Route::post('permission-import', 'import')->name('permission.import');
    });

    //Role Route
    Route::controller('RoleController')->group(function () {
        Route::get('all-role', 'allrole')->name('all.roles');
        Route::get('add-role', 'addRole')->name('add.roles');
        Route::post('store-role', 'storeRole')->name('store.roles');
        Route::get('edit-role/{id}', 'editRole')->name('edit.roles');
        Route::post('update-role', 'updateRole')->name('update.roles');
        Route::get('delete-role/{id}', 'deleteRole')->name('delete.roles');    


        //Role Permission
        Route::get('add-roles-prtmission', 'rolesPermission')->name('add.roles.permission');
        Route::post('store-roles-prtmission', 'storePermission')->name('store.roles.permission');
        Route::get('all-roles-prtmission', 'AllRolesPermission')->name('all.roles.permission');
        Route::get('edit-roles-prtmission/{id}', 'EditRolesPermission')->name('edit.roles.permission');
        Route::post('update-roles-prtmission/{id}', 'UpdateRolesPermission')->name('update.roles.permission');
        Route::get('delete-roles-prtmission/{id}', 'DeleteRolesPermission')->name('delete.roles.permission');
    });

    //Manage Admin
    Route::controller('ManageAdminController')->group(function () {
        Route::get('all', 'allAdmin')->name('all.admin');
        Route::get('add', 'addAdmin')->name('add.admin');
        Route::post('store', 'storeAdmin')->name('store.admin');
        Route::get('edit/{id}', 'editAdmin')->name('edit.admin');
        Route::post('update/{id}', 'updateAdmin')->name('update.admin');
        Route::get('delete/{id}', 'deleteAdmin')->name('delete.admin');
        

    });

});//end admin group middleware
