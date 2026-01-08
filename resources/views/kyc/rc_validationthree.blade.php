@extends('adminlte::page')

@section('title', 'Regtechapi - RC Validation')

@section('content_header')
@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">

        <!-- ================= RC FORM ================= -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">RC Validation (Premium)</h3>
                <a role="button" class="btn btn-light float-right"
                   href="{{ route('kyc.rc_api') }}">RC APIs</a>
            </div>

            <div class="card-body">

                {{-- -------- ERROR MESSAGES -------- --}}
                @if(isset($statusCode) && $statusCode == 102)
                    <div class="alert alert-danger">
                        Invalid Vehicle Number
                    </div>
                @endif

                @if(isset($statusCode) && $statusCode == 403)
                    <div class="alert alert-danger">
                        Unauthorized Access
                    </div>
                @endif

                @if(isset($statusCode) && $statusCode == 404)
                    <div class="alert alert-danger">
                        Required data missing
                    </div>
                @endif

                @if(isset($statusCode) && $statusCode == 500)
                    <div class="alert alert-danger">
                        Internal Server Error. Please try again later.
                    </div>
                @endif

                {{-- -------- RC INPUT FORM -------- --}}
                <form method="post" action="{{ route('kyc.rc_validationthree') }}">
                    @csrf

                    <div class="form-group">
                        <label>RC Number</label>
                        <input type="text"
                               name="rcNumber"
                               class="form-control"
                               placeholder="Ex: MH12AB1234"
                               value="{{ old('rcNumber') }}"
                               required>
                    </div>

                    <button type="submit" class="btn btn-success">
                        Validate RC
                    </button>
                </form>
            </div>
        </div>

        <!-- ================= RC RESULT ================= -->
       @if(!empty($rc_validation) && isset($rc_validation['success']) && $rc_validation['success'] === true)

<div class="card card-success mt-3">
    <div class="card-header">
        <h3 class="card-title">RC Validation Result</h3>
    </div>

    <div class="card-body">

       
        <h5 class="text-primary">Basic Details</h5>
        <table class="table table-bordered table-sm">
            <tr><th>RC Number</th><td>{{ $rc_validation['data']['rc_number'] ?? '-' }}</td></tr>
            <tr><th>RC Status</th><td>{{ $rc_validation['data']['rc_status'] ?? '-' }}</td></tr>
            <tr><th>Registration Date</th><td>{{ $rc_validation['data']['registration_date'] ?? '-' }}</td></tr>
            <tr><th>Last Updated On</th><td>{{ $rc_validation['data']['latest_by'] ?? '-' }}</td></tr>
            <tr><th>Registered At</th><td>{{ $rc_validation['data']['registered_at'] ?? '-' }}</td></tr>
        </table>

      
        <h5 class="text-primary mt-3">Owner Details</h5>
        <table class="table table-bordered table-sm">
            <tr><th>Owner Name</th><td>{{ $rc_validation['data']['owner_name'] ?? '-' }}</td></tr>
            <tr><th>Father Name</th><td>{{ $rc_validation['data']['father_name'] ?? '-' }}</td></tr>
            <tr><th>Owner Count</th><td>{{ $rc_validation['data']['owner_number'] ?? '-' }}</td></tr>
            <tr><th>Mobile Number</th><td>{{ $rc_validation['data']['mobile_number'] ?? '-' }}</td></tr>
            <tr><th>Present Address</th><td>{{ $rc_validation['data']['present_address'] ?? '-' }}</td></tr>
            <tr><th>Permanent Address</th><td>{{ $rc_validation['data']['permanent_address'] ?? '-' }}</td></tr>
        </table>

       
        <h5 class="text-primary mt-3">Vehicle Details</h5>
        <table class="table table-bordered table-sm">
            <tr><th>Manufacturer</th><td>{{ $rc_validation['data']['maker_model'] ?? '-' }}</td></tr>
            <tr><th>Model</th><td>{{ $rc_validation['data']['maker_description'] ?? '-' }}</td></tr>
            <tr><th>Vehicle Category</th><td>{{ $rc_validation['data']['vehicle_category'] ?? '-' }}</td></tr>
            <tr><th>Body Type</th><td>{{ $rc_validation['data']['body_type'] ?? '-' }}</td></tr>
            <tr><th>Fuel Type</th><td>{{ $rc_validation['data']['fuel_type'] ?? '-' }}</td></tr>
            <tr><th>Color</th><td>{{ $rc_validation['data']['color'] ?? '-' }}</td></tr>
            <tr><th>Manufacturing Year</th><td>{{ $rc_validation['data']['manufacturing_date'] ?? '-' }}</td></tr>
            <tr><th>Norms Type</th><td>{{ $rc_validation['data']['norms_type'] ?? '-' }}</td></tr>
        </table>

        
        <h5 class="text-primary mt-3">Technical Details</h5>
        <table class="table table-bordered table-sm">
            <tr><th>Cubic Capacity (CC)</th><td>{{ $rc_validation['data']['cubic_capacity'] ?? '-' }}</td></tr>
            <tr><th>No. of Cylinders</th><td>{{ $rc_validation['data']['no_cylinders'] ?? '-' }}</td></tr>
            <tr><th>Seat Capacity</th><td>{{ $rc_validation['data']['seat_capacity'] ?? '-' }}</td></tr>
            <tr><th>Standing Capacity</th><td>{{ $rc_validation['data']['standing_capacity'] ?? '-' }}</td></tr>
            <tr><th>Sleeper Capacity</th><td>{{ $rc_validation['data']['sleeper_capacity'] ?? '-' }}</td></tr>
            <tr><th>Wheelbase</th><td>{{ $rc_validation['data']['wheelbase'] ?? '-' }}</td></tr>
            <tr><th>Gross Weight</th><td>{{ $rc_validation['data']['vehicle_gross_weight'] ?? '-' }}</td></tr>
            <tr><th>Unladen Weight</th><td>{{ $rc_validation['data']['unladen_weight'] ?? '-' }}</td></tr>
        </table>

        
        <h5 class="text-primary mt-3">Insurance & Tax</h5>
        <table class="table table-bordered table-sm">
            <tr><th>Insurance Company</th><td>{{ $rc_validation['data']['insurance_company'] ?? '-' }}</td></tr>
            <tr><th>Policy Number</th><td>{{ $rc_validation['data']['insurance_policy_number'] ?? '-' }}</td></tr>
            <tr><th>Insurance Valid Upto</th><td>{{ $rc_validation['data']['insurance_upto'] ?? '-' }}</td></tr>
            <tr><th>Tax Valid Upto</th><td>{{ $rc_validation['data']['tax_upto'] ?? '-' }}</td></tr>
            <tr><th>Fitness Valid Upto</th><td>{{ $rc_validation['data']['fit_up_to'] ?? '-' }}</td></tr>
        </table>

       
        <h5 class="text-primary mt-3">Permit & PUC</h5>
        <table class="table table-bordered table-sm">
            <tr><th>Permit Type</th><td>{{ $rc_validation['data']['permit_type'] ?? '-' }}</td></tr>
            <tr><th>Permit Number</th><td>{{ $rc_validation['data']['permit_number'] ?? '-' }}</td></tr>
            <tr><th>Permit Issued On</th><td>{{ $rc_validation['data']['permit_issue_date'] ?? '-' }}</td></tr>
            <tr><th>Permit Valid From</th><td>{{ $rc_validation['data']['permit_valid_from'] ?? '-' }}</td></tr>
            <tr><th>Permit Valid Upto</th><td>{{ $rc_validation['data']['permit_valid_upto'] ?? '-' }}</td></tr>
            <tr><th>PUCC Number</th><td>{{ $rc_validation['data']['pucc_number'] ?? '-' }}</td></tr>
            <tr><th>PUCC Valid Upto</th><td>{{ $rc_validation['data']['pucc_upto'] ?? '-' }}</td></tr>
        </table>

        <h5 class="text-primary mt-3">Other Details</h5>
        <table class="table table-bordered table-sm">
            <tr><th>Financer</th><td>{{ $rc_validation['data']['financer'] ?? '-' }}</td></tr>
            <tr><th>Blacklist Status</th><td>{{ $rc_validation['data']['blacklist_status'] ?? '-' }}</td></tr>
            <tr><th>Non-Use Status</th><td>{{ $rc_validation['data']['non_use_status'] ?? '-' }}</td></tr>
            <tr><th>Non-Use From</th><td>{{ $rc_validation['data']['non_use_from'] ?? '-' }}</td></tr>
            <tr><th>Non-Use To</th><td>{{ $rc_validation['data']['non_use_to'] ?? '-' }}</td></tr>
        </table>

    </div>
</div>

@endif


    </div>
</div>
@stop

@section('custom_js')
@stop
