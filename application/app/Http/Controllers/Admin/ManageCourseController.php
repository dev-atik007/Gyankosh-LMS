<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class ManageCourseController extends Controller
{
    public function allCourse()
    {
        $courses = Course::latest()->get();

        return view('admin.course.all', compact('courses'));
    }

    public function updateCourseStatus(Request $request)
    {
        
        $courseId = $request->input('course_id');
        $isChecked = $request->input('is_checked', 0);

        $course = Course::find($courseId);
        if ($course) {
            $course->status = $isChecked;
            $course->save();
        }

        return response()->json(['message' => 'Course Status Updated Successfully']);
    }

    public function courseDetails($id)
    {
        $course = Course::find($id);

        return view('admin.course.details', compact('course'));
    }
}
