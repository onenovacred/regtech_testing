@extends('adminlte::page')

@section('title', 'Pancard APIs')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class = "container">
    <div class="row">
      <div class = "col-md-4">
        <span class = "badge badge-dark"><h3>Udhyog Aadhar APIs</h3></span>
      </div>
      <div class = "col-md-6">
        <span class = "badge badge-warning"><h4><u>Udhyog Aadhar</u></h4></span><br>
        <p><b> Hitting URL : </b> http://regtechapi.in/api/udyogaadhaars</p>
        <b>Header : </b><br>
        {<br>   
        "AccessToken":"xxxxxxxxxxxxx"<br>
        }<br>
        <b>Request Body : </b><br>
        {<br>   
        "uamnumber":"MH26E0170657"<br>
        }<br>

        <p><b>Success Response : </b><br>
            [<br>
                &nbsp;&nbsp;{<br>
                "status_code":200<br>
                &nbsp;&nbsp;"response":  {<br>
                &nbsp;&nbsp;"essentials": {<br>
                &nbsp;&nbsp;"uamNumber":"MH26E0170657"<br>
                &nbsp;&nbsp;&nbsp;&nbsp;}<br>
                &nbsp;&nbsp;"essentials": {<br>
                &nbsp;&nbsp;"result": {{
            "uamNumber": "MH26E0170657",
            "nameofEnterprise": "ZAPFIN TEKNOLOGIES PRIVATE LIMITED",
            "majorActivity": "SERVICES",
            "socialCategory": "GENERAL",
            "enterpriseType": "SMALL",
            "dateofCommencement": "09/11/2018",
            "dicName": "PUNE",
            "state": "MAHARASHTRA",
            "appliedDate": "18/09/2019",
            "modifiedDate": "N/A",
            "validTillDate": "30/06/2022.",
            "nic2Digit": "66-OTHER FINANCIAL ACTIVITIES",
            "nic4Digit": "6619-ACTIVITIES AUXILIARY TO FINANCIAL SERVICE ACTIVITIES N.E.C.",
            "nic5DigitCode": "66190-ACTIVITIES AUXILIARY TO FINANCIAL SERVICE ACTIVITIES N.E.C.",
            "status": "ACTIVE"
        }"<br>
                &nbsp;&nbsp;&nbsp;&nbsp;}<br>
               


                &nbsp;&nbsp;}<br>
            ]<br>
        </p>


        <!-- PAN Upload -->
        

       

    </div>

    <!-- <div class = "row">
        <div class = "col-md-4">
            
        </div>
    </div> -->
</div> 
@stop


@section('custom_js')
@stop