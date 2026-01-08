@extends('adminlte::page')

@section('title', 'PAN – Aadhaar Link Status')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">

        {{-- FORM CARD --}}
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">PAN – Aadhaar Link Check</h3>
            </div>

            <div class="card-body">

                {{-- ERROR MESSAGE --}}
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

                {{-- LOW WALLET --}}
                @if(isset($low_wallet_balance) && $low_wallet_balance == 1)
                    <div class="alert alert-warning">
                        Low wallet balance. Please recharge.
                    </div>
                @endif

                {{-- FORM --}}
                <form method="POST" action="{{ route('kyc.pan_aadhaar_link') }}">
                    @csrf

                    <div class="form-group">
                        <label>PAN Number</label>
                        <input type="text"
                               name="pan"
                               class="form-control"
                               placeholder="Enter PAN Number"
                               maxlength="10"
                               value="{{ old('pan') }}"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Aadhaar Number</label>
                        <input type="text"
                               name="aadhaar"
                               class="form-control"
                               placeholder="Enter Aadhaar Number"
                               maxlength="12"
                               value="{{ old('aadhaar') }}"
                               required>
                    </div>

                    <button type="submit" class="btn btn-success">
                        Check Link Status
                    </button>
                </form>
            </div>
        </div>

        {{-- RESULT CARD --}}
        @if(isset($linkData['result']))
        <div class="card card-success mt-3">
            <div class="card-header">
                <h3 class="card-title">PAN – Aadhaar Link Result</h3>
            </div>

            <div class="card-body">
                <p>
                    <strong>Status:</strong>
                    {{ $linkData['result']['message'] ?? '-' }}
                </p>

                <p>
                    <strong>Code:</strong>
                    {{ $linkData['result']['code'] ?? '-' }}
                </p>

                @if(($linkData['result']['code'] ?? '') === 'LINK-001')
                    <span class="badge badge-success">
                        ✔ PAN is linked with Aadhaar
                    </span>
                @elseif(($linkData['result']['code'] ?? '') === 'LINK-002')
                    <span class="badge badge-warning">
                        ✖ PAN is not linked with Aadhaar
                    </span>
                @else
                    <span class="badge badge-secondary">
                        Status Unknown
                    </span>
                @endif
            </div>
        </div>
        @endif

    </div>
</div>
@stop
