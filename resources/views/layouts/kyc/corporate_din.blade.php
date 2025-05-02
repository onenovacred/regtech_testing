@extends('adminlte::page')

@section('title', 'CORPORATE DIN')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">CORPORATE DIN</h3>
                <a role = "button" class = "btn btn-light float-right" 
                href = "{{ route('kyc.corporate_din_apis') }}">DIN APIs</a>
            </div>
            <div class="card-body">
                @if(isset($statusCode) && $statusCode == '102')
                    <div class="alert alert-danger" role="alert">
                        CORPORATE DIN is Invalid 
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
                        <form role="form" method="post" action="{{route('kyc.corporate_din')}}">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">CORPORATE DIN NUMBER</label>
                                <input type="text" class="form-control" 
                                    maxlength="8" minlength="8" 
                                    id="corporate_din" name="corporate_din" value="{{old('corporate_din')}}" 
                                    placeholder="Ex: ABCDE1234N" required>
                                </div>
                                <!-- <div class="form-group">
                                    <label>Companies Associated</label>
                                    <select class="custom-select" name="companies_associated">
                                      <option value="true">Yes</option>
                                      <option value="false" selected>No</option>
                                    </select>
                                  </div> -->
                                <button type="submit" class="btn btn-success">Verify</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($corporate_din) && $corporate_din['status_code'] == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">CORPORATE DIN Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                        <p>present_address: {{ $corporate_din['data']['present_address'] }}</p>
                        <p>nationality: {{ $corporate_din['data']['nationality'] }}</p>
                        <p>client_id: {{ $corporate_din['data']['client_id'] }}</p>
                        <p>father_name: {{ $corporate_din['data']['father_name'] }}</p>
                        <p>email: {{ $corporate_din['data']['email'] }}</p>
                        <p>permanent_address: {{ $corporate_din['data']['permanent_address'] }}</p>
                        <p>full_name: {{ $corporate_din['data']['full_name'] }}</p>
                        <p>dob: {{ $corporate_din['data']['dob'] }}</p>
                        <p>din_number: {{ $corporate_din['data']['din_number'] }}</p>

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