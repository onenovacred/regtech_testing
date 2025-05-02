@extends('adminlte::page')

@section('title', 'CORPORATE CIN')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">CORPORATE CIN</h3>
                <a role = "button" class = "btn btn-light float-right" 
                href = "{{ route('kyc.corporate_cin_apis') }}">CIN APIs</a>
            </div>
            <div class="card-body">
                @if(isset($statusCode) && $statusCode == '102')
                    <div class="alert alert-danger" role="alert">
                        CORPORATE CIN is Invalid 
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
                        <form role="form" method="post" action="{{route('kyc.corporate_cin')}}">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">CORPORATE CIN Number</label>
                                <input type="text" class="form-control" 
                                    id="corporate_cin" name="id_number" value="{{old('id_number')}}" 
                                    placeholder="Ex: ABCDE1234N" required>
                                </div>
                                
                                <button type="submit" class="btn btn-success">Verify</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($corporate_cin) && $corporate_cin[0]['corporate_cin']['status_code'] == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">CORPORATE CIN Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                        <p>company_class: {{ $corporate_cin[0]['corporate_cin']['data']['company_class'] }}</p>
                        <p>client_id: {{ $corporate_cin[0]['corporate_cin']['data']['client_id'] }}</p>
                        <p>cin_number: {{ $corporate_cin[0]['corporate_cin']['data']['cin_number'] }}</p>
                        <p>zip: {{ $corporate_cin[0]['corporate_cin']['data']['zip'] }}</p>
                        <p>company_address: {{ $corporate_cin[0]['corporate_cin']['data']['company_address'] }}</p>
                        <p>email: {{ $corporate_cin[0]['corporate_cin']['data']['email'] }}</p>
                        <p>incorporation_date: {{ $corporate_cin[0]['corporate_cin']['data']['incorporation_date'] }}</p>
                        
                        <p>director_name: {{ $corporate_cin[0]['corporate_cin']['data']['directors'][0]['director_name'] }}</p>
                        <p>din_number: {{ $corporate_cin[0]['corporate_cin']['data']['directors'][1]['din_number'] }}</p>
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