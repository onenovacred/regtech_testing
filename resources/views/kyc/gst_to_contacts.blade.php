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
                <h3 class="card-title">GST to Contact Details</h3>
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

                <form method="post" action="{{ route('kyc.gst_to_contacts') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label>GSTIN</label>
                        <input type="text"
                               name="gstin"
                               class="form-control"
                               maxlength="15"
                               placeholder="Enter GSTIN"
                               required>
                    </div>

                    <button type="submit" class="btn btn-success">
                        Fetch Contact Details
                    </button>
                </form>
            </div>
        </div>

        {{-- RESULT CARD --}}
        @if(!empty($gstData) && $statusCode == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Contact Details</h3>
            </div>
            <div class="card-body">

                <p><strong>GSTIN:</strong> {{ $gstData['gstin'] }}</p>
                <p><strong>Mobile:</strong> {{ $gstData['mobile'] ?? '-' }}</p>
                <p><strong>Email:</strong> {{ $gstData['email'] ?? '-' }}</p>

            </div>
        </div>
        @endif

    </div>
</div>
@stop

@section('custom_js')
@stop
