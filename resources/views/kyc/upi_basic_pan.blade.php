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
                <h3 class="card-title">UAN Basic Sync (PAN)</h3>
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

                <form method="post" action="{{ route('kyc.uan_basic_pan') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label>PAN Number</label>
                        <input type="text"
                               name="pan"
                               class="form-control"
                               maxlength="10"
                               placeholder="Enter PAN number"
                               required>
                    </div>

                    <button type="submit" class="btn btn-success">
                        Fetch UAN Details
                    </button>
                </form>
            </div>
        </div>

        {{-- RESULT CARD --}}
        @if(!empty($uanData) && $statusCode == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">UAN Details</h3>
            </div>
            <div class="card-body">

                <p>
                    <strong>UAN Count:</strong>
                    {{ $uanData['uan_count'] ?? 0 }}
                </p>

                <p>
                    <strong>Employment Status:</strong>
                    @if($uanData['is_employed'])
                        <span class="badge badge-success">Employed</span>
                    @else
                        <span class="badge badge-danger">Not Employed</span>
                    @endif
                </p>

                @if(!empty($uanData['uan_list']))
                    <hr>
                    <h5>UAN List</h5>
                    <ul>
                        @foreach($uanData['uan_list'] as $uan)
                            <li>{{ $uan }}</li>
                        @endforeach
                    </ul>
                @endif

                @if(!empty($uanData['recent_employer']))
                    <hr>
                    <h5>Recent Employer</h5>

                    <p><strong>Establishment Name:</strong>
                        {{ $uanData['recent_employer']['establishment_name'] ?? 'N/A' }}
                    </p>

                    <p><strong>Date of Joining:</strong>
                        {{ $uanData['recent_employer']['date_of_joining'] ?? 'N/A' }}
                    </p>

                    <p><strong>Member ID:</strong>
                        {{ $uanData['recent_employer']['member_id'] ?? 'N/A' }}
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
