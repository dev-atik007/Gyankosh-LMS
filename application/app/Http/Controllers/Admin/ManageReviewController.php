<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ManageReviewController extends Controller
{
    public function pendingReview()
    {
        $review = Review::where('status', 0)->latest()->get();

        return view('admin.review.pending', compact('review'));
    }

    public function pendingUpdate(Request $request)
    {
        $reviewId = $request->input('review_id');
        $isChecked = $request->input('is_checked', 0);

        $review = Review::find($reviewId);
        if ($review) {
            $review->status = $isChecked;
            $review->save();
        }

        return response()->json(['message' => 'Review Status Updated Successfully']);
    }

    public function activeReview()
    {
        $review = Review::where('status', 1)->latest()->get();

        return view('admin.review.active', compact('review'));
    }
}
