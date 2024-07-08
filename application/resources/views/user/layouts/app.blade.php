@extends('user.layouts.master')
@section('master')


<!-- start cssload-loader -->
<div class="preloader">
  <div class="loader">
    <svg class="spinner" viewBox="0 0 50 50">
      <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
    </svg>
  </div>
</div>
<!-- end cssload-loader -->

  @include('user.partials.topnav')

<section class="dashboard-area">
  <div class="dashboard-content-wrap">
    @include('user.partials.sidenav')
    
    @yield('content')
  </div>
</section><!-- end dashboard-area -->
<!-- ================================
    END DASHBOARD AREA
================================= -->

<!-- start scroll top -->
<div id="scroll-top">
  <i class="la la-arrow-up" title="Go top"></i>
</div>
<!-- end scroll top -->

<!-- Modal -->
<div class="modal fade modal-container" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
        <span class="la la-exclamation-circle fs-60 text-warning"></span>
        <h4 class="modal-title fs-19 font-weight-semi-bold pt-2 pb-1" id="deleteModalTitle">Your account will be deleted permanently!</h4>
        <p>Are you sure you want to delete your account?</p>
        <div class="btn-box pt-4">
          <button type="button" class="btn font-weight-medium mr-3" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn theme-btn theme-btn-sm lh-30">Ok, Delete</button>
        </div>
      </div><!-- end modal-body -->
    </div><!-- end modal-content -->
  </div><!-- end modal-dialog -->
</div><!-- end modal -->

@endsection