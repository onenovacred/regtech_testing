@extends('adminlte::page')

@section('title', 'UAN Advanced Verification')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">

        {{-- FORM CARD --}}
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">UAN Advanced Verification</h3>
            </div>

            <div class="card-body">

                {{-- ERROR --}}
                @if(isset($errorMessage))
                    <div class="alert alert-danger">
                        {{ $errorMessage }}
                    </div>
                @endif

                {{-- HIT LIMIT --}}
                @if($hit_limits_exceeded == 1)
                    <div class="alert alert-danger">
                        You are not allowed to use this service. Please upgrade your plan.
                    </div>
                @endif

                {{-- WALLET --}}
                @if($low_wallet_balance == 1)
                    <div class="alert alert-danger">
                        Insufficient wallet balance. Please recharge.
                    </div>
                @endif

                {{-- FORM --}}
                <form method="POST" action="{{ route('kyc.uan_advanced') }}">
                    @csrf

                    <div class="form-group">
                        <label>UAN Number</label>
                        <input type="text"
                               name="uan"
                               class="form-control"
                               placeholder="Enter 12-digit UAN"
                               maxlength="12"
                               value="{{ old('uan') }}"
                               required>
                    </div>

                    <button type="submit" class="btn btn-success">
                        Verify UAN
                    </button>
                </form>
            </div>
        </div>

        {{-- RESULT --}}
        @if(!empty($uanData))
        <div class="card card-success mt-3">
            <div class="card-header">
                <h3 class="card-title">UAN Verification Result</h3>
            </div>

            <div class="card-body">
                <p><strong>Name:</strong> {{ $uanData['employee_name'] ?? '-' }}</p>
                <p><strong>Gender:</strong> {{ $uanData['gender'] ?? '-' }}</p>
                <p><strong>DOB:</strong> {{ $uanData['dob'] ?? '-' }}</p>
                <p><strong>Is Employed:</strong> {{ isset($uanData['is_employed']) ? ($uanData['is_employed'] ? 'Yes' : 'No') : '-' }}</p>
                <p><strong>UAN Count:</strong> {{ $uanData['uan_count'] ?? '-' }}</p>

                <hr>

                <p><strong>Employer Name:</strong> {{ $uanData['establishment_name'] ?? '-' }}</p>
                <p><strong>Establishment ID:</strong> {{ $uanData['establishment_id'] ?? '-' }}</p>
                <p><strong>Member ID:</strong> {{ $uanData['member_id'] ?? '-' }}</p>
                <p><strong>Date of Joining:</strong> {{ $uanData['date_of_joining'] ?? '-' }}</p>
                <p><strong>Date of Exit:</strong> {{ $uanData['date_of_exit'] ?? '-' }}</p>

                <hr>

                <p><strong>Email:</strong> {{ $uanData['email'] ?? '-' }}</p>
                <p><strong>Relation:</strong> {{ $uanData['relation'] ?? '-' }}</p>
                <p><strong>Relative Name:</strong> {{ $uanData['relative_name'] ?? '-' }}</p>
            </div>
        </div>
        @endif

    </div>
</div>
@stop
