@extends('adminlte::page')

@section('title', 'Regtechapi - UPI Validation')

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
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">UPI Validation</h3>
            </div>
            <div class="card-body">
                @if(isset($statusCode) && $statusCode == '102')
                    <div class="alert alert-danger" role="alert">
                        Please enter valid details
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
                        <form role="form" method="post" action="{{route('kyc.upi_validation')}}">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="name">Name<span style="color:red">*</span></label>
                                <input type="text" class="form-control"
                                id="name" name="name" value=""
                                placeholder="Enter Name" required>
                            </div>
                            <div class="form-group">
                                <label for="name">UPI ID<span style="color:red">*</span></label>
                                <input type="text" class="form-control"
                                id="upi_id" name="upi_id" value=""
                                placeholder="Enter upi id" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Order ID</label>
                                <input type="text" class="form-control"
                                id="order_id" name="order_id" value=""
                                placeholder="Enter order id">
                            </div>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form><br>
                    </div>
                </div>
            </div>
        </div>
        @if(!empty($upidetails['upidetails']) && $upidetails['statusCode'] == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">UPI Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                        <p><b>Order ID:</b> {{$upidetails['upidetails']['response']['orderId']}}</p>
                        <p><b>Name:</b> {{$upidetails['upidetails']['response']['account_details']['beneficiary_name']}}</p>
                        <p><b>UPI Id:</b> {{$upidetails['upidetails']['response']['account_details']['beneficiary_vpa']}}</p>
                        {{-- <p><b>Account Status:</b> {{$upidetails['upidetails']['response']['account_details']['account_status']}}</p> --}}
                        {{-- <!-- <p>PAN Verification: @if(isset($pancard[0]['pancard']['message'][0])) $pancard[0]['pancard']['message'][0] @endif</p> --> --}}
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
