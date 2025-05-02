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
    <a class="nav-link" href="{{route('reports.list')}}">
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
		<li class="nav-item">
			<a class="nav-link" href="{{route('kyc.pancard')}}">
				<i class="far fa-fw fa-circle"></i>
				<p>PAN CARD</p>
			</a>
        </li>
        <li class="nav-item">
			<a class="nav-link" href="{{route('kyc.pancard.upload')}}">
				<i class="far fa-fw fa-circle"></i>
				<p>PAN CARD UPLOAD</p>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="{{route('kyc.aadhaar_validation')}}">
				<i class="far fa-fw fa-circle"></i>
				<p>AADHAAR CARD</p>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="{{route('kyc.voter_validation')}}">
				<i class="far fa-fw fa-circle"></i>
				<p>VOTER ID</p>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="{{route('kyc.license_validation')}}">
				<i class="far fa-fw fa-circle"></i>
				<p>LICENCE </p>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="{{route('kyc.rc_validation')}}">
				<i class="far fa-fw fa-circle"></i>
				<p>RC</p>
			</a>
		</li>
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