@extends('adminlte::page')

@section('title', 'DL APIs')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class = "container">
    <div class="row">
      <div class = "col-md-4">
        <span class = "badge badge-dark"><h3>Driving License APIs</h3></span>
      </div>
      <div class = "col-md-6">
        <span class = "badge badge-warning"><h4><u>DL Verification</u></h4></span><br>
        <p><b> Hitting URL : </b> http://regtechapi.in/api/license_validation</p>
        <b>Request Body : </b><br>
        {<br>   
        "license_number":"UP20 20150000000"<br>
        "dob":"DD/MM/YYYY"<br>
        }<br>
        <b>Success Response : </b><br>
            {<br>
    "data": {<br>
        "temporary_address": "TRIPATHI HAVELI, MIRZAPUR",<br>
        "father_or_husband_name": "KALEEN BHAIYA",<br>
        "doe": "2032-07-23",<br>
        "temporary_zip": "231001",<br>
        "permanent_address": "TRIPATHI HAVELI, MIRZAPUR",<br>
        "doi": "2012-07-24",<br>
        "client_id": "dIysSjHnIG",<br>
        "citizenship": "IND",<br>
        "dob": "1990-08-31",<br>
        "permanent_zip": "231001",<br>
        "gender": "Male",<br>
        "license_number": "UP20 20150000000",<br>
        "name": "MUNNA BHAIYA",<br>
        "state": "UP",<br>
        "ola_name": "DISTRICT TRANSPORT OFFICE, MIRZAPUR",<br>
        "ola_code": "UP20"<br>
    },<br>
    "status_code": 200,<br>
    "message": "",<br>
    "success": true<br>
}<br>
        


        <!-- DL Upload -->
        <span class = "badge badge-warning"><h4><u>DL Upload</u></h4></span><br>
        <p><b> Hitting URL : </b>http://regtechapi.docboyz.in/api/driving_upload</p>
        <br>
        <b>Request form-data : </b><br>
        front – driving license front image file<br>
        back - driving license back image file<br>
        <br>
        <b>Success Response :</b>
        <br>
        <p>
            "{\"data\":  {\"document_type\":  null,  \"license_number\":  {\"value\":  \"MH13  20100006214\",  \"con fidence\":  80.0},  \"dob\":  {\"value\":  \"1991-07-
            04\",  \"confidence\":  90.0},  \"image_url\":  null},  \"status_code\":  200,  \"success\":  true,  \"mes sage\":  null,  \"message_code\":  \"success\"}\n"

        </p>
      </div>
      <div class = "col-md">
            <a style = "color: white;"class = "btn btn-primary" onclick="history.back()" role = "button">Back</a>
        </div>

    </div>

    <!-- <div class = "row">
        <div class = "col-md-4">
            
        </div>
    </div> -->
</div> 
@stop


@section('custom_js')
@stop