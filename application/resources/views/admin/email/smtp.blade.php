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
                        <li class="breadcrumb-item active" aria-current="page">Smtp Setting</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="card">
                    <div class="card-body p-4">
                        <h5 class="mb-4">Smtp Setting</h5>

                        <form action="{{ route('admin.smtp.setting.update') }}" method="POST" id="myForm"
                            enctype="multipart/form-data" class="row g-3">
                            @csrf

                            <input type="hidden" name="id" id="" value="{{ $smtp->id }}">

                            <div class="form-group col-md-6">
                                <label for="input1" class="form-label">Mailer</label>
                                <input type="text" name="mailer" value="{{ $smtp->mailer }}" class="form-control"
                                    id="catName">
                                <span class="category text-danger"></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="input1" class="form-label">Host</label>
                                <input type="text" name="host" value="{{ $smtp->host }}" class="form-control"
                                    id="catName">
                                <span class="category text-danger"></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="input1" class="form-label">Port</label>
                                <input type="text" name="port" value="{{ $smtp->port }}" class="form-control"
                                    id="catName">
                                <span class="category text-danger"></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="input1" class="form-label">User Name</label>
                                <input type="text" name="username" value="{{ $smtp->username }}" class="form-control"
                                    id="catName">
                                <span class="category text-danger"></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="input1" class="form-label">From Address</label>
                                <input type="text" name="from_address" value="{{ $smtp->from_address }}" class="form-control"
                                    id="catName">
                                <span class="category text-danger"></span>
                            </div>                         

                            <div class="form-group col-md-6">
                                <label for="input1" class="form-label">Encryption</label>
                                <input type="text" name="encryption" value="{{ $smtp->encryption }}" class="form-control"
                                    id="catName">
                                <span class="category text-danger"></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="input1" class="form-label">Password</label>
                                <input type="text" name="password" value="{{ $smtp->password }}" class="form-control"
                                    id="catName">
                                <span class="category text-danger"></span>
                            </div>

                           

                            <div class="col-md-6">

                            </div>


                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3"></div>
                                <button type="submit" class="btn btn-primary px-4" id="formSubmit">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
