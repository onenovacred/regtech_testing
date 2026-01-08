@extends('adminlte::page')

@section('title', 'Employment UAN Advanced Verification')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">

        {{-- FORM --}}
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Employment UAN Advanced (Name + DOB)</h3>
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

                <form method="POST"
                      action="{{ route('kyc.employment_uan_advanced_v2') }}">
                    @csrf

                    <div class="form-group">
                        <label>Employee Name</label>
                        <input type="text"
                               name="employee_name"
                               class="form-control"
                               value="{{ old('employee_name') }}"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Date of Birth</label>
                        <input type="date"
                               name="dob"
                               class="form-control"
                               value="{{ old('dob') }}"
                               required>
                    </div>

                    <button type="submit" class="btn btn-success">
                        Verify UAN (Advanced)
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

                <p><strong>Total UANs Found:</strong>
                    {{ $uanData['result']['summary']['uan_count'] ?? '-' }}
                </p>

                <p><strong>Employee Name Match:</strong>
                    {{ $uanData['result']['summary']['employee_name_match'] ? 'Yes' : 'No' }}
                </p>

                <p><strong>Currently Employed:</strong>
                    {{ $uanData['result']['summary']['is_employed'] ? 'Yes' : 'No' }}
                </p>

                <hr>

                <h6>UAN List</h6>
                <ul>
                    @foreach(($uanData['result']['uan'] ?? []) as $uan)
                        <li>{{ $uan }}</li>
                    @endforeach
                </ul>

                <hr>

                <h6>Recent Employer</h6>
                <p>
                    {{ $uanData['result']['summary']['recent_employer_data']['establishment_name'] ?? '-' }}
                </p>

            </div>
        </div>
        @endif

    </div>
</div>
@stop
