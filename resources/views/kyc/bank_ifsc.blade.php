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
                @if(isset($bank_verification_ifsc[0]['bank_verification_api']['code']) && $bank_verification_ifsc[0]['bank_verification_api']['code'] == '102')
                    <div class="alert alert-danger" role="alert">
                        IFSC CODE is invalid
                  </div>
                @endif
                @if(isset($bank_verification_ifsc[0]['bank_verification_api']['code']) && ($bank_verification_ifsc[0]['bank_verification_api']['code'] == '404'))
                <div class="alert alert-danger" role="alert">
                    {{$bank_verification_ifsc[0]['bank_verification_api']['response']}}
                </div>
                @endif
                @if(isset($bank_verification_ifsc[0]['bank_verification_api']['code']) && $bank_verification_ifsc[0]['bank_verification_api']['code'] == '500')
                <div class="alert alert-danger" role="alert">
                    Internal Server Error. Please contact techsupport@docboyz.in. for more details.
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

        @if(!empty($bank_verification_ifsc) && isset($bank_verification_ifsc[0]['bank_verification_api']['code']) && $bank_verification_ifsc[0]['bank_verification_api']['code'] == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Bank Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                        <p>ifsc: {{ $bank_verification_ifsc[0]['bank_verification_api']['response']['ifsc'] }}</p>
                        <p>Bank Name: {{ $bank_verification_ifsc[0]['bank_verification_api']['response']['name'] }}</p>
                        <p>code: {{ $bank_verification_ifsc[0]['bank_verification_api']['response']['code'] }}</p>
                        <p>Branch: {{ $bank_verification_ifsc[0]['bank_verification_api']['response']['branch'] }}</p>
                        <p>Address: {{ $bank_verification_ifsc[0]['bank_verification_api']['response']['address'] }}</p>
                        <p>City: {{ $bank_verification_ifsc[0]['bank_verification_api']['response']['city'] }}</p>
                        <p>State: {{ $bank_verification_ifsc[0]['bank_verification_api']['response']['state'] }}</p>
                        <p>District: {{ $bank_verification_ifsc[0]['bank_verification_api']['response']['district'] }}</p>
                        <p>contact: {{ $bank_verification_ifsc[0]['bank_verification_api']['response']['contact'] }}</p>
                        <p>UPI: {{ $bank_verification_ifsc[0]['bank_verification_api']['response']['upi'] }}</p>
                        <p>Rtgs: {{ $bank_verification_ifsc[0]['bank_verification_api']['response']['rtgs'] }}</p>
                        <p>neft: {{ $bank_verification_ifsc[0]['bank_verification_api']['response']['neft'] }}</p>
                        <p>imps: {{ $bank_verification_ifsc[0]['bank_verification_api']['response']['imps'] }}</p>
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