@extends('adminlte::master')

@inject('layoutHelper', \JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper::class)


@if($layoutHelper->isLayoutTopnavEnabled())
    @php( $def_container_class = 'container' )
@else
    @php( $def_container_class = 'container-fluid' )
@endif

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('classes_body', $layoutHelper->makeBodyClasses())

@section('body_data', $layoutHelper->makeBodyData())

@section('body')
    <div class="wrapper">
        {{-- Top Navbar --}}
        @if($layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.navbar.navbar-layout-topnav')
        @else
            @include('adminlte::partials.navbar.navbar')
        @endif

        {{-- Left Main Sidebar --}}
        @if(!$layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.sidebar.left-sidebar')
        @endif

        {{-- Content Wrapper --}}
        <div class="content-wrapper {{ config('adminlte.classes_content_wrapper') ?? '' }}">

            {{-- Content Header --}}
            <div class="content-header">
                <div class="{{ config('adminlte.classes_content_header') ?: $def_container_class }}">
                    @yield('content_header')
                </div>
            </div>

            {{-- Main Content --}}
            <div class="content">
                <div class="{{ config('adminlte.classes_content') ?: $def_container_class }}">
                    @include('demo_warning')
                    @yield('content')
                    @if(Auth::user()->role_id==0)
                    @include('wallet_admin_amount')
                  @else
                      @include('wallet_user_amount')
                  @endif
                </div>
            </div>

        </div>

        {{-- Footer --}}
        @hasSection('footer')
            @include('adminlte::partials.footer.footer')
        @endif

        {{-- Right Control Sidebar --}}
        @if(config('adminlte.right_sidebar'))
            @include('adminlte::partials.sidebar.right-sidebar')
        @endif

    </div>
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
    <script type="text/javascript">
        //user drower
        document.addEventListener('DOMContentLoaded', function() {
         var openDrawerButton = document.getElementById('openDrawerButton');
         var closeDrawerButton = document.getElementById('closeDrawerButton');
         var drawer = document.getElementById('drawer-1');

         openDrawerButton.addEventListener('click', function() {
             drawer.classList.add('open');
         });

         closeDrawerButton.addEventListener('click', function() {
             drawer.classList.remove('open');
         });
     });
     //admin drower
     document.addEventListener('DOMContentLoaded', function() {
         var openDrawerButton = document.getElementById('openDrawerButtonAdmin');
         var closeDrawerButton = document.getElementById('closeDrawerButtonAdmin');
         var drawer = document.getElementById('drawer-2');

         openDrawerButton.addEventListener('click', function() {
             drawer.classList.add('open');
         });

         closeDrawerButton.addEventListener('click', function() {
             drawer.classList.remove('open');
         });
     });
 </script>
@stop
