<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('Title') ::Samagi Musical:: </title>
@include('libaries.styles')
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        @include('components.navbar')
        @include('components.sidebar')


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">


            @yield('content')
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">

            <strong>Copyright &copy; 2024 Samagi Musical - Ambalangoda.
        </footer>

    </div>
    <!-- ./wrapper -->
@include('libaries.script')
</body>

</html>
