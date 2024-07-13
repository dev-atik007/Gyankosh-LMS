@extends('user.layouts.app')
@section('content')


@php
    $id = Auth::user()->id;
    $userData = App\Models\User::find($id);
@endphp


<div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between mb-5">
    <div class="media media-card align-items-center">
        <div class="media-img media--img media-img-md rounded-full">
            <img class="rounded-full" src="{{ (!empty($userData->image)) ? url('application/public/application/public/upload/user_images/' . $userData->image) : url('application/public/application/public/upload/no_image.jpg') }}" alt="Student thumbnail image">
        </div>
        <div class="media-body">
            <h2 class="section__title fs-30">Hello, {{ $userData->name }}</h2>
        </div><!-- end media-body -->
    </div><!-- end media -->
</div>

<div class="dashboard-heading mb-5">
    <h3 class="fs-22 font-weight-semi-bold">Change Password</h3>
</div>

<form action="{{ route('user.password.update') }}" method="POST" enctype="multipart/form-data" class="row pt-40px">
    @csrf

    <div class="input-box col-lg-12">
        <label class="label-text">Old Password</label>
        <div class="form-group">
            <input class="form-control form--control @error('old_password') is-invalid @enderror" type="password" name="old_password" placeholder="Old Password" id="old_password">
            <span class="la la-lock input-icon"></span>

            @error('old_password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        
    </div><!-- end input-box -->
    <div class="input-box col-lg-12">
        <label class="label-text">New Password</label>
        <div class="form-group">
            <input class="form-control form--control @error('new_password') is-invalid @enderror" type="password" name="new_password" id="new_password" placeholder="New Password">
            <span class="la la-lock input-icon"></span>

            @error('new_password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div><!-- end input-box -->
    <div class="input-box col-lg-12">
        <label class="label-text">Confirm New Pasword</label>
        <div class="form-group">
            <input class="form-control form--control @error('new_password') is-invalid @enderror" type="password" name="new_password_confirmation" id="new_password_confirmation" placeholder="Confirm New Password">
            <span class="la la-lock input-icon"></span>
        </div>
    </div><!-- end input-box -->


    <div class="input-box col-lg-12 py-2">
        <button class="btn theme-btn">Save Changes</button>
    </div><!-- end input-box -->
</form>



@endsection