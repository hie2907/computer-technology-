<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Modernize Free</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('admin/Authencation/assets/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('admin/Authencation/assets/css/styles.min.css') }}" />
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <img src="{{ asset('admin/Authencation/assets/images/logos/dark-logo.svg') }}"
                                        width="180" alt="">
                                </a>
                                <p class="text-center">Chào Mừng Tới Hie</p>
                                @yield('formAuthen')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('admin/Authencation/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/Authencation/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
