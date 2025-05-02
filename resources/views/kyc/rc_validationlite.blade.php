@extends('adminlte::page')

@section('title', 'RC Verification Lite')

@section('content_header')
    <style>
        table{
            width:100%;
        }
    
        .data-title{
            background-color:grey;
            color:black;
            height:20px;
            table-layout: fixed;
            -webkit-font-smoothing: antialiased;	
        }
    
    </style>
@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-light">
            <div class="card-header">
                <h3 class="card-title">RC Verification Lite</h3>
                <a role = "button" class = "btn btn-light float-right" 
                href = "{{ route('kyc.rc_api') }}">RC APIs</a>
            </div>
            <div class="card-body">
                @if(isset($rc_validation['statusCode']) && $rc_validation['statusCode'] == '102')
                    <div class="alert alert-danger" role="alert">
                        Invalid RC Number / RC Number in Multiple RTOs. Error Code - 102 
                    </div>
                @endif
                @if(isset($rc_validation['statusCode']) && $rc_validation['statusCode'] == '101')
                    <div class="alert alert-danger" role="alert">
                        RC Number in Multiple RTOs. Error Code - 101
                    </div>
                @endif
                @if(isset($rc_validation['statusCode']) && ($rc_validation['statusCode'] == '404' || $rc_validation['statusCode'] == '400' || $rc_validation['statusCode'] == '401'))
                <div class="alert alert-danger" role="alert">
                    Server Error, Please try later
                </div>
                @endif
                @if(isset($rc_validation['statusCode']) && $rc_validation['statusCode'] == '500')
                <div class="alert alert-danger" role="alert">
                      Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{route('kyc.rc_validationlite')}}">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">RC Number</label>
                                <input type="text" class="form-control"
                                    id="rc_number" name="rc_number" value="{{old('rc_number')}}" 
                                    placeholder="Ex: MH12PQ1234" required>
                                </div>
                                <button type="submit" class="btn btn-success">Verify</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(!empty($rc_validation) && isset($rc_validation[0]['rc_validation']['status_code']))
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">RC Details</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                <h3>Owner Details</h3>
                                <hr>
                                <p><strong>Owner Name: </strong>{{ $rc_validation[0]['rc_validation']['data']['owner_name'] }}</p>
                               

                                <h3>Vehicle Details</h3>
                                <hr>
                                <p><strong>RC Number:</strong> {{ $rc_validation[0]['rc_validation']['data']['rc_number'] }}</p>
                                <p><strong>Registration Date:</strong> {{ $rc_validation[0]['rc_validation']['data']['registration_date'] }}</p>
                                <p><strong>Manufacturing Date:</strong> {{ $rc_validation[0]['rc_validation']['data']['manufacturing_date'] }}</p>
                                <p><strong>Registered At:</strong> {{ $rc_validation[0]['rc_validation']['data']['registered_at'] }}</p>
                                <p><strong>Fuel Type:</strong> {{$rc_validation[0]['rc_validation']['data']['fuel_type']}}</p>
                                <p><strong>Fit Upto:</strong> {{$rc_validation[0]['rc_validation']['data']['fit_up_to']}}</p>
                                <p><strong>Tax Upto:</strong> {{$rc_validation[0]['rc_validation']['data']['tax_upto']}}</p>
            
                                <h3>Insurance</h3>
                                <hr>
                                <p><strong>Insurance Upto:</strong> {{ $rc_validation[0]['rc_validation']['data']['insurance_upto'] }}</p>
                                <hr>
                                <p><strong>rc_number: </strong>{{ $rc_validation[0]['rc_validation']['data']['rc_number' ] }}</p>
                                <p><strong>registration_date: </strong>{{ $rc_validation[0]['rc_validation']['data']['registration_date' ] }}</p>
                                <p><strong>owner_name: </strong>{{ $rc_validation[0]['rc_validation']['data']['owner_name' ] }}</p>
                                <p><strong>vehicle_category:</strong>{{ $rc_validation[0]['rc_validation']['data']['vehicle_category' ] }}</p>
                                <p><strong>fuel_type:</strong>{{ $rc_validation[0]['rc_validation']['data']['fuel_type' ] }}</p>
                                <p><strong>fit_up_to:</strong>{{ $rc_validation[0]['rc_validation']['data']['fit_up_to' ] }}</p>
                                <p><strong>insurance_upto:</strong>{{ $rc_validation[0]['rc_validation']['data']['insurance_upto' ] }}</p>
                                <p><strong>manufacturing_date:</strong>{{ $rc_validation[0]['rc_validation']['data']['manufacturing_date' ] }}</p>
                                <p><strong>registered_at:</strong>{{ $rc_validation[0]['rc_validation']['data']['registered_at' ] }}</p>
                                <p><strong>tax_upto:</strong>{{ $rc_validation[0]['rc_validation']['data']['tax_upto' ] }}</p>
                                <p><strong>pucc_upto:</strong>{{ $rc_validation[0]['rc_validation']['data']['pucc_upto' ] }}</p>
                                <p><strong>rc_status: </strong>{{ $rc_validation[0]['rc_validation']['data']['rc_status' ] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@stop


@section('custom_js')
@stop