<!Doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Teko:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/app.css') }}">
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
    @yield('head')
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/fa9a16eb6f.js" crossorigin="anonymous"></script>
</head>
<body>
    @include('web.layout.include.navbar')

	@yield('content')

    @include('web.layout.include.footer')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script>
        @if(Session::has('success'))
            toastr.success("{{Session::get('success')}}");
        @endif
        @if(Session::has('warning'))
            toastr.warning("{{Session::get('warning')}}");
        @endif
        @if(Session::has('info'))
            toastr.info("{{Session::get('info')}}");
        @endif
        @if(Session::has('error'))
            toastr.error("{{Session::get('error')}}");
        @endif
    </script>
    @yield('script')
</body>
</html>
