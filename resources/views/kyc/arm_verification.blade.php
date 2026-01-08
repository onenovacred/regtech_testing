@extends('adminlte::page')

@section('title', 'ARM Verification')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">

        {{-- FORM CARD --}}
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">ARM Verification</h3>
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

                {{-- INPROGRESS --}}
                @if(isset($statusCode) && $statusCode == 102)
                    <div class="alert alert-warning">
                        Request is in progress. Please wait and try again.
                    </div>
                @endif

                {{-- FORM --}}
                <form method="POST" action="{{ route('kyc.arm_verification') }}">
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
                        <label>Full Name</label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               placeholder="Enter Full Name"
                               value="{{ old('name') }}"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Email ID</label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               placeholder="Enter Email ID"
                               value="{{ old('email') }}"
                               required>
                    </div>

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
                        Verify ARM
                    </button>
                </form>
            </div>
        </div>

        {{-- RESULT --}}
        @if(isset($armData['result']) && ($armData['result']['status'] ?? '') == 'OK')
        <div class="card card-success mt-3">
            <div class="card-header">
                <h3 class="card-title">ARM Verification Result</h3>
            </div>

            <div class="card-body">
                <p><strong>Transaction ID:</strong> {{ $armData['transaction_id'] ?? '-' }}</p>
                <p><strong>Risk Score:</strong> {{ $armData['result']['risk_score'] ?? '-' }}</p>
                <p><strong>Risk Band:</strong> {{ $armData['result']['risk_band'] ?? '-' }}</p>

                <hr>

                <h5>PAN Insights</h5>
                <p><strong>Full Name:</strong>
                    {{ $armData['result']['services']['pan_insights']['result']['fullname'] ?? '-' }}
                </p>
                <p><strong>DOB:</strong>
                    {{ $armData['result']['services']['pan_insights']['result']['dob'] ?? '-' }}
                </p>
                <p><strong>PAN Type:</strong>
                    {{ $armData['result']['services']['pan_insights']['result']['pan_type'] ?? '-' }}
                </p>

                <hr>

                <h5>UPI Insights</h5>
                <p><strong>VPA:</strong>
                    {{ $armData['result']['services']['upi_insights']['result']['vpa'] ?? '-' }}
                </p>
                <p><strong>Name Match:</strong>
                    {{ ($armData['result']['services']['upi_insights']['result']['name_match'] ?? false) ? 'Yes' : 'No' }}
                </p>

                <hr>

                <h5>Telecom Insights</h5>
                <p><strong>Network:</strong>
                    {{ $armData['result']['services']['telecom_insights']['result']['currentNetworkName'] ?? '-' }}
                </p>
                <p><strong>Region:</strong>
                    {{ $armData['result']['services']['telecom_insights']['result']['currentNetworkRegion'] ?? '-' }}
                </p>

                @if(!empty($armData['result']['raw_feature_url']))
                    <hr>
                    <a href="{{ $armData['result']['raw_feature_url'] }}"
                       target="_blank"
                       class="btn btn-secondary btn-sm">
                        View Raw Feature JSON
                    </a>
                @endif
            </div>
        </div>
        @endif

    </div>
</div>
@stop
