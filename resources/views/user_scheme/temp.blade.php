@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card card-primary">
				<div class="card-header">
					<h3 class="card-title">Scheme Details</h3>
					<div class="card-tools">
						<a href="#" class="btn btn-warning"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;SAVE</a>
					</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<table class="table table-bordered table-striped">
								<tbody>
									<tr>
										<td style="width:30%"><b>MKYCDOCS</b></td>
										<td>
											<div class="row" style="border-bottom: 1px solid #000000; padding: 5px 0px;">
												<div class="col-md-6">
													PAN CARD
												</div>
												<div class="col-md-6">
													<input type="text" class="form-control" name="txtName[]" value="PAN CARD">
													<input type="text" class="form-control" name="txtPrice0">
												</div>
											</div>
											<div class="row" style="border-bottom: 1px solid #000000; padding: 5px 0px;">
												<div class="col-md-6">
													AADHAR CARD
												</div>
												<div class="col-md-6">
													<input type="text" class="form-control" name="txtName[]" value="PAN CARD">
													<input type="text" class="form-control" name="txtPrice1">
												</div>
											</div>
											<div class="row" style="border-bottom: 1px solid #000000; padding: 5px 0px;">
												<div class="col-md-6">
													VOTER ID
												</div>
												<div class="col-md-6">
													<input type="text" class="form-control" name="txtName[]" value="PAN CARD">
													<input type="text" class="form-control" name="txtPrice2">
												</div>
											</div>
											<div class="row" style="border-bottom: 1px solid #000000; padding: 5px 0px;">
												<div class="col-md-6">
													DRIVING
												</div>
												<div class="col-md-6">
													<input type="text" class="form-control" name="txtName[]" value="PAN CARD">
													<input type="text" class="form-control" name="txtPrice3">
												</div>
											</div>
											<div class="row" style="border-bottom: 1px solid #000000; padding: 5px 0px;">
												<div class="col-md-6">
													LICENCE
												</div>
												<div class="col-md-6">
													<input type="text" class="form-control" name="txtName[]" value="PAN CARD">
													<input type="text" class="form-control" name="txtPrice4">
												</div>
											</div>
											<div class="row" style="border-bottom: 1px solid #000000; padding: 5px 0px;">
												<div class="col-md-6">
													RC
												</div>
												<div class="col-md-6">
													<input type="text" class="form-control" name="txtName[]" value="PAN CARD">
													<input type="text" class="form-control" name="txtPrice5">
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td style="width:30%"><b>Video KYC</b></td>
										<td>
											<div class="row" style="border-bottom: 1px solid #000000; padding: 5px 0px;">
												<div class="col-md-6">
													Multiple 3rd Party API’s
												</div>
												<div class="col-md-6">
													<input type="text" class="form-control" name="txtName[]" value="PAN CARD">
													<input type="text" class="form-control" name="txtPrice6">
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td style="width:30%"><b>IVR Calling</b></td>
										<td>
											<div class="row" style="border-bottom: 1px solid #000000; padding: 5px 0px;">
												<div class="col-md-6">
													Multiple 3rd Party API’s
												</div>
												<div class="col-md-6">
													<input type="text" class="form-control" name="txtName[]" value="PAN CARD">
													<input type="text" class="form-control" name="txtPrice7">
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td style="width:30%"><b>Passport</b></td>
										<td>
											<div class="row" style="border-bottom: 1px solid #000000; padding: 5px 0px;">
												<div class="col-md-6">
													Multiple 3rd Party API’s
												</div>
												<div class="col-md-6">
													<input type="text" class="form-control" name="txtName[]" value="PAN CARD">
													<input type="text" class="form-control" name="txtPrice8">
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td style="width:30%"><b>eSign</b></td>
										<td>
											<div class="row" style="border-bottom: 1px solid #000000; padding: 5px 0px;">
												<div class="col-md-6">
													Multiple 3rd Party API’s
												</div>
												<div class="col-md-6">
													<input type="text" class="form-control" name="txtName[]" value="PAN CARD">
													<input type="text" class="form-control" name="txtPrice9">
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td style="width:30%"><b>Corporate</b></td>
										<td>
											<div class="row" style="border-bottom: 1px solid #000000; padding: 5px 0px;">
												<div class="col-md-6">
													CIN
												</div>
												<div class="col-md-6">
													<input type="text" class="form-control" name="txtName[]" value="PAN CARD">
													<input type="text" class="form-control" name="txtPrice10">
												</div>
											</div>
											<div class="row" style="border-bottom: 1px solid #000000; padding: 5px 0px;">
												<div class="col-md-6">
													DIN
												</div>
												<div class="col-md-6">
													<input type="text" class="form-control" name="txtName[]" value="PAN CARD">
													<input type="text" class="form-control" name="txtPrice11">
												</div>
											</div>
											<div class="row" style="border-bottom: 1px solid #000000; padding: 5px 0px;">
												<div class="col-md-6">
													GSTIN
												</div>
												<div class="col-md-6">
													<input type="text" class="form-control" name="txtName[]" value="PAN CARD">
													<input type="text" class="form-control" name="txtPrice12">
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td style="width:30%"><b>Bank Verification</b></td>
										<td>
											<div class="row" style="border-bottom: 1px solid #000000; padding: 5px 0px;">
												<div class="col-md-6">
													Bank Verification
												</div>
												<div class="col-md-6">
													<input type="text" class="form-control" name="txtName[]" value="PAN CARD">
													<input type="text" class="form-control" name="txtPrice13">
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td style="width:30%"><b>Courier</b></td>
										<td>
											<div class="row" style="border-bottom: 1px solid #000000; padding: 5px 0px;">
												<div class="col-md-6">
													Multiple API already in that smartship API
												</div>
												<div class="col-md-6">
													<input type="text" class="form-control" name="txtName[]" value="PAN CARD">
													<input type="text" class="form-control" name="txtPrice14">
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td style="width:30%"><b>Other</b></td>
										<td>
											<div class="row" style="border-bottom: 1px solid #000000; padding: 5px 0px;">
												<div class="col-md-6">
													Electricity
												</div>
												<div class="col-md-6">
													<input type="text" class="form-control" name="txtName[]" value="PAN CARD">
													<input type="text" class="form-control" name="txtPrice15">
												</div>
											</div>
											<div class="row" style="border-bottom: 1px solid #000000; padding: 5px 0px;">
												<div class="col-md-6">
													Shop Establishment
												</div>
												<div class="col-md-6">
													<input type="text" class="form-control" name="txtName[]" value="PAN CARD">
													<input type="text" class="form-control" name="txtPrice16">
												</div>
											</div>
											<div class="row" style="border-bottom: 1px solid #000000; padding: 5px 0px;">
												<div class="col-md-6">
													Telecom
												</div>
												<div class="col-md-6">
													<input type="text" class="form-control" name="txtName[]" value="PAN CARD">
													<input type="text" class="form-control" name="txtPrice17">
												</div>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop