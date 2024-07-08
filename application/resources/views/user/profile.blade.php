@extends('user.layouts.app')
@section('content')

@php
    $id = Auth::user()->id;
    $userData = App\Models\User::find($id);
@endphp

<div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between mb-5">
    <div class="media media-card align-items-center">
        <div class="media-img media--img media-img-md rounded-full">
            <img class="rounded-full" src="{{ (!empty($userData->image)) ? url('application/public/application/public/upload/user_images/' . $userData->image) : url('application/public/application/public/upload/user_image.png') }}" alt="Student thumbnail image">
        </div>
        <div class="media-body">
            <h2 class="section__title fs-30">Hello, {{ $userData->name }}</h2>
        </div><!-- end media-body -->
    </div><!-- end media -->
</div>

<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="edit-profile" role="tabpanel" aria-labelledby="edit-profile-tab">
        <div class="setting-body">
            <h3 class="fs-17 font-weight-semi-bold pb-4">Edit Profile</h3>
            
            <form action="{{ route('user.profile.update') }}" method="post" enctype="multipart/form-data" class="row pt-40px">
                @csrf

                <div class="media media-card align-items-center">
                    <div class="media-img media-img-lg mr-4 bg-gray">
                        <img class="mr-3" src="{{ (!empty($userData->image)) ? url('application/public/application/public/upload/user_images/' . $userData->image) : url('application/public/templates/assets/images/small-avatar-1.jpg') }}" alt="avatar image">
                    </div>
                    <div class="media-body">
                        <div class="file-upload-wrap file-upload-wrap-2">
                            <input type="file" name="image" class="multi file-upload-input with-preview" multiple>
                            <span class="file-upload-text"><i class="la la-photo mr-2"></i>Upload a Photo</span>
                        </div><!-- file-upload-wrap -->
                        <p class="fs-14">Max file size is 5MB, Minimum dimension: 200x200 And Suitable files are .jpg & .png</p>
                    </div>
                </div><!-- end media -->
            
                <div class="input-box col-lg-6">
                    <label class="label-text">Name</label>
                    <div class="form-group">
                        <input class="form-control form--control" type="text" name="name" value="{{ $userData->name }}">
                        <span class="la la-user input-icon"></span>
                    </div>
                </div><!-- end input-box -->
                <div class="input-box col-lg-6">
                    <label class="label-text">User Name</label>
                    <div class="form-group">
                        <input class="form-control form--control" type="text" name="username" value="{{ $userData->username }}">
                        <span class="la la-user input-icon"></span>
                    </div>
                </div><!-- end input-box -->
                <div class="input-box col-lg-6">
                    <label class="label-text">Email</label>
                    <div class="form-group">
                        <input class="form-control form--control" type="email" name="email" value="{{ $userData->email }}">
                        <span class="la la-user input-icon"></span>
                    </div>
                </div><!-- end input-box -->
                <div class="input-box col-lg-6">
                    <label class="label-text">Phone</label>
                    <div class="form-group">
                        <input class="form-control form--control" type="text" name="phone" value="{{ $userData->phone }}">
                        <span class="la la-phone input-icon"></span>
                    </div>
                </div><!-- end input-box -->
                <div class="input-box col-lg-12">
                    <label class="label-text">Address</label>
                    <div class="form-group">
                        <input class="form-control form--control" type="text" name="address" value="{{ $userData->address }}">
                        <span class="la la-phone input-icon"></span>
                    </div>
                </div><!-- end input-box -->
                <div class="input-box col-lg-12">
                    <label class="label-text">Bio</label>
                    <div class="form-group">
                        <textarea class="form-control form--control user-text-editor pl-3" name="message">Hello! I am Alex Smith Washington area graphic designer with over 6 years of graphic design experience. I specialize in designing infographics, icons, brochures, and flyers</textarea>
                    </div>
                </div><!-- end input-box -->
                <div class="input-box col-lg-12 py-2">
                    <button class="btn theme-btn">Save Changes</button>
                </div><!-- end input-box -->
            </form>
        </div><!-- end setting-body -->
    </div><!-- end tab-pane -->
</div>

@endsection