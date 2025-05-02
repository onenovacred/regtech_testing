<li class="nav-item">
    <a class="nav-link" href="#">
        <i class="fa fa-fw fa-tachometer"></i>
        <p>Dashboard</p>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{route('transaction.list')}}">
        <i class="fa fa-fw fa-inr"></i>
        <p>Transaction</p>
    </a>
</li>

<!-- <li class="nav-item">
    <a class="nav-link" href="{{route('report.list')}}">
        <i class="fa fa-fw fa-bar-chart"></i>
        <p>Report</p>
    </a>
</li> -->

<li class="nav-item has-treeview">
	<a class="nav-link" href="">
		<i class="fa fa-fw fa-file-text-o"></i>
		<p>KYC VERIFICATION<i class="fas fa-angle-left right"></i></p>
	</a>
	<ul class="nav nav-treeview" style="display: none;">
		<?php
		$apiidarr=DB::table('scheme_master')->where('user_id',Auth::user()->id)->pluck('api_id');
		$menus=DB::table('api_master')->whereIn('id',$apiidarr)->get();
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
    <a class="nav-link" href="#">
        <i class="fa fa-fw fa-user-circle"></i>
        <p>Profile</p>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="#">
        <i class="fa fa-fw fa-key"></i>
        <p>Change Password</p>
    </a>
</li>