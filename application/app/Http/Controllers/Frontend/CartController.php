<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        $course = Course::find($id);

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

        return response()->json(['success' => 'Course Remove From Cart']);
    }
}
