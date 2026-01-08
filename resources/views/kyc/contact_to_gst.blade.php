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
                <h3 class="card-title">Contact to GST (KYB)</h3>
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

                <form method="post" action="{{ route('kyc.contact_to_gst') }}">
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

                    <button type="submit" class="btn btn-success">
                        Fetch GST Details
                    </button>
                </form>
            </div>
        </div>

        {{-- RESULT CARD --}}
        @if(!empty($gstData) && $statusCode == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">GST Details</h3>
            </div>
            <div class="card-body">

                <p><strong>Mobile:</strong> {{ $gstData['mobile'] }}</p>
                <p><strong>Total GST Found:</strong> {{ $gstData['gst_count'] }}</p>

                @if(!empty($gstData['gst_list']))
                    <hr>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>GSTIN</th>
                                <th>Legal Name</th>
                                <th>Trade Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($gstData['gst_list'] as $gst)
                                <tr>
                                    <td>{{ $gst['gstin'] }}</td>
                                    <td>{{ $gst['legal_name'] }}</td>
                                    <td>{{ $gst['trade_name'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

            </div>
        </div>
        @endif

    </div>
</div>
@stop

@section('custom_js')
@stop
