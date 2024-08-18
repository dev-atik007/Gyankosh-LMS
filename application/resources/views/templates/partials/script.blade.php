{{-- //Start Wishlist add option --}}
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    function addToWishList(course_id) {

        $.ajax({
            type: "POST",
            dataType: 'json',
            url: '{{ route('add.to.wishlist', ':course_id') }}'.replace(':course_id', course_id),

            success: function(data) {

                //start message
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 6000
                });

                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success,
                    });
                } else {
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error,
                    });
                }
                // end message
            }
        })
    }
</script>
{{-- //End Wishlist add option --}}


{{-- //Start load Wishlist data --}}
<script type="text/javascript">
    function wishlist() {
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: '{{ route('get.wishlist.course') }}',

            success: function(response) {

                $('#wishQty').text(response.wishQty);

                var rows = ""

                $.each(response.wishlist, function(key, value) {
                    rows += `
                         <div class="col-lg-4 responsive-column-half">
                            <div class="card card-item">
                                <div class="card-image">
                                    <a href="course-details.html" class="d-block">
                                        <img class="card-img-top" src="/${value.course.course_image}" alt="Card image cap">
                                      
                                    </a>
                
                                </div><!-- end card-image -->
                                <div class="card-body">
                                    <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">${value.course.label}</h6>
                                    <h5 class="card-title"><a href="/course/details/${value.course.id}/${value.course.course_name_slug}">${value.course.course_name}</a></h5>
      
                                    <div class="d-flex justify-content-between align-items-center">

                                        ${value.course.discount_price == null
                                            ?`<p class="card-price text-black font-weight-bold">$${value.course.selling_price}</p>`
                                            :` <p class="card-price text-black font-weight-bold">$${value.course.discount_price} <span class="before-price font-weight-medium">$${value.course.selling_price}</span></p>`
                                        }
                                       

                                        <div class="icon-element icon-element-sm shadow-sm cursor-pointer" data-toggle="tooltip" data-placement="top" title="Remove from Wishlist" id="${value.id}" onclick="wishlistRemove(this.id)"><i class="la la-heart"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `
                });
                $('#wishlist').html(rows);
            }
        })
    }
    wishlist();


    // wishlist remove start

    function wishlistRemove(id) {
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: '{{ route('wishlist.remove', ':id') }}'.replace(':id', id),

            success: function(data) {
                wishlist();
                
                //start message
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 6000
                });

                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success,
                    });
                } else {
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error,
                    });
                }
                // end message
            }
        })
    }
    // wishlist remove end

</script>
{{-- //End load Wishlist data --}}
