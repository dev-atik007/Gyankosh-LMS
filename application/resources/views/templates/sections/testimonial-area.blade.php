@php
    $reviews = App\Models\Review::where('status', 1)->latest()->limit(5)->get();
@endphp


<section class="testimonial-area section-padding">
    <div class="container">
        <div class="section-heading text-center">
            <h5 class="ribbon ribbon-lg mb-2">Testimonials</h5>
            <h2 class="section__title">Student's Feedback</h2>
            <span class="section-divider"></span>
        </div><!-- end section-heading -->
    </div><!-- end container -->
    <div class="container-fluid">
        <div class="testimonial-carousel owl-action-styled">

            @foreach ($reviews as $item)
                <div class="card card-item">
                    <div class="card-body">
                        <div class="media media-card align-items-center pb-3">
                            <div class="media-img avatar-md">
                                <img src="{{ !empty($item->user->image) ? url('application/public/application/public/upload/user_images/' . $item->user->image) : url('application/public/application/public/upload/no_image.jpg') }}"
                                    alt="Testimonial avatar" class="rounded-full">
                            </div>
                            <div class="media-body">
                                <h5>{{ $item->user->name }}</h5>
                                <div class="d-flex align-items-center pt-1">
                                    <span class="lh-18 pr-2">Student</span>
                                    <div class="review-stars">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $item->rating)
                                                <span class="la la-star text-warning"></span>
                                            @else
                                                <span class="la la-star text-muted"></span>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div><!-- end media -->
                        <p class="card-text">{{ Str::limit($item->comment, 65, '...') }}</p>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            @endforeach


        </div><!-- end testimonial-carousel -->
    </div><!-- container-fluid -->
</section>
