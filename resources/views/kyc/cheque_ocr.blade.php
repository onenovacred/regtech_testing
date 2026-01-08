@extends('adminlte::page')

@section('title', 'Cheque OCR')

@section('content_header')
<h1>Cheque OCR</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">

    
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Cheque OCR</h3>
            </div>

            <form method="POST" enctype="multipart/form-data">
                @csrf

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

                    
                    @if(isset($errorMessage))
                        <div class="alert alert-danger">
                            {{ $errorMessage }}
                        </div>
                    @endif

                
                    <div class="form-group">
                        <label>Cheque Image</label>
                        <input type="file"
                               name="file"
                               class="form-control"
                               accept=".jpg,.jpeg,.png,.pdf"
                               required>
                    </div>

                   
                    <div class="form-group">
                        <label>Account Holder Name</label>
                        <input type="text"
                               name="account_holder_name"
                               class="form-control"
                               placeholder="Enter account holder name">
                    </div>

                </div>

                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                </div>
            </form>
        </div>

    
        @if(isset($chequeData['statusCode']) && $chequeData['statusCode'] == 200)
            <div class="card card-success mt-3">
                <div class="card-header">
                    <h3 class="card-title">Cheque OCR Result</h3>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th width="40%">Account Number</th>
                            <td>{{ $chequeData['result']['account_number'] ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>IFSC Code</th>
                            <td>{{ $chequeData['result']['ifsc_code'] ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>MICR Code</th>
                            <td>{{ $chequeData['result']['micr_code'] ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Cheque Number</th>
                            <td>{{ $chequeData['result']['cheque_number'] ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Bank Name</th>
                            <td>{{ $chequeData['result']['bank_name'] ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Account Holder Name</th>
                            <td>{{ $chequeData['result']['account_name'] ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        @endif

    </div>
</div>
@stop
