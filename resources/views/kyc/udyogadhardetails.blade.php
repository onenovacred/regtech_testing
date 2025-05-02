@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Udhyog Aadhaar Number Search.</h3>
                <a role = "button" class = "btn btn-light float-right" 
                href = "{{ route('kyc.udyamadhar_api') }}">Udhyog Aadhaar APIs</a>
            </div>
            <div class="card-body">
                @if(isset($udyamcard['statusCode']) && $udyamcard['statusCode'] == '102')
                    <div class="alert alert-danger" role="alert">
                        Udyam Number is Invalid 
                  </div>
                @endif
                @if(isset($udyamcard['statusCode']) && ($udyamcard['statusCode'] == '404'))
                <div class="alert alert-danger" role="alert">
                    Server Error. Please try again later.
                </div>
                @endif
                @if(isset($udyamcard['statusCode']) && $udyamcard['statusCode'] == '500') <!--$pancard[0]['pancard']['code']-->
                    <div class="alert alert-danger" role="alert">
                        Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                  </div>
                @endif
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{route('kyc.udyog.details')}}">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">UAN Number</label>
                                <input type="text" class="form-control" 
                                    maxlength="20" minlength="10" 
                                    id="udyogadhar_number" name="udyogadhar_number" value="{{old('udyogadhar_number')}}" 
                                    placeholder="Ex: ABCDE1234N" required>
                                </div>
                                <button type="submit" class="btn btn-success">Verify</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($udyamcard) &&  isset($udyamcard['statusCode']) && $udyamcard['statusCode'] == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Udhyog Aadhaar Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                      <p><strong>Full Name:</strong> {{ $udyamcard['response']['result']['uamNumber'] }}</p>
                        <p><strong>Name of Enterprise: </strong>{{ $udyamcard['response']['result']['nameofEnterprise'] }}</p>
                        <p><strong>Major Activity: </strong>{{ $udyamcard['response']['result']['majorActivity'] }}</p>
                        <p><strong>Social Category: </strong>{{$udyamcard['response']['result']['socialCategory'] }}</p>
                        <p><strong>Enterprise Type: </strong>{{ $udyamcard['response']['result']['enterpriseType'] }}</p>
                        <p><strong>Date of Commencement: </strong>{{ $udyamcard['response']['result']['dateofCommencement'] }}</p>
                        <p><strong>Dic Name: </strong>{{ $udyamcard['response']['result']['dicName'] }}</p>
                        <p><strong>State: </strong>{{ $udyamcard['response']['result']['state'] }}</p>
                        <p><strong>AppliedDate: </strong>{{ $udyamcard['response']['result']['appliedDate'] }}</p>
                        <p><strong>Modified Date: </strong>{{ $udyamcard['response']['result']['modifiedDate'] }}</p>
                        <p><strong>ValidTill Date: </strong>{{ $udyamcard['response']['result']['validTillDate'] }}</p>
                        <p><strong>Nic2Digit: </strong>{{ $udyamcard['response']['result']['nic2Digit'] }}</p>
                        <p><strong>nic4Digit: </strong>{{ $udyamcard['response']['result']['nic4Digit'] }}</p>
                        <p><strong>nic5DigitCode: </strong>{{ $udyamcard['response']['result']['nic5DigitCode'] }}</p>
                        <p><strong>Status: </strong>{{ $udyamcard['response']['result']['status'] }}</p> 
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