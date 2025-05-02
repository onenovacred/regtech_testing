@extends('adminlte::page')

@section('title', 'Verify IFSC')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">IFSC Verified</h3>
            </div>
            <div class="card-body">
                @if($statusCode == '422')
                    <div class="alert alert-danger" role="alert">
                        IFSC CODE is invalid
                  </div>
                @endif
                @if($statusCode == '401' || $statusCode == '404' || $statusCode == '500' || null)
                <div class="alert alert-danger" role="alert">
                    Error: {{ $statusCode }} Server Error, Please try later
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{route('kyc.bank_ifsc')}}">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">IFSC Code</label>
                                <input type="text" class="form-control" 
                                    name="ifsc" value="{{old('ifsc')}}" 
                                    placeholder="Enter IFSC" required>
                                </div>
                                <button type="submit" class="btn btn-success">Verify</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($bank_verification_ifsc) && $bank_verification_ifsc['status_code'] == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Bank Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                        <p>Client ID: {{ $bank_verification_ifsc['data']['client_id'] }}</p>
                        <p>ifsc: {{ $bank_verification_ifsc['data']['ifsc'] }}</p>
                        <p>Bank Name: {{ $bank_verification_ifsc['data']['ifsc_data']['bank_name'] }}</p>
                        <p>centre: {{ $bank_verification_ifsc['data']['ifsc_data']['centre'] }}</p>
                        <p>Branch: {{ $bank_verification_ifsc['data']['ifsc_data']['branch'] }}</p>
                        <p>Address: {{ $bank_verification_ifsc['data']['ifsc_data']['address'] }}</p>
                        <p>State: {{ $bank_verification_ifsc['data']['ifsc_data']['state'] }}</p>
                        <p>contact: {{ $bank_verification_ifsc['data']['ifsc_data']['contact'] }}</p>
                        <p>UPI: {{ $bank_verification_ifsc['data']['ifsc_data']['upi'] }}</p>
                        <p>Rtgs: {{ $bank_verification_ifsc['data']['ifsc_data']['rtgs'] }}</p>
                        <p>City: {{ $bank_verification_ifsc['data']['ifsc_data']['city'] }}</p>
                        <p>District: {{ $bank_verification_ifsc['data']['ifsc_data']['district'] }}</p>
                        <p>neft: {{ $bank_verification_ifsc['data']['ifsc_data']['neft'] }}</p>
                        <p>imps: {{ $bank_verification_ifsc['data']['ifsc_data']['imps'] }}</p>
                        <p>bank: {{ $bank_verification_ifsc['data']['ifsc_data']['bank_code'] }}</p>
                        <p>IFSC: {{ $bank_verification_ifsc['data']['ifsc_data']['ifsc'] }}</p>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@stop


@section('custom_js')

@stop