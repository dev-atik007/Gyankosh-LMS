<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CourseSection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CourseController extends Controller
{
    public function myCourse()
    {
        $id = Auth::user()->id;

        $latestOrders = Order::where('user_id', $id)
            ->select('course_id', DB::raw('MAX(id) as max_id'))
            ->groupBy('course_id');

            $myCourse = Order::joinSub($latestOrders, 'latest_order', function ($join) {
                $join->on('orders.id', '=', 'latest_order.max_id');
        })->orderBy('latest_order.max_id', 'DESC')->get();

        return view('user.courses.index', compact('myCourse'));
    }

    public function courseView($course_id)
    {
        $id = Auth::user()->id;

        $course = Order::where('course_id', $course_id)->where('user_id', $id)->first();

        $section = CourseSection::where('course_id', $course_id)->latest()->get();

        return view('user.courses.course_view', compact('course', 'section'));
    }
}
