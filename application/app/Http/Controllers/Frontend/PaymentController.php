<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        if (Session::has('coupon')) {
            $total_amount = Session::get('coupon')['total_amount'];
        } else {
            $total_amount = round(Cart::total());
        }

        // Create a new Paymnet Record
        $data = new Payment();

        $data->name     = $request->name;
        $data->email    = $request->email;
        $data->phone    = $request->phone;
        $data->address  = $request->address;

        $data->cash_delivery= $request->cash_delivery;
        $data->total_amount = $total_amount;
        $data->payment_type	= 'Direct Payment';
        $data->invoice_no   = 'EOS' . mt_rand(10000000, 99999999);
        $data->order_date   = Carbon::now()->format('d F Y');
        $data->order_month  = Carbon::now()->format('F');
        $data->order_year   = Carbon::now()->format('Y');
        $data->status       = 'pending';
        $data->updated_at   = Carbon::now();
        $data->save();

        foreach ($request->course_title as $key => $course_title) {
            
            $existingOrder = Order::where('user_id', Auth::user()->id)->where('course_id', $request->course_id[$key])->first();
            if ($existingOrder) {
                $notification = array(
                    'message'   => 'You Have already enrolled in this course',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            } //end if
          
            
            $order = new Order();

            $order->payment_id    = $data->id;
            $order->user_id       = auth()->user()->id;
            $order->course_id     = $request->course_id[$key];
            $order->instructor_id = $request->instructor_id[$key];
            $order->course_title  = $course_title;
            $order->price         = $request->price[$key];
            $order->save();

            if ($request->cash_delivery == 'stripe') {
                echo "Stripe";
            } else {
                $notification = array(
                    'message'   => 'Cash Payment Submit Successfully',
                    'alert-type' => 'success'
                );
                return redirect()->route('templates')->with($notification);
            }
        }
    }
}
