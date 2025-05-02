@extends('layouts.app')

@section('title', 'Consumer Page')


@section('content')
    <div class="container p-5">

        <div class="row">
            <div class="col-md-6 offset-md-3">

                <h3 class="font-weight-bold">Consumer Details</h3>

                    <div class="card">
                        <div class="card-body lead">
                            <form action="{{route('consumer.data')}}" method="POST" id="formSubmitted" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="Name">Name</label>
                                    <input type="text" style="background-color: lightgrey" class="form-control" name="name" id="name" placeholder="Name" value="{{old('name')}}" required>
                                </div>
                                <div class="form-group">
                                <label for="dob">Date Of Birth</label>
                                <input type="date" style="background-color: lightgrey" 
                                    class="form-control" name="dob" id="dob" placeholder="Date of birth"  
                                    value="{{old('dob')}}">
                                </div>
                                <div class="form-group">
                                <label for="user_email">Email</label>
                                <input type="email" style="background-color: lightgrey" 
                                    class="form-control" name="user_email" id="user_email" placeholder="user email"  
                                    value="{{old('email')}}" required >
                                </div>
                                <div class="form-group">
                                <label for="mobileno">Mobile No</label>
                                <input type="text" style="background-color: lightgrey" 
                                    class="form-control" name="mobileno" id="mobileno" 
                                    placeholder="Mobile No" required value="{{old('mobileno')}}">
                                </div>
                                <div class="form-group">
                                <label for="file">Upload pancard</label>
                                <input type="file" style="background-color: lightgrey" 
                                    class="form-control" name="file" id="file" required>
                                </div>
                                <div class="form-group">
                                    <label for="pan_number">PAN Number</label>
                                <input type="text" class="form-control" 
                                    maxlength="10" minlength="10" 
                                    id="pan_number" name="pan_number" value="{{old('pan_number')}}" 
                                    placeholder="Ex: ABCDE1234N" style="background-color: lightgrey" required>
                                </div>
                                <button type="submit" class="btn btn-danger" id="submitForm" name="submitForm">Submit</button>
                            </form>

                        </div>
                    </div>
                    <div style="padding-top: 12px;"></div>
                    @if(!empty($pancard) &&  $pancard[0]['statusCode'] == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">PAN CARD Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                        <p>Full Name: {{ $pancard[0]['pancard']['data']['full_name'] }}</p>
                        <p>PAN no: {{ $pancard[0]['pancard']['data']['pan_number'] }}</p>
                        <p>PAN Verification: {{ $pancard[0]['pancard']['message_code'] }}</p>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div style="padding-top: 12px;"></div>
        @if(!empty($pancards) && $pancards['status_code'] == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Uploaded PAN CARD Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                        <p>PAN Number: {{ $pancards['data']['pan_number'] }}</p>
                        <p>DOB: {{ $pancards['data']['dob'] }}</p>
                        <p>Father Name: {{ $pancards['data']['father_name'] }}</p>
                        <p>Full Name: {{ $pancards['data']['full_name'] }}</p>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
         <div style="padding-top: 12px;"></div>
        @if(!empty($pancard2) && isset($pan_verified)==1)
            <div class = "card card-success">
                <div class = "card-header">
                    <h3 class = "card-title">Uploaded PAN CARD Detailed Information</h3>
                </div>
                <div class = "card-body">
                    <div class="row">
                        <div class="col-md-12">
                          <div>
                            <p>Pan Verified: {{ ($pan_verified==1)? 'Verified' : 'Failed' }}</p>
                            <p>Full Name: {{ $pancard2[0]['pancard']['data']['full_name'] }}</p>
                            <p>PAN no: {{ $pancard2[0]['pancard']['data']['pan_number'] }}</p>
                            <p>PAN Verification: {{ $pancard2[0]['pancard']['message_code'] }}</p>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
                @endif
                <div style="padding-top: 12px;"></div>
                @if(!empty($esign) && $esign['status_code'] == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">eSign Initialize</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                        <p>client_id: {{ $esign['data']['client_id'] }}</p>
                        <p>group_id: {{ $esign['data']['group_id'] }}</p>
                        <!-- <p>token: {{ $esign['data']['token'] }}</p> -->
                        <p>url: <a href="{{ $esign['data']['url'] }}" target="_blank">{{ $esign['data']['url'] }}</a></p>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
            </div>

        </div> <!-- end of row div -->
       
        <!-- Starting of the modal -->
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
        <!-- ending of the modal -->
    </div>  <!-- end of container div -->
  
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript">
    $(document).ready(function() {
            $("#submitForm").click(function(e) {
                e.preventDefault();
                if($("#mobileno").val()=="")
                {
                    alert('Please enter Phone Number');
                }
                // if($("#name").val()=="")
                // {
                //     alert("please enter name");
                // }
                // if($("#user_email").val()=="")
                // {
                //     alert("please enter email");
                // }
                if($("#mobileno").val()!="" && $("#name").val()!="" && $("#user_email").val()!="")
                {
                    var temp2 = new Object;
                    temp2._token = "{{csrf_token()}}";
                    temp2.phone = $("#mobileno").val();
    
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
                else
                {
                    alert('Please fill out all the forms value'); 
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
                               // document.location.href = "consumercreate";
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