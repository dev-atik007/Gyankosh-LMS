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
                        <li class="breadcrumb-item active" aria-current="page">Add Blog Post</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('admin.blog.post') }}" class="btn btn-primary px-5">All Post</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="card">
                    <div class="card-body p-4">
                        <h5 class="mb-4">Add Blog Category</h5>

                        <form action="{{ route('admin.blog.post.store') }}" method="POST" id="myForm"
                            enctype="multipart/form-data" class="row g-3">
                            @csrf


                            <div class="form-group col-md-6">
                                <label for="input2" class="form-label">Blog Post Image</label>
                                <input type="file" name="post_image" class="form-control" id="image">
                                <span class="image text-danger"></span>
                            </div>

                            <div class="col-md-6">
                                <img id="showImage"
                                    src="{{ url('application/public/application/public/upload/no_image.jpg') }}"
                                    alt="admin" class="rounded-circle p-1 bg-primary" width="100">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="input1" class="form-label">Blog Category</label>
                                <select class="form-select" id="single-select-field" data-placeholder="Choose one thing"
                                    name="blogcat_id">
                                    <option value="">Select Category</option>
                                    @foreach ($category as $category)
                                        <option value="{{ $category->id }}">{{ $category->category }}</option>
                                    @endforeach
                                </select>
                                <span class="category text-danger"></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="input1" class="form-label">Post Title</label>
                                <input type="text" name="post_title" class="form-control" id="catName">
                                <span class="category text-danger"></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="input1" class="form-label">Post Tags</label>
                                <input type="text" class="form-control" name="tags" data-role="tagsinput" value="">
                                <span class="category text-danger"></span>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="exampleInputName1">Post Description</label>
                                <textarea name="description" class="form-control" id="summernote"> </textarea>
                                <span class="summernote text-danger"></span>

                            </div>

                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3"></div>
                                <button type="submit" class="btn btn-primary px-4" id="formSubmit">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <link href="{{ asset('application/public/backend/assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
@endpush

@push('script')
    {{-- tagsinput --}}
    <script src="{{ asset('application/public/backend/assets/plugins/input-tags/js/tagsinput.js') }}"></script>
    {{-- end tagsinput --}}

    <!-- summernote cdn -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <!-- Summernote -->
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
@endpush

@push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endpush

//validation
@push('script')
    <script type="text/javascript">
        $('#formSubmit').on('click', function(event) {
            var catName = $('#catName').val();
            var image = $('#image').val();
            var isValid = true;

            if (catName == '') {

                $('.category').text('Please fill up the category name');
                isValid = false;
            } else {
                $('.category').text('');
            }

            if (image == '') {
                $('.image').text('Please upload an image');
                isValid = false;
            } else {
                $('.image').text('');
            }

            if (!isValid) {
                event.preventDefault();
            }
        });
    </script>
@endpush
