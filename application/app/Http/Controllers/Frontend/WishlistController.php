<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function AddToWishList(Request $request, $course_id)
    {
        if (Auth::check()) {
            $exists = Wishlist::where('user_id', Auth::id())->where('course_id', $course_id)->first();

            if (!$exists) {
                $wishlist = new Wishlist();
                $wishlist->user_id = Auth::id();
                $wishlist->course_id = $course_id;
                $wishlist->created_at = Carbon::now();
                $wishlist->save();

                return response()->json(['success' => 'Successfully added to your Wishlist']);
            } else {
                return response()->json(['error' => 'This product already in your Wishlist']);
            }
        } else {
            return response()->json(['error' => 'At First Login Your Account']);
        }
    }

    public function allWishList()
    {
        return view('user.wishlist.all_wishlist');
    }

    public function getWishlist()
    {
        $wishlist = Wishlist::with('course')->where('user_id', Auth::id())->latest()->get();
        $wishQty = Wishlist::count();

        return response()->json(['wishlist' => $wishlist, 'wishQty' => $wishQty]);
    }

    public function wishlistRemove($id)
    {
        Wishlist::where('user_id', Auth::id())->where('id', $id)->delete();

        return response()->json(['success' => 'Successfully Course Remove']);
    }

}
