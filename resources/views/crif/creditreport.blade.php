@extends('adminlte::page')

@section('title', 'Credit Report')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Credit Score Report</h3>
            </div>
            <div class="card-body">
                @if(isset($statusCode) && $statusCode == '102')
                    <div class="alert alert-danger" role="alert">
                        Please enter valid details.
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
                        <form role="form" method="post" action="{{route('other.crif')}}" id="formSubmitted">
                            {{csrf_field()}}

                                   
                                <div class="form-group">
                                        <label for="name">Full Name</label>
                                                <input type="text" class="form-control" 
                                                    id="fullname" name="fullname"  
                                                    placeholder="Ex: XYZ XYZ" />
                               </div>

                                <div class="form-group">
                                <label for="pan">PAN Card</label>
                                <input type="text" class="form-control" 
                                    id="pan" name="pan" maxlength="10"  
                                    placeholder="Ex: XYZ XYZ" >
                                </div>

                                <div class="form-group">
                                <label for="mno">Mobile Number</label>
                                <input type="text" class="form-control" 
                                    id="mno" name="mno" value="XXXXX" 
                                    placeholder="Ex: XYZ XYZ" >
                                </div>


                                <div class="form-group">
                                <label for="dob">DOB</label>
                                <input type="text" class="form-control" 
                                    id="dob" name="dob" value="2011-12-20" 
                                    placeholder="Ex: XXXX-XX-XX" >
                                </div>


                                <label class = "col-form-label" for = "sex">Gender</label>
                                <div class = "row">

                                    <div class = "form-group px-3">
                                        <input type = "radio" class = "form-check-input" name = "gender" id = "gender" value = "male">
                                        <label for = "male" class = "form-check-label">
                                            Male
                                        </label>
                                    </div>

                                    <div class = "form-group px-3">
                                        <input type = "radio" class = "form-check-input" name = "gender" id = "gender"
                                        value = "female">
                                        <label class = "form-check-label" for = "female">
                                            Female
                                        </label>
                                    </div>
                                </div>

                                <div class = "form-group">
                                        <label for = "zipcode" class = "col-form-label">ZipCode</label>
                                        <input type = "text" class = "form-control" id = "zipcode" name = "zipcode" value = "175024"> 
                                </div>

                                <div class = "form-group">
                                    <label for = "addrline1" class = "col-form-label">Address Line 1
                                    </label>
                                    <input type = "text" value = "Address line 1" class = "form-control" id = "addrline1" name = "addrline1">
                                </div>

                                <div class = "form-group">
                                    <label for = "addrline1" class = "col-form-label">Address Line 2
                                    </label>
                                    <input type = "text" value = "Address line 2" class = "form-control" id = "addrline2" name = "addrline2">
                                </div>

                                <div class = "form-group">
                                    <label for = "city" class = "col-form-label">City</label>
                                    <input type = "text" value = "hyderabad" class = "form-control" id = "city" name = "city">
                                </div>

    

                                <button id="submitForm" type="submit" class="btn btn-success">Verify</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
           <!-- Modal -->
           <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">OTP has been Sent</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <div class="input-group input-group--style-1">
                                    <input type="number" class="form-control" name="otp_code" placeholder="Enter OTP" id="otp_code" required minlength="4" maxlength="4" />
                                    <span class="input-group-addon">
                                        <i class="text-md la la-lock"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <span id="timer"></span>
                    <span id="otp_check" style="display:none">OTP not received ? <a class="btn btn-primary" href="#" id="resent">Resend</a></span>
                    <span><button type="button" class="btn btn-success" id="btnVerify">Verify</button></span>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@if(!empty($reportgenerated) && $reportgenerated['status'] == 'success')
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Details</h3>
    </div>
    <div class="card-body" style="padding-left:0.8rem !important">
        <div class="row">
            <div class="col-md-12">
              <div>
                <p>Unique ID: {{ $reportgenerated['unique_id'] }}</p>
                <p>Customer Ref. No.: {{ $CustRefField }}</p>
                <p>Gender: @if($reportgenerated['data']['request_meta']['gender'] == 'male') Male @elseif($reportgenerated['data']['request_meta']['gender'] == 'female') Female @else {{$reportgenerated['data']['request_meta']['gender']}} @endif</p>
                <p>DOB: {{ $reportgenerated['data']['request_meta']['dob'] }}</p>
                <p>Pan Card: {{ $reportgenerated['data']['request_meta']['pan_card'] }}</p>
                <p>Mobile Number: {{ $reportgenerated['data']['request_meta']['mobile_number'] }}</p>
                <p>Full Name: {{ $reportgenerated['data']['request_meta']['full_name'] }}</p>
                <p>Zip Code: {{ $reportgenerated['data']['request_meta']['home']['zipcode'] }}</p>
                <p>Address Line 1:  {{ $reportgenerated['data']['request_meta']['home']['address']['line1'] }}</p>
                <p>Address Line 2: {{ $reportgenerated['data']['request_meta']['home']['address']['line2'] }}</p>
                <p>City: {{ $reportgenerated['data']['request_meta']['home']['city'] }}</p>
                <p>Credit Report ID: {{ $reportgenerated['data']['crif_report_id'] }}</p>
                <p>Response XML: {!! $reportgenerated['data']['file']['response_xml'] !!}</p>
                <p>HTML Report: {!! $html_report !!}</p>
                
              </div>
            </div>
        </div>
    </div>
</div>
@endif
@stop

@section('custom_js')
<script type="text/javascript">
    $(document).ready(function() {
       
            $("#submitForm").click(function(e) {
                e.preventDefault();
                if($("#mno").val()=="")
                {
                    alert('Please enter Phone Number');
                }
                else
                {
                    var temp2 = new Object;
                    temp2._token = "{{csrf_token()}}";
                    temp2.phone = $("#mno").val();
    
                    var myJSON = JSON.stringify(temp2);
    
                    $.ajax({
                        url: "{{url('/sendotp')}}",
                        type: "post",
                        data: myJSON,
                        contentType: "application/json",
                        processData: false,
                        success: function(response) {
                            if(response.hasOwnProperty('success'))
                            {
                                $("#myModal").modal("show");
                            }
                            else if(response.hasOwnProperty('duplicate'))
                            {
                                alert(response.duplicate);
                            } 
                            else
                            {
                                alert("OTP send failed. Please try later.");
                                return false;
                            }
                        }
                    });
                }
            });
    
    
            $("#btnVerify").click(function(e) {
                e.preventDefault();
                $("#verified").val("0");
                    var temp = new Object;
                    temp._token = "{{csrf_token()}}";
                    temp.otp_code = $("#otp_code").val();
    
                    var myJSON = JSON.stringify(temp);
    
                    $.ajax({
                        url: "{{url('/verifyotp')}}",
                        type: "post",
                        data: myJSON,
                        contentType: "application/json",
                        processData: false,
                        success: function(response) {
                            if(response.hasOwnProperty('success'))
                            {
                                $("#myModal").modal("hide");
                                $("#verified").val("1");
                                $("#formSubmitted").submit();
                            }
                            else
                            {
                                alert("OTP is not match");
                                return false;
                            }
                        }
                    });
            });
        });
        </script>
@stop