@extends('adminlte::page')

@section('title', 'UPI Enhanced Verification')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">

        {{-- FORM CARD --}}
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">UPI Enhanced Verification</h3>
            </div>

            <div class="card-body">

                {{-- ERROR --}}
                @if(isset($errorMessage))
                    <div class="alert alert-danger">
                        {{ $errorMessage }}
                    </div>
                @endif

                {{-- HIT LIMIT --}}
                @if(isset($hit_limits_exceeded) && $hit_limits_exceeded == 1)
                    <div class="alert alert-danger">
                        Hit limit exceeded. Please upgrade your plan.
                    </div>
                @endif

                {{-- FORM --}}
                <form method="POST" action="{{ route('kyc.upi_enhanced') }}">
                    @csrf

                    <div class="form-group">
                        <label>VPA</label>
                        <input type="text"
                               name="vpa"
                               class="form-control"
                               placeholder="Enter VPA "
                               value="{{ old('vpa') }}"
                               required>
                    </div>

                    <button type="submit" class="btn btn-success">
                        Verify UPI
                    </button>
                </form>
            </div>
        </div>

        {{-- RESULT --}}
        @if(isset($upiData['result']))
        <div class="card card-success mt-3">
            <div class="card-header">
                <h3 class="card-title">Verification Result</h3>
            </div>

            <div class="card-body">
                <p><strong>VPA:</strong> {{ $upiData['result']['vpa_details']['vpa'] ?? '-' }}</p>
                <p><strong>Account Holder:</strong> {{ $upiData['result']['vpa_details']['account_holder_name'] ?? '-' }}</p>
                <p><strong>Account Type:</strong> {{ $upiData['result']['account_details']['account_type'] ?? '-' }}</p>
                <p><strong>IFSC:</strong> {{ $upiData['result']['account_details']['account_ifsc'] ?? '-' }}</p>
                <p><strong>Merchant Type:</strong> {{ $upiData['result']['merchant_details']['merchant_type'] ?? '-' }}</p>
            </div>
        </div>
        @endif

    </div>
</div>
@stop
