@extends('adminlte::page')

@section('title', 'Bank Passbook OCR')

@section('content_header')
@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">

        
        @if (isset($errorMessage))
            <div class="alert alert-danger" role="alert">
                {{ $errorMessage }}
            </div>
        @endif

        @if (isset($hit_limits_exceeded) && $hit_limits_exceeded == 1)
            <div class="alert alert-danger" role="alert">
                Hit limit exceeded. Please upgrade your plan.
            </div>
        @endif

        
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Bank Passbook OCR</h3>
            </div>

            <div class="card-body">
                <form method="post" action="{{ route('kyc.bankpassbook_ocr') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label>Passbook </label>
                        <input type="file" class="form-control" name="file" required>
                    </div>

                    {{-- <div class="form-group">
                        <label>Account Holder Name (Optional)</label>
                        <input type="text" class="form-control" name="account_holder_name"
                               value="{{ old('account_holder_name') }}">
                    </div> --}}

                    <button type="submit" class="btn btn-success">Verify</button>
                </form>
            </div>
        </div>

        
        @if (isset($bankData['statusCode']) && $bankData['statusCode'] == 200)

            <div class="card card-success mt-3">
                <div class="card-header">
                    <h3 class="card-title">Bank Details</h3>
                </div>

                <div class="card-body">
                    <p>
                        <strong>Account Number:</strong>
                        {{ $bankData['result']['account_number'] ?? 'N/A' }}
                    </p>

                    <p>
                        <strong>IFSC Code:</strong>
                        {{ $bankData['result']['ifsc_code'] ?? 'N/A' }}
                    </p>

                    <p>
                        <strong>Account Holder Name:</strong>
                        {{ $bankData['result']['name'] ?? 'N/A' }}
                    </p>

                    <p>
                        <strong>Name Match:</strong>
                        @if (isset($bankData['result']['name_match']))
                            {{ $bankData['result']['name_match'] ? 'Yes' : 'No' }}
                        @else
                            N/A
                        @endif
                    </p>
                </div>
            </div>

        @endif

    </div>
</div>
@stop

@section('custom_js')
@stop
    