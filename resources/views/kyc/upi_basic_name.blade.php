@extends('adminlte::page')

@section('title', 'UPI Basic Verification')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">

        {{-- FORM CARD --}}
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">UPI BASIC + NAME MATCH</h3>
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
                        {{ $errorMessage ?? 'Verification failed' }}
                    </div>
                @endif

                {{-- FORM --}}
             <form method="post" action="{{ route('kyc.upi_basic_name') }}">

                    @csrf

                    <div class="form-group">
                        <label>UPI ID (VPA)</label>
                        <input type="text"
                               name="vpa"
                               class="form-control"
                               value="{{ old('vpa') }}"
                               placeholder="Ex: 9876543210@ybl"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Account Holder Name</label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               value="{{ old('name') }}"
                               placeholder="Ex: Rahul Kumar"
                               required>
                    </div>

                    <button class="btn btn-success">Verify </button>
                </form>
            </div>
        </div>

        {{-- RESULT CARD --}}
       @if(isset($upiData['result']) && ($upiData['result_code'] ?? 0) == 101)

        <div class="card card-success mt-3">
            <div class="card-header">
                <h3 class="card-title">UPI VERIFICATION RESULT</h3>
            </div>

            <div class="card-body">
                <p>
                    <strong>UPI ID:</strong>
                    {{ $upiData['result']['vpa_details']['vpa'] ?? '-' }}
                </p>

                <p>
                    <strong>Account Holder Name:</strong>
                    {{ $upiData['result']['vpa_details']['account_holder_name'] ?? '-' }}
                </p>

                @if(isset($upiData['result']['name_match']))
                    <p>
                        <strong>Name Match:</strong>
                        @if($upiData['result']['name_match'] == true)
                            <span class="badge badge-success">Yes</span>
                        @else
                            <span class="badge badge-danger">No</span>
                        @endif
                    </p>

                    <p>
                        <strong>Name Match Score:</strong>
                        {{ $upiData['result']['name_match_score'] ?? 'N/A' }}
                    </p>
                @else
                    <p class="text-warning">
                        Name match not performed (basic UPI validation)
                    </p>
                @endif
            </div>
        </div>
        @endif

    </div>
</div>
@stop
