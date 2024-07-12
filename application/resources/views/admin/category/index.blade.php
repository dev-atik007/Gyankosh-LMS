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
                    <li class="breadcrumb-item active" aria-current="page">All Category</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.add.category') }}" class="btn btn-primary px-5">Add Category</a>
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
                            <th>Category Image</th>
                            <th>Category Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $category as $key=>$data)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td><img src="{{ asset($data->image) }}" alt="Image" style="width: 70px; height: 40px;"></td>
                            <td>{{ $data->category }}</td>
                            <td>
                                <a href="{{ route('admin.edit.category', $data->id) }}" class="btn btn-success btn-sm">Details</a>
                                <a href="{{ route('admin.delete.category', $data->id) }}" class="btn btn-danger btn-sm" id="delete">Trash</a>
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