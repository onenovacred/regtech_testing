@extends('adminlte::page')

@section('title', 'PAN → Father Name')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">

        {{-- FORM CARD --}}
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">PAN → Father Name Verification</h3>
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
                <form method="POST" action="{{ route('kyc.pan_to_fname') }}">
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
                        Verify Father Name
                    </button>
                </form>
            </div>
        </div>

        {{-- RESULT --}}
        @if(isset($fnameData['result']))
        <div class="card card-success mt-3">
            <div class="card-header">
                <h3 class="card-title">Verification Result</h3>
            </div>

            <div class="card-body">
                <p><strong>PAN:</strong> {{ $fnameData['result']['pan'] ?? '-' }}</p>
                <p><strong>Father Name:</strong> {{ $fnameData['result']['father_name'] ?? '-' }}</p>
            </div>
        </div>
        @endif

    </div>
</div>
@stop
