<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Trung Tâm Máy Tính Đình Lưu</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{ asset('admin/DashboardAuth/assets/img/kaiadmin/favicon.ico') }}" type="image/x-icon" />

    @include('admin.components.js.script2')
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->

        @include('admin.components.sidebarDasboard')
        <!-- End Sidebar -->

        <div class="main-panel">
            @include('admin.components.headbarDashboard')

            @yield('bodyDashboard')

            @include('admin.components.footer')
        </div>

        <!-- Custom template | don't include it in your project! -->
            @include('admin.components.buttonColors')
        <!-- End Custom template -->
    </div>
    <!--   Core JS Files   -->
    @include('admin.components.js.script')
</body>

</html>
