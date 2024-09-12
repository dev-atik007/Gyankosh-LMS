@php
    $courses = App\Models\Course::where('featured', 1)->active()->latest()->take(6)->get();
@endphp

<section class="course-area pb-90px">
    <div class="course-wrapper">
        <div class="container">
            <div class="section-heading text-center">
                <h5 class="ribbon ribbon-lg mb-2">Learn on your schedule</h5>
                <h2 class="section__title">Students are viewing</h2>
                <span class="section-divider"></span>
            </div><!-- end section-heading -->
            <div class="course-carousel owl-action-styled owl--action-styled mt-30px">

                @foreach ($courses as $course)
                    <div class="card card-item card-preview" data-tooltip-content="#tooltip_content_3">
                        <div class="card-image">
                            <a href="{{ route('course.details', ['id' => $course->id, 'slug' => $course->course_name_slug]) }}"
                                class="d-block">
                                <img class="card-img-top" src="{{ asset($course->course_image) }}" alt="Card image cap">
                            </a>
                            @php
                                $amount = $course->selling_price - $course->discount_price;
                                $discount = ($amount / $course->selling_price) * 100;
                            @endphp
                            <div class="course-badge-labels">
                              @if ($course->bestseller == 1)
                              <div class="course-badge">Bestseller</div>
                          @else
                          @endif

                          @if ($course->highestrated == 1)
                              <div class="course-badge blue">Highestrated</div>
                          @else
                          @endif

                          @if ($course->discount_price == null)
                              <div class="course-badge blue">New</div>
                          @else
                              <div class="course-badge blue">-{{ round($discount) }}%</div>
                          @endif
                            </div>
                        </div><!-- end card-image -->
                        <div class="card-body">
                          @php
                          $reviewcount = App\Models\Review::where('course_id', $course->id)
                              ->where('status', 1)
                              ->latest()
                              ->get();
                          $avarage = App\Models\Review::where('course_id', $course->id)
                              ->where('status', 1)
                              ->avg('rating');
                      @endphp
                            <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">{{ $course->label }}</h6>
                            <h5 class="card-title"><a
                                    href="{{ route('course.details', ['id' => $course->id, 'slug' => $course->course_name_slug]) }}">{{ Str::limit($course->course_name, 45, '...') }}</a></h5>
                            <p class="card-text"><a href="{{ route('instructor.details', $course->instructor_id) }}">{{ $course->user->name }}</a></p>
                            <div class="rating-wrap d-flex align-items-center py-2">
                                <div class="review-stars">
                                    <span class="rating-number">{{ round($avarage, 1) }}</span>
                                    @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $avarage)
                                                        <span class="la la-star"></span>
                                                    @elseif($i > $avarage && $i - $avarage < 1)
                                                        <span class="la la-star-half-alt"></span>
                                                    @else
                                                        <span class="la la-star-o"></span>
                                                    @endif
                                                @endfor
                                </div>
                                <span class="rating-total pl-1">({{ count($reviewcount) }})</span>
                            </div><!-- end rating-wrap -->
                            <div class="d-flex justify-content-between align-items-center">
                              @if ($course->discount_price == null)
                              <p class="card-price text-black font-weight-bold">
                                  ${{ $course->selling_price }}</p>
                          @else
                              <p class="card-price text-black font-weight-bold">
                                  ${{ $course->discount_price }} <span
                                      class="before-price font-weight-medium">${{ $course->selling_price }}</span>
                              </p>
                          @endif
                                <div class="icon-element icon-element-sm shadow-sm cursor-pointer"
                                    title="Add to Wishlist" id="{{ $course->id }}" onclick="addToWishList(this.id)"><i class="la la-heart-o"></i></div>
                            </div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                @endforeach

            </div><!-- end tab-content -->
        </div><!-- end container -->
    </div><!-- end course-wrapper -->
</section>
