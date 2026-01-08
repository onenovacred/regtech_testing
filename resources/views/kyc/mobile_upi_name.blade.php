@extends('adminlte::page')

@section('title', 'RegtechAPI')

@section('content_header')
@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">

        {{-- FORM CARD --}}
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Mobile UPI Lookup</h3>
            </div>
            <div class="card-body">

                @if($low_wallet_balance == 1)
                    <div class="alert alert-danger">
                        Please recharge your wallet.
                    </div>
                @endif

                @if($hit_limits_exceeded == 1)
                    <div class="alert alert-warning">
                        You have exceeded your hit limits.
                    </div>
                @endif

                @if(isset($statusCode) && in_array($statusCode, [400,404,500]))
                    <div class="alert alert-danger">
                        Server error. Please try again later.
                    </div>
                @endif

                <form method="post" action="{{ route('kyc.mobile_upi_name') }}">
                    {{ csrf_field() }}

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
                        <label>Name (for matching)</label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               placeholder="Enter name"
                               required>
                    </div>

                    <button type="submit" class="btn btn-success">
                        Fetch UPI Details
                    </button>
                </form>
            </div>
        </div>

        
        @if(!empty($upiData) && $statusCode == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">UPI Details</h3>
            </div>
            <div class="card-body">

                <p>
                    <strong>Mobile Linked Name:</strong>
                    {{ $upiData['mobile_linked_name'] ?? 'N/A' }}
                </p>

                <p>
                    <strong>UPI ID (VPA):</strong>
                    {{ $upiData['vpa'] ?? 'N/A' }}
                </p>

                <p>
                    <strong>Name Match:</strong>
                    @if($upiData['name_match'])
                        <span class="badge badge-success">Matched</span>
                    @else
                        <span class="badge badge-danger">Not Matched</span>
                    @endif
                </p>

                <p>
                    <strong>Name Match Score:</strong>
                    {{ $upiData['name_match_score'] ?? 'N/A' }}
                </p>

            </div>
        </div>
        @endif

    </div>
</div>
@stop

@section('custom_js')
@stop
