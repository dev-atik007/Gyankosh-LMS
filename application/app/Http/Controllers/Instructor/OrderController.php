<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function allOrder()
    {
        $id = Auth::user()->id;
        $orderData = Order::where('instructor_id', $id)->latest()->get();

        return view('instructor.order.orders', compact('orderData'));
    }

    public function orderDetails($payment_id)
    {
        $payment = Payment::where('id', $payment_id)->first();
        $order = Order::where('payment_id', $payment_id)->latest()->get();

        return view('instructor.order.details', compact('payment', 'order'));

    }
}
