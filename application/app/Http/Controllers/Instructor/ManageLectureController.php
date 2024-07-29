<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseLecture;
use App\Models\CourseSection;

class ManageLectureController extends Controller
{
    public function courseLecture($course_name_slug)
    {
        $course = Course::where('course_name_slug', $course_name_slug)->first();

        $section = CourseSection::where('course_id', $course->id)->get();

        return view('instructor.lecture.course_lecture', compact('course', 'section'));
    }

    public function AddcourseSection(Request $request)
    {
        $cid = $request->id;

        $section = new CourseSection();

        $section->course_id     = $cid;
        $section->section_title = $request->section_title;
        $section->save();

        $notification = array(
            'message'   => 'Course Section Added Succesfuly',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function deleteSection($course_name_slug)
    {
        $section = CourseSection::where('course_name_slug', $course_name_slug)->first();

        if ($section) {
            $section->lectures()->delete();
            $section->delete();

            $notification = array(
                'message'   => 'Course Section Deleted Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }

        $notification = array(
            'message'   => 'Course lecture Not Found',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }

    public function SaveLecture(Request $request)
    {

        $lecture = new CourseLecture();

        $lecture->course_id     = $request->course_id;
        $lecture->section_id    = $request->section_id;
        $lecture->lecture_title = $request->lecture_title;
        $lecture->url           = $request->lecture_url;
        $lecture->content       = $request->content;
        $lecture->save();

        return response()->json(['success' => 'Lecture Save Successfully']);
    }

    public function editLecture($id)
    {
        $lecture = courseLecture::with('course')->find($id);

        return view('instructor.lecture.edit', compact('lecture'));
    }

    public function updateLecture(Request $request)
    {
        $id = $request->id;

        $lecture = CourseLecture::find($id);

        $lecture->lecture_title = $request->lecture_title;
        $lecture->url           = $request->url;
        $lecture->content       = $request->content;
        $lecture->save();


        $notification = array(
            'message'   => 'Course Lecture Updated Succesfuly',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function deleteLecture($id)
    {
        $delete =  CourseLecture::find($id);

        if ($delete) {
            $delete->delete();

            $notification = array(
                'message'   => 'Course Lecture Deleted Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }

        $notification = array(
            'message'   => 'Course lecture Not Found',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }
}
