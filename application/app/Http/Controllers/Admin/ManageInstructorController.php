<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ManageInstructorController extends Controller
{
    public function instructor()
    {
        $instructor = User::where('role', 'instructor')->latest()->get();
        $totalInstructor = User::where('role', 'instructor')->count();

        return view('admin.instructor.index', compact('instructor','totalInstructor'));
    }

    public function updateUserStatus(Request $request)
    {
        $userId = $request->input('user_id');
        $isChecked = $request->input('is_checked', 0);

        $user = User::find($userId);
        if ($user) {
            $user->status = $isChecked;
            $user->save();
        }

        return response()->json(['message' => 'User Status Updated Successfully']);
    }
}
