@extends('adminlte::page')

@section('title', 'DL Verification')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">

        {{-- FORM --}}
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">DL Verification</h3>
            </div>

            <div class="card-body">

                @if(isset($errorMessage))
                    <div class="alert alert-danger">{{ $errorMessage }}</div>
                @endif

                @if(isset($hit_limits_exceeded) && $hit_limits_exceeded == 1)
                    <div class="alert alert-danger">
                        Hit limit exceeded. Please upgrade your plan.
                    </div>
                @endif
        
                <form method="POST" action="{{ route('dl.validation') }}">
                    @csrf

                    <div class="form-group">
                        <label>Driving Licence Number</label>
                        <input type="text" name="dl_number" class="form-control"
                               value="{{ old('dl_number') }}" required>
                    </div>

                    <div class="form-group">
                        <label>Date of Birth</label>
                        <input type="date" name="dob" class="form-control"
                               value="{{ old('dob') }}" required>
                    </div>

                    <button type="submit" class="btn btn-success">
                        Verify DL
                    </button>
                </form>
            </div>
        </div>

        {{-- RESULT --}}
        @if(isset($dlData['result']))
        <div class="card card-success mt-3">
            <div class="card-header">
                <h3 class="card-title">Verification Result</h3>
            </div>

            <div class="card-body">

                <p><strong>DL Number:</strong>
                    {{ $dlData['result']['dl_number'] ?? '-' }}
                </p>

                <p><strong>Name:</strong>
                    {{ $dlData['result']['details_of_driving_licence']['name'] ?? '-' }}
                </p>

                <p><strong>Father / Husband Name:</strong>
                    {{ $dlData['result']['details_of_driving_licence']['father_or_husband_name'] ?? '-' }}
                </p>

                <p><strong>Status:</strong>
                    {{ $dlData['result']['details_of_driving_licence']['status'] ?? '-' }}
                </p>

                <p><strong>Date of Issue:</strong>
                    {{ $dlData['result']['details_of_driving_licence']['date_of_issue'] ?? '-' }}
                </p>

                <p><strong>Address:</strong><br>
                    {{ $dlData['result']['details_of_driving_licence']['address'] ?? '-' }}
                </p>

                <hr>

                <strong>Class of Vehicle:</strong>
                <ul>
                    @foreach(($dlData['result']['badge_details'][0]['class_of_vehicle'] ?? []) as $class)
                        <li>{{ $class }}</li>
                    @endforeach
                </ul>

            </div>
        </div>
        @endif

    </div>
</div>
@stop
