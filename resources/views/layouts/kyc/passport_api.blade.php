@extends('adminlte::page')

@section('title', 'Passport APIs')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class = "container">
    <div class="row">
      <div class = "col-md-4">
        <span class = "badge badge-dark"><h3>Passport APIs</h3></span>
      </div>
      <div class = "col-md-6">
        <span class = "badge badge-warning"><h4><u>Passport Create Client</u></h4></span><br>
        <p><b> Hitting URL : </b> http://regtechapi.in/api/pancard</p>
        <b>Request Method : POST </b><br>
        <p><b>Success Response : </b><br>
        &nbsp;&nbsp;{<br>
        &nbsp;&nbsp;"data": {<br>
        &nbsp;&nbsp;"client_id": "takdTqhCxo"<br>
        &nbsp;&nbsp;},<br>
        &nbsp;&nbsp;"status_code": 201,<br>
        &nbsp;&nbsp;"message": "",<br>
        &nbsp;&nbsp;"success": true<br>
        &nbsp;&nbsp;}    <br>
                
        </p>


        <span class = "badge badge-warning"><h4><u>Passport Upload</u></h4></span><br>
        <p><b> Hitting URL : </b> http://regtechapi.docboyz.in/api/</p>
        <b>Request Method : POST </b><br>
        <b>Request Body : </b><br>
        {<br>   
        file – passport image file,<br>
        }<br>
        <b>Success Response : </b>
        <p>
            {<br>
        "data": {<br>
        "doe": "2020-09-15",<br>
        "dob": "1990-08-31",<br>
        "father": "KALEEN BHAIYA",<br>
        "given_name": "MUNNA BHAIYA",<br>
        "mrz_line_1": "PPINDBHAIYA&lt;&lt;MUNNA&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;",<br>
        "old_passport_num": "F0233736",<br>
        "file_num": "UPHM00597710",<br>
        "client_id": "TTJmMxbZQi",<br>
        "place_of_issue": "MIRZAPUR",<br>
        "spouse": "",<br>
        "country_code": "IND",<br>
        "address": "TRIPATHI HAVELI, MIRZAPUR",<br>
        "surname": "BAGGA",<br>
        "mrz_line_2": "J0933933<1IND9008319M2009155<<<<<<<<<<<<<<04",<br>
        "passport_num": "J0933836",<br>
        "doi": "2010-10-15",<br>
        "old_doi": "2005-10-15",<br>
        "gender": "MALE",<br>
        "nationality": "INDIAN",<br>
        "place_of_birth": " MIRZAPUR",<br>
        "mother": "BEENA TRIPATHI",<br>
        "old_place_of_issue": "MIRZAPUR",<br>
        "pin": "231001",<br>
        "verified": null<br>
    },<br>
    "status_code": 200,<br>
    "message": "",<br>
    "success": true<br>
}<br></p>
 
       <span class = "badge badge-warning"><h4><u>Verify Passport</u></h4></span><br>
        <p><b> Hitting URL : </b> http://regtechapi.docboyz.in/api/</p>
        <b>Request Method : POST </b><br>
        {<br>   
        "client_id": "@{{client_id}}",<br>
        }<br>
        
        <p><b>Success Response : </b><br>
         {<br>
    "data": {<br>
        "doe": "2020-09-15",<br>
        "dob": "1990-08-31",<br>
        "father": "KALEEN BHAIYA",<br>
        "given_name": "MUNNA BHAIYA",<br>
        "mrz_line_1": "PPINDBHAIYA&lt;&lt;MUNNA&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;",<br>
        "old_passport_num": "F0233736",<br>
        "file_num": "UPHM00597710",<br>
        "client_id": "TTJmMxbZQi",<br>
        "place_of_issue": "MIRZAPUR",<br>
        "spouse": "",<br>
        "country_code": "IND",<br>
        "address": "TRIPATHI HAVELI, MIRZAPUR",<br>
        "surname": "BAGGA",<br>
        "mrz_line_2": "J0933933<1IND9008319M2009155<<<<<<<<<<<<<<04",<br>
        "passport_num": "J0933836",<br>
        "doi": "2010-10-15",<br>
        "old_doi": "2005-10-15",<br>
        "gender": "MALE",<br>
        "nationality": "INDIAN",<br>
        "place_of_birth": " MIRZAPUR",<br>
        "mother": "BEENA TRIPATHI",<br>
        "old_place_of_issue": "MIRZAPUR",<br>
        "pin": "231001",<br>
        "passport_validity": true<br>
    },<br>
    "status_code": 200,<br>
    "message": "Passport Verified.",<br>
    "success": true<br>
}       
        </p>



      </div>

      <!-- <div class = "col-md-6">
        <span class = "badge badge-warning"><h4><u>Passport Verify</u></h4></span><br>
        <p><b> Hitting URL : </b> http://regtechapi.docboyz.in/api/credit_report</p>
        <b>Request Method : POST </b><br>
        <b>Request Body : </b><br>
        {<br>   
        "id_number":""<br>
        "dob":""<br>
        }<br>

        <p><b>Success Response : </b><br>
            [<br>
                &nbsp;&nbsp;{<br>
                &nbsp;&nbsp;"aadhaar_validation": { "data": {<br>
                &nbsp;&nbsp;"client_id": "aadhaar_validation_aIqubluqVsnmhWcebctf", "age_range": "&nbsp;&nbsp;30-40",<br>
                &nbsp;&nbsp;"aadhaar_number": "868889041183", "state": "Maharashtra",<br>
                &nbsp;&nbsp;"gender": "M", "last_digits": "693", "is_mobile": true, "less_info": false<br>
                &nbsp;&nbsp;},<br>
                &nbsp;&nbsp;"status_code": 200, "success": true, "message": null,<br>
                &nbsp;&nbsp;"message_code": "success"<br>
                &nbsp;&nbsp;},<br>
                &nbsp;&nbsp;"statusCode": null<br>
                &nbsp;&nbsp;}<br> 
            ]<br>
        </p>
    </div>
     -->
      <div class = "col-md">
            <a style = "color: white;"class = "btn btn-primary" onclick="history.back()" role = "button">Back</a>
        </div>

    </div>
</div> 
        
@stop


@section('custom_js')
@stop