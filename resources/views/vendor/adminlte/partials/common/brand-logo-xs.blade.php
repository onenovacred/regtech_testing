@inject('layoutHelper', \JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper::class)

@php( $dashboard_url = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home') )

@if (config('adminlte.use_route_url', false))
    @php( $dashboard_url = $dashboard_url ? route($dashboard_url) : '' )
@else
    @php( $dashboard_url = $dashboard_url ? url($dashboard_url) : '' )
@endif

<a href="{{ $dashboard_url }}" style="padding: 0.56rem 0.5rem; background-color: #f4f6f9"
    @if($layoutHelper->isLayoutTopnavEnabled())
        class="navbar-brand {{ config('adminlte.classes_brand') }} text-center"
    @else
        class="brand-link {{ config('adminlte.classes_brand') }} text-center"
    @endif>

    {{-- Small brand logo --}}
    <img src="{{ asset(config('adminlte.logo_img', 'vendor/adminlte/dist/img/AdminLTELogo.png')) }}"
         alt="{{ config('adminlte.logo_img_alt', 'AdminLTE') }}"
         class="{{ config('img-circle elevation-3') }}"
         style="opacity:.8; width:17%; height: 30%; margin-top: -10px">

    {{-- Brand text --}}
    <span class="brand-text font-weight-light {{ config('adminlte.classes_brand_text') }}">
        <!-- {!! config('adminlte.logo', '<b>Admin</b>LTE') !!} -->
        <b><span style="color:#d12928; font-size:35px">Reg</span><span style="color: #3344b7; font-size:35px">Tech</span></b>
    </span>

</a>
