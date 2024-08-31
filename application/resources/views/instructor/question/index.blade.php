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
                        <li class="breadcrumb-item active" aria-current="page">Student Question</li>
                    </ol>
                </nav>
            </div>

        </div>

        <div class="card" style="text-align: center;">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Course Name</th>
                                <th>Subject</th>
                                <th>Student</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($question as $key => $data)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $data['course']['course_name'] }}</td>
                                    <td>{{ $data->subject }}</td>
                                    <td>{{ $data['student']['name'] }}</td>
                                    <td>
                                        {{-- <a href="" class="btn btn-info btn-sm" title="Edit"><i
                                                class="lni lni-eraser"></i></a> --}}
                                        <a href="{{ route('instructor.chat.box', $data->id) }}"
                                            class="btn btn-info btn-sm" title="details"><i class="lni lni-eye"></i></a>

                                        {{-- <a href="" class="btn btn-warning btn-sm" title="Lecture"><i
                                                class="lni lni-list"></i></a> --}}
                                        {{-- <a href=""
                                            class="btn btn-warning btn-sm" title="pdf"><i
                                                class="lni lni-download"></i></a> --}}

                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
