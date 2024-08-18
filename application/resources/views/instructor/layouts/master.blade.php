<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    
    <!--favicon-->
    <link rel="icon" href="{{ asset('application/public/backend/assets/images/favicon-32x32.png') }}" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('application/public/backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    <link href="{{ asset('application/public/backend/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('application/public/backend/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('application/public/backend/assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('application/public/backend/assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('application/public/backend/assets/js/pace.min.js') }}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('application/public/backend/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('application/public/backend/assets/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{ asset('application/public/backend/assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('application/public/backend/assets/css/icons.css') }}" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{ asset('application/public/backend/assets/css/dark-theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('application/public/backend/assets/css/semi-dark.css') }}" />
    <link rel="stylesheet" href="{{ asset('application/public/backend/assets/css/header-colors.css') }}" />
    {{-- datatable --}}
    <link href="{{ asset('application/public/backend/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}"
        rel="stylesheet" />
    {{-- //sweetalert2 --}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />

    <title>Rocker - Bootstrap 5 Admin Dashboard Template</title>
</head>

<body>

    @yield('content')
    
    <!-- Bootstrap JS -->
    <script src="{{ asset('application/public/backend/assets/js/bootstrap.bundle.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ asset('application/public/backend/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('application/public/backend/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('application/public/backend/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('application/public/backend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('application/public/backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('application/public/backend/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('application/public/backend/assets/plugins/chartjs/js/chart.js') }}"></script>
    <script src="{{ asset('application/public/backend/assets/js/index.js') }}"></script>

    {{-- datatable --}}
    <script src="{{ asset('application/public/backend/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('application/public/backend/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}">
    </script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>

    {{-- //sweetalert2 --}}
    <script src="{{ asset('application/public/backend/assets/js/code.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- //sweetalert2 end --}}

    {{-- jQuery cdn --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <!--app JS-->
    <script src="{{ asset('application/public/backend/assets/js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        new PerfectScrollbar(".app-container")
    </script>

    <script>
        @if(Session::has('message'))

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

    @stack('script')
</body>

</html>