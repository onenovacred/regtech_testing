@extends('adminlte::page')

@section('title', 'Aadhaar to PAN Validation')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">

        {{-- FORM CARD --}}
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">AADHAAR TO PAN VERIFICATION</h3>
            </div>

            <div class="card-body">

                {{-- VALIDATION ERRORS --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- API ERRORS --}}
                @if(isset($statusCode) && $statusCode != 200)
                    <div class="alert alert-danger">
                        {{ $errorMessage ?? 'Verification failed. Please try again.' }}
                    </div>
                @endif

                {{-- HIT LIMIT ERROR --}}
                @if(isset($hit_limits_exceeded) && $hit_limits_exceeded == 1)
                    <div class="alert alert-warning">
                        Your hit limit has been exceeded. Please upgrade your plan.
                    </div>
                @endif

                {{-- LOW WALLET --}}
                @if(isset($low_wallet_balance) && $low_wallet_balance == 1)
                    <div class="alert alert-warning">
                        Low wallet balance. Please recharge to continue.
                    </div>
                @endif

                {{-- FORM --}}
                <form method="post" action="{{ route('kyc.aadhar_validation') }}">
                    @csrf

                    <div class="form-group">
                        <label>Aadhaar Number</label>
                        <input type="text"
                               name="aadhar_no"
                               class="form-control"
                               maxlength="12"
                               minlength="12"
                               value="{{ old('aadhar_no') }}"
                               placeholder="Enter 12-digit Aadhaar Number"
                               required>
                    </div>

                    <button class="btn btn-success">Verify</button>
                </form>
            </div>
        </div>

        {{-- RESULT CARD --}}
        @if(isset($aadhar['aadhar']['data']))
            <div class="card card-success mt-3">
                <div class="card-header">
                    <h3 class="card-title">VERIFICATION RESULT</h3>
                </div>

                <div class="card-body">
                    <p>
                        <strong>Request ID:</strong>
                        {{ $aadhar['aadhar']['data']['requestId'] ?? 'N/A' }}
                    </p>

                    <p>
                        <strong>Client Reference No:</strong>
                        {{ $aadhar['aadhar']['data']['client_Ref_Num'] ?? 'N/A' }}
                    </p>

                    <p>
                        <strong>Status:</strong>
                        <span class="badge badge-success">Verified</span>
                    </p>
                </div>
            </div>
        @endif

    </div>
</div>
@stop
