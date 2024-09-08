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
                        <li class="breadcrumb-item active" aria-current="page">All Blog Post</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('admin.add.blog.post') }}" class="btn btn-primary px-5">Add Category</a>
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
                                <th>Blog Category</th>
                                <th>Post Title</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($posts as $key => $data)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td><img src="{{ asset($data->post_image) }}" alt="Image"
                                            style="width: 70px; height: 40px;"></td>
                                    <td>{{ $data->blogcategory->category }}</td>
                                    <td>{{ Str::limit($data->post_title, 30) }}</td>
                                    <td>
                                        <a href="{{ route('admin.blog.post.edit', $data->id) }}"
                                            class="btn btn-success btn-sm">Edit</a>
                                        <a href="{{ route('admin.blog.post.delete', $data->id) }}"
                                            class="btn btn-danger btn-sm" id="delete">Trash</a>
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
