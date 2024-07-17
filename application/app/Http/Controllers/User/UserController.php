<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
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

    public function password()
    {
        return view('user.password');
    }

    public function passwordUpdate(Request $request)
    {
        //validation 
        $request->validate([
            'old_password'  => 'required',
            'new_password'  => 'required|confirmed',
        ]);

        if (!Hash::check($request->old_password, auth()->user()->password)) {
            
            $notification = array(
                'message'   => 'Old Password Does not Match',
                'alert-type'=> 'error',
            );
            return redirect()->back()->with($notification);
        }

        //Update The new password
        User::whereId(auth()->user()->id)->update([
            'password'  => Hash::make($request->new_password)
        ]);

        $notification = array(
            'message'   => 'Password Change Successfully',
            'alert-type'=> 'success'
        );
        return back()->with($notification);
    }

    public function settings()
    {
        return view('user.settings');
    }
}
