<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class ManageOrderController extends Controller
{
    public function pendingOrder()
    {
        $order = Payment::where('status', 'pending')->latest()->get();

        return view('admin.order.pending', compact('order'));
    }

    public function orderDetails($payment_id)
    {
        $payment = Payment::where('id', $payment_id)->first();
        $order = Order::where('payment_id', $payment_id)->latest()->get();

        return view('admin.order.details', compact('payment', 'order'));
    }

    public function pendingToConfirm($payment_id)
    {
        $payment = Payment::find($payment_id);
        $payment->status = 'confirm';
        $payment->save();

        $notification = array(
            'message'   => 'Order Confirm Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.confirm.order')->with($notification);
    }

    public function confirmOrder()
    {
        $order = Payment::where('status', 'confirm')->latest()->get();

        return view('admin.order.confirm', compact('order'));

    }
}
