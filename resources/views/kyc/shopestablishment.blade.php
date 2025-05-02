@extends('adminlte::page')

@section('title', 'shop establishment')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">shop establishment</h3>
            </div>
            <div class="card-body">
                @if(isset($statusCode) && $statusCode == '102')
                    <div class="alert alert-danger" role="alert">
                        Shop establishment is Invalid 
                  </div>
                @endif
                @if(isset($statusCode) && ($statusCode == '404' || $statusCode == '400'))
                <div class="alert alert-danger" role="alert">
                    Server Error, Please try later
                </div>
                @endif
                @if(isset($statusCode) && $statusCode == '500')
                <div class="alert alert-danger" role="alert">
                    Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{route('kyc.shopestablishment')}}">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">shop establishment Number</label>
                                <input type="text" class="form-control" 
                                    maxlength="10" minlength="10" 
                                    id="id_number" name="id_number" value="{{old('id_number')}}" 
                                    placeholder="Ex: ABCDE1234N" required>
                                </div>
                                @if(!empty($states) && isset($states['status_code']) && $states['status_code'] == 200)
                                <div class="form-group">
                                    <label>State</label>
                                    <select class="form-control select2" name="state_code" style="width: 100%;" required>
                                      <option selected="selected" disabled>Select State</option>
                                      @foreach($states['data'] as $state)
                                    <option value="{{$state['state_code']}}">{{$state['state']}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                  @endif
                                <button type="submit" class="btn btn-success">Verify</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($shopestablishment))
            @if(isset($shopestablishment['status_code']) && $shopestablishment['status_code'] == 200)
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">shop establishment Details</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                        <div>
                            <p>Client Id: {{ $shopestablishment['data']['client_id'] }}</p>
                            <p>SE Number: {{ $shopestablishment['data']['se_number'] }}</p>
                            <p>State Code: {{ $shopestablishment['data']['state_code'] }}</p>
                            <p>state_name: {{ $shopestablishment['data']['state_name'] }}</p>
                            <p>business_name: {{ $shopestablishment['data']['business_name'] }}</p>
                            <p>address: {{ $shopestablishment['data']['address'] }}</p>
                            <p>user_mobile_number: {{ $shopestablishment['data']['user_mobile_number'] }}</p>
                            <p>registration_number: {{ $shopestablishment['data']['registration_number'] }}</p>
                            <p>registration_date: {{ $shopestablishment['data']['registration_date'] }}</p>
                            <p>category: {{ $shopestablishment['data']['category'] }}</p>
                            <p>certificate_number: {{ $shopestablishment['data']['certificate_number'] }}</p>
                            <p>document_link: {{ $shopestablishment['data']['document_link'] }}</p>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="alert alert-danger" role="alert">
                Internal Server Error. Please contact techsupport@docboyz.in. for more details.
            </div>
            @endif
        @endif
    </div>
</div>
@stop


@section('custom_js')

@stop