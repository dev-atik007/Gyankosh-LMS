@extends('instructor.layouts.app')
@section('instructor')
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

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
