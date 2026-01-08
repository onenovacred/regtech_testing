@extends('adminlte::page')

@section('title', 'UAN Basic Lookup')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">

        {{-- ALERTS --}}
        @if($low_wallet_balance)
            <div class="alert alert-danger">
                Please recharge your wallet.
            </div>
        @endif

        @if($hit_limits_exceeded)
            <div class="alert alert-warning">
                You have exceeded your hit limits.
            </div>
        @endif

        @if(isset($errorMessage))
            <div class="alert alert-danger">
                {{ $errorMessage }}
            </div>
        @endif

       
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">UAN Basic Verification</h3>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('kyc.uan_basic') }}">
                    @csrf

                    <div class="form-group">
                        <label>Mobile Number</label>
                        <input type="text"
                               name="mobile"
                               class="form-control"
                               maxlength="10"
                               placeholder="Enter mobile number"
                               required>
                    </div>

                    <button class="btn btn-success btn-block">
                        Verify
                    </button>
                </form>
            </div>
        </div>

        {{-- RESULT --}}
        @if(!empty($uanData) && $statusCode == 200)

        <div class="card card-success mt-4">
            <div class="card-header">
                <h3 class="card-title">UAN Details</h3>
            </div>

            <div class="card-body">

                <p><strong>UAN Count:</strong> {{ $uanData['summary']['uan_count'] ?? '-' }}</p>
                <p><strong>Currently Employed:</strong>
                    @if($uanData['summary']['is_employed'])
                        <span class="badge badge-success">Yes</span>
                    @else
                        <span class="badge badge-danger">No</span>
                    @endif
                </p>

                <hr>

                <h5>UAN Numbers</h5>
                <ul>
                    @foreach(($uanData['uan'] ?? []) as $uan)
                        <li>{{ $uan }}</li>
                    @endforeach
                </ul>

                @if(isset($uanData['summary']['recent_employer_data']))
                    <hr>
                    <h5>Recent Employer</h5>

                    <p><strong>Company:</strong>
                        {{ $uanData['summary']['recent_employer_data']['establishment_name'] ?? '-' }}
                    </p>

                    <p><strong>Date of Joining:</strong>
                        {{ $uanData['summary']['recent_employer_data']['date_of_joining'] ?? '-' }}
                    </p>

                    <p><strong>Date of Exit:</strong>
                        {{ $uanData['summary']['recent_employer_data']['date_of_exit'] ?? '-' }}
                    </p>
                @endif

            </div>
        </div>
        @endif

    </div>
</div>
@stop
