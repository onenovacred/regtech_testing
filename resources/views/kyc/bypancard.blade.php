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
                <h3 class="card-title">PAN CARD</h3>
                <a role = "button" class = "btn btn-light float-right" 
                href = "{{ route('kyc.pancard_api') }}">Pan Card APIs</a>
            </div>
            <div class="card-body">
                @if(isset($bypancard_details['statusCode']) && $bypancard_details['statusCode'] == 102)
                    <div class="alert alert-danger" role="alert">
                         Invalid Pancard. Please enter correct pancard number.
                  </div>
                @endif
                @if(isset($bypancard_details['statusCode']) && $bypancard_details['statusCode'] ==103)
                <div class="alert alert-danger" role="alert">
                    You are not registered to use this service. Please update your plan.
                </div>
                @endif
                @if(isset($bypancard_details['statusCode']) && $bypancard_details['statusCode'] ==202)
                <div class="alert alert-danger" role="alert">
                    Server Error please try later.
                </div>
                @endif
                @if(isset($bypancard_details['statusCode']) && $bypancard_details['statusCode'] ==500)
                    <div class="alert alert-danger" role="alert">
                       Internal Server Error.Please contact techsupport@docboyz.in. for more details
                  </div>
                @endif
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{route('kyc.by_pancard')}}">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">PAN Number</label>
                                <input type="text" class="form-control" 
                                    maxlength="10" minlength="10" 
                                    id="pan_number" name="pan_number" value="{{old('pan_number')}}" 
                                    placeholder="Ex: ABCDE1234N" required>
                                </div>
                                <button type="submit" class="btn btn-success">Verify</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @if(!empty($bypancard_details) &&  isset($bypancard_details['statusCode']) && $bypancard_details['statusCode'] == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">PAN CARD Details</h3>
            </div>
            <div class="card-body">
                    <div>
                        <p><strong>GSTIN Number:&nbsp;&nbsp;</strong>
                            @if (!empty($bypancard_details['data']['GSTIN']))
                                {{ $bypancard_details['data']['GSTIN'] }}
                            @else
                                null
                            @endif
                        </p>
                        <p><strong>GSTIN Status:&nbsp;&nbsp;</strong>
                            @if (!empty($bypancard_details['data']['GSTIN_STATUS']))
                                {{ $bypancard_details['data']['GSTIN_STATUS'] }}
                            @else
                                null
                            @endif
                        </p> 
                        <p><strong>STATE:&nbsp;&nbsp;</strong>
                            @if (!empty($bypancard_details['data']['STATE']))
                                {{ $bypancard_details['data']['STATE'] }}
                            @else
                                null
                            @endif
                        </p> 
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