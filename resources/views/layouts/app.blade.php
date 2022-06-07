<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Login</title>
    <meta content="Responsive admin theme build on top of Bootstrap 4" name="description" />
    <meta content="Themesdesign" name="author" />
    {{-- <link rel="shortcut icon" href="{{ URL::to('assets/images/favicon.ico') }}"> --}}
    <link rel="shortcut icon" href="{{ URL::to('images/jaqs-sm.jpeg') }}">
    <link href="{{ URL::to('../plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ URL::to('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::to('assets/css/metismenu.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::to('assets/css/icons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::to('assets/css/style.css') }}" rel="stylesheet" type="text/css">
    {{-- <link href='https://fonts.googleapis.com/css?family=Josefin Sans' rel='stylesheet'> --}}
    {{-- message toastr --}}
    {{-- <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script> --}}
    <script src="{{ URL::to('assets/js/jquery224.min.js') }}"></script>
    {{-- <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
</head>
<body>
    <style>
        .invalid-feedback{
            font-size: 14px;
        }
    </style>
    @yield('content')
    <!-- jQuery  -->
    <script src="{{ URL::to('assets/js/jquery.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/metismenu.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ URL::to('assets/js/waves.min.js') }}"></script>
    <script src="{{ URL::to('../plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- App js -->
    <script src="{{ URL::to('assets/js/app.js') }}"></script>

</body>
</html>
