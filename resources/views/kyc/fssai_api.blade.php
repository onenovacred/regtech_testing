@extends('adminlte::page')

@section('title', 'FSSAI APIs')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class = "container">
    <div class="row">
      <div class = "col-md-4">
        <span class = "badge badge-dark"><h3>FSSAI APIs</h3></span>
      </div>
      <div class = "col-md-6">
        <span class = "badge badge-warning"><h4><u>FSSAI Validation</u></h4></span><br>
        <p><b> Hitting URL : </b>http://regtechapi.in/api/fssi</p>
        <b>Request Method : POST </b><br>
        <b>Request Body : </b><br>
        {<br>   
        "id_number":"22819015001312"<br>
        }<br>

        <p><b>Success Response : </b><br>
            [<br>
                &nbsp;&nbsp;{<br>
                &nbsp;&nbsp;"fssai_validation": { "data": {<br>
                &nbsp;&nbsp;"client_id": "corporate_fssai_JYzkscgMaYbuxblNynuy",,<br>
                &nbsp;&nbsp;"fssai_number": "22819015001312", <br>
                    
                &nbsp;&nbsp;"Details": <br> { "
                &nbsp;&nbsp;"address": "EXTENTION BUILDING, MANGUSHREE COMPLEX, POST-KHANJANCHAK", <br>
                &nbsp;&nbsp;"license_no": "22819015001312",<br>
                &nbsp;&nbsp;"fbo_id": 8026290, <br>
                &nbsp;&nbsp;"display_ref_id": "30191207152500067", <br>
                &nbsp;&nbsp;"license_category_name": "Registration", <br>
                &nbsp;&nbsp; "state_name": "West Bengal",<br>
                &nbsp;&nbsp;"status_desc": "License Issued", <br>
                &nbsp;&nbsp;"license_category_id": 3, <br>
                &nbsp;&nbsp; "company_name": "SURYODOY ENTERPRISE", <br>
                &nbsp;&nbsp;"license_active_flag": false, <br>
                &nbsp;&nbsp;"ref_id": 105813727, <br>
                &nbsp;&nbsp;"app_type_desc": "New Registration", <br>
                &nbsp;&nbsp;"premise_pincode": 721602 <br>

                &nbsp;&nbsp;"status_code": 200, "success": true, "message": null,<br>
                &nbsp;&nbsp;"message_code": "success"<br>
                &nbsp;&nbsp;},<br>
                &nbsp;&nbsp;"statusCode": null<br>
                &nbsp;&nbsp;}<br>
            ]<br>
        </p>



    },<br>
    "message_code": "success"<br>
}<br>



      </div>
      <div class = "col-md">
            <a style = "color: white;"class = "btn btn-primary" onclick="history.back()" role = "button">Back</a>
        </div>

    </div>
</div> 
        
@stop


@section('custom_js')
@stop