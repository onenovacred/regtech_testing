@extends('adminlte::page')

@section('title', 'RegtechAPI')

@section('content_header')
@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">

        {{-- FORM --}}
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">E-Commerce Generate URL (Order Duration)</h3>
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

                <form method="post" action="{{ route('kyc.ecom_generate_url_order_duration') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label>Client Reference Number</label>
                        <input type="text" name="client_ref_num"
                               class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Transaction Callback URL</label>
                        <input type="url" name="txn_completed_cburl"
                               class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Return URL</label>
                        <input type="url" name="return_url"
                               class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Order Duration</label>
                        <input type="text" name="order_duration"
                               class="form-control"
                               placeholder="3+"
                               required>
                    </div>

                    <button type="submit" class="btn btn-success">
                        Generate URL
                    </button>
                </form>
            </div>
        </div>

        {{-- RESULT --}}
        @if(!empty($ecomData) && $statusCode == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Generated Transaction URL</h3>
            </div>
            <div class="card-body">

                <p><strong>Status:</strong> {{ $ecomData['status'] }}</p>
                <p><strong>Request ID:</strong> {{ $ecomData['request_id'] }}</p>
                <p><strong>Expires:</strong> {{ $ecomData['expires'] }}</p>
                <p><strong>Order Duration:</strong> {{ $ecomData['order_duration'] }}</p>

                <p><strong>Transaction URL:</strong></p>
                <textarea class="form-control" rows="4" readonly>
{{ $ecomData['url'] }}
                </textarea>

            </div>
        </div>
        @endif

    </div>
</div>
@stop

@section('custom_js')
@stop
