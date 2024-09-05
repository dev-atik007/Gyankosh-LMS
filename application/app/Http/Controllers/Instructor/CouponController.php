<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Course;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    public function allCoupon()
    {
        $id = Auth::user()->id;
        $coupon = Coupon::where('instructor_id', $id)->latest()->get();

        return view('instructor.coupon.index', compact('coupon'));
    }

    public function addCoupon()
    {
        $id = Auth::user()->id;
        $courses = Course::where('instructor_id', $id)->get();
        return view('instructor.coupon.form', compact('courses'));
    }

    public function storeCoupon(Request $request)
    {
        $request->validate([
            'coupon_name'     => 'required|string|unique:coupons,coupon_name|max:255',
            'coupon_discount' => 'required|numeric|min:1|max:100',
            'course_id'       => 'required',
            'coupon_validity' => 'required|date|after_or_equal:today',
        ]);

        $coupon = new Coupon();
        $coupon->coupon_name     = strtoupper($request->coupon_name);
        $coupon->coupon_discount = $request->coupon_discount;
        $coupon->course_id       = $request->course_id;
        $coupon->coupon_validity = $request->coupon_validity;
        $coupon->instructor_id   = Auth::user()->id;
        $coupon->created_at      = Carbon::now();
        $coupon->save();

        $notification = array(
            'message'   => 'Coupon Inserted Succesfuly',
            'alert-type' => 'success'
        );
        return redirect()->route('instructor.all.coupon')->with($notification);
    }

    public function editCoupon($id)
    {
        $coupon = Coupon::find($id);
        $insId  = Auth::user()->id;
        $courses = Course::where('instructor_id', $insId)->get();

        return view('instructor.coupon.edit', compact('courses', 'coupon', 'insId'));
    }

    public function updateCoupon(Request $request)
    {
        $coupon_id = $request->coupon_id;

        $coupon = Coupon::find($coupon_id);
        $coupon->coupon_name     = strtoupper($request->coupon_name);
        $coupon->coupon_discount = $request->coupon_discount;
        $coupon->course_id       = $request->course_id;
        $coupon->coupon_validity = $request->coupon_validity;
        $coupon->instructor_id   = Auth::user()->id;
        $coupon->created_at      = Carbon::now();
        $coupon->save();

        $notification = array(
            'message'   => 'Coupon Updated Succesfuly',
            'alert-type' => 'success'
        );
        return redirect()->route('instructor.all.coupon')->with($notification);
    }

    public function deleteCoupon($id)
    {
        Coupon::find($id)->delete();

        $notification = array(
            'message'   => 'Coupon Delete Succesfuly',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
