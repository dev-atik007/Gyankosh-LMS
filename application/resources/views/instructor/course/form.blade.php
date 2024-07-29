@extends('instructor.layouts.app')
@section('instructor')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add New Courses</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('instructor.course') }}" class="btn btn-primary px-5">All Courses</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="card">
                    <div class="card-body p-4">
                        <h5 class="mb-4">Add Category</h5>

                        <form action="{{ route('instructor.store.course') }}" method="POST" id="myForm"
                            enctype="multipart/form-data" class="row g-3">
                            @csrf

                            <div class="form-group col-md-6">
                                <label for="input1" class="form-label">Course Name</label>
                                <input type="text" name="course_name" class="form-control" id="name">
                                <span class="name text-danger"></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="input1" class="form-label">Course Title</label>
                                <input type="text" name="course_title" class="form-control" id="title">
                                <span class="title text-danger"></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="input2" class="form-label">Course Image</label>
                                <input type="file" name="course_image" class="form-control" id="image">
                                <span class="image text-danger"></span>

                            </div>

                            <div class="col-md-6">
                                <img id="showImage"
                                    src="{{ url('application/public/application/public/upload/no_image.jpg') }}"
                                    alt="admin" class="rounded-circle p-1 bg-primary" width="100">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="input1" class="form-label">Course Intro Video</label>
                                <input type="file" name="video" class="form-control" accept="video/mp4, video/webm"
                                    id="video">
                                <span class="video text-danger"></span>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="input1" class="form-label">Course Category</label>
                                <select class="form-select" id="single-select-field" data-placeholder="Choose one thing"
                                    name="category_id">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category }}</option>
                                    @endforeach
                                </select>
                                <span class="single-select-field text-danger"></span>

                            </div>

                            <div class="form-group col-md-4">
                                <label for="input1" class="form-label">Course SubCategory</label>
                                <select name="subcategory_id" class="form-select" aria-label="Default select example"
                                    id="subCategory">
                                    <option selected="" disabled>Open this select menu</option>
                                    @foreach ($subCat as $subCat)
                                        <option value="{{ $subCat->id }}">{{ $subCat->subcategory_name }}</option>
                                    @endforeach

                                </select>
                                <span class="subCategory text-danger"></span>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="input1" class="form-label">Certificate Available</label>
                                <select class="form-select" id="single-select-field" data-placeholder="Choose one thing"
                                    name="certificate" id="certificate">
                                    <option value="" disabled>Select Category</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="input1" class="form-label">Course Price</label>
                                <input type="text" name="selling_price" class="form-control" id="price">
                                <span class="price text-danger"></span>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="input1" class="form-label">Course Discount Price</label>
                                <input type="text" name="discount_price" class="form-control" id="discount">
                                <span class="discount text-danger"></span>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="input1" class="form-label">Course Label</label>
                                <select class="form-select" id="single-select-field" data-placeholder="Choose one thing"
                                    name="label" id="label">
                                    <option value="" disabled>Open this select menu</option>
                                    <option value="begginer">Begginer</option>
                                    <option value="middle">Middle</option>
                                    <option value="advance">Advance</option>
                                </select>
                                <span class="label text-danger"></span>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="input1" class="form-label">Duration</label>
                                <input type="text" name="duration" class="form-control" id="duration">
                                <span class="duration text-danger"></span>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="input1" class="form-label">Resources</label>
                                <input type="text" name="resource" class="form-control" id="resource">
                                <span class="resource text-danger"></span>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="input1" class="form-label">Course Prerequisites</label>
                                <textarea name="prerequisites" placeholder="Course Prerequisites....." class="form-control" id="prerequisites"
                                    rows="3"></textarea>
                                <span class="prerequisites text-danger"></span>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="exampleInputName1">Course Description</label>
                                <textarea name="description" class="form-control" id="summernote"> </textarea>
                                <span class="summernote text-danger"></span>

                            </div>

                            <p>Corse Goal</p>

                            <div class="row add_item">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="goals" class="form-label"> Goals </label>
                                        <input type="text" name="course_goals[]" id="goals" class="form-control"
                                            placeholder="Goals">
                                    </div>
                                </div>
                                <div class="form-group col-md-6" style="padding-top: 30px;">
                                    <a class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> Add
                                        More..</a>
                                </div>
                            </div>
                            <!-- end row -->

                            <hr>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" name="bestseller" type="checkbox"
                                            id="flexCheckDefault" value="1">
                                        <label class="form-check-label" for="flexCheckDefault">BestSeller</label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" name="featured" type="checkbox"
                                            id="flexCheckDefault" value="1">
                                        <label class="form-check-label" for="flexCheckDefault">Featured</label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="highestrated"
                                            id="flexCheckDefault" value="1">
                                        <label class="form-check-label" for="flexCheckDefault">Highest Rated</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3"></div>
                                <button type="submit" class="btn btn-primary px-4" id="formSubmit">Save Course</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Start of add multiple class with ajax -->
    <div style="visibility: hidden">
        <div class="whole_extra_item_add" id="whole_extra_item_add">
            <div class="whole_extra_item_delete" id="whole_extra_item_delete">
                <div class="container mt-2">
                    <div class="row">

                        <div class="form-group col-md-6">
                            <label for="goals">Goals</label>
                            <input type="text" name="course_goals[]" id="goals" class="form-control"
                                placeholder="Goals">
                        </div>
                        <div class="form-group col-md-6" style="padding-top: 20px">
                            <span class="btn btn-success btn-sm addeventmore"><i class="fa fa-plus-circle"></i> Add</span>
                            <span class="btn btn-danger btn-sm removeeventmore"><i class="fa fa-minus-circle"></i>
                                Remove</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <!-- For Section-->
    <script type="text/javascript">
        $(document).ready(function() {
            var counter = 0;
            $(document).on("click", ".addeventmore", function() {
                var whole_extra_item_add = $("#whole_extra_item_add").html();
                $(this).closest(".add_item").append(whole_extra_item_add);
                counter++;
            });
            $(document).on("click", ".removeeventmore", function(event) {
                $(this).closest("#whole_extra_item_delete").remove();
                counter -= 1;
            });
        });
    </script>
    <!-- End of add multiple class with ajax -->
@endpush

@push('script')
    {{-- category to choose subcategory --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="category_id"]').on('change', function() {
                var category_id = $(this).val();
                if (category_id) {
                    $.ajax({
                        url: "{{ url('instructor/subcategory/ajax') }}/" + category_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="subcategory_id"]').html('');
                            var d = $('select[name="subcategory_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="subcategory_id"]').append(
                                    '<option value="' + value.id + '">' + value
                                    .subcategory + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script>
@endpush

{{-- validation --}}
@push('script')
    <script type="text/javascript">
        $('#formSubmit').on('click', function(event) {
            var courseName = $('#name').val();
            var image = $('#image').val();
            var Title = $('#title').val();
            var Video = $('#video').val();
            var SubCategory = $('#subCategory').val();
            var Video = $('#video').val();
            var Price = $('#price').val();
            var Label = $('#label').val();
            var Duration = $('#duration').val();
            var Category = $('#single-select-field').val();
            var isValid = true;

            if (courseName == '') {

                $('.name').text('Please fill up the Course Name');
                isValid = false;
            } else {
                $('.name').text('');
            }

            if (Price == '') {
                $('.price').text('Please fill up the Course Name');
                isValid = false;
            } else {
                $('.price').text('');
            }

            if (Label == '') {

                $('.label').text('Please fill up the Course Label');
                isValid = false;
            } else {
                $('.label').text('');
            }

            if (Duration == '') {

                $('.duration').text('Please fill up the Course Name');
                isValid = false;
            } else {
                $('.duration').text('');
            }

            if (image == '') {
                $('.image').text('Please upload an image');
                isValid = false;
            } else {
                $('.image').text('');
            }

            if (SubCategory == '') {
                $('.subCategory').text('Please upload an image');
                isValid = false;
            } else {
                $('.subCategory').text('');
            }

            if (Title == '') {
                $('.title').text('Please fill up the Course Title');
                isValid = false;
            } else {
                $('.title').text('');
            }

            if (Video == '') {
                $('.video').text('Please fill up the Course Video');
                isValid = false;
            } else {
                $('.video').text('');
            }

            if (Category == '') {
                $('.single-select-field').text('Please fill up the Course Video');
                isValid = false;
            } else {
                $('.single-select-field').text('');
            }

            if (!isValid) {
                event.preventDefault();
            }
        });
    </script>
@endpush

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


@push('script')
    {{-- @php echo $post->description; @endphp --}}

    <!-- summernote cdn -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <!-- Summernote -->
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
@endpush
