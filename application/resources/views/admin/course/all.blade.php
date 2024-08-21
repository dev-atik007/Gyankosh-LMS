@extends('admin.layouts.app')
@section('panel')
    <style>
        .large-checkbox {
            transform: scale(1.3);
        }
    </style>

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Courses:<b></b>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <span class="" style="-webkit-text-fill-color: rgb(18, 17, 19)">44</span>
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
                                <th>Instructor Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Action</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($courses as $key=> $course)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td><img src="{{ asset($course->course_image) }}" alt="Image" style="width: 70px; height: 40px;"></td>
                                    <td>{{ $course->course_name }}</td>
                                    <td>{{ $course['user']['name'] }}</td>
                                    <td>{{ $course['category']['category'] }}</td>
                                    <td>{{ $course->selling_price }}</td>
                                    <td><a href="{{ route('admin.course.details', $course->id) }}" class="btn btn-success btn-sm"><i class="lni lni-eye"></i></a></td>
                                    <td>
                                        <div class="form-check-danger form-check form-switch">
                                            <input class="form-check-input status-toggle large-check box" type="checkbox"
                                                id="flexSwitchCheckDanger" data-course-id="{{ $course->id }}"
                                                {{ $course->status ? 'checked' : '' }}>
                                            <label class="form-check-label" for="flexSwitchCheckCheckedDanger"></label>
                                        </div>
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

@push('script')
    <script>
        $(document).ready(function() {
            $('.status-toggle').on('change', function() {
                var courseId = $(this).data('course-id');
                var isChecked = $(this).is(':checked');

                //ajax request to update status
                $.ajax({
                    url: "{{ route('admin.update.course.status') }}",
                    method: "POST",
                    data: {
                        course_id: courseId,
                        is_checked: isChecked ? 1 : 0,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        toastr.success(response.message);
                    },
                    error: function() {

                    }
                });

            });
        });
    </script>
@endpush
