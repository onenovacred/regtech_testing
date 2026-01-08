@extends('adminlte::page')

@section('title', 'RegtechAPI')

@section('content_header')
@stop

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">

        {{-- ================= FORM CARD ================= --}}
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Mobile to UDYAM Lookup</h3>
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

                @if(isset($errorMessage))
                    <div class="alert alert-danger">
                        {{ $errorMessage }}
                    </div>
                @endif

                {{-- ================= FORM ================= --}}
                <form method="post" action="{{ route('kyc.mobile_to_udyam') }}">
                    @csrf

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

        {{-- ================= RESULT CARD ================= --}}
        @if(!empty($udyamData) && $statusCode == 200)

            <div class="card card-success mt-3">
                <div class="card-header">
                    <h3 class="card-title">UDYAM Details</h3>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>UDYAM Number</th>
                                <th>Enterprise Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($udyamData['result'] as $index => $udyam)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $udyam['udyam_number'] ?? '-' }}</td>
                                    <td>{{ $udyam['enterprise_name'] ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">
                                        No UDYAM records found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        @endif

    </div>
</div>
@stop

@section('custom_js')
@stop
