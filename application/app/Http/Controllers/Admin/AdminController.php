<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //admin dashboard
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    //admin logout
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    //admin login
    public function login()
    {
        return view('admin.auth.login');
    }

    public function profile()
    {
        // $admin = auth()->user(); // বর্তমান লগইনকৃত ইউজারের পুরো অবজেক্ট
        // $admin = User::all(); //user table sob data show kore

        $id           = Auth::user()->id;
        $ProfileData  = User::find($id);
        return view('admin.profile', compact('ProfileData'));
    }

    //profile update
    public function profileUpdate(Request $request)
    {
        $id    = Auth::user()->id;
        $data  = User::find($id);

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('application/public/upload/admin_images'), $filename);
            $data['image'] = $filename;
        }

        $data->name     = $request->name;
        $data->username = $request->username;
        $data->email    = $request->email;
        $data->phone    = $request->phone;
        $data->address  = $request->address;
        $data->save();

        $notification = array(
            'message'   => 'Admin Profile Updated Successfully',
            'alert-type'=> 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function password()
    {
        $id = Auth::user()->id;
        $ProfileData = User::find($id);

        return view('admin.password', compact('ProfileData'));
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


}
