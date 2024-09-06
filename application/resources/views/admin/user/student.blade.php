@extends('admin.layouts.app')
@section('panel')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Student</li>
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
                                <th>Student Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $key => $data)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td><img src="{{ (!empty($data->image)) ? url('application/public/application/public/upload/user_images/' . @$data->image) : url('application/public/application/public/upload/no_image.jpg') }}" alt="Image"
                                            style="width: 70px; height: 40px;"></td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>{{ $data->phone ?? '01234' }}</td>
                                    <td>
                                        @if ($data->UserOnline())
                                            <span class="badge badge-pill bg-success">Active Now</span>
                                            @else
                                            <span class="badge badge-pill bg-danger">{{ Carbon\Carbon::parse($data->last_seen)->diffForHumans() }}</span>

                                        @endif
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
