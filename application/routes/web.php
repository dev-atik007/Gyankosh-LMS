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
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('user/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::post('user/profile/update', [UserController::class, 'profileUpdate'])->name('user.profile.update');
    Route::get('logout', [UserController::class, 'logout'])->name('user.logout');
    Route::get('user/password', [UserController::class, 'password'])->name('user.password');
    Route::post('user/password/update', [UserController::class, 'passwordUpdate'])->name('user.password.update');
    Route::get('user/settings', [UserController::class, 'settings'])->name('settings');



    Route::controller('WishlistController')->namespace('Frontend')->group(function () {

        Route::get('user/wishlist', 'allWishList')->name('user.wishlist');
        Route::get('user/get/wishlist/course', 'getWishlist')->name('get.wishlist.course');
        Route::get('/wishlist-remove/{id}', 'wishlistRemove')->name('wishlist.remove');

    });
    

}); //End Auth Middleware

// 01715986786-hanif
// Route Accessable for all
Route::controller('SiteController')->group(function () {

    Route::get('/', 'templates')->name('templates');

    Route::get('/course/details/{id}/{slug}', 'courseDetails')->name('course.details');

    Route::get('category/{id}/{slug}', 'categoryCourse');
    Route::get('subcategory/{id}/{slug}', 'subcategoryCourse');

    Route::get('instructor/details/{id}', 'instructorDetails')->name('instructor.details');
});
// End Route Accessable for All


Route::controller('WishlistController')->namespace('Frontend')->group(function () {

    Route::post('add-to-wishlist/{course_id}', 'AddToWishList')->name('add.to.wishlist');
});


Route::controller('CartController')->namespace('Frontend')->group(function () {

    Route::post('/cart/data/store/{id}', 'addToCart')->name('cart.store');
    Route::get('/cart/data/', 'cartData')->name('cart.data');
    //Get Data from Minicart
    Route::get('/course-mini-cart', 'addToMiniCart')->name('course.mini.cart');
    Route::get('/mini-cart-remove/{rowId}', 'removeToMiniCart')->name('mini.cart.remove');

    //Cart Details Page
    Route::get('/cart-page', 'cartPage')->name('cart.page');
    Route::get('get-cart-course', 'getCartCourse')->name('get.cart.course');
    Route::get('get-cart-course-remove/{rowId}', 'getCartCourseRemove')->name('get.cart.course.remove');

    //Coupon
    Route::post('coupon-apply', 'couponApply')->name('coupon.apply');
    Route::get('coupon-calculation', 'couponCalculation')->name('coupon.calculation');
    Route::get('coupon-remove', 'couponRemove')->name('coupon.remove');

    //Checkout Page
    Route::get('cart-checkout', 'checkout')->name('checkout');
    
});

Route::controller('PaymentController')->namespace('Frontend')->group(function () {
    Route::post('payment', 'payment')->name('payment');
});









require __DIR__.'/auth.php';
