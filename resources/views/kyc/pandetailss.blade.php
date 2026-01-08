@extends('adminlte::page')

@section('title', 'PAN Card Validation')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">

        {{-- FORM CARD --}}
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">PAN CARD VALIDATION</h3>
            </div>

            <div class="card-body">

                {{-- ERROR MESSAGE --}}
                @if(isset($errorMessage))
                    <div class="alert alert-danger">
                        {{ $errorMessage }}
                    </div>
                @endif

                {{-- HIT LIMIT MESSAGE --}}
                @if(isset($hit_limits_exceeded) && $hit_limits_exceeded == 1)
                    <div class="alert alert-danger">
                        Hit limit exceeded. Please upgrade your plan.
                    </div>
                @endif

                {{-- FORM --}}
                <form method="POST" action="{{ route('kyc.pan-details') }}">
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
       @if(isset($panData['result']))
    <p><strong>PAN:</strong> {{ $panData['result']['pan'] }}</p>
    <p><strong>Full Name:</strong> {{ $panData['result']['fullname'] }}</p>
    <p><strong>First Name:</strong> {{ $panData['result']['first_name'] }}</p>
    <p><strong>Middle Name:</strong> {{ $panData['result']['middle_name'] }}</p>
    <p><strong>Last Name:</strong> {{ $panData['result']['last_name'] }}</p>
    <p><strong>Gender:</strong> {{ ucfirst($panData['result']['gender']) }}</p>
    <p><strong>DOB:</strong> {{ $panData['result']['dob'] }}</p>

    <p><strong>Aadhaar Linked:</strong>
        {{ $panData['result']['aadhaar_linked'] ? 'Yes' : 'No' }}
    </p>

    <p><strong>Aadhaar Number:</strong>
        {{ $panData['result']['aadhaar_number'] ?? 'N/A' }}
    </p>
@endif


    </div>
</div>
@stop
