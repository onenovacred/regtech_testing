@extends('adminlte::page')

@section('title', 'RegtechAPI')

@section('content_header')
@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">TAN to Company Verification</h3>
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

                <form method="post" action="{{ route('kyc.tan_to_company') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label>TAN Number</label>
                        <input type="text"
                               name="tan"
                               class="form-control"
                               placeholder="PNEN21759D"
                               required>
                    </div>

                    <button type="submit" class="btn btn-success">
                        Verify TAN
                    </button>
                </form>
            </div>
        </div>

        
        @if(!empty($tanData) && $statusCode == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Company Details</h3>
            </div>
            <div class="card-body">

                <p><strong>TAN:</strong> {{ $tanData['tan_number'] }}</p>
                <p><strong>Company Name:</strong> {{ $tanData['company_name'] }}</p>
                <p><strong>Status:</strong> {{ $tanData['status'] }}</p>
                <p><strong>TAN Allotment Date:</strong> {{ $tanData['tan_allotment_date'] }}</p>
                <p><strong>Filing Date:</strong> {{ $tanData['filing_date'] }}</p>
                <p><strong>Phone:</strong> {{ $tanData['phone_number'] }}</p>
                <p><strong>Email:</strong> {{ $tanData['email_id'] }}</p>

                @if(isset($tanData['address']))
                    <hr>
                    <p><strong>Address:</strong></p>
                    <p>
                        {{ $tanData['address']['add_line_1'] ?? '' }}
                        {{ $tanData['address']['add_line_2'] ?? '' }},
                        {{ $tanData['address']['add_line_3'] ?? '' }},
                        {{ $tanData['address']['add_line_4'] ?? '' }},
                        {{ $tanData['address']['add_line_5'] ?? '' }}
                    </p>
                    <p>
                        {{ $tanData['address']['state'] ?? '' }} -
                        {{ $tanData['address']['pin_code'] ?? '' }}
                    </p>
                @endif

            </div>
        </div>
        @endif

    </div>
</div>
@stop

@section('custom_js')
@stop
