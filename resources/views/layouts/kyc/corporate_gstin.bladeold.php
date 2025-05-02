@extends('adminlte::page')

@section('title', 'CORPORATE GSTIN')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">CORPORATE GSTIN</h3>
                <a role = "button" class = "btn btn-light float-right" 
                href = "{{ route('kyc.corporate_gstin_apis') }}">GSTIN APIs</a>
            </div>
            <div class="card-body">
                @if($statusCode == '422')
                    <div class="alert alert-danger" role="alert">
                        CORPORATE GSTIN is Invalid 
                  </div>
                @endif
                @if($statusCode == '401' || $statusCode == '404' || null)
                <div class="alert alert-danger" role="alert">
                    Server Error, Please try later
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{route('kyc.corporate_gstin')}}">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">CORPORATE GSTIN NUMBER</label>
                                <input type="text" class="form-control" 
                                   
                                    id="corporate_gstin" name="corporate_gstin" value="{{old('corporate_gstin')}}" 
                                    placeholder="Ex: ABCDE1234N" required>
                                </div>
                                
                                <button type="submit" class="btn btn-success">Verify</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($corporate_gstin) && $corporate_gstin['status_code'] == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">CORPORATE GSTIN Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                        <p>client_id: {{ $corporate_gstin['data']['client_id'] }}</p>
                        <p>business_name: {{ $corporate_gstin['data']['business_name'] }}</p>
                        <p>gstin_status: {{ $corporate_gstin['data']['gstin_status'] }}</p>
                        <p>constitution_of_business: {{ $corporate_gstin['data']['constitution_of_business'] }}</p>
                        <p>state_jurisdiction: {{ $corporate_gstin['data']['state_jurisdiction'] }}</p>
                        <p>center_jurisdiction: {{ $corporate_gstin['data']['center_jurisdiction'] }}</p>
                        <p>date_of_registration: {{ $corporate_gstin['data']['date_of_registration'] }}</p>
                        <p>field_visit_conducted: {{ $corporate_gstin['data']['field_visit_conducted'] }}</p>
                        <p>taxpayer_type: {{ $corporate_gstin['data']['taxpayer_type'] }}</p>
                        <p>date_of_cancellation: {{ $corporate_gstin['data']['date_of_cancellation'] }}</p>
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