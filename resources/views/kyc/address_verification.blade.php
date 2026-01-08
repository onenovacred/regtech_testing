@extends('adminlte::page')

@section('title', 'Address Verification')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">

        {{-- FORM CARD --}}
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Address Verification</h3>
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
                <form method="POST" action="{{ route('kyc.address_verification') }}">
                    @csrf

                    <div class="form-group">
                        <label>Latitude</label>
                        <input type="text"
                               name="latitude"
                               class="form-control"
                               placeholder="Enter Latitude"
                               value="{{ old('latitude') }}"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Longitude</label>
                        <input type="text"
                               name="longitude"
                               class="form-control"
                               placeholder="Enter Longitude"
                               value="{{ old('longitude') }}"
                               required>
                    </div>

                    <button type="submit" class="btn btn-success">
                        Verify Address
                    </button>
                </form>
            </div>
        </div>

        {{-- RESULT --}}
        @if(isset($addressData['model']))
        <div class="card card-success mt-3">
            <div class="card-header">
                <h3 class="card-title">Verification Result</h3>
            </div>

            <div class="card-body">
                <p><strong>Address:</strong> {{ $addressData['model']['address'] ?? '-' }}</p>
                <p><strong>Pincode:</strong> {{ $addressData['model']['pincode'] ?? '-' }}</p>
                <p><strong>District:</strong> {{ $addressData['model']['district'] ?? '-' }}</p>
                <p><strong>State:</strong> {{ $addressData['model']['state'] ?? '-' }}</p>
            </div>
        </div>
        @endif

    </div>
</div>
@stop
