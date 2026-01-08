@extends('adminlte::page')

@section('title', 'Mobile Vintage Lookup')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">

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

        {{-- FORM CARD --}}
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Mobile Vintage Lookup</h3>
            </div>

            <div class="card-body">
                <form method="POST"
                      action="{{ route('kyc.mobile_vintage_lookup') }}">
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
                        Fetch Vintage
                    </button>
                </form>
            </div>
        </div>

        {{-- RESULT --}}
        @if(!empty($vintageData))
        <div class="card card-success mt-4">
            <div class="card-header">
                <h3 class="card-title">Mobile Vintage Details</h3>
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Mobile Tenure (Min)</th>
                        <td>{{ $vintageData['mobile_tenure']['min'] ?? '-' }} months</td>
                    </tr>
                    <tr>
                        <th>Mobile Tenure (Max)</th>
                        <td>{{ $vintageData['mobile_tenure']['max'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Last Deactivated (Min)</th>
                        <td>{{ $vintageData['last_deactivated']['min'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Last Deactivated (Max)</th>
                        <td>{{ $vintageData['last_deactivated']['max'] ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>
        @endif

    </div>
</div>
@stop
