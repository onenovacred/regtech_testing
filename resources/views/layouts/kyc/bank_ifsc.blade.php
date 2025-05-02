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
                    @if (isset($statusCode) && $statusCode == 102)
                        <div class="alert alert-danger" role="alert">
                            IFSC CODE is invalid
                        </div>
                    @endif
                    @if (isset($bank_verification_ifsc[0]['bank_verification_api']['code']) &&
                            $bank_verification_ifsc[0]['bank_verification_api']['code'] == '404')
                        <div class="alert alert-danger" role="alert">
                            {{ $bank_verification_ifsc[0]['bank_verification_api']['response'] }}
                        </div>
                    @endif
                    @if (isset($statusCode) && $statusCode == 500)
                        <div class="alert alert-danger" role="alert">
                            Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <form role="form" method="post" action="{{ route('kyc.bank_ifsc') }}">
                                {{ csrf_field() }}
                                @if (isset($bankIfsc_request[1]) && $bankIfsc_request[1] == 'ifsc')
                                    <div class="form-group">
                                        <label for="name">IFSC Code</label>
                                        <input type="text" class="form-control" name="ifsc"
                                            value="{{ old('ifsc') }}" placeholder="Enter IFSC" required>
                                    </div>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                @else
                                    <div class="form-group">
                                        <label for="name">IFSC Code</label>
                                        <input type="text" class="form-control" name="ifsc"
                                            value="{{ old('ifsc') }}" placeholder="Enter IFSC" required>
                                    </div>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                @endif
                             </form>
                        </div>
                    </div>
                </div>
            </div>

            @if (!empty($bank_verification_ifsc) && isset($bank_verification_ifsc[0]['bank_ifsc_verification']['code']) && $bank_verification_ifsc[0]['bank_ifsc_verification']['code'] == 200)
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Bank Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    <p>IFSC: {{ $bank_verification_ifsc[0]['bank_ifsc_verification']['response']['ifsc'] }}
                                    </p>
                                    <p>Bank Name:
                                        {{ $bank_verification_ifsc[0]['bank_ifsc_verification']['response']['name'] }}</p>
                                    <p>code: {{ $bank_verification_ifsc[0]['bank_ifsc_verification']['response']['code'] }}
                                    </p>
                                    <p>Branch:
                                        {{ $bank_verification_ifsc[0]['bank_ifsc_verification']['response']['branch'] }}</p>
                                    <p>Address:
                                        {{ $bank_verification_ifsc[0]['bank_ifsc_verification']['response']['address'] }}</p>
                                    <p>City: {{ $bank_verification_ifsc[0]['bank_ifsc_verification']['response']['city'] }}
                                    </p>
                                    <p>State:
                                        {{ $bank_verification_ifsc[0]['bank_ifsc_verification']['response']['state'] }}</p>
                                    <p>District:
                                        {{ $bank_verification_ifsc[0]['bank_ifsc_verification']['response']['district'] }}
                                    </p>
                                    <p>contact:
                                        {{ $bank_verification_ifsc[0]['bank_ifsc_verification']['response']['contact'] }}
                                    </p>
                                    <p>UPI: {{ $bank_verification_ifsc[0]['bank_ifsc_verification']['response']['upi'] }}
                                    </p>
                                    <p>Rtgs: {{ $bank_verification_ifsc[0]['bank_ifsc_verification']['response']['rtgs'] }}
                                    </p>
                                    <p>neft: {{ $bank_verification_ifsc[0]['bank_ifsc_verification']['response']['neft'] }}
                                    </p>
                                    <p>imps: {{ $bank_verification_ifsc[0]['bank_ifsc_verification']['response']['imps'] }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if (!empty($bank_verification_response) && $bank_verification_response != null)
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Bank Details</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                @if(!empty($bank_verification_response[0]['bank_ifsc_verification']['response']['request_id']))
                                  <p>Request Id: {{ $bank_verification_response[0]['bank_ifsc_verification']['response']['request_id'] }}
                                 </p>
                                @endif
                                @if(!empty($bank_verification_response[0]['bank_ifsc_verification']['response']['ifsc']))
                                   <p>IFSC: {{ $bank_verification_response[0]['bank_ifsc_verification']['response']['ifsc'] }}
                                   </p>
                                @endif
                                @if(!empty($bank_verification_response[0]['bank_ifsc_verification']['response']['name']))
                                <p>Bank Name:
                                    {{ $bank_verification_response[0]['bank_ifsc_verification']['response']['name'] }}</p>
                                @endif
                                @if(!empty($bank_verification_response[0]['bank_ifsc_verification']['response']['code']))
                                  <p>code: {{ $bank_verification_response[0]['bank_ifsc_verification']['response']['code'] }}
                                  </p>
                                @endif
                                @if(!empty($bank_verification_response[0]['bank_ifsc_verification']['response']['branch']))
                                   <p>Branch:
                                    {{ $bank_verification_response[0]['bank_ifsc_verification']['response']['branch'] }}</p>
                                @endif
                                @if(!empty($bank_verification_response[0]['bank_ifsc_verification']['response']['micr']))
                                <p>MICR:
                                    {{ $bank_verification_response[0]['bank_ifsc_verification']['response']['micr'] }}</p>
                                @endif
                                @if(!empty($bank_verification_response[0]['bank_ifsc_verification']['response']['city']))
                                  <p>City:
                                    {{ $bank_verification_response[0]['bank_ifsc_verification']['response']['city'] }}</p>
                                @endif
                                @if(!empty($bank_verification_response[0]['bank_ifsc_verification']['response']['address']))
                                <p>Address:
                                    {{ $bank_verification_response[0]['bank_ifsc_verification']['response']['address'] }}</p>
                                @endif
                                @if(!empty($bank_verification_response[0]['bank_ifsc_verification']['response']['state']))
                                <p>State:
                                    {{ $bank_verification_response[0]['bank_ifsc_verification']['response']['state'] }}</p>
                                @endif
                                @if(!empty($bank_verification_response[0]['bank_ifsc_verification']['response']['district']))
                                  <p>District:
                                    {{ $bank_verification_response[0]['bank_ifsc_verification']['response']['district'] }}
                                  </p>
                                @endif
                                @if(!empty($bank_verification_response[0]['bank_ifsc_verification']['response']['contact']))
                                 <p>Contact:
                                    {{ $bank_verification_response[0]['bank_ifsc_verification']['response']['contact'] }}
                                </p>
                                @endif
                                @if(!empty($bank_verification_response[0]['bank_ifsc_verification']['response']['upi']))
                                <p>UPI: {{ $bank_verification_response[0]['bank_ifsc_verification']['response']['upi'] }}
                                </p>
                               @endif
                               @if(!empty($bank_verification_response[0]['bank_ifsc_verification']['response']['rtgs']))
                                <p>Rtgs: {{ $bank_verification_response[0]['bank_ifsc_verification']['response']['rtgs'] }}
                               </p>
                               @endif
                               @if(!empty($bank_verification_response[0]['bank_ifsc_verification']['response']['neft']))
                                <p>neft: {{ $bank_verification_response[0]['bank_ifsc_verification']['response']['neft'] }}
                                </p>
                               @endif
                               @if(!empty($bank_verification_response[0]['bank_ifsc_verification']['response']['imps']))
                               <p>imps: {{ $bank_verification_response[0]['bank_ifsc_verification']['response']['imps'] }}
                               </p>
                              @endif
                              @if(!empty($bank_verification_response[0]['bank_ifsc_verification']['response']['logo']))
                              <p>Logo: <br>
                                <img src="{{$bank_verification_response[0]['bank_ifsc_verification']['response']['logo']}}" width="150" height="130" alt="no logo"/>
                              </p>
                             @endif
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
