@extends('templates.layouts.frontend')
@section('master')

    @section('title')
        Gyankosh Learning
    @endsection

    @include('templates.sections.hero-area')

    @include('templates.sections.feature-area')

    @include('templates.sections.category')

    @include('templates.sections.course-area')

    @include('templates.sections.course-area-two')

    @include('templates.sections.funfact-area')

    @include('templates.sections.cat-area')

    @include('templates.sections.testimonial-area')

    <div class="section-block"></div>

    @include('templates.sections.about-area')

    <div class="section-block"></div>

    @include('templates.sections.register-area')

    <div class="section-block"></div>

    @include('templates.sections.logo-area')

    @include('templates.sections.blog-area')

    @include('templates.sections.get-started')

    @include('templates.sections.subscriber')
    
@endsection
