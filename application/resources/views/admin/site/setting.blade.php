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
                        <li class="breadcrumb-item active" aria-current="page">Site Setting</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="card">
                    <div class="card-body p-4">
                        <h5 class="mb-4">Site Setting</h5>

                        <form action="{{ route('admin.site.setting.update') }}" method="POST" id="myForm"
                            enctype="multipart/form-data" class="row g-3">
                            @csrf

                            <input type="hidden" name="id" id="" value="{{ $siteSettings->id }}">

                                                  
                            <div class="form-group col-md-6">
                                <label for="input1" class="form-label">Phone</label>
                                <input type="text" name="phone" value="{{ $siteSettings->phone }}" class="form-control"
                                    id="catName">
                                <span class="category text-danger"></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="input1" class="form-label">Email</label>
                                <input type="text" name="email" value="{{ $siteSettings->email }}" class="form-control"
                                    id="catName">
                                <span class="category text-danger"></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="input1" class="form-label">Address</label>
                                <input type="text" name="address" value="{{ $siteSettings->address }}" class="form-control"
                                    id="catName">
                                <span class="category text-danger"></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="input1" class="form-label">Copyright</label>
                                <input type="text" name="copyright" value="{{ $siteSettings->copyright }}" class="form-control"
                                    id="catName">
                                <span class="category text-danger"></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="input1" class="form-label">Facebook</label>
                                <input type="text" name="facebook" value="{{ $siteSettings->facebook }}" class="form-control"
                                    id="catName">
                                <span class="category text-danger"></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="input1" class="form-label">Twitter</label>
                                <input type="text" name="twitter" value="{{ $siteSettings->twitter }}" class="form-control"
                                    id="catName">
                                <span class="category text-danger"></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="input2" class="form-label">Logo</label>
                                <input type="file" name="logo" class="form-control" id="image">
                                <span class="image text-danger"></span>
    
                            </div>
    
                            <div class="col-md-6">
                                <img id="showImage" src="{{ asset($siteSettings->logo) }}" alt="admin" class="rounded-circle p-1 bg-primary" width="100">
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