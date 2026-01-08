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

        {{-- FORM --}}
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">UAN Basic (Mobile + Employee Name)</h3>
            </div>

            <div class="card-body">
                <form method="POST"
                      action="{{ route('kyc.uan_basic_mobile') }}">
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

                    <div class="form-group">
                        <label>Employee Name</label>
                        <input type="text"
                               name="employee_name"
                               class="form-control"
                               placeholder="Enter employee name"
                               required>
                    </div>

                    <button class="btn btn-success btn-block">
                       Verify
                    </button>
                </form>
            </div>
        </div>

        {{-- RESULT --}}
        @if(!empty($uanData))
        <div class="card card-success mt-4">
            <div class="card-header">
                <h3 class="card-title">UAN Details</h3>
            </div>

            <div class="card-body">
                <p>
                    <strong>UAN Count:</strong>
                    {{ $uanData['summary']['uan_count'] ?? count($uanData['uan_list'] ?? []) }}
                </p>

                <p>
                    <strong>Currently Employed:</strong>
                    @if(($uanData['summary']['is_employed'] ?? false))
                        <span class="badge badge-success">Yes</span>
                    @else
                        <span class="badge badge-danger">No</span>
                    @endif
                </p>

                <hr>

                <h5>UAN List</h5>
                <ul>
                    @foreach(($uanData['uan_list'] ?? []) as $uan)
                        <li>{{ $uan }}</li>
                    @endforeach
                </ul>

                @if(!empty($uanData['summary']['recent_employer_data']))
                    <hr>
                    <h5>Recent Employer</h5>
                    <p>
                        <strong>Name:</strong>
                        {{ $uanData['summary']['recent_employer_data']['establishment_name'] ?? '-' }}
                    </p>
                    <p>
                        <strong>Date of Joining:</strong>
                        {{ $uanData['summary']['recent_employer_data']['date_of_joining'] ?? '-' }}
                    </p>
                    <p>
                        <strong>Date of Exit:</strong>
                        {{ $uanData['summary']['recent_employer_data']['date_of_exit'] ?? '-' }}
                    </p>
                @endif
            </div>
        </div>
        @endif

    </div>
</div>
@stop
