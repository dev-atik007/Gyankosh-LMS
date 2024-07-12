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
                        <li class="breadcrumb-item active" aria-current="page">New SubCategory</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('admin.all.sub.category') }}" class="btn btn-primary px-5">All SubCategory</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="card">
                    <div class="card-body p-4">
                        <h5 class="mb-4">Edit SubCategory</h5>

                        <form action="{{ route('admin.update.sub.category',$subCategory->slug) }}" method="POST" id="myForm" enctype="multipart/form-data" class="row g-3">
                            @csrf

                            <div class="mb-4">
                                <label for="single-select-field" class="form-label">Category</label>
                                <select class="form-select" id="single-select-field" data-placeholder="Choose one thing"
                                    name="category_id">
                                    <option>Select Category</option>
                                    @foreach ($category as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == $subCategory->category_id ? 'selected' : '' }}>{{ $category->category }}</option>
                                    @endforeach
                                </select>
                                <span class="category_id text-danger"></span>
                            </div>

                            <div class="md-6">
                                <label for="input1" class="form-label">SubCategory Name</label>
                                <input type="text" name="subcategory" value="{{ $subCategory->subcategory }}" class="form-control" id="subName">
                                <span class="subcategory text-danger"></span>
                            </div>

                            <div class="col-md-6">

                            </div>


                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3"></div>
                                <button type="submit" class="btn btn-primary px-4" id="formSubmit">Save UbCategory</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('script-lib')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush


@push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#single-select-field').select2({
                placeholder: "Choose one thing"
            });
        });

        //Validation
        $('#formSubmit').on('click', function(event) {
            var catName = $('#single-select-field').val();
            var subName = $('#subName').val();
            var isValid = true;


            if (catName == '') {

                $('.category_id').text('Please fill up the select category Name');
                isValid = false;
            } else {
                $('.category_id').text('');
            }

            if (subName == '') {
                $('.subcategory').text('Please fill up the SubCategory Name');
                isValid = false;
            } else {
                $('.subcategory').text('');
            }

            if (!isValid) {
                event.preventDefault();
            }
        });
    </script>
@endpush
