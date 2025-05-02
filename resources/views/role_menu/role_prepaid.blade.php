<li class="nav-item">
    <a class="nav-link" href="{{ route('home') }}">
        <i class="fa fa-fw fa-tachometer"></i>
        <p>Prepaid Dashboard</p>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="#">
        <i class="fa fa-fw fa-tachometer"></i>
        <p>My Prepaid Scheme</p>
    </a>
</li>

<li class="nav-item">
    <?php
    $user_menus = DB::table('menu_permission')
        ->where('user_id', Auth::user()->id)
        ->get();
    // dd($user_menus);
    ?>
    @foreach ($user_menus as $key => $user_menu)
        @if ($user_menu->menu == 'user')
<li class="nav-item">
    <a class="nav-link" href="{{ route('user.list') }}">
        <i class="fa fa-fw fa-user"></i>
        <p>Users</p>
    </a>
</li>
@endif
@if ($user_menu->menu == 'report')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('reports.list') }}">
            <i class="fa fa-fw fa-bar-chart"></i>
            <p>Report</p>
        </a>
    </li>
@endif
@endforeach

<a class="nav-link" href="{{ route('transaction.list') }}">
    <i class="fa fa-fw fa-inr"></i>
    <p>Transaction</p>
</a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('api.api_docs') }}">
        <i class="fa fa-fw fa-file-alt"></i>
        <p>API Docs</p>
    </a>
</li>

<?php
$user_api_group = DB::table('user_scheme_master')
    ->select('api_group_id')
    ->where('user_id', Auth::user()->id)
    ->groupBy('api_group_id')
    ->get()
    ->toArray();
$arrayName = [];
$myarr = '';
foreach ($user_api_group as $key => $value) {
    array_push($arrayName, $value->api_group_id);
    $myarr .= $value->api_group_id . ',';
}
$myarr = rtrim($myarr, ',');

?>

@if (in_array(1, $arrayName))
    <li class="nav-item has-treeview">
        <a class="nav-link" href="">
            <i class="fa fa-fw fa-file-text-o"></i>
            <p>KYC VERIFICATION<i class="fas fa-angle-left right"></i></p>
        </a>
        <ul class="nav nav-treeview" style="display: none;">
            <?php
            $apiidarr = DB::table('user_scheme_master')
                ->where('user_id', Auth::user()->id)
                ->where('api_group_id', 1)
                ->pluck('api_id');
            
            $menus = DB::table('api_master')->whereIn('id', $apiidarr)->get();
            ?>
            @foreach ($menus as $key => $menu)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route($menu->route_name) }}">
                        <i class="far fa-fw fa-circle"></i>
                        <p>{{ $menu->api_name }}</p>
                    </a>
                </li>
            @endforeach
        </ul>
    </li>
@endif

@if (in_array(6, $arrayName))
    <li class="nav-item has-treeview">
        <a class="nav-link" href="">
            <i class="fa fa-fw fa-file-text-o"></i>
            <p>Corporate<i class="fas fa-angle-left right"></i></p>
        </a>
        <ul class="nav nav-treeview" style="display: none;">
            <?php
            $apiidarr = DB::table('user_scheme_master')
                ->where('user_id', Auth::user()->id)
                ->where('api_group_id', 6)
                ->pluck('api_id');
            $menus = DB::table('api_master')->whereIn('id', $apiidarr)->get();
            ?>
            @foreach ($menus as $key => $menu)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route($menu->route_name) }}">
                        <i class="far fa-fw fa-circle"></i>
                        <p>{{ $menu->api_name }}</p>
                    </a>
                </li>
            @endforeach
        </ul>
    </li>
@endif

@if (in_array(7, $arrayName))
    <li class="nav-item has-treeview">
        <a class="nav-link" href="">
            <i class="fa fa-fw fa-file-text-o"></i>
            <p>Bank Verification<i class="fas fa-angle-left right"></i></p>
        </a>
        <ul class="nav nav-treeview" style="display: none;">
            <?php
            $apiidarr = DB::table('user_scheme_master')
                ->where('user_id', Auth::user()->id)
                ->where('api_group_id', 7)
                ->pluck('api_id');
            $menus = DB::table('api_master')->whereIn('id', $apiidarr)->get();
            ?>
            @foreach ($menus as $key => $menu)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route($menu->route_name) }}">
                        <i class="far fa-fw fa-circle"></i>
                        <p>{{ $menu->api_name }}</p>
                    </a>
                </li>
            @endforeach
        </ul>
    </li>
@endif


<li class="nav-item">
    <a class="nav-link" href="{{ route('user.profile') }}">
        <i class="fa fa-fw fa-user-circle"></i>
        <p>Profile</p>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('user.changePassword') }}">
        <i class="fa fa-fw fa-key"></i>
        <p>Change Password</p>
    </a>
</li>
