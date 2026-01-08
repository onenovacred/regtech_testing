@extends('adminlte::page')

@section('title', 'RegtechAPI')

@section('content_header')
@stop

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">

        {{-- FORM CARD --}}
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Mobile Number Lookup</h3>
            </div>

            <div class="card-body">

                @if($low_wallet_balance == 1)
                    <div class="alert alert-danger">
                        Please recharge your wallet.
                    </div>
                @endif

                @if($hit_limits_exceeded == 1)
                    <div class="alert alert-warning">
                        You have exceeded your hit limits.
                    </div>
                @endif

                @if(isset($statusCode) && in_array($statusCode, [400,404,500]))
                    <div class="alert alert-danger">
                        Server error. Please try again later.
                    </div>
                @endif

                @if(isset($errorMessage))
                    <div class="alert alert-danger">
                        {{ $errorMessage }}
                    </div>
                @endif

                {{-- FORM --}}
                <form method="post" action="{{ route('kyc.mobile_number_lookup') }}">
                    @csrf

                    <div class="form-group">
                        <label>Mobile Number</label>
                        <input type="text"
                               name="mobile_number"
                               class="form-control"
                               maxlength="10"
                               placeholder="Enter mobile number"
                               required>
                    </div>

                    <button type="submit" class="btn btn-success">
                        Verify
                    </button>
                </form>
            </div>
        </div>

        {{-- RESULT CARD --}}
        @if(!empty($mobileData) && $statusCode == 200)
        <div class="card card-success mt-3">
            <div class="card-header">
                <h3 class="card-title">Mobile Details</h3>
            </div>

            <div class="card-body table-responsive">
                <table class="table table-bordered">

                    <tr>
                        <th>Name</th>
                        <td>{{ $mobileData['customer_details']['name'] ?? '-' }}</td>
                    </tr>

                    <tr>
                        <th>Alternate Number</th>
                        <td>{{ $mobileData['customer_details']['alternate_number'] ?? '-' }}</td>
                    </tr>

                    <tr>
                        <th>Valid Number</th>
                        <td>
                            @if($mobileData['is_valid'])
                                <span class="badge badge-success">Yes</span>
                            @else
                                <span class="badge badge-danger">No</span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th>Subscriber Status</th>
                        <td>{{ $mobileData['subscriber_status'] ?? '-' }}</td>
                    </tr>

                    <tr>
                        <th>Connection Type</th>
                        <td>{{ $mobileData['connection_type'] ?? '-' }}</td>
                    </tr>

                    <tr>
                        <th>Current Network</th>
                        <td>
                            {{ $mobileData['current_service_provider']['network_name'] ?? '-' }}
                            ({{ $mobileData['current_service_provider']['network_region'] ?? '-' }})
                        </td>
                    </tr>

                    <tr>
                        <th>Original Network</th>
                        <td>
                            {{ $mobileData['original_service_provider']['network_name'] ?? '-' }}
                            ({{ $mobileData['original_service_provider']['network_region'] ?? '-' }})
                        </td>
                    </tr>

                    <tr>
                        <th>Ported</th>
                        <td>
                            @if($mobileData['is_ported'])
                                <span class="badge badge-warning">Yes</span>
                            @else
                                <span class="badge badge-success">No</span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th>MSISDN</th>
                        <td>{{ $mobileData['msisdn']['msisdn'] ?? '-' }}</td>
                    </tr>

                </table>
            </div>
        </div>
        @endif

    </div>
</div>
@stop

@section('custom_js')
@stop
