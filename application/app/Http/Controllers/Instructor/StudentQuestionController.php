<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentQuestionController extends Controller
{
    public function stQuestion()
    {
        $id = auth()->user()->id;
        $question = Question::where('instructor_id', $id)->where('parent_id', null)->latest()->get();
        // dd($question);
        return view('instructor.question.index', compact('question'));
    }

    public function chatBox()
    {
        return view('instructor.question.chat_box');
    }
}
