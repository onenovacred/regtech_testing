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
                <h3 class="card-title">Pin Code</h3>
                <a role = "button" class="btn btn-light float-right" 
                href = "{{ route('kyc.pincode_api') }}">Pin Code APIs</a>
            </div>
            <div class="card-body">
                @if(isset($pincode_details['statusCode']) && $pincode_details['statusCode'] == 102)
                    <div class="alert alert-danger" role="alert">
                        Invalid from pincode and to pincode.Please enter correct from pincode and to pincode.
                    </div>
                @endif
                @if(isset($pincode_details['statusCode'])&& $pincode_details['statusCode'] ==202)
                  <div class="alert alert-danger" role="alert">
                          Server Error Please try later.
                   </div>
                @endif
               
                @if(isset($pincode_details['statusCode']) && ($pincode_details['statusCode'] ==103))
                <div class="alert alert-danger" role="alert">
                        You are not registered to use this service. Please update your plan.
                </div>
                @endif
                @if(isset($pincode_details['statusCode']) && $pincode_details['statusCode'] ==500)
                    <div class="alert alert-danger" role="alert">
                        Internal Server Error.Please contact techsupport@docboyz.in. for more details
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{route('kyc.pincode')}}">
                            {{csrf_field()}}
                                <div class="form-group">
                                 <label for="name">From Pincode</label>
                                  <input type="text" class="form-control" 
                                    id="from_pincode" name="from_pincode" value="{{old('from_pincode')}}" 
                                    placeholder="Ex: 410006" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">To Pincode</label>
                                     <input type="text" class="form-control" 
                                       id="to_pincode" name="to_pincode" value="{{old('to_pincode')}}" 
                                       placeholder="Ex: 450908" required>
                                </div>
                                <button type="submit" class="btn btn-success">Verify</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(isset($pincode_details['statusCode']) && $pincode_details['statusCode'] == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Pincode Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                        <p><strong>fromPinCode:</strong> {{ isset($pincode_details['data']['fromPin'])?$pincode_details['data']['fromPin']:'null' }}</p>
                        <p><strong>toPinCode: </strong>{{ isset($pincode_details['data']['toPin'])?$pincode_details['data']['toPin']:'null'}}</p>
                        <p><strong>Distance: </strong>{{ isset($pincode_details['data']['distance'])?$pincode_details['data']['distance']:'null' }}</p>
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