@extends('adminlte::page')

@section('title', 'GSTIN')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">GSTIN Details</h3>
                <a role = "button" class = "btn btn-light float-right" 
                href = "{{ route('kyc.gstin_details_api') }}">GSTIN APIs</a>
            </div>
            <div class="card-body">
                @if(isset($gstin_details['statusCode']) && $gstin_details['statusCode'] == 102)
                    <div class="alert alert-danger" role="alert">
                        Gstin Number is Invalid 
                  </div>
                @endif
                @if(isset($gstin_details['statusCode']) && ($gstin_details['statusCode'] == 202 ))
                <div class="alert alert-danger" role="alert">
                    Server Error, Please try later
                </div>
                @endif
                @if(isset($gstin_details['statusCode']) && $gstin_details['statusCode'] == 500)
                <div class="alert alert-danger" role="alert">
                    Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                </div>
                @endif
                @if(isset($gstin_details['statusCode']) && $gstin_details['statusCode'] == 103)
                <div class="alert alert-danger" role="alert">
                       You are not registered to use this service. Please update your plan.
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{route('kyc.gstin_details')}}">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">GSTIN Number</label>
                                <input type="text" class="form-control" 
                                    id="gstin_details_number" name="gstin_details_number" value="{{old('gstin_details_number')}}" 
                                    placeholder="Ex: ZA121020152012" required>
                                </div>
                                <button type="submit" class="btn btn-success">Verify</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @if(isset($gstin_details['statusCode']) && $gstin_details['statusCode']==200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">GSTIN Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Nature of Business Activities:</strong> @if(isset($gstin_details['data']['Nature of Business Activities'])){{ $gstin_details['data']['Nature of Business Activities'] }}@else '' @endif</p>
                        <p><strong>Dealing in Goods and Services:</strong> @if(isset($gstin_details['data']['Dealing in Goods and Services'])){{ $gstin_details['data']['Dealing in Goods and Services']}}@else '' @endif</p>
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