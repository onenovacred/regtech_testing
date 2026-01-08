@extends('adminlte::page')

@section('title', 'UDYAM Verification')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">

        {{-- FORM CARD --}}
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">UDYAM VERIFICATION</h3>
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
                        {{ $errorMessage ?? 'Unable to process UDYAM verification.' }}
                    </div>
                @endif

                {{-- FORM --}}
                <form method="post" action="{{ route('kyc.udyam_authentication') }}">
                    @csrf

                    <div class="form-group">
                        <label>UDYAM Registration Number</label>
                        <input type="text"
                               name="udyam_reg_no"
                               class="form-control"
                               value="{{ old('udyam_reg_no') }}"
                               placeholder="UDYAM-MH-26-0001234"
                               required>
                    </div>

                    <button class="btn btn-success">Verify</button>
                </form>
            </div>
        </div>

        {{-- RESULT CARD --}}
        @if(isset($udyamData['result']) && ($udyamData['result_code'] ?? 0) == 101)
            <div class="card card-success mt-3">
                <div class="card-header">
                    <h3 class="card-title">UDYAM DETAILS</h3>
                </div>

                <div class="card-body">

                    <p>
                        <strong>UDYAM Number:</strong>
                        {{ $udyamData['result']['udyam_reg_no'] ?? '-' }}
                    </p>

                    <p>
                        <strong>Enterprise Name:</strong>
                        {{ $udyamData['result']['profile']['enterprise_name'] ?? '-' }}
                    </p>

                    <p>
                        <strong>Enterprise Type:</strong>
                        {{ $udyamData['result']['profile']['enterprise_type'] ?? '-' }}
                    </p>

                    <p>
                        <strong>UDYAM Category:</strong>
                        {{ $udyamData['result']['udyam_category'] ?? '-' }}
                    </p>

                    <p>
                        <strong>Date of Registration:</strong>
                        {{ $udyamData['result']['date_of_reg'] ?? '-' }}
                    </p>

                    <p>
                        <strong>Gender:</strong>
                        {{ $udyamData['result']['gender'] ?? '-' }}
                    </p>

                    <p>
                        <strong>Date of Birth:</strong>
                        {{ $udyamData['result']['dob'] ?? '-' }}
                    </p>

                    <p>
                        <strong>District Industries Center:</strong>
                        {{ $udyamData['result']['district_industries_center'] ?? '-' }}
                    </p>

                    <hr>

                    <p>
                        <strong>State:</strong>
                        {{ $udyamData['result']['official_address']['state'] ?? '-' }}
                    </p>

                    <p>
                        <strong>District:</strong>
                        {{ $udyamData['result']['official_address']['district'] ?? '-' }}
                    </p>

                    <p>
                        <strong>Pincode:</strong>
                        {{ $udyamData['result']['official_address']['pincode'] ?? '-' }}
                    </p>

                </div>
            </div>
        @endif

    </div>
</div>
@stop
