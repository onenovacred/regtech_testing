@extends('adminlte::page')

@section('title', 'PAN → Name')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">

        {{-- FORM CARD --}}
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">PAN → Name Verification</h3>
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
                <form method="POST" action="{{ route('kyc.pan_to_name') }}">
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
                        Verify Name
                    </button>
                </form>
            </div>
        </div>

        
        @if(isset($panData['result']))
        <div class="card card-success mt-3">
            <div class="card-header">
                <h3 class="card-title">Verification Result</h3>
            </div>

            <div class="card-body">
                <p><strong>PAN:</strong> {{ $panData['result']['pan'] ?? '-' }}</p>
                <p><strong>Full Name:</strong> {{ $panData['result']['name'] ?? '-' }}</p>
                <p><strong>First Name:</strong> {{ $panData['result']['first_name'] ?? '-' }}</p>
                <p><strong>Middle Name:</strong> {{ $panData['result']['middle_name'] ?? '-' }}</p>
                <p><strong>Last Name:</strong> {{ $panData['result']['last_name'] ?? '-' }}</p>
            </div>
        </div>
        @endif

    </div>
</div>
@stop
