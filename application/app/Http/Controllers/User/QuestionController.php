<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function userQuestion(Request $request)
    {
        $course_id = $request->course_id;
        $instructor_id = $request->instructor_id;

        $question = new Question();

        $question->course_id = $course_id;
        $question->user_id = auth()->user()->id;
        $question->instructor_id = $instructor_id;
        $question->subject = $request->subject;
        $question->question = $request->question;
        $question->created_at = Carbon::now();
        $question->save();

        $notification = array(
            'message'   => 'Message Send Successfully',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);

    }
}
