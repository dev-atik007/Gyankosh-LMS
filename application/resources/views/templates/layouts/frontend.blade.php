<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="author" content="TechyDevs">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Aduca - Education HTML Template</title>

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" sizes="16x16" href="{{ asset('application/public/templates/assets/images/favicon.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- inject:css -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="{{ asset('application/public/templates/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('application/public/templates/assets/css/line-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('application/public/templates/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('application/public/templates/assets/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('application/public/templates/assets/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('application/public/templates/assets/css/fancybox.css') }}">
    <link rel="stylesheet" href="{{ asset('application/public/templates/assets/css/tooltipster.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('application/public/templates/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('application/public/templates/assets/css/plyr.css') }}">
    {{-- //sweetalert2 --}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />

    

    <!-- end inject -->
</head>

<body>
    <div class="preloader">
        <div class="loader">
            <svg class="spinner" viewBox="0 0 50 50">
                <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
            </svg>
        </div>
    </div>

    @include('templates.partials.header')

    @yield('master')

    @include('templates.partials.footer')


    <div id="scroll-top">
        <i class="la la-arrow-up" title="Go top"></i>
    </div>

    <!-- template js files -->
    <script src="{{ asset('application/public/templates/assets/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('application/public/templates/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('application/public/templates/assets/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('application/public/templates/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('application/public/templates/assets/js/isotope.js') }}"></script>
    <script src="{{ asset('application/public/templates/assets/js/waypoint.min.js') }}"></script>
    <script src="{{ asset('application/public/templates/assets/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('application/public/templates/assets/js/fancybox.js') }}"></script>
    <script src="{{ asset('application/public/templates/assets/js/datedropper.min.js') }}"></script>
    <script src="{{ asset('application/public/templates/assets/js/emojionearea.min.js') }}"></script>
    <script src="{{ asset('application/public/templates/assets/js/tooltipster.bundle.min.js') }}"></script>
    <script src="{{ asset('application/public/templates/assets/js/jquery.lazy.min.js') }}"></script>
    <script src="{{ asset('application/public/templates/assets/js/main.js') }}"></script>
    <script src="{{ asset('application/public/templates/assets/js/plyr.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- jQuery cdn --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    {{-- //sweetalert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- //sweetalert2 end --}}


    @include('templates.partials.script')

    <script>
        var player = new Plyr('#player');
    </script>

    <script>
        @if (Session::has('message'))

            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;

                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;

                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;

                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
        @endif
    </script>
</body>

</html>
