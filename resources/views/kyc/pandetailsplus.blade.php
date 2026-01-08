@extends('adminlte::page')

@section('title', 'PAN Details Plus')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">

        {{-- FORM CARD --}}
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">PAN DETAILS PLUS</h3>
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
                <form method="POST" action="{{ route('kyc.pandetailsplus') }}">
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

                    <button type="submit" class="btn btn-success">
                        Validate PAN
                    </button>
                </form>
            </div>
        </div>

        {{-- RESULT CARD --}}
        @if(isset($panData['data']))
        <div class="card card-success mt-3">
            <div class="card-header">
                <h3 class="card-title">PAN VERIFICATION RESULT</h3>
            </div>

            <div class="card-body">

                {{-- BASIC DETAILS --}}
                <h5><strong>Basic Information</strong></h5>
                <p><strong>PAN:</strong> {{ $panData['data']['pan'] ?? '-' }}</p>
                <p><strong>Full Name:</strong> {{ $panData['data']['fullname'] ?? '-' }}</p>
                <p><strong>Gender:</strong> {{ ucfirst($panData['data']['gender'] ?? '-') }}</p>
                <p><strong>Date of Birth:</strong> {{ $panData['data']['dob'] ?? '-' }}</p>
                <p><strong>PAN Type:</strong> {{ $panData['data']['pan_type'] ?? '-' }}</p>
                <p><strong>PAN Status:</strong> {{ $panData['data']['pan_status'] ?? '-' }}</p>
                <p><strong>PAN Allotment Date:</strong> {{ $panData['data']['pan_allotment_date'] ?? '-' }}</p>

                <hr>

                {{-- AADHAAR --}}
                <h5><strong>Aadhaar Details</strong></h5>
                <p><strong>Aadhaar Linked:</strong>
                    {{ isset($panData['data']['aadhaar_linked']) && $panData['data']['aadhaar_linked'] ? 'Yes' : 'No' }}
                </p>
                <p><strong>Aadhaar Number:</strong> {{ $panData['data']['aadhaar_number'] ?? 'N/A' }}</p>

                <hr>

                {{-- ADDRESS --}}
                <h5><strong>Address</strong></h5>
                <p>
                    {{ $panData['data']['address']['building_name'] ?? '' }}<br>
                    {{ $panData['data']['address']['street_name'] ?? '' }}<br>
                    {{ $panData['data']['address']['locality'] ?? '' }}<br>
                    {{ $panData['data']['address']['city'] ?? '' }},
                    {{ $panData['data']['address']['state'] ?? '' }} -
                    {{ $panData['data']['address']['pincode'] ?? '' }}<br>
                    {{ $panData['data']['address']['country'] ?? '' }}
                </p>

                <hr>

                {{-- CONTACT --}}
                <h5><strong>Contact</strong></h5>
                <p><strong>Mobile:</strong> {{ $panData['data']['mobile'] ?? 'N/A' }}</p>
                <p><strong>Email:</strong> {{ $panData['data']['email'] ?? 'N/A' }}</p>

                <hr>

                {{-- FLAGS --}}
                <h5><strong>Additional Information</strong></h5>
                <p><strong>Sole Proprietor:</strong> {{ $panData['data']['is_sole_proprietor'] ?? 'N/A' }}</p>
                <p><strong>Director:</strong> {{ $panData['data']['is_director'] ?? 'N/A' }}</p>
                <p><strong>Salaried:</strong> {{ $panData['data']['is_salaried'] ?? 'N/A' }}</p>

            </div>
        </div>
        @endif

    </div>
</div>
@stop
