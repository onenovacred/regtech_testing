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
                <h3 class="card-title">WhatsApp Number Check</h3>
            </div>
            <div class="card-body">

                {{-- Wallet / Hit limit alerts --}}
                @if(isset($low_wallet_balance) && $low_wallet_balance == 1)
                    <div class="alert alert-danger" role="alert">
                        Please recharge your wallet to continue using this service.
                    </div>
                @endif

                @if(isset($hit_limits_exceeded) && $hit_limits_exceeded == 1)
                    <div class="alert alert-warning" role="alert">
                        You have exceeded your hit limits. Please upgrade your plan.
                    </div>
                @endif

                {{-- Server / API Errors --}}
                @if(isset($statusCode) && in_array($statusCode, [400,404]))
                    <div class="alert alert-danger" role="alert">
                        Server error. Please try again later.
                    </div>
                @endif

                @if(isset($statusCode) && $statusCode == 500)
                    <div class="alert alert-danger" role="alert">
                        Internal Server Error. Please contact techsupport@docboyz.in.
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <form role="form" method="post" action="{{ route('kyc.whatsapp_number_check') }}">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="mobile">Mobile Number</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="mobile"
                                    placeholder="Enter 10-digit mobile number"
                                    maxlength="10"
                                    required
                                >
                            </div>

                            <button type="submit" class="btn btn-success">
                                Verify Number
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        {{-- RESULT CARD --}}
        @if(!empty($whatsappData) && isset($statusCode) && $statusCode == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Verification Result</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <p>
                            <strong>Mobile Number:</strong>
                            {{ $whatsappData['mobile'] ?? '-' }}
                        </p>

                        <p>
                            <strong>Account Found:</strong>
                            @if(($whatsappData['account_found'] ?? false) === true)
                                <span class="badge badge-success">Yes</span>
                            @else
                                <span class="badge badge-danger">No</span>
                            @endif
                        </p>

                        <p>
                            <strong>Status:</strong>
                            {{ $whatsappData['status'] ?? '-' }}
                        </p>

                        <p>
                            <strong>Business Account:</strong>
                            @if(($whatsappData['is_business'] ?? false) === true)
                                <span class="badge badge-info">Yes</span>
                            @else
                                <span class="badge badge-secondary">No</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @endif

    </div>
</div>
@stop

@section('custom_js')
@stop
