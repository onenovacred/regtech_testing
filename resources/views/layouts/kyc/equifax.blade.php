@extends('adminlte::page')

@section('title', 'Equifax')

@section('content_header')

@stop
<link href="https://codeseven.github.io/toastr/build/toastr.min.css" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">
<style type="text/css">
    	
    .bootstrap-select.btn-group .dropdown-menu li a {
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }
    .dropdown-menu>.active>a, .dropdown-menu>.active>a:hover, .dropdown-menu>.active>a:focus {
        color: #fff;
        text-decoration: none;
        background-color: #428bca;
        outline: 0;
    }
    .dropdown-menu>li>a {
        display: block;
        padding: 3px 20px;
        clear: both;
        font-weight: 400;
        line-height: 1.42857143;
        color: #333;
        white-space: nowrap;
    }
    .multiselect, .bs-select-all, .bs-deselect-all{
        border: 1px solid #ced4da !important;
    }
    
</style>

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Ecredit API</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{route('other.equifax')}}" id="formSubmitted">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">First Name</label>
                                    <input type="text" class="form-control" name="fname" id = "fname" placeholder = "Enter First Name" value="VIJAY"   autofocus required>
                                </div>

                                <div class="form-group">
                                    <label for="name">Last Name</label>
                                    <input type="text" class="form-control" name="lname" id = "lname" placeholder = "Enter Last Name" 
                                    value="MEHTA" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="name">Phone Number</label>
                                    <input type="text" class="form-control" name="phone_number" 
                                    id = "phone_number" placeholder = "Enter phone number" 
                                    value="7830645084" required>
                                </div>

                                <div class="form-group">
                                    <label for="name">Date of Birth (DOB)</label>
                                    <input type="text" class="form-control" id="dob" name="dob" value="{{old('dob')}}" placeholder="YYYY-MM-DD" required>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
										<label for="" ><strong>Select ID Type</strong></label>
        							</div>
									<select name="id_type[]" id="id_type" class="form-control selectpicker multiselect" data-live-search="true" data-actions-box="true" multiple>
									    <option value="" selected >Select ID Type</option>
                                      		
                   					</select>
        						</div>
                                <div class="row checkAllCheckBox" style="display: none">
                                    <div class="col-md-3">
                                        <label class="ui-check m-a-0">
                                            <input id="checkAllRadius" type="checkbox" class=""><i></i> Check All
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="form-group" id="aadhar_no">
                                    <label for="name">Aadhar Card Number</label>
                                    <input type="text" class="form-control" name="aadhar_num" 
                                    id = "aadhar_num" placeholder = "Enter aadhar card number" 
                                    value = "" required>
                                </div>

                                <div class="form-group" id="pan_no">
                                    <label for="name">PAN Card Number</label>
                                    <input type="text" class="form-control" name="pan_num" 
                                    id = "pan_num" placeholder = "Enter pan card number" 
                                    value = "" required>
                                </div>

                                <div class="form-group" id="driving_licence">
                                    <label for="name">Driving Licence Number</label>
                                    <input type="text" class="form-control" name="driving_num" 
                                    id = "driving_num" placeholder = "Enter driving licence number" 
                                    value = "" required>
                                </div>

                                <div class="form-group" id="voter_id">
                                    <label for="name">Voter ID</label>
                                    <input type="text" class="form-control" name="voter_num" 
                                    id = "voter_num" placeholder = "Enter voter id" 
                                    value = "" required>
                                </div>

                                <div class="form-group" id="passport">
                                    <label for="name">Passport Number</label>
                                    <input type="text" class="form-control" name="passport_num" 
                                    id = "passport_num" placeholder = "Enter passport number" 
                                    value = "" required>
                                </div>
                                
                                <button type="submit" id = "submitForm" class="btn btn-success offset-md-4">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

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

        @if(!empty($equifax) && $equifax['InquiryResponseHeader']['SuccessCode'] == 0)
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">Ecredit Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <p>{{ $equifax['Error']['ErrorCode'] }}</p>
                            <p>{{ $equifax['Error']['ErrorDesc'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if(!empty($equifax) && $equifax['InquiryResponseHeader']['SuccessCode'] == 1 && $isFound == 0)
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">Consumer Details Not Found in Bereau</h3>
            </div>
        </div>
        @endif   
   

    </div>
</div>
@stop


@section('custom_js')
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script> 

<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>

<script type="text/javascript">
    
    $(document).ready(function() {
        $('.selectpicker').selectpicker();
        $('#aadhar_no').hide();
        $('#pan_no').hide();
        $('#driving_licence').hide();
        $('#voter_id').hide();
        $('#passport').hide();
        $('#id_type').change(function(){
			var data = $(this).val();
            $('#aadhar_no').hide();
            $('#pan_no').hide();
            $('#driving_licence').hide();
            $('#voter_id').hide();
            $('#passport').hide();
            
            for(var i=0;i<data.length;i++){
                
                if(data[i] == "M") {
                	$('#aadhar_no').show();
                }
                if(data[i] == "T"){
                    $('#pan_no').show();
                }
                if(data[i] == "DL"){
                    $('#driving_licence').show();
                }
                if(data[i] == "V"){
                    $('#voter_id').show();
                }
                if(data[i] == "P"){
                    $('#passport').show();
                }
            }
		});

            var formdata1 = ""; 
            $.ajax({
                type: 'get',
                url: '{!! route('idtypes') !!}',
                data: formdata1,
                datatype:'json',
                success: function(data)
                {
                    $('#id_type').empty(); 
                    jQuery.noConflict();
                    jQuery('#id_type').selectpicker('refresh');
                    for(var i=0;i<data.length;i++)
                    {
                        // alert(data[i]);
                        $('#id_type').append("<option value='"+data[i]['value']+"'>"+data[i]['name']+"</option>");
                    }
                    jQuery('#id_type').selectpicker('refresh');
                },
                error: function (error) {
                    // console.log(error);
                }
            }); 

            $("#submitForm").click(function(e) {
                e.preventDefault();
                if($("#phone_number").val()=="")
                {
                    alert('Please enter Phone Number');
                }
                else
                {
                    var temp2 = new Object;
                    temp2._token = "{{csrf_token()}}";
                    temp2.phone = $("#phone_number").val();
    
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
    
            // $("#resent").click(function(e) {
            //     var resend = new Object;
            //         resend._token = "{{csrf_token()}}";
            //         resend.phone = $("#phone").val();
    
            //         var newOtp = JSON.stringify(resend);
            //                 e.preventDefault();
    
            //             $.ajax({
            //                 url: "{{url('/sendotp')}}",
            //                 type: "POST",
            //                 data: newOtp,
            //                 contentType: "application/json",
            //                 processData: false,
            //             });
                         
            //     });
    
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