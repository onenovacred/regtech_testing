@extends('adminlte::page')

@section('title', 'RegtechAPI')

@section('content_header')
@stop

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">

        {{-- FORM CARD --}}
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">PAN to DIN Lookup</h3>
            </div>

            <div class="card-body">

                {{-- ERROR MESSAGE --}}
                @if(isset($errorMessage))
                    <div class="alert alert-danger">
                        {{ $errorMessage }}
                    </div>
                @endif

                {{-- HIT LIMIT --}}
                @if($hit_limits_exceeded)
                    <div class="alert alert-warning">
                        You are not registered to use this service. Please update your plan.
                    </div>
                @endif

                {{-- LOW WALLET --}}
                @if($low_wallet_balance)
                    <div class="alert alert-danger">
                        Please recharge your wallet.
                    </div>
                @endif

                {{-- SERVER ERROR --}}
                @if(isset($statusCode) && in_array($statusCode, [400,404,500]))
                    <div class="alert alert-danger">
                        Server error. Please try again later.
                    </div>
                @endif

                {{-- FORM --}}
                <form method="POST" action="{{ route('kyc.pan_to_din') }}">
                    @csrf

                    <div class="form-group">
                        <label>PAN Number</label>
                        <input type="text"
                               name="pan"
                               class="form-control"
                               maxlength="10"
                               placeholder="ABCDE1234F"
                               value="{{ old('pan') }}"
                               required>
                    </div>

                    <button type="submit" class="btn btn-success">
                        Verify
                    </button>
                </form>
            </div>
        </div>

        @if(!empty($dinData) && $statusCode == 200)
        <div class="card card-success mt-3">
            <div class="card-header">
                <h3 class="card-title">DIN Details</h3>
            </div>

            <div class="card-body table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>DIN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $dinData['din'] ?? '-' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @endif

    </div>
</div>
@stop
