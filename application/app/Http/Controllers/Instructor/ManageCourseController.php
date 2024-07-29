<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Course_goal;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use PHPUnit\Framework\Constraint\Count;

class ManageCourseController extends Controller
{
    public function allCourse()
    {
        $id = Auth::user()->id;
        $courses = Course::where('instructor_id', $id)->orderBy('id', 'desc')->get();

        return view('instructor.course.index', compact('courses'));
    }


    public function addCourse()
    {
        $categories = Category::latest()->get();
        $subCat = SubCategory::latest()->get();
        return view('instructor.course.form', compact('categories', 'subCat'));
    }


    public function getSubCategory($category_id)
    {
        $subCat = SubCategory::where('category_id', $category_id)->orderBy('subcategory', 'ASC')->get();

        // return json_encode($subCat);
        return response()->json($subCat);
    }


    public function storeCourse(Request $request)
    {
        $request->validate([
            'video'     => 'required|mimes:mp4|max:10000',
        ]);

        $image = $request->file('course_image');
        if ($image) {
            $image_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(370, 246)->save('application/public/upload/course/thambnail/' . $image_gen);
            $save_url = 'application/public/upload/course/thambnail/' . $image_gen;
        }

        $video = $request->file('video');
        if ($video) {
            $videoName = time() . '.' . $video->getClientOriginalExtension();
            $video->move('application/public/upload/course/video', $videoName);
            $save_video = 'application/public/upload/course/video/' . $videoName;
        }

        $course_id = Course::insertGetId([

            'category_id'      => $request->category_id,
            'subcategory_id'   => $request->subcategory_id,
            'instructor_id'    => auth()->user()->id,

            'course_title'     => $request->course_title,
            'course_name'      => $request->course_name,
            'course_name_slug' => strtolower(str_replace(' ', '-', $request->course_name)),
            'description'      => $request->description,
            'video'            => $save_video,
            'label'            => $request->label,
            'duration'         => $request->duration,
            'resource'         => $request->resource,
            'certificate'      => $request->certificate,
            'selling_price'    => $request->selling_price,
            'discount_price'   => $request->discount_price,
            'prerequisites'    => $request->prerequisites,

            'bestseller'       => $request->bestseller,
            'featured'         => $request->featured,
            'highestrated'     => $request->highestrated,
            'status'           => 1,
            'course_image'     => $save_url,
            'created_at'       => Carbon::now(),
        ]);

        ///Course Goals And form

        $goles = Count($request->course_goals);
        if ($goles != NULL) {
            for ($i = 0; $i < $goles; $i++) {
                $gcount = new Course_goal();
                $gcount->course_id = $course_id;
                $gcount->goal_name = $request->course_goals[$i];
                $gcount->save();
            }
        }

        $notification = array(
            'message'   => 'Course Inserted Succesfuly',
            'alert-type' => 'success'
        );
        return redirect()->route('instructor.course')->with($notification);
    }

    // protected function createUniqueSlug($title, $model)
    // {
    //     // ei code block ta ensure kore je database e slug always unique thakbe, 
    //     // jodi kono duplicate slug thake tahole oitar shathe number add kore ekta unique slug generate kora hoy.

    //     $slug = Str::course_name_slug($title);
    //     $originalSlug = $slug;
    //     $counter = 1;

    //     while ($model::where('course_name_slug', $slug)->exists()) {
    //         $slug = $originalSlug . '-' . $counter;
    //         $counter++;
    //     }

    //     return $slug;
    // }


    public function editCourse($course_name_slug)
    {
        $course = Course::where('course_name_slug', $course_name_slug)->first();
        $categories = Category::latest()->get();
        $category_id = $course->category_id;
        $subCat = SubCategory::where('category_id', $category_id)->get();

        $goals = Course_goal::where('course_id', $course->id)->get();
        // dd($goals);
        return view('instructor.course.edit', compact('course', 'subCat', 'categories', 'goals'));
    }


    public function updateCourse(Request $request, $course_name_slug)
    {
        $course = Course::where('course_name_slug', $course_name_slug)->first();

        if ($course) {
            $course->category_id      = $request->category_id;
            $course->subcategory_id   = $request->subcategory_id;
            $course->instructor_id    = Auth::user()->id;
            $course->course_title     = $request->course_title;
            $course->course_name      = $request->course_name;
            $course->description      = $request->description;
            $course->label            = $request->label;
            $course->duration         = $request->duration;
            $course->resource         = $request->resource;
            $course->certificate      = $request->certificate;
            $course->selling_price    = $request->selling_price;
            $course->discount_price   = $request->discount_price;
            $course->prerequisites    = $request->prerequisites;

            $course->bestseller       = $request->bestseller;
            $course->featured         = $request->featured;
            $course->highestrated     = $request->highestrated;
            $course->save();

            $notification = array(
                'message'   => 'Courses Updated Succesfuly',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }

        ///Course Goals And form

        $goles = Count($request->course_goals);
        if ($goles != NULL) {
            for ($i = 0; $i < $goles; $i++) {
                $gcount = new Course_goal();
                $gcount->course_id = $course;
                $gcount->goal_name = $request->course_goals[$i];
                $gcount->save();
            }
        }

        $notification = array(
            'message' => 'Corses Not Found',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }


    //Update Course Image
    public function updateCourseImage(Request $request, $course_name_slug)
    {
        $course = Course::where('course_name_slug', $course_name_slug)->first();
        $oldImage = $request->old_img;

        if ($request->hasFile('course_image')) {
            $image = $request->file('course_image');
            $image_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(370, 246)->save('application/public/upload/course/thambnail/' . $image_gen);
            $save_url = 'application/public/upload/course/thambnail/' . $image_gen;

            if ($oldImage && file_exists(public_path($oldImage))) {
                unlink(public_path($oldImage));
            }

            $course->course_image = $save_url;
        }

        $course->updated_at = Carbon::now();
        $course->save();

        $notification = array(
            'message' => 'Image Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    //Update Course Video
    public function updateCourseVideo(Request $request, $course_name_slug)
    {
        $course = Course::where('course_name_slug', $course_name_slug)->first();
        $oldVideo = $request->old_vid;

        $video = $request->file('video');
        if ($video) {
            $videoName = time() . '.' . $video->getClientOriginalExtension();
            $video->move('application/public/upload/course/video', $videoName);
            $save_video = 'application/public/upload/course/video/' . $videoName;

            if ($oldVideo && file_exists(public_path($oldVideo))) {
                unlink(public_path($oldVideo));
            }
            $course->video = $save_video;
        }

        $course->updated_at = Carbon::now();
        $course->save();

        $notification = array(
            'message' => 'Video Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    //Update Course Goals
    public function updateCourseGoal(Request $request, $course_name_slug)
    {
        // Step 1: Fetch the course
        $course = Course::where('course_name_slug', $course_name_slug)->first();
        
        if (!$course) {
            $notification = array(
                'message' => 'Course not found',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    
        $cid = $course->id;
    
        // Step 2: Validate course goals
        if ($request->course_goals == NULL) {
            $notification = array(
                'message' => 'Course goals are required',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    
        // Step 3: Delete existing course goals
        Course_goal::where('course_id', $cid)->delete();
    
        // Step 4: Insert new course goals
        $goalsCount = count($request->course_goals);
        if ($goalsCount > 0) {
            for ($i = 0; $i < $goalsCount; $i++) {
                $goal = new Course_goal();
                $goal->course_id = $cid;
                $goal->goal_name = $request->course_goals[$i];
                $goal->save();
            }
        }
    
        // Step 5: Return success notification
        $notification = array(
            'message'   => 'Course Goals Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    
    // Course Delete
    public function deleteCourse($course_name_slug)
    {
        $delete = Course::where('course_name_slug', $course_name_slug)->first();

        if ($delete) {
            $delete->delete();

            $notification = array(
                'message'   => 'Course Deleted Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }

        $notification = array(
            'message'   => 'Course Not Found',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }
}
