<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ManageCouponController extends Controller
{
    public function allCoupon()
    {
        $coupon = Coupon::latest()->get();

        return view('admin.coupon.index', compact('coupon'));
    }

    public function addCoupon()
    {
        return view('admin.coupon.form');
    }

    public function storeCoupon(Request $request)
    {

        $request->validate([
            'coupon_name' => 'required|string|unique:coupons,coupon_name|max:255',
            'coupon_discount' => 'required|numeric|min:1|max:100',
            'coupon_validity' => 'required|date|after_or_equal:today',
        ]);

        $coupon = new Coupon();
        $coupon->coupon_name = strtoupper($request->coupon_name);
        $coupon->coupon_discount = $request->coupon_discount;
        $coupon->coupon_validity = $request->coupon_validity;
        $coupon->created_at = Carbon::now();
        $coupon->save();

        $notification = array(
            'message'   => 'Coupon Inserted Succesfuly',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.all.coupon')->with($notification);
    }

    public function editCoupon($id)
    {
        $coupon = Coupon::find($id);

        return view('admin.coupon.edit', compact('coupon'));
    }

    public function updateCoupon(Request $request)
    {
        $id = $request->id;

        // Validation rules
        $request->validate([
            'coupon_name' => 'required|string|unique:coupons,coupon_name,' . $id . '|max:255',
            'coupon_discount' => 'required|numeric|min:1|max:100',
            'coupon_validity' => 'required|date|after_or_equal:today',
        ]);

        // Data update
        $coupon = Coupon::find($id);
        $coupon->coupon_name = strtoupper($request->coupon_name);
        $coupon->coupon_discount = $request->coupon_discount;
        $coupon->coupon_validity = $request->coupon_validity;
        $coupon->save();

        // Notification
        $notification = array(
            'message'   => 'Coupon updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.all.coupon')->with($notification);
    }

    public function deleteCoupon($id)
    {
        $coupon = Coupon::find($id); 

        $coupon->delete();

        $notification = array(
            'message'   => 'Coupon deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.all.coupon')->with($notification);
    }
}
