<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Course_goal;
use App\Models\SiteSetting;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    public function templates()
    {
        return view('templates.home');
    }


    public function courseDetails($id, $slug)
    {
        $course = Course::with(['category','subcategory','user'])->find($id);
        $goals = Course_goal::where('course_id', $id)->latest()->get();

        $ins_id = $course->instructor_id;
        $instructorCourses = Course::where('instructor_id', $ins_id)->latest()->get();

        $categories = Category::latest()->get();
     
        $cat_id = $course->category_id;
        $relatedCourses = Course::where('category_id', $cat_id)->where('id', '!=', $id)->latest()->take(3)->get();

        return view('templates.course.details', compact('course', 'goals', 'instructorCourses', 'categories', 'relatedCourses'));
    }

    public function categoryCourse($id, $slug)
    {
        $courses = Course::where('category_id', $id)->active()->get();
        $category = Category::where('id', $id)->first();
        $categories = Category::latest()->get();
        return view('templates.category_page', compact('courses', 'category', 'categories'));
    }
    
    public function subcategoryCourse($id, $slug)
    {
        $courses = Course::where('subcategory_id', $id)->active()->get();
        $subcategories = SubCategory::where('id', $id)->first();
        $categories = Category::latest()->get();
      
        return view('templates.subcategory_page', compact('courses', 'subcategories', 'categories'));
    }

    public function instructorDetails($id)
    {
        $instructor = User::find($id);
        $courses = Course::where('instructor_id', $id)->paginate(8);

        return view('templates.instructor.details', compact('instructor', 'courses'));
    }


    public function MarkAsRead(Request $request, $notificationId)
    {
        $user = Auth::user();
        $notification = $user->notifications()->where('id', $notificationId)->first();

        if ($notification) {
            $notification->MarkAsRead();
        }
        return response()->json(['count' => $user->unreadNotifications()->count() ]);
    }

    
}
