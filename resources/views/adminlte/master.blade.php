<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title_prefix', config('adminlte.title_prefix', ''))
@yield('title', config('adminlte.title', 'AdminLTE 2'))
@yield('title_postfix', config('adminlte.title_postfix', ''))</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('ionicons/css/ionicons.min.css') }}">

    @if(config('adminlte.plugins.select2'))
        <!-- Select2 -->
        <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
    @endif

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/css/AdminLTE.min.css') }}">

    @if(config('adminlte.plugins.datatables'))
        {{--  <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables/css/dataTables.min.css') }}">  --}}
        <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
    @endif

    @yield('adminlte_css')

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition @yield('body_class')">

@yield('body')
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>


@if(config('adminlte.plugins.datatables'))
    <script src="{{ asset('adminlte/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
      {{--  <script src="{{ asset('adminlte/plugins/datatables/js/dataTables.min.js') }}"></script>  --}}
      <script src="{{ asset('adminlte/plugins/datatables/js/dataTables.bootstrap.min.js') }}"></script>
@endif
{{--  <script src="{{ asset('js/app.js') }}"></script>  --}}


@if(config('adminlte.plugins.select2'))
    <!-- Select2 -->
     <script src="{{ asset('adminlte/plugins/select2/js/select2.min.js') }}"></script>
@endif

    <script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>

@yield('adminlte_js')

</body>
</html>
