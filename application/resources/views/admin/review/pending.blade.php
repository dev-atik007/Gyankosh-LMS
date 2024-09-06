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
                        <li class="breadcrumb-item active" aria-current="page">All Pending Review
                        </li>
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
                                <th>Username</th>
                                <th>Comment</th>
                                <th>Rating</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($review as $key => $data)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $data['course']['course_name'] }}</td>
                                    <td>{{ $data['user']['name'] }}</td>
                                    <td>{{ Str::limit($data->comment, 16, '...') }}</td>
                                    <td>
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $data->rating)
                                                <i class="bx bxs-star text-warning"></i>
                                            @elseif($i > $data->rating && $i - $data->rating < 1)
                                                <i class="bx bxs-star text-secondary"></i>
                                            @else
                                                <i class="bx bxs-star text-secondary"></i>
                                            @endif
                                        @endfor
                                    </td>
                                    {{-- <td>
                                        @if ($data->status == 1)
                                            <span class="btn btn-success btn-sm">Active</span>
                                        @else
                                            <span class="btn btn-danger btn-sm">InActive</span>
                                        @endif
                                    </td> --}}
                                    <td style="text-align: center; vertical-align: middle;">
                                        <div class="form-check-danger form-check form-switch" style="display: flex; justify-content: center; align-items: center; height: 100%;">
                                            <input class="form-check-input status-toggle large-check box" type="checkbox"
                                                id="flexSwitchCheckDanger" data-review-id="{{ $data->id }}"
                                                {{ $data->status ? 'checked' : '' }}>
                                            <label class="form-check-label" for="flexSwitchCheckCheckedDanger"></label>
                                        </div>
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

@push('script')
    <script>
        $(document).ready(function() {
            $('.status-toggle').on('change', function() {
                var reviewrId = $(this).data('review-id');
                var isChecked = $(this).is(':checked');

                //ajax request to update status
                $.ajax({
                    url: "{{ route('admin.update.review.status') }}",
                    method: "POST",
                    data: {
                        review_id: reviewrId,
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
