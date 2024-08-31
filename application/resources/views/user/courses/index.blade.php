@extends('user.layouts.app')
@section('content')
 
   
 
       
     
        <div class="dashboard-heading mb-5">
            <h3 class="fs-22 font-weight-semi-bold">My Courses</h3>
        </div>
        <div class="dashboard-cards mb-5">
            @forelse ($myCourse as $data)
                
           
            <div class="card card-item card-item-list-layout">
                <div class="card-image">
                    <a href="{{ route('course.view', $data->course_id) }}" class="d-block">
                        <img class="card-img-top" src="{{ asset($data->course->course_image) }}" alt="Card image cap">
                    </a>
    
                </div><!-- end card-image -->
                <div class="card-body">
                    <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">{{$data->course->label}}</h6>
                    <h5 class="card-title"><a href="{{ route('course.view', $data->course_id) }}">{{$data->course->course_name}}</a></h5>
                    <p class="card-text"><a href="teacher-detail.html">{{$data->course->user->name}}</a></p>
                    <div class="rating-wrap d-flex align-items-center py-2">
                        <div class="review-stars">
                            <span class="rating-number">4.4</span>
                            <span class="la la-star"></span>
                            <span class="la la-star"></span>
                            <span class="la la-star"></span>
                            <span class="la la-star"></span>
                            <span class="la la-star-o"></span>
                        </div>
                        <span class="rating-total pl-1">(20,230)</span>
                    </div><!-- end rating-wrap -->
                    <ul class="card-duration d-flex align-items-center fs-15 pb-2">
                        <li class="mr-2">
                            <span class="text-black">Status:</span>
                            <span class="badge badge-success text-white">Published</span>
                        </li>
                        <li class="mr-2">
                            <span class="text-black">Duration:</span>
                            <span>{{$data->course->duration}}</span>
                        </li>
                        <li class="mr-2">
                            <span class="text-black">Students:</span>
                            <span>30,405</span>
                        </li>
                    </ul>
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="card-price text-black font-weight-bold">${{$data->course->selling_price}}</p>
                     
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
            @empty
                
            @endforelse
           
        </div><!-- end col-lg-12 -->
        <div class="text-center py-3">
            <nav aria-label="Page navigation example" class="pagination-box">
                <ul class="pagination justify-content-center">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true"><i class="la la-arrow-left"></i></span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true"><i class="la la-arrow-right"></i></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <p class="fs-14 pt-2">Showing 1-4 of 16 results</p>
        </div>
        <div class="row align-items-center dashboard-copyright-content pb-4">
            <div class="col-lg-6">
                <p class="copy-desc">&copy; 2021 Aduca. All Rights Reserved. by <a
                        href="https://techydevs.com/">TechyDevs</a></p>
            </div><!-- end col-lg-6 -->
            <div class="col-lg-6">
                <ul class="generic-list-item d-flex flex-wrap align-items-center fs-14 justify-content-end">
                    <li class="mr-3"><a href="terms-and-conditions.html">Terms & Conditions</a></li>
                    <li><a href="privacy-policy.html">Privacy Policy</a></li>
                </ul>
            </div><!-- end col-lg-6 -->
        </div><!-- end row -->
  

    <!-- ================================
            END DASHBOARD AREA
        ================================= -->

    <!-- start scroll top -->
    <div id="scroll-top">
        <i class="la la-arrow-up" title="Go top"></i>
    </div>
    <!-- end scroll top -->

    <!-- Modal -->
    <div class="modal fade modal-container" id="deleteModal" tabindex="-1" role="dialog"
        aria-labelledby="deleteModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="la la-exclamation-circle fs-60 text-warning"></span>
                    <h4 class="modal-title fs-19 font-weight-semi-bold pt-2 pb-1" id="deleteModalTitle">Your account will
                        be deleted permanently!</h4>
                    <p>Are you sure you want to delete your account?</p>
                    <div class="btn-box pt-4">
                        <button type="button" class="btn font-weight-medium mr-3" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn theme-btn theme-btn-sm lh-30">Ok, Delete</button>
                    </div>
                </div><!-- end modal-body -->
            </div><!-- end modal-content -->
        </div><!-- end modal-dialog -->
    </div><!-- end modal -->

    <!-- Modal -->
    <div class="modal fade modal-container" id="itemDeleteModal" tabindex="-1" role="dialog"
        aria-labelledby="itemDeleteModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="la la-exclamation-circle fs-60 text-warning"></span>
                    <h4 class="modal-title fs-19 font-weight-semi-bold pt-2 pb-1" id="itemDeleteModalTitle">Your item will
                        be deleted permanently!</h4>
                    <p>Are you sure you want to delete your item?</p>
                    <div class="btn-box pt-4">
                        <button type="button" class="btn font-weight-medium mr-3" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn theme-btn theme-btn-sm lh-30">Ok, Delete</button>
                    </div>
                </div><!-- end modal-body -->
            </div><!-- end modal-content -->
        </div><!-- end modal-dialog -->
    </div><!-- end modal -->
@endsection
