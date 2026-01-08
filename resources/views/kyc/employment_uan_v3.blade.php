@extends('adminlte::page')

@section('title', 'Employment UAN v3 Verification')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">

        {{-- FORM --}}
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Employment UAN v3 Verification</h3>
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

                <form method="POST" action="{{ route('kyc.employment_uan_v3') }}">
                    @csrf

                    <div class="form-group">
                        <label>UAN Number</label>
                        <input type="text"
                               name="uan"
                               class="form-control"
                               value="{{ old('uan') }}"
                               required>
                        @error('uan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success">
                        Verify UAN
                    </button>
                </form>
            </div>
        </div>

        {{-- RESULT --}}
        @if(isset($uanData['result']))
        <div class="card card-success mt-3">
            <div class="card-header">
                <h3 class="card-title">Verification Result</h3>
            </div>

            <div class="card-body">

                <p>
                    <strong>Matching UAN:</strong>
                    {{ $uanData['result']['summary']['matching_uan'] ?? '-' }}
                </p>

                <p>
                    <strong>Total UAN Count:</strong>
                    {{ $uanData['result']['summary']['uan_count'] ?? '-' }}
                </p>

                <p>
                    <strong>Currently Employed:</strong>
                    {{ isset($uanData['result']['summary']['is_employed']) && $uanData['result']['summary']['is_employed'] ? 'Yes' : 'No' }}
                </p>

                <p>
                    <strong>Date of Exit Marked:</strong>
                    {{ isset($uanData['result']['summary']['date_of_exit_marked']) && $uanData['result']['summary']['date_of_exit_marked'] ? 'Yes' : 'No' }}
                </p>

                <hr>

                <h6>Recent Employer Details</h6>

                <p>
                    <strong>Establishment Name:</strong>
                    {{ $uanData['result']['summary']['recent_employer_data']['establishment_name'] ?? '-' }}
                </p>

                <p>
                    <strong>Establishment ID:</strong>
                    {{ $uanData['result']['summary']['recent_employer_data']['establishment_id'] ?? '-' }}
                </p>

                <p>
                    <strong>Member ID:</strong>
                    {{ $uanData['result']['summary']['recent_employer_data']['member_id'] ?? '-' }}
                </p>

                <p>
                    <strong>Date of Joining:</strong>
                    {{ $uanData['result']['summary']['recent_employer_data']['date_of_joining'] ?? '-' }}
                </p>

                <p>
                    <strong>Date of Exit:</strong>
                    {{ $uanData['result']['summary']['recent_employer_data']['date_of_exit'] ?? '-' }}
                </p>

            </div>
        </div>
        @endif

    </div>
</div>
@stop
