<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ActiveUserController extends Controller
{
    public function student()
    {
        $students = User::where('role', 'user')->latest()->get();

        return view('admin.user.student', compact('students'));
    }

    public function instructorAll()
    {
        $instructors = User::where('role', 'instructor')->latest()->get();

        return view('admin.user.instructor', compact('instructors'));
    }
}
