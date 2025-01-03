<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Trung Tâm Máy Tính Đình Lưu</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet" />

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="{{ asset('client/css/bootstrap.min.css') }}" />

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="{{ asset('client/css/slick.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('client/css/slick-theme.css') }}" />

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="{{ asset('client/css/nouislider.min.css') }}" />

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="{{ asset('client/css/font-awesome.min.css') }}" />

    <!-- Custom stylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ asset('client/css/style.css') }}" />
    <link rel="stylesheet" href="{{asset('client/css/cart-product.css')}}">
    <link rel="stylesheet" href="{{asset('client/css/client-profile.css')}}">
</head>

<body>

    @include('users.components.header')

    @include('users.components.navigation')

    {{-- body --}}
    @yield('bodyclient')
    @include('users.components.footer')



    <!-- jQuery Plugins -->
    <script src="{{asset('client/js/jquery.min.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{asset('client/js/bootstrap.min.js')}}"></script>
    <script type="module" src="{{asset('client/js/products/filterProduct.js')}}"></script>
    <script src="{{asset('client/js/slick.min.js')}}"></script>
    <script src="{{asset('client/js/nouislider.min.js')}}"></script>
    <script src="{{asset('client/js/jquery.zoom.min.js')}}"></script>
    <script src="{{asset('client/js/main.js')}}"></script>
</body>

</html>
