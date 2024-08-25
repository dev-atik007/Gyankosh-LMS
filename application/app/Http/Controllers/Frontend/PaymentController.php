<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\OrderConfirm;
use App\Models\Order;
use App\Models\Payment;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        if (Session::has('coupon')) {
            $total_amount = Session::get('coupon')['total_amount'];
        } else {
            $total_amount = round(Cart::total());
        }

        // Create a new Payment Record
        $paymentData = new Payment();

        $paymentData->name          = $request->name;
        $paymentData->email         = $request->email;
        $paymentData->phone         = $request->phone;
        $paymentData->address       = $request->address;
        $paymentData->cash_delivery = $request->cash_delivery;
        $paymentData->total_amount  = $total_amount;
        $paymentData->payment_type  = 'Direct Payment';
        $paymentData->invoice_no    = 'EOS' . mt_rand(10000000, 99999999);
        $paymentData->order_date    = Carbon::now()->format('d F Y');
        $paymentData->order_month   = Carbon::now()->format('F');
        $paymentData->order_year    = Carbon::now()->format('Y');
        $paymentData->status        = 'pending';
        $paymentData->updated_at    = Carbon::now();
        $paymentData->save();

        if ($paymentData->save()) {
            
            foreach ($request->course_title as $key => $course_title) {
                $order = new Order();
                $order->payment_id    = $paymentData->id;
                $order->user_id       = auth()->user()->id;
                $order->course_id     = $request->course_id[$key];
                $order->instructor_id = $request->instructor_id[$key];
                $order->course_title  = $course_title;
                $order->price         = $request->price[$key];
                $order->save();
            }

            // Clear the cart session
            $request->session()->forget('cart');

            // Start Send email to student //
            $emailData = [
                'invoice_no' => $paymentData->invoice_no,
                'amount'     => $total_amount,
                'name'       => $paymentData->name,
                'email'      => $paymentData->email,
            ];

            Mail::to($request->email)->send(new OrderConfirm($emailData));
            // End Send email to student //

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
