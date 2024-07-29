@extends('instructor.layouts.app')
@section('instructor')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Lecture</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('instructor.course.lecture',$lecture->course->course_name_slug) }}" class="btn btn-primary px-5">Back</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="card">
                    <div class="card-body p-4">
                        <h5 class="mb-4">Add Category</h5>

                        <form action="{{ route('instructor.course.update.lecture') }}" method="POST" id="myForm"
                            enctype="multipart/form-data" class="row g-3">
                            @csrf

                            <input type="hidden" name="id" value="{{ $lecture->id }}">

                            <div class="form-group col-md-6">
                                <label for="input1" class="form-label">Lecture Title</label>
                                <input type="text" name="lecture_title" class="form-control" value="{{ $lecture->lecture_title }}" id="catName">
                                <span class="category text-danger"></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="input1" class="form-label">Video Url</label>
                                <input type="text" name="url" class="form-control" value="{{ $lecture->url }}" id="catName">
                                <span class="category text-danger"></span>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="input1" class="form-label">Lecture Content</label>
                                <textarea name="content" class="form-control">{{ $lecture->content }}</textarea>
                            </div>

                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3"></div>
                                <button type="submit" class="btn btn-primary px-4" id="formSubmit">Save Lecture</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
