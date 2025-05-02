{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Demo Form</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Hello</h1>
    <form id="demoForm">
        @csrf
        <label for="rc">Enter RC Number:</label>
        <input type="text" id="rc" name="rc" required>
        <button type="submit">Submit</button>
    </form>

    <div id="response"></div>

    <script>
        $(document).ready(function() {
            $('#demoForm').on('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission

                // Retrieve the access token from wherever it's stored
                var accessToken = {csrf_token};
                console.log('token: ',accessToken) // Replace this with your actual access token

                $.ajax({
                    url: "{{ route('demo.submit') }}", // Ensure this route matches your backend route
                    type: 'POST',
                    data: $(this).serialize(),
                    headers: {
                        'AccessToken': accessToken // Include the access token in the request headers
                    },
                    success: function(response) {
                        var data = response.rc_validation.data;
                var html = '<h2>Response:</h2>' +
                           '<p><strong>RC Number:</strong> ' + (data.rc_number || 'N/A') + '</p>' +
                           '<p><strong>Owner Name:</strong> ' + (data.owner_name || 'N/A') + '</p>' +
                           '<p><strong>Present Address:</strong> ' + (data.present_address || 'N/A') + '</p>' +
                           '<p><strong>Permanent Address:</strong> ' + (data.permanent_address || 'N/A') + '</p>' +
                           '<p><strong>Mobile Number:</strong> ' + (data.mobile_number || 'N/A') + '</p>' +
                           '<p><strong>Vehicle Category:</strong> ' + (data.vehicle_category || 'N/A') + '</p>' +
                           '<p><strong>Vehicle Chasi Number:</strong> ' + (data.vehicle_chasi_number || 'N/A') + '</p>' +
                           '<p><strong>Vehicle Engine Number:</strong> ' + (data.vehicle_engine_number || 'N/A') + '</p>' +
                           '<p><strong>Maker Model:</strong> ' + (data.maker_model || 'N/A') + '</p>' +
                           '<p><strong>Fuel Type:</strong> ' + (data.fuel_type || 'N/A') + '</p>' +
                           '<p><strong>Color:</strong> ' + (data.color || 'N/A') + '</p>' +
                           '<p><strong>Manufacturing Date:</strong> ' + (data.manufacturing_date || 'N/A') + '</p>' +
                           '<p><strong>Insurance Company:</strong> ' + (data.insurance_company || 'N/A') + '</p>' +
                           '<p><strong>Insurance Policy Number:</strong> ' + (data.insurance_policy_number || 'N/A') + '</p>' +
                           '<p><strong>Registered At:</strong> ' + (data.registered_at || 'N/A') + '</p>' +
                           '<p><strong>Cubic Capacity:</strong> ' + (data.cubic_capacity || 'N/A') + '</p>' +
                           '<p><strong>Vehicle Gross Weight:</strong> ' + (data.vehicle_gross_weight || 'N/A') + '</p>' +
                           '<p><strong>Number of Cylinders:</strong> ' + (data.no_cylinders || 'N/A') + '</p>' +
                           '<p><strong>Seat Capacity:</strong> ' + (data.seat_capacity || 'N/A') + '</p>' +
                           '<p><strong>Wheelbase:</strong> ' + (data.wheelbase || 'N/A') + '</p>' +
                           '<p><strong>Unladen Weight:</strong> ' + (data.unladen_weight || 'N/A') + '</p>' +
                           '<p><strong>PUCC Number:</strong> ' + (data.pucc_number || 'N/A') + '</p>' +
                           '<p><strong>PUCC Upto:</strong> ' + (data.pucc_upto || 'N/A') + '</p>' +
                           '<p><strong>RTO Code:</strong> ' + (data.rto_code || 'N/A') + '</p>' +
                           '<p><strong>Latest By:</strong> ' + (data.latest_by || 'N/A') + '</p>' +
                           '<p><strong>Tax Upto:</strong> ' + (data.tax_upto || 'N/A') + '</p>' +
                           '<p><strong>NOC Details:</strong> ' + (data.noc_details || 'N/A') + '</p>' +
                           '<p><strong>RC Status:</strong> ' + (data.rc_status || 'N/A') + '</p>' +
                           '<p><strong>Authority:</strong> ' + (data.authority || 'N/A') + '</p>';

                $('#response').html(html);
                    },
                    error: function(xhr) {
                        $('#response').html('<h2>Error:</h2><p>' + xhr.responseJSON.message + '</p>');
                    }
                });
            });
        });
    </script>
</body>
</html> --}}















@extends('adminlte::page')

@section('title', 'Regtechapi - rc_validation')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
    

    <div>
        <div class="container">

            {{-- show errors --}}
            @if (isset($rc_validation['statusCode']) && $rc_validation['statusCode'] == '102')
                <div class="alert alert-danger" role="alert">
                    Invalid RC Number / RC Number in Multiple RTOs. Error Code - 102
                </div>
            @endif
            @if (isset($rc_validation['statusCode']) && $rc_validation['statusCode'] == '101')
                <div class="alert alert-danger" role="alert">
                    RC Number in Multiple RTOs. Error Code - 101
                </div>
            @endif
            @if (isset($rc_validation['statusCode']) &&
                    ($rc_validation['statusCode'] == '404' ||
                        $rc_validation['statusCode'] == '400' ||
                        $rc_validation['statusCode'] == '401'))
                <div class="alert alert-danger" role="alert">
                    Server Error, Please try later
                </div>
            @endif
            @if (isset($rc_validation['statusCode']) && $rc_validation['statusCode'] == '500')
                <div class="alert alert-danger" role="alert">
                    Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                </div>
            @endif


            <h1 class="mt-4">Hello</h1>
            <form method="POST" action="{{ route('kyc.deom') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="rc">Enter RC Number:</label>
                    <input type="text" id="rc" name="rc" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

            @if (isset($rc_validation) && isset($rc_validation['status_code']) && (int)$rc_validation['status_code'] === 200)
                    <div class="mt-4">
                        <h2>Response:</h2>
                        <p><strong>RC Number:</strong> {{ $rc_validation['rc_validation']['data']['rc_number'] ?? 'N/A' }}
                        </p>
                        <p><strong>Owner Name:</strong> {{ $rc_validation['rc_validation']['data']['owner_name'] ?? 'N/A' }}
                        </p>
                        <p><strong>Present Address:</strong>
                            {{ $rc_validation['rc_validation']['data']['present_address'] ?? 'N/A' }}</p>
                        <p><strong>Permanent Address:</strong>
                            {{ $rc_validation['rc_validation']['data']['permanent_address'] ?? 'N/A' }}</p>
                        <p><strong>Mobile Number:</strong>
                            {{ $rc_validation['rc_validation']['data']['mobile_number'] ?? 'N/A' }}</p>
                        <p><strong>Vehicle Category:</strong>
                            {{ $rc_validation['rc_validation']['data']['vehicle_category'] ?? 'N/A' }}</p>
                        <p><strong>Vehicle Chasi Number:</strong>
                            {{ $rc_validation['rc_validation']['data']['vehicle_chasi_number'] ?? 'N/A' }}</p>
                        <p><strong>Vehicle Engine Number:</strong>
                            {{ $rc_validation['rc_validation']['data']['vehicle_engine_number'] ?? 'N/A' }}</p>
                        <p><strong>Maker Model:</strong>
                            {{ $rc_validation['rc_validation']['data']['maker_model'] ?? 'N/A' }}
                        </p>
                        <p><strong>Fuel Type:</strong> {{ $rc_validation['rc_validation']['data']['fuel_type'] ?? 'N/A' }}
                        </p>
                        <p><strong>Color:</strong> {{ $rc_validation['rc_validation']['data']['color'] ?? 'N/A' }}</p>
                        <p><strong>Manufacturing Date:</strong>
                            {{ $rc_validation['rc_validation']['data']['manufacturing_date'] ?? 'N/A' }}</p>
                        <p><strong>Insurance Company:</strong>
                            {{ $rc_validation['rc_validation']['data']['insurance_company'] ?? 'N/A' }}</p>
                        <p><strong>Insurance Policy Number:</strong>
                            {{ $rc_validation['rc_validation']['data']['insurance_policy_number'] ?? 'N/A' }}</p>
                        <p><strong>Registered At:</strong>
                            {{ $rc_validation['rc_validation']['data']['registered_at'] ?? 'N/A' }}</p>
                        <p><strong>Cubic Capacity:</strong>
                            {{ $rc_validation['rc_validation']['data']['cubic_capacity'] ?? 'N/A' }}</p>
                        <p><strong>Vehicle Gross Weight:</strong>
                            {{ $rc_validation['rc_validation']['data']['vehicle_gross_weight'] ?? 'N/A' }}</p>
                        <p><strong>Number of Cylinders:</strong>
                            {{ $rc_validation['rc_validation']['data']['no_cylinders'] ?? 'N/A' }}</p>
                        <p><strong>Seat Capacity:</strong>
                            {{ $rc_validation['rc_validation']['data']['seat_capacity'] ?? 'N/A' }}</p>
                        <p><strong>Wheelbase:</strong> {{ $rc_validation['rc_validation']['data']['wheelbase'] ?? 'N/A' }}
                        </p>
                        <p><strong>Unladen Weight:</strong>
                            {{ $rc_validation['rc_validation']['data']['unladen_weight'] ?? 'N/A' }}</p>
                        <p><strong>PUCC Number:</strong>
                            {{ $rc_validation['rc_validation']['data']['pucc_number'] ?? 'N/A' }}
                        </p>
                        <p><strong>PUCC Upto:</strong> {{ $rc_validation['rc_validation']['data']['pucc_upto'] ?? 'N/A' }}
                        </p>
                        <p><strong>RTO Code:</strong> {{ $rc_validation['rc_validation']['data']['rto_code'] ?? 'N/A' }}
                        </p>
                        <p><strong>Latest By:</strong> {{ $rc_validation['rc_validation']['data']['latest_by'] ?? 'N/A' }}
                        </p>
                        <p><strong>Tax Upto:</strong> {{ $rc_validation['rc_validation']['data']['tax_upto'] ?? 'N/A' }}
                        </p>
                        <p><strong>NOC Details:</strong>
                            {{ $rc_validation['rc_validation']['data']['noc_details'] ?? 'N/A' }}
                        </p>
                        <p><strong>RC Status:</strong> {{ $rc_validation['rc_validation']['data']['rc_status'] ?? 'N/A' }}
                        </p>
                        <p><strong>Authority:</strong> {{ $rc_validation['rc_validation']['data']['authority'] ?? 'N/A' }}
                        </p>
                    </div>
            @endif

        </div>
    </div>

@stop


@section('custom_js')
@stop
