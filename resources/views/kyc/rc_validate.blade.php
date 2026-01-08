@extends('adminlte::page')

@section('title', 'RC Verification')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">

        {{-- RC FORM --}}
        <div class="card card-light">
            <div class="card-header">
                <h3 class="card-title">RC Verification</h3>
            </div>

            <div class="card-body">

                
                @if(isset($statusCode) && $statusCode != 200)
                    <div class="alert alert-danger">
                        {{ $message ?? 'RC verification failed' }}
                    </div>
                @endif

                <form method="post" action="{{ route('kyc.rc-validate') }}">
                    @csrf
                    <div class="form-group">
                        <label>RC Number</label>
                        <input type="text"
                               name="rcNumber"
                               class="form-control"
                               placeholder="Ex: AP30AF8089"
                               value="{{ old('rcNumber') }}"
                               required>
                    </div>
                    <button class="btn btn-success">Verify</button>
                </form>

            </div>
        </div>
    </div>
</div>


@if(isset($rcData['statusCode']) && $rcData['statusCode'] == 200)
<div class="row mt-3">
    <div class="col-md-8 offset-md-2">

        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">RC Details</h3>
            </div>

            <div class="card-body">

                {{-- OWNER DETAILS --}}
                <h4>Owner Details</h4>
                <hr>
                <p><strong>Owner Name:</strong>
                    {{ $rcData['result']['registration']['owner']['name'] ?? '-' }}
                </p>
                <p><strong>Father Name:</strong>
                    {{ $rcData['result']['registration']['owner']['fatherName'] ?? '-' }}
                </p>
                <p><strong>Mobile:</strong>
                    {{ $rcData['result']['registration']['owner']['mobileNumber'] ?? '-' }}
                </p>
                <p><strong>Permanent Address:</strong>
                    {{ $rcData['result']['registration']['owner']['permanentAddress'] ?? '-' }}
                </p>

                {{-- VEHICLE DETAILS --}}
                <h4 class="mt-4">Vehicle Details</h4>
                <hr>
                <p><strong>RC Number:</strong>
                    {{ $rcData['result']['registration']['number'] ?? '-' }}
                </p>
                <p><strong>Registration Date:</strong>
                    {{ $rcData['result']['registration']['date'] ?? '-' }}
                </p>
                <p><strong>Expiry Date:</strong>
                    {{ $rcData['result']['registration']['expiryDate'] ?? '-' }}
                </p>
                <p><strong>Vehicle Class:</strong>
                    {{ $rcData['result']['vehicle']['class'] ?? '-' }}
                </p>
                <p><strong>Manufacturer:</strong>
                    {{ $rcData['result']['vehicle']['manufacturer'] ?? '-' }}
                </p>
                <p><strong>Model:</strong>
                    {{ $rcData['result']['vehicle']['model'] ?? '-' }}
                </p>
                <p><strong>Fuel Type:</strong>
                    {{ $rcData['result']['vehicle']['fuelType'] ?? '-' }}
                </p>
                <p><strong>Chassis No:</strong>
                    {{ $rcData['result']['vehicle']['chassis'] ?? '-' }}
                </p>
                <p><strong>Engine No:</strong>
                    {{ $rcData['result']['vehicle']['engine'] ?? '-' }}
                </p>

                {{-- INSURANCE --}}
                <h4 class="mt-4">Insurance</h4>
                <hr>
                <p><strong>Company:</strong>
                    {{ $rcData['result']['insurance']['company'] ?? '-' }}
                </p>
                <p><strong>Policy Number:</strong>
                    {{ $rcData['result']['insurance']['policyNumber'] ?? '-' }}
                </p>
                <p><strong>Valid Upto:</strong>
                    {{ $rcData['result']['insurance']['expiryDate'] ?? '-' }}
                </p>

                {{-- FINANCE --}}
                <h4 class="mt-4">Finance</h4>
                <hr>
                <p><strong>Financed:</strong>
                    {{ isset($rcData['result']['finance']['isFinanced']) && $rcData['result']['finance']['isFinanced'] ? 'Yes' : 'No' }}
                </p>
                <p><strong>Financer:</strong>
                    {{ $rcData['result']['finance']['rcFinancer'] ?? '-' }}
                </p>

            </div>
        </div>
    </div>
</div>
@endif
@stop
