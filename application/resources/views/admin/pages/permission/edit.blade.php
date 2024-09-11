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
                        <li class="breadcrumb-item active" aria-current="page">Edit Permission</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('admin.all.permission') }}" class="btn btn-primary btn-sm">All Permission</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="card">
                    <div class="card-body p-4">
                        <h5 class="mb-4">Edit Permission</h5>

                        <form action="{{ route('admin.update.permission') }}" method="POST" id="myForm"
                            enctype="multipart/form-data" class="row g-3">
                            @csrf

                            <input type="hidden" name="id" value="{{ $permission->id }}">

                            <div class="form-group col-md-6">
                                <label for="input1" class="form-label">Permission Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $permission->name }}">
                                <span class="subcategory text-danger"></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="single-select-field" class="form-label">Group Name</label>
                                <select class="form-select" id="single-select-field" data-placeholder="Choose one thing"
                                    name="group_name">
                                    <option value="" disabled>Open this select menu</option>

                                    <option value="Category" {{ $permission->group_name == 'Category' ? 'selected' : '' }}>Category</option>
                                    <option value="Instructor" {{ $permission->group_name == 'Instructor' ? 'selected' : '' }}>Instructor</option>
                                    <option value="Coupon" {{ $permission->group_name == 'Coupon' ? 'selected' : '' }}>Coupon</option>
                                    <option value="Setting" {{ $permission->group_name == 'Setting' ? 'selected' : '' }}>Setting</option>
                                    <option value="Orders" {{ $permission->group_name == 'Orders' ? 'selected' : '' }}>Orders</option>
                                    <option value="Report" {{ $permission->group_name == 'Report' ? 'selected' : '' }}>Report</option>
                                    <option value="Review" {{ $permission->group_name == 'Review' ? 'selected' : '' }}>Review</option>
                                    <option value="All User" {{ $permission->group_name == 'All User' ? 'selected' : '' }}>All User</option>
                                    <option value="Blog" {{ $permission->group_name == 'Blog' ? 'selected' : '' }}>Blog</option>
                                    <option value="Role And Permission" {{ $permission->group_name == 'Role And Permission' ? 'selected' : '' }}>Role And Permission</option>
                                </select>
                                <span class="category_id text-danger"></span>
                            </div>



                            <div class="col-md-6">

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
