@extends('adminlte::page')

@section('title', 'Voter ID APIs')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class = "container">
    <div class="row">
      <div class = "col-md-4">
        <span class = "badge badge-dark"><h3>Voter ID APIs</h3></span>
      </div>
      <div class = "col-md-6">
        <span class = "badge badge-warning"><h4><u>Voter ID Verification</u></h4></span><br>
        <p><b> Hitting URL : </b>http://regtechapi.in/api/voter_validation</p>
        <b>Request Body : </b><br>
        {<br>   
        "voter_number":""<br>
        }<br>
        <b>Success Response :</b><br>
        {<br>
    "data": {<br>
        "relation_type": "F",<br>
        "gender": "M",<br>
        "age": "29",<br>
        "epic_no": "NLN2089555",<br>
        "client_id": "bkpkzGyssQ",<br>
        "dob": "1990-08-31",<br>
        "relation_name": "KALEEN BHAIYA",<br>
        "name": "MUNNA BHAIYA",<br>
        "area": "Mirzapur",<br>
        "state": "Uttar Pradesh",<br>
        "house_no": "Tripathi Haveli"<br>
    },<br>
    "status_code": 200,<br>
    "message": "",<br>
    "success": true<br>
}<br>

        

        <!-- VOTER ID UPLOAD -->
        <span class = "badge badge-warning"><h4><u>Voter ID Upload</u></h4></span><br>
        <p><b> Hitting URL : </b>http://regtechapi.docboyz.in/api/voter_upload</p>
        <b>Request form-data : </b><br>
        file – voter id image file<br>
        <br>-
        <b>Success Response :</b>
        <br>
        <p>
            "{\"data\":  {\"client_id\":  \"ocr_voter_JJqCfxggzTMswegksvdp\",  \"ocr_fields\":  [{\"document_type
            \":  \"voterid_front\",  \"full_name\":  {\"value\":  \"Rajesh\",  \"confidence\":  92.0},  \"age\":  {\" value\":  \"26\",  \"confidence\":  78.0},  \"care_of\":  {\"value\":  \"Saradaval\",  \"confidence\":  9 6.0},  \"dob\":  {\"value\":  \"1800-01-01\",  \"confidence\":  0.0},  \"doc\":  {\"value\":  \"2003-01- 01\",  \"confidence\":  95.0},  \"gender\":  {\"value\":  \"M\",  \"confidence\":  95.0},  \"epic_number\ ":  {\"value\":  \"MTG1947852\",  \"confidence\":  92.0}}]},  \"status_code\":  200,  \"success\":  true,
            \"message\":  null,  \"message_code\":  \"success\"}\n"

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