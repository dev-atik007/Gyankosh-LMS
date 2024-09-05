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
                    <li class="breadcrumb-item active" aria-current="page">Add Coupon</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.all.coupon') }}" class="btn btn-primary px-5">All Coupon</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row">
        <div class="col-xl-12 mx-auto">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="mb-4">Add Coupon</h5>

                    <form action="{{ route('admin.store.coupon') }}" method="POST" id="myForm" enctype="multipart/form-data" class="row g-3">
                        @csrf

                        <div class="form-group col-md-6">
                            <label for="input1" class="form-label">Coupon Name</label>
                            <input type="text" name="coupon_name" class="form-control" id="catName">
                            <span class="category text-danger"></span>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="input1" class="form-label">Coupon Discount </label>
                            <input type="text" name="coupon_discount" class="form-control" id="catName">
                            <span class="category text-danger"></span>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="input1" class="form-label">coupon Validity Date</label>
                            <input name="coupon_validity" class="form-control" type="date" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                      
                        </div>

                        <div class="col-md-6">

                        </div>
         

                        <div class="col-md-12">
                            <div class="d-md-flex d-grid align-items-center gap-3"></div>
                            <button  type="submit" class="btn btn-primary px-4" id="formSubmit">Save Coupon</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

