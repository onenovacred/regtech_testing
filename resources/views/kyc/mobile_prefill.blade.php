@extends('adminlte::page')

@section('title', 'Mobile → Prefill')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">

        {{-- FORM CARD --}}
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Mobile Prefill Verification</h3>
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

                {{-- LOW WALLET --}}
                @if(isset($low_wallet_balance) && $low_wallet_balance == 1)
                    <div class="alert alert-danger">
                        Insufficient wallet balance. Please recharge.
                    </div>
                @endif

                {{-- FORM --}}
                <form method="POST" action="{{ route('kyc.mobile_prefill') }}">
                    @csrf

                    <div class="form-group">
                        <label>Mobile Number</label>
                        <input type="text"
                               name="mobile_no"
                               class="form-control"
                               placeholder="Enter Mobile Number"
                               value="{{ old('mobile_no') }}"
                               required>
                    </div>

                    <button type="submit" class="btn btn-success">
                        Fetch Details
                    </button>
                </form>
            </div>
        </div>

        {{-- RESULT --}}
        @if(isset($mobilePrefillData))
        <div class="card card-success mt-3">
            <div class="card-header">
                <h3 class="card-title">Prefill Result</h3>
            </div>

            <div class="card-body">
                <p><strong>Mobile:</strong> {{ $mobilePrefillData['mobile_number'] ?? '-' }}</p>
                <p><strong>Name:</strong> {{ $mobilePrefillData['name'] ?? '-' }}</p>
                <p><strong>DOB:</strong> {{ $mobilePrefillData['dob'] ?? '-' }}</p>
                <p><strong>Age:</strong> {{ $mobilePrefillData['age'] ?? '-' }}</p>
                <p><strong>Gender:</strong> {{ $mobilePrefillData['gender'] ?? '-' }}</p>
                <p><strong>PAN:</strong> {{ $mobilePrefillData['pan'] ?? '-' }}</p>
                <p><strong>Email:</strong> {{ $mobilePrefillData['email'] ?? '-' }}</p>
                <p><strong>Score:</strong> {{ $mobilePrefillData['score'] ?? '-' }}</p>

                <hr>

                <p><strong>Address</strong></p>
                <p>
                    {{ $mobilePrefillData['address_line_1'] ?? '' }}<br>
                    {{ $mobilePrefillData['address_line_2'] ?? '' }}<br>
                    {{ $mobilePrefillData['address_line_3'] ?? '' }}<br>
                    {{ $mobilePrefillData['city'] ?? '' }},
                    {{ $mobilePrefillData['state'] ?? '' }} -
                    {{ $mobilePrefillData['pincode'] ?? '' }}
                </p>
            </div>
        </div>
        @endif

    </div>
</div>
@stop
