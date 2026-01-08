@extends('adminlte::page')

@section('title', 'Mobile Name Lookup')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">

        {{-- FORM CARD --}}
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">MOBILE NAME LOOKUP</h3>
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
        {{ $errorMessage ?? 'Something went wrong' }}
    </div>
@endif


                {{-- FORM --}}
                <form method="post" action="{{ route('kyc.mobilename_info') }}">
                    @csrf

                    <div class="form-group">
                        <label>Mobile Number</label>
                        <input type="text"
                               name="mobile"
                               class="form-control"
                               maxlength="10"
                               minlength="10"
                               value="{{ old('mobile') }}"
                               placeholder="Ex: 9876543210"
                               required>
                    </div>

                    <button class="btn btn-success">Verify</button>
                </form>
            </div>
        </div>

       
        @if(isset($statusCode) && $statusCode == 200)
        <div class="card card-success mt-3">
            <div class="card-header">
                <h3 class="card-title">MOBILE NAME DETAILS</h3>
            </div>
            <div class="card-body">
                <p>
                    <strong>Mobile Linked Name:</strong>
                  {{ $mobilenum['data']['mobile_linked_name'] }}

                </p>
            </div>
        </div>
        @endif

    </div>
</div>
@stop
