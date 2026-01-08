<li class="nav-item">
    <a class="nav-link" href="{{route('home')}}">
        <i class="fa fa-fw fa-tachometer"></i>
        <p>Dashboard</p>
    </a>
</li>
@if(Auth::user()->role_id==0)
<li class="nav-item">
    <a class="nav-link" id="openDrawerButtonAdmin">
        <i class="fa fa-fw fa-tachometer"></i>
        <p>Wallet Credit/Debit</p>
    </a>
</li>
@endif

<li class="nav-item">
    <a class="nav-link" href="{{route('api.list')}}">
        <i class="fa fa-fw fa-th"></i>
        <p>Api Master</p>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{route('api.sitechange')}}">
        <i class="fa fa-fw fa-th"></i>
        <p>Website</p>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{route('scheme_type.list')}}">
        <i class="fa fa-fw fa-th"></i>
        <p>Scheme Type Master</p>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{route('user.list')}}">
        <i class="fa fa-fw fa-user"></i>
        <p>Users</p>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{route('transaction.list')}}">
        <i class="fa fa-fw fa-inr"></i>
        <p>Transaction</p>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{route('reports.list')}}">
        <i class="fa fa-fw fa-bar-chart"></i>
        <p>Report</p>
    </a>
</li>

<li class="nav-item has-treeview">
    <a class="nav-link" href="">
        <i class="fa fa-fw fa-file-text-o"></i>
        <p>KYC VERIFICATION<i class="fas fa-angle-left right"></i></p>
    </a>
    <ul class="nav nav-treeview" style="display: none;">
        <?php
        $menus=DB::table('api_master')->where('api_group_id',1)->get();
        ?>
        
        @foreach($menus as $key=>$menu)
        <li class="nav-item">
            <a class="nav-link" href="{{route($menu->route_name)}}">
                <i class="far fa-fw fa-circle"></i>
                <p>{{$menu->api_name}}</p>
            </a>
        </li>
        @endforeach
    </ul>
</li>

<li class="nav-item has-treeview">
    <a class="nav-link" href="">
        <i class="fa fa-fw fa-building"></i>
		<p>Corporate<i class="fas fa-angle-left right"></i></p>
    </a>
    <ul class="nav nav-treeview" style="display: none;">
        <?php
        $menus=DB::table('api_master')->where('api_group_id',6)->get();
        ?>
        @foreach($menus as $key=>$menu)
        <li class="nav-item">
            <a class="nav-link" href="{{route($menu->route_name)}}">
                <i class="far fa-fw fa-circle"></i>
                <p>{{$menu->api_name}}</p>
            </a>
        </li>
        @endforeach
    </ul>
</li>

<li class="nav-item has-treeview">
    <a class="nav-link" href="">
        <i class="fa fa-fw fa-university"></i>
		<p>Bank Verification<i class="fas fa-angle-left right"></i></p>
    </a>
    <ul class="nav nav-treeview" style="display: none;">
        <?php
        $menus=DB::table('api_master')->where('api_group_id',7)->get();
        ?>
        @foreach($menus as $key=>$menu)
        <li class="nav-item">
            <a class="nav-link" href="{{route($menu->route_name)}}">
                <i class="far fa-fw fa-circle"></i>
                <p>{{$menu->api_name}}</p>
            </a>
        </li>
        @endforeach
    </ul>
</li>

<li class="nav-item has-treeview">
    <a class="nav-link" href="">
        <i class="fa fa-fw fa-gift"></i>
		<p>Courier<i class="fas fa-angle-left right"></i></p>
    </a>
    <ul class="nav nav-treeview" style="display: none;">
        <?php
        $menus=DB::table('api_master')->where('api_group_id',8)->get();
        ?>
        @foreach($menus as $key=>$menu)
        <li class="nav-item">
            <a class="nav-link" href="{{route($menu->route_name)}}">
                <i class="far fa-fw fa-circle"></i>
                <p>{{$menu->api_name}}</p>
            </a>
        </li>
        @endforeach
    </ul>
</li>

<li class="nav-item has-treeview">
    <a class="nav-link" href="">
        <i class="fa fa-fw fa-pencil"></i>
		<p>eSign<i class="fas fa-angle-left right"></i></p>
    </a>
    <ul class="nav nav-treeview" style="display: none;">
        <?php
        $menus=DB::table('api_master')->where('api_group_id',5)->get();
        ?>
        @foreach($menus as $key=>$menu)
        <li class="nav-item">
            <a class="nav-link" href="{{route($menu->route_name)}}">
                <i class="far fa-fw fa-circle"></i>
                <p>{{$menu->api_name}}</p>
            </a>
        </li>
        @endforeach
    </ul>
</li>

<li class="nav-item has-treeview">
    <a class="nav-link" href="">
        <i class="fa fa-fw fa-file-video-o"></i>
		<p>Video KYC<i class="fas fa-angle-left right"></i></p>
    </a>
    <ul class="nav nav-treeview" style="display: none;">
        <?php
        $menus=DB::table('api_master')->where('api_group_id',2)->get();
        ?>
        @foreach($menus as $key=>$menu)
        <li class="nav-item">
            <a class="nav-link" href="{{route($menu->route_name)}}">
                <i class="far fa-fw fa-circle"></i>
                <p>{{$menu->api_name}}</p>
            </a>
        </li>
        @endforeach
    </ul>
</li>

<li class="nav-item has-treeview">
    <a class="nav-link" href="">
        <i class="fa fa-fw fa-phone"></i>
		<p>IVR Calling<i class="fas fa-angle-left right"></i></p>
    </a>
    <ul class="nav nav-treeview" style="display: none;">
        <?php
        $menus=DB::table('api_master')->where('api_group_id',3)->get();
        ?>
        @foreach($menus as $key=>$menu)
        <li class="nav-item">
            <a class="nav-link" href="{{route($menu->route_name)}}">
                <i class="far fa-fw fa-circle"></i>
                <p>{{$menu->api_name}}</p>
            </a>
        </li>
        @endforeach
    </ul>
</li>

<li class="nav-item has-treeview">
    <a class="nav-link" href="">
        <i class="fa fa-fw fa-address-book"></i>
		<p>Passport<i class="fas fa-angle-left right"></i></p>
    </a>
    <ul class="nav nav-treeview" style="display: none;">
        <?php
        $menus=DB::table('api_master')->where('api_group_id',4)->get();
        ?>
        @foreach($menus as $key=>$menu)
        <li class="nav-item">
            <a class="nav-link" href="{{route($menu->route_name)}}">
                <i class="far fa-fw fa-circle"></i>
                <p>{{$menu->api_name}}</p>
            </a>
        </li>
        @endforeach
    </ul>
</li>

<li class="nav-item has-treeview">
    <a class="nav-link" href="">
        <i class="fa fa-fw fa-sitemap"></i>
		<p>Other<i class="fas fa-angle-left right"></i></p>
    </a>
    <ul class="nav nav-treeview" style="display: none;">
        <?php
        $menus=DB::table('api_master')->where('api_group_id',9)->get();
        ?>
        @foreach($menus as $key=>$menu)
        <li class="nav-item">
            <a class="nav-link" href="{{route($menu->route_name)}}">
                <i class="far fa-fw fa-circle"></i>
                <p>{{$menu->api_name}}</p>
            </a>
        </li>
        @endforeach
    </ul>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{route('user.profile')}}">
        <i class="fa fa-fw fa-user-circle"></i>
        <p>Profile</p>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{route('user.changePassword')}}">
        <i class="fa fa-fw fa-key"></i>
        <p>Change Password</p>
    </a>
</li>