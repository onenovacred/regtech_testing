@extends('adminlte::page')

@section('title', 'Employment UAN v5 Verification')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">

        {{-- FORM --}}
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Employment UAN v5 Verification</h3>
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

                <form method="POST" action="{{ route('kyc.employment_uan_v5') }}">
                    @csrf

                    <div class="form-group">
                        <label>UAN Numbers (comma separated)</label>
                        <textarea name="uan_list"
                                  class="form-control"
                                  rows="3"
                                  placeholder="100960765588, 101185804570"
                                  required>{{ old('uan_list') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success">
                        Verify UAN(s)
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

                <p><strong>Matching UAN:</strong>
                    {{ $uanData['result']['summary']['matching_uan'] ?? '-' }}
                </p>

                <p><strong>Total UAN Count:</strong>
                    {{ $uanData['result']['summary']['uan_count'] ?? '-' }}
                </p>

                <p><strong>Currently Employed:</strong>
                    {{ $uanData['result']['summary']['is_employed'] ? 'Yes' : 'No' }}
                </p>

                <hr>

                <h6>Recent Employer</h6>
                <p><strong>Name:</strong>
                    {{ $uanData['result']['summary']['recent_employer_data']['establishment_name'] ?? '-' }}
                </p>
                <p><strong>Member ID:</strong>
                    {{ $uanData['result']['summary']['recent_employer_data']['member_id'] ?? '-' }}
                </p>

                <hr>

                <h6>UAN Details</h6>
                @foreach($uanData['result']['uan_details'] as $uan => $details)
                    <div class="border p-2 mb-2">
                        <strong>UAN:</strong> {{ $uan }} <br>
                        <strong>Name:</strong> {{ $details['basic_details']['name'] ?? '-' }} <br>
                        <strong>DOB:</strong> {{ $details['basic_details']['date_of_birth'] ?? '-' }}
                    </div>
                @endforeach

            </div>
        </div>
        @endif

    </div>
</div>
@stop
