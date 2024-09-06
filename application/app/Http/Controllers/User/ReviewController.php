<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function reviewStore(Request $request)
    {
        $course = $request->course_id;
        $instructor = $request->instructor_id;

        $request->validate([
            'comment' => 'required',
        ]);

        $review = new Review();

        $review->course_id      = $course;
        $review->user_id        = Auth::guard()->user()->id;
        $review->comment        = $request->comment;
        $review->rating         = $request->rate;
        $review->instructor_id  = $instructor;
        $review->created_at     = Carbon::now();
        $review->save();

        $notification = array(
            'message'   => 'Review Will Approve By Admin',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
        
    }
}
