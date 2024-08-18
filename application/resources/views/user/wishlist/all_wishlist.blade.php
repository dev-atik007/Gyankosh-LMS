@extends('user.layouts.app')
@section('content')

@php
    $id = Auth::user()->id;
    $userData = App\Models\User::find($id);
@endphp

<div class="container-fluid">
  
    <div class="section-block mb-5"></div>
    <div class="dashboard-heading mb-5">
        <h3 class="fs-22 font-weight-semi-bold">My Wishlist</h3>
    </div>
    <div class="row" id="wishlist">
       
       
    </div><!-- end row -->


</div><!-- end container-fluid -->


@endsection