<?php

namespace App\Http\Controllers\Instructor;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class InstructorController extends Controller
{
    //Instructor Dashboard
    public function dashboard()
    {
        $id             = Auth::user()->id;
        $instructorData = User::find($id);

        return view('instructor.dashboard', compact('instructorData'));
    }

    // Instructor logout
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('instructor.login');
    }

    // Instructor login
    public function login()
    {
        return view('instructor.auth.login');
    }

    //profile
    public function profile()
    {
        $id = Auth::user()->id;
        $instructorData = User::find($id);
        return view('instructor.profile', compact('instructorData'));
    }

    public function profileUpdate(Request $request)
    {
        $id    = Auth::user()->id;
        $data  = User::find($id);

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('application/public/upload/instructor_images'), $filename);
            $data['image'] = $filename;
        }

        $data->name     = $request->name;
        $data->username = $request->username;
        $data->email    = $request->email;
        $data->phone    = $request->phone;
        $data->address  = $request->address;
        $data->save();

        $notification = array(
            'message'   => 'Instructor Profile Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    //instructor password
    public function password()
    {
        $id = Auth::user()->id;
        $instructorData = User::find($id);
        return view('instructor.password', compact('instructorData'));
    }

    //instructor password update
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
                'alert-type' => 'error',
            );

            return redirect()->back()->with($notification);
        }
        //Update The new password
        User::whereId(auth()->user()->id)->update([
            'password'  => Hash::make($request->new_password)
        ]);

        $notification = array(
            'message'   => 'Password Change Successfully',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    //instructor become register
    public function register()
    {
        return view('templates.instructor.register_ins');
    }

    public function registerStore(Request $request)
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        ]);

        User::insert([
            'name'      => $request->name,
            'username'  => $request->username,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'address'   => $request->address,
            'password'  => Hash::make($request->password),
            'role'      => 'instructor',
            'status'    => '0',
        ]);

        $notification = array(
            'message'   => 'Register Successfully Completed',
            'alert-type' => 'success'
        );
        return redirect()->route('instructor.login')->with($notification);
    }
}
