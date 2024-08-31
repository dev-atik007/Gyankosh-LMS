<!-- template js files -->
<script src="{{ asset('application/public/templates/assets/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('application/public/templates/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('application/public/templates/assets/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('application/public/templates/assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('application/public/templates/assets/js/isotope.js') }}"></script>
<script src="{{ asset('application/public/templates/assets/js/waypoint.min.js') }}"></script>
<script src="{{ asset('application/public/templates/assets/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('application/public/templates/assets/js/fancybox.js') }}"></script>
<script src="{{ asset('application/public/templates/assets/js/plyr.js') }}"></script>
<script src="{{ asset('application/public/templates/assets/js/datedropper.min.js') }}"></script>
<script src="{{ asset('application/public/templates/assets/js/emojionearea.min.js') }}"></script>
<script src="{{ asset('application/public/templates/assets/js/jquery-te-1.4.0.min.js') }}"></script>
<script src="{{ asset('application/public/templates/assets/js/jquery.MultiFile.min.js') }}"></script>
<script src="{{ asset('application/public/templates/assets/js/main.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
