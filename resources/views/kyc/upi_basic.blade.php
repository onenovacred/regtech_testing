@extends('adminlte::page')

@section('title', 'UPI Basic Validation')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">

        {{-- FORM CARD --}}
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">UPI BASIC VALIDATION</h3>
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

               
                @if(isset($statusCode) && $statusCode != 200)
                    <div class="alert alert-danger">
                        {{ $errorMessage ?? 'UPI validation failed' }}
                    </div>
                @endif

              
                <form method="post" action="{{ route('kyc.upi-basic') }}">
                    @csrf

                    <div class="form-group">
                        <label>UPI ID (VPA)</label>
                        <input type="text"
                               name="vpa"
                               class="form-control"
                               value="{{ old('vpa') }}"
                               placeholder="Ex: 9876543210@ybl"
                               required>
                    </div>

                    <button class="btn btn-success">Verify</button>
                </form>
            </div>
        </div>

        {{-- SUCCESS RESPONSE --}}
        @if(isset($statusCode) && $statusCode == 200 && isset($upiData))
        <div class="card card-success mt-3">
            <div class="card-header">
                <h3 class="card-title">UPI DETAILS</h3>
            </div>
            <div class="card-body">

                <p>
                    <strong>UPI ID:</strong>
                    {{ $upiData['result']['vpa_details']['vpa'] ?? '-' }}
                </p>

                <p>
                    <strong>Account Holder Name:</strong>
                    {{ $upiData['result']['vpa_details']['account_holder_name'] ?? '-' }}
                </p>

                <p>
                    <strong>Status:</strong>
                    {{ $upiData['message'] ?? 'Success' }}
                </p>

            </div>
        </div>
        @endif

        {{-- HIT LIMIT MESSAGE --}}
        @if(isset($hit_limits_exceeded) && $hit_limits_exceeded == 1)
            <div class="alert alert-warning mt-3">
                Hit limit exceeded. Please upgrade your plan.
            </div>
        @endif

    </div>
</div>
@stop
