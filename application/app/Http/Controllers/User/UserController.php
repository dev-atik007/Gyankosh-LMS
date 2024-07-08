<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    // public function dashboard()
    // {
    //     return view('user.dashboard');
    // }

    public function profile()
    {
        $id = auth()->user()->id;
        $userData = User::find($id);

        return view('user.profile', compact('userData'));
    }

    public function profileUpdate(Request $request)
    {
        $id    = Auth::user()->id;
        $userData  = User::find($id);

        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('application/public/upload/user_images/'. $userData->image));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('application/public/upload/user_images'), $filename);
            $userData['image'] = $filename;
        }

        $userData->name     = $request->name;
        $userData->username = $request->username;
        $userData->email    = $request->email;
        $userData->phone    = $request->phone;
        $userData->address  = $request->address;
        $userData->save();

        $notification = array(
            'message'   => 'Profile Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('templates');
    }
}
