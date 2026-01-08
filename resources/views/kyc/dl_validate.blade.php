@extends('adminlte::page')

@section('title', 'RegtechAPI')

@section('content_header')
@stop

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">

        {{-- FORM CARD --}}
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Driving License Validation</h3>
            </div>

            <div class="card-body">

                {{-- LOW WALLET --}}
                @if($low_wallet_balance == 1)
                    <div class="alert alert-danger">
                        Please recharge your wallet.
                    </div>
                @endif

                {{-- HIT LIMIT --}}
                @if($hit_limits_exceeded == 1)
                    <div class="alert alert-warning">
                        You have exceeded your hit limits. Please upgrade your plan.
                    </div>
                @endif

                {{-- SERVER ERROR --}}
                @if(isset($statusCode) && in_array($statusCode, [400,404,500]))
                    <div class="alert alert-danger">
                        Server error. Please try again later.
                    </div>
                @endif

                {{-- CUSTOM ERROR --}}
                @if(isset($errorMessage))
                    <div class="alert alert-danger">
                        {{ $errorMessage }}
                    </div>
                @endif

                {{-- FORM --}}
                <form method="POST" action="{{ route('kyc.dl_validate') }}">
                    @csrf

                    <div class="form-group">
                        <label>Driving License Number</label>
                        <input type="text"
                               name="dl_number"
                               class="form-control"
                               placeholder="MH1420110061234"
                               value="{{ old('dl_number') }}"
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
                        Verify DL
                    </button>
                </form>
            </div>
        </div>

        {{-- RESULT CARD --}}
        @if(!empty($dlData) && $statusCode == 200)
        <div class="card card-success mt-3">
            <div class="card-header">
                <h3 class="card-title">Driving License Details</h3>
            </div>

            <div class="card-body table-responsive">
                <table class="table table-bordered">

                    <tr>
                        <th>DL Number</th>
                        <td>{{ $dlData['dl_number'] ?? '-' }}</td>
                    </tr>

                    <tr>
                        <th>Name</th>
                        <td>{{ $dlData['details_of_driving_licence']['name'] ?? '-' }}</td>
                    </tr>

                    <tr>
                        <th>Father / Husband Name</th>
                        <td>{{ $dlData['details_of_driving_licence']['father_or_husband_name'] ?? '-' }}</td>
                    </tr>

                    <tr>
                        <th>Status</th>
                        <td>{{ $dlData['details_of_driving_licence']['status'] ?? '-' }}</td>
                    </tr>

                    <tr>
                        <th>Date of Issue</th>
                        <td>{{ $dlData['details_of_driving_licence']['date_of_issue'] ?? '-' }}</td>
                    </tr>

                    <tr>
                        <th>Address</th>
                        <td>{{ $dlData['details_of_driving_licence']['address'] ?? '-' }}</td>
                    </tr>

                </table>
            </div>
        </div>
        @endif

    </div>
</div>
@stop

@section('custom_js')
@stop
