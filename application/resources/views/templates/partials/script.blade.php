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
                    timer: 3000
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
                                    <a href="{{ url('/') }}/course/details/${value.course.id}/${value.course.course_name_slug}" class="d-block" target="_blank" >
                                        <img class="card-img-top" src="{{ url('/') }}/${value.course.course_image}" alt="Card image cap">
                                      
                                    </a>
                
                                </div><!-- end card-image -->
                                <div class="card-body">
                                    <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">${value.course.label}</h6>
                                    <h5 class="card-title">
                                        <a href="{{ url('/') }}/course/details/${value.course.id}/${value.course.course_name_slug}" target="_blank">
                                            ${value.course.course_name}
                                        </a>
                                    </h5>
      
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


{{-- //Start Add To Cart data --}}
<script type="text/javascript">
    function addToCart(courseId, courseName, instructorId, slug) {
        $.ajax({
            type: "POST",
            dataType: 'json',
            data: {
                _token: '{{ csrf_token() }}',
                course_name: courseName,
                course_name_slug: slug,
                instructor: instructorId,
            },

            url: '{{ route('cart.store', ':courseId') }}'.replace(':courseId', courseId),
            success: function(data) {

                miniCart()

                //start message
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
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
        });
    }
</script>
{{-- //End  Add To Cart data --}}


{{-- //Start MIni Cart --}}
<script type="text/javascript">
    $(document).ready(function() {
        $('.addToCartCount').on('click mouseenter', function() {
            miniCart();
        });

    });

    function miniCart() {
        $.ajax({
            type: 'GET',
            url: '{{ route('course.mini.cart') }}',
            dataType: 'json',
            success: function(response) {
                var baseUrl = "{{ url('/') }}";


                $('span[id="cartSubTotal"]').text(response.cartTotal);
                $('#cartQty').text(response.cartQty);

                var miniCart = "";

                $.each(response.carts, function(key, value) {
                    var imageUrl = value.options.image ? baseUrl + `/${value.options.image}` :
                        '/path/to/default/image.jpg';

                    miniCart += `
                        <li class="media media-card">
                            <a href="{{ url('/') }}/course/details/${value.id}/${value.options.slug}" class="media-img">
                                <img src="${imageUrl}" alt="Cart image">
                            </a>
                            <div class="media-body">
                                <h5><a href="{{ url('/') }}/course/details/${value.id}/${value.options.slug}">${value.name}</a></h5>
                                <span class="d-block fs-14">$${value.price}</span>
                                <a type="submit" id="${value.rowId}" onclick="miniCartRemove(this.id)"><i class="la la-times"></i></a>
                                
                            </div>
                        </li>
                    `;
                });

                $('#miniCart').html(miniCart);
            }
        });
    }
    miniCart();



    // Mini Cart Remove Start
    function miniCartRemove(rowId) {
        let url = "{{ route('mini.cart.remove', ':rowId') }}".replace(':rowId', rowId);
        $.ajax({
            type: 'GET',
            url: url,
            dataType: 'json',

            success(data) {

                miniCart();

                //start message
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
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
    // Remove Cart Remove Start
</script>

{{-- //End MIni Cart --}}


{{-- //Start Cart Page --}}
<script type="text/javascript">
    function cart() {
        $.ajax({
            type: "GET",
            url: '{{ route('get.cart.course') }}',
            dataType: 'json',
            success: function(response) {

                var baseUrl = "{{ url('/') }}";

                $('span[id="cartSubTotal"]').text(response.cartTotal);

                var rows = "";

                $.each(response.carts, function(key, value) {
                    rows += `                    
                           <tr>
                            <th scope="row">
                                <div class="media media-card">
                                    <a href="${baseUrl}/course/details/${value.id}/${value.options.slug}" class="media-img mr-0">
                                        <img src="${baseUrl}/${value.options.image}" alt="Cart image">
                                    </a>
                                </div>
                            </th>
                            <td>
                                <a href="${baseUrl}/course/details/${value.id}/${value.options.slug}" class="text-black font-weight-semi-bold">${value.name}</a>
                              
                            </td>
                            <td>
                                <ul class="generic-list-item font-weight-semi-bold">
                                    <li class="text-black lh-18">$${value.price}</li>                              
                                </ul>
                            </td>
  
                            <td>
                                <button type="button" class="icon-element icon-element-xs shadow-sm border-0"
                                    data-toggle="tooltip" data-placement="top" id="${value.rowId}" onclick="cartRemove(this.id)">
                                    <i class="la la-times"></i>
                                </button>
                            </td>
                        </tr>
                    `
                });

                $('#cartPage').html(rows);
            }
        })
    }
    cart();


    // My Cart Remove Start
    function cartRemove(rowId) {
        let url = "{{ route('get.cart.course.remove', ':rowId') }}".replace(':rowId', rowId);
        $.ajax({
            type: 'GET',
            url: url,
            dataType: 'json',

            success(data) {

                miniCart();
                cart();
                couponCalculation();

                //start message
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
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
    cartRemove();
    // My Cart Remove End
</script>

{{-- //End Cart Page --}}




{{-- //Start Coupon --}}

{{-- //coupon-apply --}}
<script type="text/javascript">
    function applyCoupon() {
        
        couponCalculation();

        var coupon_name = $('#coupon_name').val();
        $.ajax({
            type: "POST",
            url: '{{ route('coupon.apply') }}',
            dataType: 'json',
            data: {
                coupon_name: coupon_name
            },

            success(data) {

                if (data.validity == true) {
                    $('#couponField').hide();
                }


                //start message
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
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
    // {{-- //Start Coupon end --}}
    

    /// Start Coupon Calculation Method
    function couponCalculation() {
        $.ajax({
            type: 'GET',
            url: '{{ route('coupon.calculation') }}',
            dataType: 'json',

            success: function(data) {
                if (data.total) {
                    $('#couponCalField').html(`
                        <h3 class="fs-18 font-weight-bold pb-3">Cart Totals</h3>
                        <div class="divider"><span></span></div>
                        <ul class="generic-list-item pb-4">
                            <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                <span class="text-black">Subtotal:</span>
                                <span>$${data.total} </span>
                            </li>
                            <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                <span class="text-black">Total:</span>
                                <span>$${data.total}</span>
                            </li>
                        </ul>
                    `)
                } else {
                    $('#couponCalField').html(`
                        <h3 class="fs-18 font-weight-bold pb-3">Cart Totals</h3>
                        <div class="divider"><span></span></div>
                        <ul class="generic-list-item pb-4">
                            <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                <span class="text-black">Subtotal:</span>
                                <span>$${data.subtotal} </span>
                            </li>
                            <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                <span class="text-black">Coupon Name:</span>
                                <span>${data.coupon_name} <button type="button" class="icon-element icon-element-xs shadow-sm border-0" data-toggle="tooltip" data-placement="top" id="20a6c8aaf71e4b9ba471b19506bb1145" onclick="couponRemove()" data-original-title="" >
                                    <i class="la la-times"></i>
                                </button></span>
                            </li>
                            <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                <span class="text-black">Coupon Discount:</span>
                                <span>$${data.discount_amount}</span>
                            </li>
                            <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                <span class="text-black">Grand Totoal:</span>
                                <span>$${data.total_amount}</span>
                            </li>
                        </ul>
                    `)
                }
            }
        })
    }
    
    couponCalculation();


</script>
{{-- //End Coupon Calculation Method --}}


{{-- //Remove Coupon --}}
<script type="text/javascript">
    function couponRemove(){
        $.ajax({
            type: "GEt",
            dataType: 'json',
            url: '{{ route('coupon.remove') }}',

            success:function(data){

                couponCalculation();
                $('#couponField').show();

                //start message
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
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
{{-- //Remove Coupon End--}}