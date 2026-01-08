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
                <h3 class="card-title">E-Commerce Generate URL</h3>
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

                <form method="post" action="{{ route('kyc.ecom_url_username') }}">
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
                        <label>Username (Mobile / Email)</label>
                        <input type="text" name="username"
                               class="form-control"
                               placeholder="+919876543210">
                    </div>

                    <div class="form-group">
                        <label>Is Editable</label>
                        <select name="is_editable" class="form-control">
                            <option value="false">No</option>
                            <option value="true">Yes</option>
                        </select>
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
                <p><strong>Expires At:</strong> {{ $ecomData['expires'] }}</p>
                <p><strong>Username:</strong> {{ $ecomData['username'] ?? '-' }}</p>
                <p><strong>Editable:</strong>
                    {{ $ecomData['is_editable'] ? 'Yes' : 'No' }}
                </p>

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
