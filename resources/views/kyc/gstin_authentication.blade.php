@extends('adminlte::page')

@section('title', 'GSTIN Authentication')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">

        {{-- FORM CARD --}}
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">GSTIN AUTHENTICATION</h3>
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
                        {{ $message }}
                    </div>
                @endif

                {{-- FORM --}}
                <form method="post" action="{{ route('kyc.gstin_authentication') }}">
                    @csrf

                    <div class="form-group">
                        <label>GSTIN Number</label>
                        <input type="text"
                               name="gstin"
                               class="form-control"
                               maxlength="15"
                               minlength="15"
                               value="{{ old('gstin') }}"
                               placeholder="Ex: 27AAACR5055K1Z7"
                               required>
                    </div>

                    <button class="btn btn-success">Verify GSTIN</button>
                </form>
            </div>
        </div>

        {{-- RESULT CARD --}}
        @if(isset($statusCode) && $statusCode == 200)
        <div class="card card-success mt-3">
            <div class="card-header">
                <h3 class="card-title">GSTIN DETAILS</h3>
            </div>

            <div class="card-body">

                <p><strong>GSTIN:</strong>
                    {{ $gstData['result']['taxpayerDetails']['gstin'] ?? '-' }}
                </p>

                <p><strong>Legal Name:</strong>
                    {{ $gstData['result']['taxpayerDetails']['lgnm'] ?? '-' }}
                </p>

                <p><strong>Trade Name:</strong>
                    {{ $gstData['result']['taxpayerDetails']['tradeNam'] ?? '-' }}
                </p>

                <p><strong>Status:</strong>
                    {{ $gstData['result']['taxpayerDetails']['sts'] ?? '-' }}
                </p>

                <p><strong>Constitution of Business:</strong>
                    {{ $gstData['result']['taxpayerDetails']['ctb'] ?? '-' }}
                </p>

                <p><strong>Registration Date:</strong>
                    {{ $gstData['result']['taxpayerDetails']['rgdt'] ?? '-' }}
                </p>

                <p><strong>Taxpayer Type:</strong>
                    {{ $gstData['result']['taxpayerDetails']['dty'] ?? '-' }}
                </p>

                <p><strong>Principal Address:</strong>
                    {{ $gstData['result']['taxpayerDetails']['pradr']['adr'] ?? '-' }}
                </p>

            </div>
        </div>
        @endif

    </div>
</div>
@stop
