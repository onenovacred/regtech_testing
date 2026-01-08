@extends('adminlte::page')

@section('title', 'Mobile Name Lookup')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">

        
        @if(isset($errorMessage))
            <div class="alert alert-danger">
                {{ $errorMessage }}
            </div>
        @endif

       
        @if($hit_limits_exceeded)
            <div class="alert alert-warning">
                You are not registered to use this service. Please update your plan.
            </div>
        @endif

        @if($low_wallet_balance)
            <div class="alert alert-danger">
                Please recharge your wallet.
            </div>
        @endif

        
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Mobile with Name Lookup</h3>
            </div>

            <div class="card-body">
                <form method="POST"  action="{{ route('kyc.mobile_name_lookup') }}" >
                    @csrf

                    <div class="form-group">
                        <label>Mobile Number</label>
                        <input type="text"
                               name="mobile"
                               class="form-control"
                               maxlength="10"
                               placeholder="Enter mobile number"
                               value="{{ old('mobile') }}"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               placeholder="Enter name"
                               value="{{ old('name') }}"
                               required>
                    </div>

                    <button type="submit" class="btn btn-success btn-block">
                        Verify
                    </button>
                </form>
            </div>
        </div>

        
        @if(!empty($mobileData))
            <div class="card mt-4">
                <div class="card-header">
                    Verification Result
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Mobile Linked Name</th>
                            <td>{{ $mobileData['mobile_linked_name'] ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Name Match</th>
                            <td>
                                @if($mobileData['name_match'])
                                    <span class="badge badge-success">Yes</span>
                                @else
                                    <span class="badge badge-danger">No</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Name Match Score</th>
                            <td>{{ $mobileData['name_match_score'] ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        @endif

    </div>
</div>
@stop
