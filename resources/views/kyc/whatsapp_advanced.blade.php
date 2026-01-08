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
                <h3 class="card-title">WhatsApp Advanced Check</h3>
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

                <form method="post" action="{{ route('kyc.whatsapp_advanced') }}">
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
                        Verify
                    </button>
                </form>
            </div>
        </div>

        {{-- RESULT --}}
        @if(!empty($whatsappData) && $statusCode == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">WhatsApp Details</h3>
            </div>
            <div class="card-body">

                <p><strong>Mobile:</strong> {{ $whatsappData['mobile'] }}</p>

                <p>
                    <strong>Account Found:</strong>
                    {!! $whatsappData['account_found']
                        ? '<span class="badge badge-success">Yes</span>'
                        : '<span class="badge badge-danger">No</span>' !!}
                </p>

                <p>
                    <strong>Business Account:</strong>
                    {!! $whatsappData['is_business']
                        ? '<span class="badge badge-info">Yes</span>'
                        : '<span class="badge badge-secondary">No</span>' !!}
                </p>

                <p><strong>Status Message:</strong>
                    {{ $whatsappData['status_message'] ?? '-' }}
                </p>

                <p><strong>Devices Count:</strong>
                    {{ $whatsappData['device_count'] ?? 0 }}
                </p>

                @if(!empty($whatsappData['devices']))
                    <hr>
                    <strong>Devices:</strong>
                    <ul>
                        @foreach($whatsappData['devices'] as $device)
                            <li>
                                Device ID: {{ $device['device'] }},
                                Primary: {{ $device['is_primary'] ? 'Yes' : 'No' }}
                            </li>
                        @endforeach
                    </ul>
                @endif

            </div>
        </div>
        @endif

    </div>
</div>
@stop

@section('custom_js')
@stop
