@extends('adminlte::page')

@section('title', 'PAN Verification V4')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">

        {{-- PAN FORM --}}
        <div class="card card-light">
            <div class="card-header">
                <h3 class="card-title">PAN Verification (V4)</h3>
            </div>

            <div class="card-body">

                {{-- ERROR / INFO MESSAGE --}}
                @if(isset($statusCode) && in_array($statusCode, [102, 104]))
                    <div class="alert {{ $statusCode == 104 ? 'alert-warning' : 'alert-danger' }}">
                        {{ $errorMessage ?? 'PAN verification failed' }}
                    </div>
                @endif

                <form method="post" action="{{ route('kyc.pandetailsv4') }}">
                    @csrf
                    <div class="form-group">
                        <label>PAN Number</label>
                        <input type="text"
                               name="pan"
                               class="form-control"
                               placeholder="Ex: ABCDE1234F"
                               maxlength="10"
                               value="{{ old('pan') }}"
                               required>
                    </div>
                    <button class="btn btn-success">Verify</button>
                </form>

            </div>
        </div>
    </div>
</div>

{{-- PAN RESULT --}}
@if(isset($pan['result_code']) && $pan['result_code'] == 101)

<div class="row mt-3">
    <div class="col-md-8 offset-md-2">

        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">PAN Details</h3>
            </div>

            <div class="card-body">

                {{-- BASIC DETAILS --}}
                <h4>Basic Details</h4>
                <hr>
                <p><strong>PAN:</strong> {{ $pan['result']['pan'] ?? '-' }}</p>
                <p><strong>PAN Status:</strong> {{ $pan['result']['pan_status'] ?? '-' }}</p>
                <p><strong>PAN Type:</strong> {{ $pan['result']['pan_type'] ?? '-' }}</p>

                {{-- PERSONAL DETAILS --}}
                <h4 class="mt-4">Personal Details</h4>
                <hr>
                <p><strong>Father Name:</strong> {{ $pan['result']['father_name'] ?? '-' }}</p>
                <p><strong>Gender:</strong> {{ ucfirst($pan['result']['gender'] ?? '-') }}</p>

                {{-- AADHAAR --}}
                <h4 class="mt-4">Aadhaar</h4>
                <hr>
                <p>
                    <strong>Aadhaar Linked:</strong>
                    {{ !empty($pan['result']['aadhaar_linked']) ? 'Yes' : 'No' }}
                </p>
                <p><strong>Aadhaar Number:</strong>
                    {{ $pan['result']['aadhaar_number'] ?? '-' }}
                </p>

                {{-- ADDRESS --}}
                <h4 class="mt-4">Address</h4>
                <hr>
                <p>
                    {{ $pan['result']['address']['building_name'] ?? '' }}<br>
                    {{ $pan['result']['address']['street_name'] ?? '' }}<br>
                    {{ $pan['result']['address']['locality'] ?? '' }}<br>
                    {{ $pan['result']['address']['city'] ?? '' }},
                    {{ $pan['result']['address']['state'] ?? '' }} -
                    {{ $pan['result']['address']['pincode'] ?? '' }}<br>
                    {{ $pan['result']['address']['country'] ?? 'India' }}
                </p>

                {{-- CONTACT --}}
                <h4 class="mt-4">Contact</h4>
                <hr>
                <p><strong>Mobile:</strong> {{ $pan['result']['mobile'] ?? '-' }}</p>
                <p><strong>Email:</strong> {{ $pan['result']['email'] ?? '-' }}</p>

            </div>
        </div>
    </div>
</div>
@endif
@stop
