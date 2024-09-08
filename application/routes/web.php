<?php

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

Route::get('/dashboard', function () {
    return view('user.dashboard');
})->middleware(['auth', 'roles:user'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('user/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::post('user/profile/update', [UserController::class, 'profileUpdate'])->name('user.profile.update');
    Route::get('logout', [UserController::class, 'logout'])->name('user.logout');
    Route::get('user/password', [UserController::class, 'password'])->name('user.password');
    Route::post('user/password/update', [UserController::class, 'passwordUpdate'])->name('user.password.update');
    Route::get('user/settings', [UserController::class, 'settings'])->name('settings');


    // User Wishlist Route
    Route::controller('WishlistController')->namespace('Frontend')->group(function () {
        Route::get('user/wishlist', 'allWishList')->name('user.wishlist');
        Route::get('user/get/wishlist/course', 'getWishlist')->name('get.wishlist.course');
        Route::get('wishlist-remove/{id}', 'wishlistRemove')->name('wishlist.remove');
    });

    // User My Course Route
    Route::controller('CourseController')->namespace('User')->group(function () {
        Route::get('my-course', 'myCourse')->name('my.course');
        Route::get('course-view/{course_id}', 'courseView')->name('course.view');
    });

    // User Question Route 
    Route::controller('QuestionController')->namespace('User')->group(function () {
        Route::post('user-question', 'userQuestion')->name('user.question');
    });

    
}); //End Auth Middleware


// Route Accessable for all

Route::controller('SiteController')->group(function () {

    Route::get('/', 'templates')->name('templates');

    Route::get('course/details/{id}/{slug}', 'courseDetails')->name('course.details');

    Route::get('category/{id}/{slug}', 'categoryCourse');
    Route::get('subcategory/{id}/{slug}', 'subcategoryCourse');

    Route::get('instructor/details/{id}', 'instructorDetails')->name('instructor.details');
});

Route::controller('BlogController')->namespace('Frontend')->group(function () {
    Route::get('blog', 'blog')->name('blog');
    Route::get('blog-details/{slug}', 'blogDetails')->name('blog.details');
    Route::get('blog-category-list/{id}/{slug}', 'catList')->name('blog.category.list');
});

// End Route Accessable for All


//Review Controller
Route::controller('ReviewController')->namespace('User')->group(function () {
    Route::post('store-review', 'reviewStore')->name('store.review');
});

//Wishlist Controller
Route::controller('WishlistController')->namespace('Frontend')->group(function () {

    Route::post('add-to-wishlist/{course_id}', 'AddToWishList')->name('add.to.wishlist');
});


Route::controller('CartController')->namespace('Frontend')->group(function () {

    Route::post('cart/data/store/{id}', 'addToCart')->name('cart.store');
    Route::get('cart/data/', 'cartData')->name('cart.data');
    //Get Data from Minicart
    Route::get('course-mini-cart', 'addToMiniCart')->name('course.mini.cart');
    Route::get('mini-cart-remove/{rowId}', 'removeToMiniCart')->name('mini.cart.remove');

    //Cart Details Page
    Route::get('cart-page', 'cartPage')->name('cart.page');
    Route::get('get-cart-course', 'getCartCourse')->name('get.cart.course');
    Route::get('get-cart-course-remove/{rowId}', 'getCartCourseRemove')->name('get.cart.course.remove');

    //Coupon
    Route::post('coupon-apply', 'couponApply')->name('coupon.apply');
    Route::get('coupon-calculation', 'couponCalculation')->name('coupon.calculation');
    Route::get('coupon-remove', 'couponRemove')->name('coupon.remove');

    //Instructor Coupon Apply
    Route::post('instructor-coupon-apply', 'applyInsCoupon')->name('instructor.coupon.apply');


    //Checkout Page
    Route::get('cart-checkout', 'checkout')->name('checkout');

    // Buy now button
    Route::post('buy-data-store/{id}', 'buyDataStore')->name('buy.data.store');
});

Route::controller('PaymentController')->namespace('Frontend')->group(function () {
    Route::post('payment/stripe', 'payment')->name('payment');

    // Stripe Payment
    Route::post('stripe/order', 'stripeOrder')->name('stripe.order');
});









require __DIR__ . '/auth.php';
