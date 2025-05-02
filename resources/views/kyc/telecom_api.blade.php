@extends('adminlte::page')

@section('title', 'Telecom APIs')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class = "container">
    <div class="row">
      <div class = "col-md-4">
        <span class = "badge badge-dark"><h3>Telecom APIs</h3></span>
      </div>
      <div class = "col-md-6">
        <span class = "badge badge-warning"><h4><u>Telecom Generate OTP</u></h4></span><br>
        <p><b> Hitting URL : </b> http://regtechapi.in/api/telecom</p>
        <b>Request Method : POST </b><br>
        <b>Request Body : </b><br>
        {<br>   
        "id_number": "9840115789"<br>
        }<br>
        <p><b>Success Response : </b><br>
            
                &nbsp;&nbsp;{<br>
                &nbsp;&nbsp;"data": { <br>
                &nbsp;&nbsp;"client_id": "telecom_FSuewlwSuVZzfBAiEgqq",<br>
                &nbsp;&nbsp;"operator": "vi",<br>
                &nbsp;&nbsp;"otp_sent": "true"<br>
                &nbsp;&nbsp;"if_number": "true"<br>
                &nbsp;&nbsp;},<br>
                &nbsp;&nbsp;"status_code": 200,<br> 
                &nbsp;&nbsp;"message_code": success,<br> 
                &nbsp;&nbsp;"message": "OTP generated",<br>
                &nbsp;&nbsp;"success": "true"<br>
                &nbsp;&nbsp;}<br>
                
        </p>


        <span class = "badge badge-warning"><h4><u>Telecom OTP Submit</u></h4></span><br>
        <p><b> Hitting URL : </b> http://regtechapi.in/api/</p>
        <b>Request Method : POST </b><br>
        <b>Request Body : </b><br>
        {<br>   
        "client_id": "@{{client_id}}",<br>
        "otp": "@{{otp}}"<br>
        }<br>
        <b>Success Response : </b>
        <p class = "px-2">{<br>
            "data": {<br>
            "client_id": "telecom_vKTrdfluunadpDzxocIH",<br>
            "mobile_number": "9404758963",<br>
            "address": "SAPTASUR A-404, D.S.K. VISHWA  TALUKA HAWELI,Vadgaon Budruk,PUNE, DHAYARI, Maharashtra, 411041",<br>
            "city": "DHAYARI",<br>
            "state": "Maharashtra",<br>
            "pin_code": "411041",<br>
            "full_name": "DEVANAND KUMAR",<br>
            "dob": "1966-11-02",<br>
            "parsed_dob": "1966-11-02",<br>
            "user_email": null,<br>
            "operator": "vi",<br>
            "billing_type": "prepaid",<br>
            "alternate_phone": "8745125987",<br>
            "extra_fields": null<br>
        },
        "status_code": 200,<br>
        "success": true,<br>
        "message": "Success",<br>
        "message_code": "success"<br>
        }<p>
        
<br>
 
       


      </div>
      <div class = "col-md">
            <a style = "color: white;"class = "btn btn-primary" onclick="history.back()" role = "button">Back</a>
        </div>

    </div>
</div> 
        
@stop


@section('custom_js')
@stop