<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\OrderConfirm;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use App\Notifications\OrderComplete;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Stripe;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        $user = User::where('role', 'instructor')->get();

        if (Session::has('coupon')) {
            $total_amount = Session::get('coupon')['total_amount'];
        } else {
            $total_amount = round(Cart::total());
        }

        $data = array();
        $data['name']       = $request->name;
        $data['email']      = $request->email;
        $data['phone']      = $request->phone;
        $data['address']    = $request->address;
        $data['course_title'] = $request->course_title;
        $cartTotal = Cart::total();
        $carts = Cart::content();


        if ($request->cash_delivery == 'stripe') {
            return view('templates.payment.stripe', compact('data', 'cartTotal', 'carts'));
        } elseif ($request->cash_delivery == 'handcash') {

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

            //Send Notification
            Notification::send($user, new OrderComplete($request->name));

            $notification = array(
                'message'   => 'Cash Payment Submit Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('templates')->with($notification);
        }
    }

    public function stripeOrder(Request $request)
    {
        if (Session::has('coupon')) {
            $total_amount = Session::get('coupon')['total_amount'];
        } else {
            $total_amount = round(Cart::total());
        }

        // Ensure total amount is greater than zero
        if ($total_amount < 1) {
            return redirect()->back()->with('error', 'Total amount must be greater than zero.');
        }

        \Stripe\Stripe::setApiKey('sk_test_51Nkm2fDwdCK0e6asMlSTfhTNK1HLn3JVYNqB1ypSxZE51Rbi5kKLKP0NVDm4VTKlisDXKlRphlhKZtTvjGKtCWkK005iqHyKZU');

        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create([
            'amount'        => $total_amount * 100,
            'currency'      => 'usd',
            'description'   => 'Lms',
            'source'        => $token,
            'metadata'      => ['order_id' => '3434'],
        ]);

        $order_id = Payment::insertGetId([
            'name'          => $request->name,
            'email'         => $request->email,
            'address'        => $request->address,
            'phone'         => $request->phone,
            'total_amount'  => $total_amount,
            'payment_type'  => 'Stripe',
            'invoice_no'    => 'EOS' . mt_rand(10000000, 99999999),
            'order_date'    => Carbon::now()->format('d F Y'),
            'order_month'   => Carbon::now()->format('F'),
            'order_year'    => Carbon::now()->format('Y'),
            'status'        => 'pending',
            'created_at'    => Carbon::now(),
        ]);

        $carts = Cart::content();
        foreach ($carts as $cart) {
            Order::insert([
                'payment_id' => $order_id,
                'user_id'    => Auth::user()->id,
                'course_id'  => $cart->id,
                'instructor_id' => $cart->options->instructor,
                'course_title'  => $cart->options->name,
                'price'         => $cart->price,
            ]);
        }

        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        Cart::destroy();

        $notification = array(
            'message'   => 'Stripe Payment Submit Successfully',
            'alert-type' => 'success'
        );
    }
}
