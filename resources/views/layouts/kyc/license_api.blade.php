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
        <p><b> Hitting URL : </b>http://regtechapi.in/api/seachv4</p>
        <b>Request Body : </b><br>
        {<br>   
        "license_number":"UP20 20150000000"<br>
        "dob":"DD/MM/YYYY"<br>
        }<br>
        <b>Success Response : </b><br>
           {<br>
        "data":{<br>
        "license_number": "MH1220180035461",<br>
        "dob": "16-09-1976",<br>
        "name": "RAJESH KUMAR BHASKAR",<br>
        "father_or_husband_name": "SARDAWAL RAM BHASKAR",<br>
        "blood_group": "B+",<br>
        "profile_image": "data:image/png;base64,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",<br>
        "permanent_address": "S N0-45/3 ASTVINAYAK NAGAR  SADGURU SOC DATTA MANDIR CHANDAN NAGAR KHARDI ROAD  PUNE  411014",<br>
        "state": "MAHARASHTRA",<br>
        "district": "PUNE",<br>
        "permanent_zip": 411014,<br>
        "country": "",<br>
        "type": "NA",<br>
        "non_transport_doi": "",<br>
        "non_transport_doe": false,<br>
        "transport_doi": "14-08-2018",<br>
        "transport_doe": "13-08-2021",<br>
        "ola_code": "MH12",<br>
        "cov": "LMV-TR",<br>
        "issue_date": "14-08-2018"<br>
    },<br>
    "status_code": 200,<br>
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