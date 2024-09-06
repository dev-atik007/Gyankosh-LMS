<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function activeReview()
    {
        $id = Auth::user()->id;
        $review = Review::where('instructor_id', $id)->where('status', 1)->latest()->get();

        return view('instructor.review.active', compact('review'));
    }
}
