@extends('adminlte::page')

@section('title', 'Mobile Customer Details')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">

        {{-- ALERTS --}}
        @if($low_wallet_balance)
            <div class="alert alert-danger">Please recharge your wallet.</div>
        @endif

        @if($hit_limits_exceeded)
            <div class="alert alert-warning">
                You are not registered to use this service.
            </div>
        @endif

        @if(isset($errorMessage))
            <div class="alert alert-danger">{{ $errorMessage }}</div>
        @endif

        {{-- FORM --}}
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Mobile Customer Details Lookup</h3>
            </div>

            <div class="card-body">
                <form method="POST"
                      action="{{ route('kyc.mobile_customer_details') }}">
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

                    <button class="btn btn-success btn-block">
                        Verify
                    </button>
                </form>
            </div>
        </div>

        {{-- RESULT --}}
        @if(!empty($mobileData))
        <div class="card card-success mt-4">
            <div class="card-header">
                <h3 class="card-title">Result</h3>
            </div>

            <div class="card-body">
                <p><strong>Name:</strong>
                    {{ $mobileData['customer_details']['name'] ?? '-' }}
                </p>

                <p><strong>Alternate Number:</strong>
                    {{ $mobileData['customer_details']['alternate_number'] ?? '-' }}
                </p>

                <p><strong>Status:</strong>
                    {{ $mobileData['subscriber_status'] ?? '-' }}
                </p>

                <p><strong>Connection Type:</strong>
                    {{ $mobileData['connection_type'] ?? '-' }}
                </p>

                <p><strong>Current Operator:</strong>
                    {{ $mobileData['current_service_provider']['network_name'] ?? '-' }}
                    ({{ $mobileData['current_service_provider']['network_region'] ?? '-' }})
                </p>
            </div>
        </div>
        @endif

    </div>
</div>
@stop
