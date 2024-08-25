<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
    public function allOrder()
    {
        $id = Auth::user()->id;

        // Query builder instance হিসেবে ব্যবহার হচ্ছে
        $latestOrderItem = Order::where('instructor_id', $id)
            ->select('payment_id', DB::raw('MAX(id) as max_id'))
            ->groupBy('payment_id');

        // joinSub এর মাধ্যমে subquery যোগ করা
        $orderData = Order::joinSub($latestOrderItem, 'latest_order', function ($join) {
            $join->on('orders.id', '=', 'latest_order.max_id');
        })->orderBy('latest_order.max_id', 'DESC')->get();

        return view('instructor.order.orders', compact('orderData'));
    }


    public function orderDetails($payment_id)
    {
        $payment = Payment::where('id', $payment_id)->first();
        $order = Order::where('payment_id', $payment_id)->latest()->get();

        return view('instructor.order.details', compact('payment', 'order'));
    }

    public function orderInvoice($payment_id)
    {
        $payment = Payment::where('id', $payment_id)->first();
        $order = Order::where('payment_id', $payment_id)->latest()->get();

        $pdf = Pdf::loadView('instructor.order.pdf', compact('payment', 'order'))->setPaper('a4')->setOption([
            'tempDir'   => public_path(),
            'chroot'    => public_path(),
        ]);
        return $pdf->download('invoice.pdf');
    }
}
