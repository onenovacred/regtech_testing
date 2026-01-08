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
                <h3 class="card-title">GSTIN PAN Search</h3>
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

                <form method="post" action="{{ route('kyc.gstin_pan_search') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label>PAN Number</label>
                        <input type="text"
                               name="pan"
                               class="form-control"
                               maxlength="10"
                               placeholder="AAJCN6404D"
                               required>
                    </div>

                    <button type="submit" class="btn btn-success">
                        Search GSTINs
                    </button>
                </form>
            </div>
        </div>

        {{-- RESULT CARD --}}
        @if(!empty($gstData) && $statusCode == 200)
        <div class="card card-success mt-3">
            <div class="card-header">
                <h3 class="card-title">GSTIN Search Result</h3>
            </div>
            <div class="card-body">

                <p><strong>PAN:</strong> {{ request('pan') }}</p>
                <p><strong>Total GSTINs:</strong> {{ $gstData['result']['count'] ?? 0 }}</p>

                @if(!empty($gstData['result']['gstinResList']))
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>GSTIN</th>
                                    <th>Status</th>
                                    <th>State</th>
                                    <th>State Code</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($gstData['result']['gstinResList'] as $index => $gst)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $gst['gstin'] ?? '-' }}</td>
                                        <td>
                                            <span class="badge badge-success">
                                                {{ $gst['authStatus'] ?? '-' }}
                                            </span>
                                        </td>
                                        <td>{{ $gst['state'] ?? '-' }}</td>
                                        <td>{{ $gst['stateCd'] ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info">
                        No GSTINs found for this PAN.
                    </div>
                @endif

            </div>
        </div>
        @endif

    </div>
</div>
@stop

@section('custom_js')
@stop
