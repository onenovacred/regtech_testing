<li class="nav-item">
    <a class="nav-link" href="{{route('/home')}}">
        <i class="fa fa-fw fa-tachometer"></i>
        <p>Dashboard</p>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{route('api.list')}}">
        <i class="fa fa-fw fa-th"></i>
        <p>Api Master</p>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{route('user.scheme.list')}}">
        <i class="fa fa-fw fa-th"></i>
        <p>User Scheme</p>
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

<!-- <li class="nav-item">
    <a class="nav-link" href="{{route('report.list')}}">
        <i class="fa fa-fw fa-bar-chart"></i>
        <p>Report</p>
    </a>
</li> -->

<li class="nav-item has-treeview">
	<a class="nav-link" href="">
		<i class="fa fa-fw fa-file-text-o"></i>
		<p>MKYCDOCS<i class="fas fa-angle-left right"></i></p>
	</a>
	<ul class="nav nav-treeview" style="display: none;">
		<li class="nav-item">
			<a class="nav-link" href="{{route('kyc.pull_kra')}}">
				<i class="far fa-fw fa-circle"></i>
				<p>Pull KRA</p>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="{{route('kyc.bank_verification')}}">
				<i class="far fa-fw fa-circle"></i>
				<p>Bank Verification</p>
			</a>
		</li>
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
		<li class="nav-item">
			<a class="nav-link" href="{{route('kyc.passport_create_client')}}">
				<i class="far fa-fw fa-circle"></i>
				<p>Passport Create Client</p>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="{{route('kyc.passport_upload')}}">
				<i class="far fa-fw fa-circle"></i>
				<p>Passport Upload</p>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="{{route('kyc.passport_verify')}}">
				<i class="far fa-fw fa-circle"></i>
				<p>Passport Verify</p>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="{{route('kyc.passport_get_client_details')}}">
				<i class="far fa-fw fa-circle"></i>
				<p>Passport Get Client Details</p>
			</a>
		</li>
	</ul>
</li>

<li class="nav-item has-treeview">
	<a class="nav-link" href="">
		<i class="fa fa-fw fa-building"></i>
		<p>Corporate<i class="fas fa-angle-left right"></i></p>
	</a>
	<ul class="nav nav-treeview" style="display: none;">
		
		<li class="nav-item">
			<a class="nav-link" href="{{route('kyc.corporate_cin')}}">
				<i class="far fa-fw fa-circle"></i>
				<p>CIN</p>
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link" href="{{route('kyc.corporate_din')}}">
				<i class="far fa-fw fa-circle"></i>
				<p>DIN</p>
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link" href="{{route('kyc.corporate_gstin')}}">
				<i class="far fa-fw fa-circle"></i>
				<p>GSTIN</p>
			</a>
		</li>
		
	</ul>
</li>

<li class="nav-item has-treeview">
	<a class="nav-link" href="">
		<i class="fa fa-fw fa-university"></i>
		<p>Bank Verification<i class="fas fa-angle-left right"></i></p>
	</a>
	<ul class="nav nav-treeview" style="display: none;">
		<li class="nav-item">
			<a class="nav-link" href="#">
				<i class="far fa-fw fa-circle"></i>
				<p>Bank Verification</p>
			</a>
		</li>
	</ul>
</li>

<li class="nav-item has-treeview">
	<a class="nav-link" href="">
		<i class="fa fa-fw fa-gift"></i>
		<p>Courier<i class="fas fa-angle-left right"></i></p>
	</a>
	<ul class="nav nav-treeview" style="display: none;">
		<li class="nav-item">
			<a class="nav-link" href="#">
				<i class="far fa-fw fa-circle"></i>
				<p>Multiple API already in that smartship API</p>
			</a>
		</li>
	</ul>
</li>

<li class="nav-item">
	<a class="nav-link" href="{{route('kyc.electricity')}}"> 
        <i class="fa fa-fw fa-bolt">
        <p>Electricity</p></i>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{route('kyc.shopestablishment')}}"> 
		<i class="fa fa-fw fa-shopping-bag"></i>
        <p>Shop Establishment</p>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{route('kyc.telecom')}}">
        <i class="fa fa-fw fa-phone-square"></i>
        <p>Telecom</p>
    </a>
</li>

<li class="nav-item has-treeview">
	<a class="nav-link" href="">
		<i class="fa fa-fw fa-pencil"></i>
		<p>eSign<i class="fas fa-angle-left right"></i></p>
	</a>
	<ul class="nav nav-treeview" style="display: none;">
		<li class="nav-item">
			<a class="nav-link" href="{{route('kyc.esign_initialize')}}">
				<i class="far fa-fw fa-circle"></i>
				<p>eSign Initialize</p>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="{{route('kyc.esign_upload_link')}}">
				<i class="far fa-fw fa-circle"></i>
				<p>eSign Upload Link</p>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="{{route('kyc.esign_get_client_link')}}">
				<i class="far fa-fw fa-circle"></i>
				<p>eSign Get Client Link</p>
			</a>
		</li>
	</ul>
</li>

<li class="nav-item has-treeview">
	<a class="nav-link" href="">
		<i class="fa fa-fw fa-file-video-o"></i>
		<p>Video KYC<i class="fas fa-angle-left right"></i></p>
	</a>
	<ul class="nav nav-treeview" style="display: none;">
		<li class="nav-item">
			<a class="nav-link" href="#">
				<i class="far fa-fw fa-circle"></i>
				<p>Own API + other Multiple API</p>
			</a>
		</li>
	</ul>
</li>

<li class="nav-item has-treeview">
	<a class="nav-link" href="">
		<i class="fa fa-fw fa-phone"></i>
		<p>IVR Calling<i class="fas fa-angle-left right"></i></p>
	</a>
	<ul class="nav nav-treeview" style="display: none;">
		<li class="nav-item">
			<a class="nav-link" href="#">
				<i class="far fa-fw fa-circle"></i>
				<p>Multiple 3rd Party API’s</p>
			</a>
		</li>
	</ul>
</li>

<li class="nav-item has-treeview">
	<a class="nav-link" href="">
		<i class="fa fa-fw fa-address-book"></i>
		<p>Passport<i class="fas fa-angle-left right"></i></p>
	</a>
	<ul class="nav nav-treeview" style="display: none;">
		<li class="nav-item">
			<a class="nav-link" href="#">
				<i class="far fa-fw fa-circle"></i>
				<p>Multiple 3rd Party API’s</p>
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