@extends('adminlte::page')

@section('title', 'PAN Compliance Check')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">

        {{-- FORM CARD --}}
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">PAN COMPLIANCE (206AB)</h3>
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
                        {{ $errorMessage ?? 'PAN compliance validation failed' }}
                    </div>
                @endif

                {{-- HIT LIMIT EXCEEDED --}}
                @if(isset($hit_limits_exceeded) && $hit_limits_exceeded == 1)
                    <div class="alert alert-warning">
                        Hit limit exceeded. Please upgrade your plan.
                    </div>
                @endif

                {{-- LOW WALLET --}}
                @if(isset($low_wallet_balance) && $low_wallet_balance == 1)
                    <div class="alert alert-warning">
                        Low wallet balance. Please recharge your wallet.
                    </div>
                @endif

                {{-- FORM --}}
                <form method="post" action="{{ route('kyc.pan-compliance') }}">
                    @csrf

                    <div class="form-group">
                        <label>PAN Number</label>
                        <input type="text"
                               name="pan"
                               class="form-control"
                               maxlength="10"
                               minlength="10"
                               value="{{ old('pan') }}"
                               placeholder="ABCDE1234F"
                               required>
                    </div>

                    <button class="btn btn-success">Verify</button>
                </form>
            </div>
        </div>

        {{-- RESULT CARD --}}
        @if(isset($statusCode) && $statusCode == 200 && isset($panData['result']))
        <div class="card card-success mt-3">
            <div class="card-header">
                <h3 class="card-title">PAN COMPLIANCE DETAILS</h3>
            </div>

            <div class="card-body">
                <p>
                    <strong>PAN:</strong>
                    {{ $panData['result']['pan'] ?? '-' }}
                </p>

                <p>
                    <strong>PAN Name:</strong>
                    {{ $panData['result']['pan_name'] ?? '-' }}
                </p>

                <p>
                    <strong>Specified Person:</strong>
                    {{ ($panData['result']['specified_person'] ?? 'N') == 'Y' ? 'Yes' : 'No' }}
                </p>

                <p>
                    <strong>Operative Status:</strong>
                    {{ $panData['result']['pan_operative_status'] ?? '-' }}
                </p>

                <p>
                    <strong>Financial Year:</strong>
                    {{ $panData['result']['fin_year'] ?? '-' }}
                </p>

                <p>
                    <strong>PAN Allotment Date:</strong>
                    {{ $panData['result']['pan_allotment_date'] ?? '-' }}
                </p>
            </div>
        </div>
        @endif

    </div>
</div>
@stop
