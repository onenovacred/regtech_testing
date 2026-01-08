@extends('adminlte::page')

@section('title', 'Mobile Porting History')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">

        {{-- FORM CARD --}}
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">MOBILE PORTING HISTORY LOOKUP</h3>
            </div>

            <div class="card-body">

                {{-- VALIDATION ERRORS --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- API ERRORS --}}
                @if(isset($statusCode) && $statusCode != 200)
                    <div class="alert alert-danger">
                        {{ $errorMessage ?? 'Mobile porting history verification failed' }}
                    </div>
                @endif

                {{-- WALLET / PLAN --}}
                @if(isset($low_wallet_balance) && $low_wallet_balance)
                    <div class="alert alert-danger">
                        Please recharge your wallet.
                    </div>
                @endif

                @if(isset($hit_limits_exceeded) && $hit_limits_exceeded)
                    <div class="alert alert-warning">
                        You have exceeded your hit limits.
                    </div>
                @endif

                {{-- FORM --}}
                <form method="post">
                    @csrf
                <form method="post" action="{{ route('kyc.mobile_porting_history') }}">

                    <div class="form-group">
                        <label>Mobile Number</label>
                        <input type="text"
                               name="mobile_number"
                               class="form-control"
                               value="{{ old('mobile_number') }}"
                               placeholder="Ex: 7820904129"
                               maxlength="10"
                               required>
                    </div>

                    <button class="btn btn-success">
                        Verifys
                    </button>
                </form>
            </div>
        </div>

        {{-- RESULT CARD --}}
        @if(isset($mobileData) && ($statusCode ?? 0) == 200)

        <div class="card card-success mt-3">
            <div class="card-header">
                <h3 class="card-title">PORTING HISTORY RESULT</h3>
            </div>

            <div class="card-body">

                <p>
                    <strong>Valid Number:</strong>
                    @if($mobileData['is_valid'])
                        <span class="badge badge-success">Yes</span>
                    @else
                        <span class="badge badge-danger">No</span>
                    @endif
                </p>

                <p>
                    <strong>Subscriber Status:</strong>
                    {{ $mobileData['subscriber_status'] ?? '-' }}
                </p>

                <p>
                    <strong>Connection Type:</strong>
                    {{ $mobileData['connection_type'] ?? '-' }}
                </p>

                <p>
                    <strong>Is Ported:</strong>
                    @if($mobileData['is_ported'])
                        <span class="badge badge-warning">Yes</span>
                    @else
                        <span class="badge badge-success">No</span>
                    @endif
                </p>

                <p>
                    <strong>Last Ported Date:</strong>
                    {{ $mobileData['last_ported_date'] ?: '-' }}
                </p>

                <hr>

                <p>
                    <strong>Current Operator:</strong><br>
                    {{ $mobileData['current_service_provider']['network_name'] ?? '-' }}
                    ({{ $mobileData['current_service_provider']['network_region'] ?? '-' }})
                </p>

                <p>
                    <strong>Original Operator:</strong><br>
                    {{ $mobileData['original_service_provider']['network_name'] ?? '-' }}
                    ({{ $mobileData['original_service_provider']['network_region'] ?? '-' }})
                </p>

                <hr>

                <strong>Porting History</strong>

                @if(!empty($mobileData['porting_history']))
                    <table class="table table-bordered mt-2">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Operator</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mobileData['porting_history'] as $row)
                                <tr>
                                    <td>{{ $row['date'] ?? '-' }}</td>
                                    <td>{{ $row['operator'] ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-warning mt-2">
                        No porting history available.
                    </p>
                @endif

            </div>
        </div>
        @endif

    </div>
</div>
@stop
