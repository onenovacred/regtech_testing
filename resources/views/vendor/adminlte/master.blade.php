<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    {{-- Base Meta Tags --}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Custom Meta Tags --}}
    @yield('meta_tags')

    {{-- Title --}}
    <title>
        @yield('title_prefix', config('adminlte.title_prefix', ''))
        @yield('title', config('adminlte.title', 'AdminLTE 3'))
        @yield('title_postfix', config('adminlte.title_postfix', ''))
    </title>

    {{-- Custom stylesheets (pre AdminLTE) --}}
    @yield('adminlte_css_pre')

    {{-- Base Stylesheets --}}
    @if(!config('adminlte.enabled_laravel_mix'))
        <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css">

        {{-- Configured Stylesheets --}}
        @include('adminlte::plugins', ['type' => 'css'])

        <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    @else
        <link rel="stylesheet" href="{{ mix(config('adminlte.laravel_mix_css_path', 'css/app.css')) }}">
    @endif

    {{-- Livewire Styles --}}
    @if(config('adminlte.livewire'))
        @if(app()->version() >= 7)
            @livewireStyles
        @else
            <livewire:styles />
        @endif
    @endif

    {{-- Custom Stylesheets (post AdminLTE) --}}
    @yield('adminlte_css')

    {{-- Favicon --}}
    @if(config('adminlte.use_ico_only'))
        <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" />
    @elseif(config('adminlte.use_full_favicon'))
        <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" />
        <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicons/apple-icon-57x57.png') }}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicons/apple-icon-60x60.png') }}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicons/apple-icon-72x72.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicons/apple-icon-76x76.png') }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicons/apple-icon-114x114.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicons/apple-icon-120x120.png') }}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicons/apple-icon-144x144.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicons/apple-icon-152x152.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-icon-180x180.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/favicon-96x96.png') }}">
        <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('favicons/android-icon-192x192.png') }}">
        <link rel="manifest" href="{{ asset('favicons/manifest.json') }}">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{ asset('favicon/ms-icon-144x144.png') }}">
    @endif
    @yield('custom_css')
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}"> -->
    <!-- <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}"> -->
    <style type="text/css">
        .btnEdit {
            color: #117a8b;
            font-size: 18px;
        }
        .btnDelete {
            color: #bd2130;
            margin-left: 10px;
            font-size: 18px;
        }
        .btnNoDelete {
            color: #6c757d;
            margin-left: 10px;
            cursor: not-allowed;
            font-size: 18px;
        }
        .card-title {
            font-size: 24px;
            margin-top: 6px;
        }
        .card-header .btn {
            color: #000000 !important;
        }
        .fa-arrow-down {
            color: #dc3545;
        }
        .fa-arrow-up {
            color: #28a745;
        }
        .tableTools-container {
            margin-bottom: 8px;
            position: relative
        }
            
.gritter-item-wrapper.dt-button-info>h2 {
    margin-top: 0
}

.dt-button-collection .dropdown-menu {
    display: block;
    z-index: 1101
}

.dt-button-collection .dropdown-menu>li>a {
    color: #888;
    text-decoration: line-through
}

.dt-button-collection .dropdown-menu>li>a.active {
    color: #333;
    text-decoration: none
}

div.dt-button-background {
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    background-color: #000;
    z-index: 1100;
    opacity: .1
}

.dataTable>tbody>tr.selected>td {
    background-color: #dff0d8
}

.dataTable>tbody>tr.selected:hover>td {
    background-color: #d0e9c6
}

div.dataTables_processing {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 80%;
    height: 60px;
    margin-left: -40%;
    margin-top: -25px;
    padding-top: 20px;
    padding-bottom: 20px;
    text-align: center;
    font-size: 1.2em;
    background-color: #fff;
    border: 2px solid #DDD;
    background-color: rgba(255, 255, 255, .66)
}
.bigger-110 {
    font-size: 110%!important;
}
.dark {
    color: #333!important
}

.white {
    color: #FFF!important
}

.red {
    color: #DD5A43!important
}

.red2 {
    color: #E08374!important
}

.light-red {
    color: #F77!important
}

.blue {
    color: #478FCA!important
}

.light-blue {
    color: #93CBF9!important
}

.green {
    color: #69AA46!important
}

.light-green {
    color: #B0D877!important
}

.orange {
    color: #FF892A!important
}

.orange2 {
    color: #FEB902!important
}

.light-orange {
    color: #FCAC6F!important
}

.purple {
    color: #A069C3!important
}

.pink {
    color: #C6699F!important
}

.pink2 {
    color: #D6487E!important
}

.brown {
    color: brown!important
}

.grey {
    color: #777!important
}

.light-grey {
    color: #BBB!important
}
.btn-white.btn-primary {
    border-color: #8aafce;
    color: #6688a6!important;
}
.btn.btn-white, .btn.btn-white.no-hover:active, .btn.btn-white.no-hover:hover {
    background-color: #FFF!important;
}

.table {
    width: 100% !important;
}
    </style>
</head>

<body class="@yield('classes_body')" @yield('body_data')>

    {{-- Body Content --}}
    @yield('body')

    {{-- Base Scripts --}}
    @if(!config('adminlte.enabled_laravel_mix'))
        <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
        

        {{-- Configured Scripts --}}
        @include('adminlte::plugins', ['type' => 'js'])

        <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @else
        <script src="{{ mix(config('adminlte.laravel_mix_js_path', 'js/app.js')) }}"></script>
    @endif

    {{-- Livewire Script --}}
    @if(config('adminlte.livewire'))
        @if(app()->version() >= 7)
            @livewireScripts
        @else
            <livewire:scripts />
        @endif
    @endif

    {{-- Custom Scripts --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    @yield('adminlte_js')
    @yield('custom_js')
    <script src="{{ asset('plugins/toastr/toastr.min.js')}}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js')}}"></script> -->
    <!-- <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script> -->
    <!-- <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script> -->
    <!-- <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script> -->
    <!-- <script src="{{ asset('plugins/datatable/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('plugins/datatable/jquery.dataTables.bootstrap.min.js')}}"></script>
    <script src="{{ asset('plugins/datatable/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('plugins/datatable/buttons.flash.min.js')}}"></script>
    <script src="{{ asset('plugins/datatable/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('plugins/datatable/buttons.print.min.js')}}"></script>
    <script src="{{ asset('plugins/datatable/buttons.colVis.min.js')}}"></script>
    <script src="{{ asset('plugins/datatable/dataTables.select.min.js')}}"></script> -->
    <script src="{{asset('plugins/datatable/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatable/jquery.dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('plugins/datatable/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('plugins/datatable/jszip.min.js')}}"></script>
    <script src="{{asset('plugins/datatable/buttons.flash.min.js')}}"></script>
    <script src="{{asset('plugins/datatable/buttons.html5.min.js')}}"></script>
    <script src="{{asset('plugins/datatable/buttons.print.min.js')}}"></script>
    <script src="{{asset('plugins/datatable/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('plugins/datatable/pdfmake.min.js')}}"></script>
    <script src="{{asset('plugins/datatable/vfs_fonts.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            @if(session('success'))
            toastr.success("{{session('success')}}");
            @endif

            @if(session('error'))
            toastr.error("{{session('error')}}");
            @endif

            @if(session('warning'))
            toastr.warning("{{session('warning')}}");
            @endif

            $(document).on('click','.btnNoDelete',function() {
                toastr.error("Can not delete this");
            });
        });
    </script>
</body>

</html>
