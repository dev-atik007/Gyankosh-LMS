<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Course;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        $course = Course::find($id);

        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        //check if the already in the cart
        $cartItem = Cart::search(function ($cartItem, $rowId) use ($id) {
            return $cartItem->id === $id;
        });

        if ($cartItem->isNotEmpty()) {
            return response()->json(['error' => 'Course is Already in your Cart']);
        }

        if ($course->discount_price == NULL) {
            Cart::add([
                'id'        => $id,
                'name'      => $request->course_name,
                'qty'       => 1,
                'price'     => $course->selling_price,
                'weight'    => 1,
                'options'   => [
                    'image'     => $course->course_image,
                    'slug'      => $request->course_name_slug,
                    'instructor' => $request->instructor,
                ]
            ]);
        } else {

            Cart::add([
                'id'        => $id,
                'name'      => $request->course_name,
                'qty'       => 1,
                'price'     => $course->discount_price,
                'weight'    => 1,
                'options'   => [
                    'image'     => $course->course_image,
                    'slug'      => $request->course_name_slug,
                    'instructor' => $request->instructor,
                ]
            ]);
        }

        return response()->json(['success' => 'Successfully Added on Your  Cart']);
    }


    public function cartData()
    {

        $carts      = Cart::content();
        $cartTotal  = Cart::total();
        $cartQty    = Cart::count();

        return response()->json(array(
            'carts'     => $carts,
            'cartTotal' => $cartTotal,
            'cartQty'   => $cartQty,
        ));
    }


    public function addToMiniCart()
    {
        $carts      = Cart::content();
        $cartTotal  = Cart::total();
        $cartQty    = Cart::count();

        return response()->json(array(
            'carts'     => $carts,
            'cartTotal' => $cartTotal,
            'cartQty'   => $cartQty,
        ));
    }


    public function removeToMiniCart($rowId)
    {
        Cart::remove($rowId);

        return response()->json(['success' => 'Course Remove From Cart']);
    }


    public function cartPage()
    {
        return view('templates.cart.page');
    }


    public function getCartCourse()
    {
        $carts      = Cart::content();
        $cartTotal  = Cart::total();
        $cartQty    = Cart::count();

        return response()->json(array(
            'carts'     => $carts,
            'cartTotal' => $cartTotal,
            'cartQty'   => $cartQty,
        ));
    }

    public function getCartCourseRemove($rowId)
    {
        Cart::remove($rowId);

        if (Session::has('coupon')) {
            $coupon_name = Session::get('coupon')['coupne_name'];
            $coupon = Coupon::where('coupon_name', $coupon_name)->first();

            Session::put('coupon', [
                'coupon_name'       => $coupon->coupon_name,
                'coupon_discount'   => $coupon->coupon_discount,
                'discount_amount'   => round(Cart::total() * $coupon->coupon_discount / 100),
                'total_amount'      => round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100),
            ]);
        }

        return response()->json(['success' => 'Course Remove From Cart']);
    }



    //Coupon Start
    public function couponApply(Request $request)
    {
        $coupon = Coupon::where('coupon_name', $request->coupon_name)
            ->where('coupon_validity', '>=', Carbon::now()->format('Y-m-d'))
            ->first();

        if ($coupon) {
            Session::put('coupon', [
                'coupon_name'       => $coupon->coupon_name,
                'coupon_discount'   => $coupon->coupon_discount,
                'discount_amount'   => round(Cart::total() * $coupon->coupon_discount / 100),
                'total_amount'      => round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100),
            ]);

            return response()->json(array(
                'validity' => true,
                'success' => 'Coupon applied successfully!'
            ));
        } else {
            return response()->json(['error' => 'Invalid coupon or coupon has expired!']);
        }
    }

    public function couponCalculation()
    {
        if (Session::has('coupon')) {
            return response()->json(array(
                'subtotal'        => Cart::total(),
                'coupon_name'     => Session()->get('coupon')['coupon_name'],
                'coupon_discount' => Session()->get('coupon')['coupon_discount'],
                'discount_amount' => Session()->get('coupon')['discount_amount'],
                'total_amount'    => Session()->get('coupon')['total_amount'],
            ));
        } else {
            return response()->json(array(
                'total' => Cart::total(),
            ));
        }
    }

    public function couponRemove()
    {
        Session::forget('coupon');
        return response()->json(['success' => 'Coupon Remove Successfully']);
    }

    public function checkout()
    {
        if (Auth::check()) {

            if (Cart::total() > 0) {
                $carts      = Cart::content();
                $cartTotal  = Cart::total();
                $cartQty    = Cart::count();

                return view('templates.cart.checkout', compact('carts', 'cartTotal', 'cartQty'));
            } else {
                $notification = array(
                    'message'   => 'Add At list One Course',
                    'alert-type' => 'error'
                );
                return redirect()->route('templates')->with($notification);
            }
            
        } else {
            $notification = array(
                'message'   => 'You Need to Login First',
                'alert-type' => 'error'
            );
            return redirect()->route('login')->with($notification);
        }
        
    }
}
