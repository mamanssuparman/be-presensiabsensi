<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ url('') }}/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('') }}/assets/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ url('') }}/assets/bower_components/Ionicons/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet"
        href="{{ url('') }}/assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('') }}/assets/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ url('') }}/assets/dist/css/skins/_all-skins.min.css">
    <link href="{{ url('') }}/assets/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="{{ url('') }}/assets/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="{{ url('') }}/assets/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">
    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('cssexternal')
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="flash-data" data-flashdata="{{ session('pesan') }}"></div>
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="../../index2.html" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>K</b>BIL</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Admin</b>Panel</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            @include('includes.navbar')
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        @include('includes.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @include('includes.contentheader')
            <!-- Main content -->
            <!-- /.content -->
            @yield('content')
        </div>
        <!-- /.content-wrapper -->
        @include('includes.footer')
    </div>
    <!-- ./wrapper -->

    <!-- jQuery 3 -->
    <script src="{{ url('') }}/assets/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ url('') }}/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="{{ url('') }}/assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ url('') }}/assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="{{ url('') }}/assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="{{ url('') }}/assets/bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('') }}/assets/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ url('') }}/assets/dist/js/demo.js"></script>
    <script src="{{ url('') }}/assets/pnotify/dist/pnotify.js"></script>
    <script src="{{ url('') }}/assets/pnotify/dist/pnotify.buttons.js"></script>
    <script src="{{ url('') }}/assets/pnotify/dist/pnotify.nonblock.js"></script>
    <!-- page script -->
    <script>
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        var baseUrl = "{{ url('/') }}" + '/'
        var listRoutes = JSON.parse('{{ json_decode(listRoutes()) }}')
    </script>
    @stack('externaljs')
    <script>
        const flashData = $('.flash-data').data('flashdata');
        if (flashData == "success") {
            new PNotify({
                title: 'Informasi',
                text: 'Data berhasil di simpan',
                type: 'success',
                styling: 'bootstrap3'
            });
        }
        if (flashData == "ubah") {
            new PNotify({
                title: 'Informasi',
                text: 'Data berhasil di perbaharui',
                type: 'success',
                styling: 'bootstrap3'
            });
        }
        if (flashData == "hapus") {
            new PNotify({
                title: 'Informasi',
                text: 'Data berhasil di hapus',
                type: 'success',
                styling: 'bootstrap3'
            });
        }
        if (flashData == "gagalhapus") {
            new PNotify({
                title: 'Informasi',
                text: 'Data tersebut masih berelasi / ada kaitan dengan data yang lain, sehingga tidak bisa di hapus.!',
                type: 'error',
                styling: 'bootstrap3'
            });
        }
        if (flashData == "gagal") {
            new PNotify({
                title: 'Informasi',
                text: 'Data gagal di perbaharui.!',
                type: 'error',
                styling: 'bootstrap3'
            });
        }
        if (flashData == "warning") {
            new PNotify({
                title: 'Informasi',
                text: 'Mohon periksa kembali data.!',
                styling: 'bootstrap3'
            });
        }
    </script>
</body>

</html>
