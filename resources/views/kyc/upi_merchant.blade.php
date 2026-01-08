@extends('adminlte::page')

@section('title', 'UPI → Name')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">

        {{-- FORM CARD --}}
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">UPI → Account Holder Name</h3>
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
                <form method="POST" action="{{ route('kyc.upi_basic') }}">
                    @csrf

                    <div class="form-group">
                        <label>VPA (UPI ID)</label>
                        <input type="text"
                               name="vpa"
                               class="form-control"
                               placeholder="example@upi"
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
                <p><strong>VPA:</strong>
                    {{ $upiData['result']['vpa_details']['vpa'] ?? '-' }}
                </p>

                <p><strong>Account Holder Name:</strong>
                    {{ $upiData['result']['vpa_details']['account_holder_name'] ?? '-' }}
                </p>

                <p><strong>Message:</strong>
                    {{ $upiData['message'] ?? '-' }}
                </p>
            </div>
        </div>
        @endif

    </div>
</div>
@stop
