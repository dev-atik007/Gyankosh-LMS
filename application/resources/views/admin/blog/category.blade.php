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
                        <li class="breadcrumb-item active" aria-current="page">All Blog Category</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                {{-- <div class="btn-group">
                    <a href="" class="btn btn-primary px-5">Add Blog Category</a>
                </div> --}}
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#categorymodal">Add
                    Blog Category</button>
            </div>

        </div>

        <div class="card" style="text-align: center;">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Category Name</th>
                                <th>Category Slug</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($category as $key => $data)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $data->category }}</td>
                                    <td>{{ $data->category_slug }}</td>
                                    <td>

                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#category" id="{{ $data->id }}" onclick="categoryEdit(this.id)">Edit</button>
                                        <a href="{{ route('admin.blog.category.delete', $data->id) }}" class="btn btn-danger btn-sm" id="delete">Trash</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal insert Category -->
    <div class="modal fade" id="categorymodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Blog Category
                    </h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.blog.category.store') }}" method="POST">
                        @csrf

                        <div class="form-group col-md-12">
                            <label for="input1" class="form-label">Blog Category Name</label>
                            <input type="text" name="category" class="form-control" id="catName">
                            <span class="category text-danger"></span>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save
                        </button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal insert Category end-->



    <!-- Modal Category Edit -->
    <div class="modal fade" id="category" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Edit Blog Category
                    </h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.blog.category.update') }}" method="POST">
                        @csrf

                        <input type="hidden" name="catId" id="catId">
                        
                        <div class="form-group col-md-12">
                            <label for="input1" class="form-label">Blog Category Name</label>
                            <input type="text" name="category" class="form-control" id="cat">
                            <span class="category text-danger"></span>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save
                        </button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Category Edit end-->

    
@endsection

@push('script')
    <script>
        function categoryEdit(id) {

            var url = '{{ route('admin.edit.blog.category', ':id') }}'.replace(':id', id);

            $.ajax({
                type: 'GET',
                url: url,
                dataType: 'json',

                success:function(data){
                    // console.log(data)
                    $('#cat').val(data.category);
                    $('#catId').val(data.id);
                }
            })
        }
    </script>
@endpush
