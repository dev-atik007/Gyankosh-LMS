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
                        <li class="breadcrumb-item active" aria-current="page">All Courses</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('instructor.add.course') }}" class="btn btn-primary px-5">New Course</a>
                </div>
            </div>
        </div>

        <div class="card" style="text-align: center;">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Image</th>
                                <th>Course Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $key => $data)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td><img src="{{ asset($data->course_image) }}" alt="Image"
                                            style="width: 70px; height: 40px;"></td>
                                    <td>{{ Str::limit($data->course_name, 15) }}</td>
                                    <td>{{ $data->category->category }}</td>
                                    <td>{{ $data->selling_price }}</td>
                                    <td>{{ $data->discount_price }}</td>
                                    <td>
                                        <a href="{{ route('instructor.edit.course', $data->course_name_slug) }}" class="btn btn-info btn-sm" title="Edit"><i class="lni lni-eraser"></i></a>
                                        <a href="{{ route('instructor.delete.course', $data->course_name_slug) }}" class="btn btn-danger btn-sm" title="Delete" id="delete"><i class="lni lni-trash"></i></a>
                                        <a href="{{ route('instructor.course.lecture' , $data->course_name_slug) }}" class="btn btn-warning btn-sm" title="Lecture"><i class="lni lni-list"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
