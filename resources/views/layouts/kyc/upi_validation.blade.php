@extends('adminlte::page')

@section('title', 'Regtechapi - UPI Validation')

@section('content_header')
    <style>
        table {
            width: 100%;
        }

        .data-title {
            background-color: grey;
            color: black;
            height: 20px;
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
                    @if (isset($statusCode) && $statusCode == '102')
                        <div class="alert alert-danger" role="alert">
                            Please enter valid details
                        </div>
                    @endif
                    @if (isset($statusCode) && ($statusCode == '404' || $statusCode == '400'))
                        <div class="alert alert-danger" role="alert">
                            Server Error, Please try later
                        </div>
                    @endif
                    @if (isset($statusCode) && $statusCode == '500')
                        <div class="alert alert-danger" role="alert">
                            Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <form role="form" method="post" action="{{ route('kyc.upi_validation') }}">
                                {{ csrf_field() }}
                                @if (isset($upiRequest[1]) && $upiRequest[1] == 'name' && empty($upiRequest[2]))
                                  
                                    <div class="form-group">
                                        <label for="name">Name<span style="color:red">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="" placeholder="Enter Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">UPI ID<span style="color:red">*</span></label>
                                        <input type="text" class="form-control" id="upi_id" name="upi_id"
                                            value="" placeholder="Enter upi id" required>
                                    </div>
                                    <div class="form-group">
                                        {{-- <label for="name">Order ID</label> --}}
                                        <input type="hidden" class="form-control" id="order_id" name="order_id"
                                            value="" placeholder="Enter order id">
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                @elseif(isset($upiRequest[1]) && $upiRequest[1] == 'upi_id' && empty($upiRequest[2]))
                                   
                                    <div class="form-group">
                                        <label for="name">Name<span style="color:red">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="" placeholder="Enter Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">UPI ID<span style="color:red">*</span></label>
                                        <input type="text" class="form-control" id="upi_id" name="upi_id"
                                            value="" placeholder="Enter upi id" required>
                                    </div>
                                    <div class="form-group">
                                        {{-- <label for="name">Order ID</label> --}}
                                        <input type="hidden" class="form-control" id="order_id" name="order_id"
                                            value="" placeholder="Enter order id">
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                @elseif(isset($upiRequest[1]) && $upiRequest[1] == 'order_id' && empty($upiRequest[2]))
                                    <div class="form-group">
                                        <label for="name">Name<span style="color:red">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="" placeholder="Enter Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">UPI ID<span style="color:red">*</span></label>
                                        <input type="text" class="form-control" id="upi_id" name="upi_id"
                                            value="" placeholder="Enter upi id" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Order ID</label>
                                        <input type="text" class="form-control" id="order_id" name="order_id"
                                            value="" placeholder="Enter order id">
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                @elseif(
                                    (isset($upiRequest[1]) && $upiRequest[1] == 'name') ||
                                        (isset($upiRequest[2]) && $upiRequest[2] == 'upi_id') ||
                                        (isset($upiRequest[3]) && $upiRequest[3] == 'order_id'))
                                       
                                    <div class="form-group">
                                        <label for="name">Name<span style="color:red">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="" placeholder="Enter Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">UPI ID<span style="color:red">*</span></label>
                                        <input type="text" class="form-control" id="upi_id" name="upi_id"
                                            value="" placeholder="Enter upi id" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Order ID</label>
                                        <input type="text" class="form-control" id="order_id" name="order_id"
                                            value="" placeholder="Enter order id">
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                @else
                                    <div class="form-group">
                                        <label for="name">Name<span style="color:red">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="" placeholder="Enter Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">UPI ID<span style="color:red">*</span></label>
                                        <input type="text" class="form-control" id="upi_id" name="upi_id"
                                            value="" placeholder="Enter upi id" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Order ID</label>
                                        <input type="text" class="form-control" id="order_id" name="order_id"
                                            value="" placeholder="Enter order id">
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                @endif

                            </form><br>
                        </div>
                    </div>
                </div>
            </div>
            @if (!empty($upidetails['upidetails']) && $upidetails['statusCode'] == 200)
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">UPI Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    <p><b>Order ID:</b> {{ $upidetails['upidetails']['response']['orderId'] }}</p>
                                    <p><b>Name:</b>
                                        {{ $upidetails['upidetails']['response']['account_details']['beneficiary_name'] }}
                                    </p>
                                    <p><b>UPI Id:</b>
                                        {{ $upidetails['upidetails']['response']['account_details']['beneficiary_vpa'] }}
                                    </p>
                                    <p><b>Account Status:</b>
                                        {{ $upidetails['upidetails']['response']['account_details']['account_status'] }}</p>
            
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if(isset($upidetails_response) && $upidetails_response != null)
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">UPI Details</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                @if(!empty($upidetails_response['upidetails']['response']['orderId']))
                                   <p><b>Order ID:</b> {{$upidetails_response['upidetails']['response']['orderId'] }}</p>
                                @else
                                @endif
                                @if(!empty($upidetails_response['upidetails']['response']['account_details']['account_status']))
                                <p><b>Account Status:</b>
                                    {{ $upidetails_response['upidetails']['response']['account_details']['account_status'] }}
                                </p>
                                @else
                                @endif
                                @if(!empty($upidetails_response['upidetails']['response']['account_details']['beneficiary_name']))
                                <p><b>Name:</b>
                                    {{ $upidetails_response['upidetails']['response']['account_details']['beneficiary_name'] }}
                                </p>
                                @else
                                @endif
                                @if(!empty($upidetails_response['upidetails']['response']['account_details']['beneficiary_vpa']))
                                 <p><b>UPI Id:</b>
                                    {{$upidetails_response['upidetails']['response']['account_details']['beneficiary_vpa'] }}
                                  </p>
                                @else
                                @endif
                                @if(!empty($upidetails_response['upidetails']['response']['mode']))
                                  <p><b>Mode:</b>
                                    {{$upidetails_response['upidetails']['response']['mode'] }}
                                  </p>
                                 @else
                                @endif
                                @if(!empty($upidetails_response['upidetails']['response']['utr']))
                                <p><b>UTR:</b>
                                    {{$upidetails_response['upidetails']['response']['utr'] }}
                                  </p>
                                @else
                                @endif
                                @if(!empty($upidetails_response['upidetails']['response']['commission']))
                                <p><b>Commission:</b>
                                    {{$upidetails_response['upidetails']['response']['commission'] }}
                                  </p>
                                @else
                                @endif
                                @if(!empty($upidetails_response['upidetails']['response']['charge']))
                                <p><b>Charge:</b>
                                    {{$upidetails_response['upidetails']['response']['charge'] }}
                                  </p>
                                @else
                                @endif
                                @if(!empty($upidetails_response['upidetails']['response']['tax']))
                                <p><b>Tax:</b>
                                    {{$upidetails_response['upidetails']['response']['tax'] }}
                                  </p>
                                @else
                                @endif
                                @if(!empty($upidetails_response['upidetails']['response']['created_at']))
                                <p><b>Created At:</b>
                                    {{$upidetails_response['upidetails']['response']['created_at'] }}
                                  </p>
                                @else
                                @endif
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
