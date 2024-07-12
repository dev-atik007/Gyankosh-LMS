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
                    <li class="breadcrumb-item active" aria-current="page">Add Category</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.all.category') }}" class="btn btn-primary px-5">All Category</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row">
        <div class="col-xl-12 mx-auto">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="mb-4">Add Category</h5>

                    <form action="{{ route('admin.category.store') }}" method="POST" id="myForm" enctype="multipart/form-data" class="row g-3">
                        @csrf

                        <div class="form-group col-md-6">
                            <label for="input1" class="form-label">Category Name</label>
                            <input type="text" name="category" class="form-control" id="catName">
                            <span class="category text-danger"></span>
                        </div>

                        <div class="col-md-6">

                        </div>
                        <div class="form-group col-md-6">
                            <label for="input2" class="form-label">Category Image</label>
                            <input type="file" name="image" class="form-control" id="image">
                            <span class="image text-danger"></span>

                        </div>

                        <div class="col-md-6">
                            <img id="showImage" src="{{  url('application/public/application/public/upload/no_image.jpg')}}" alt="admin" class="rounded-circle p-1 bg-primary" width="100">
                        </div>

                        <div class="col-md-12">
                            <div class="d-md-flex d-grid align-items-center gap-3"></div>
                            <button  type="submit" class="btn btn-primary px-4" id="formSubmit">Save Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

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