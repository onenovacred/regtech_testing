@extends('adminlte::page')

@section('title', 'Pancard APIs')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class = "container">
    <div class="row">
      <div class = "col-md-4">
        <span class = "badge badge-dark"><h3>Pan Card APIs</h3></span>
      </div>
      <div class = "col-md-6">
        <span class = "badge badge-warning"><h4><u>PAN Info</u></h4></span><br>
        <p><b> Hitting URL : </b>http://regtechapi.in/api/pancard_new_details</p>
        <b>Header : </b><br>
        {<br>   
        "AccessToken":"xxxxxxxxxxxxx"<br>
        }<br>
        <b>Request Body : </b><br>
        {<br>   
        "pan_no":"HUHPS7607K"<br>
        }<br>

        <p><b>Success Response : </b><br>
            [<br>
                &nbsp;&nbsp;{<br>
                &nbsp;&nbsp;"pancard":  {<br>
                &nbsp;&nbsp;"data": {<br>,
                &nbsp;&nbsp;"client_id":null,<br/>
                &nbsp;&nbsp;"transactionId":"qjdiAYh6SXcwpcdQSNlkeVmJ",<br/>        
                &nbsp;&nbsp;"panNumber":"HUHPS7607K",<br> 
                &nbsp;&nbsp;"maskedAadhar": "XXXXXXXX4191",<br>
                &nbsp;&nbsp;"lastFourDigitAadhar": "4191",<br>
                &nbsp;&nbsp;"typeOfHolder": "Individual or Person",<br>
                &nbsp;&nbsp;"name": "HARSHIT  SINGH",<br>
                &nbsp;&nbsp;"firstName": "HARSHIT",<br>
                &nbsp;&nbsp;"middleName": "",<br>
                &nbsp;&nbsp;"lastName": "SINGH",<br>
                &nbsp;&nbsp;"gender": "M",<br>
                &nbsp;&nbsp;"dob": "12/02/1999",<br> 
                &nbsp;&nbsp;"address":"934  North Jatepur Basharatpur Gorakhpur H.O Gorakhpur GORAKHPUR 273001 Uttar Pradesh",<br> 
                &nbsp;&nbsp;"city": "GORAKHPUR",<br> 
                &nbsp;&nbsp;"state": "Uttar Pradesh",<br> 
                &nbsp;&nbsp;"country": "INDIA",<br> 
                &nbsp;&nbsp;"pincode": "273001",<br> 
                &nbsp;&nbsp;"mobile_no": "7734945195",<br> 
                &nbsp;&nbsp;"email": "luckyharshit741@gmail.com",<br> 
                &nbsp;&nbsp;"isValid": true,<br>
                &nbsp;&nbsp;"aadhaarSeedingStatus": true,<br>
                &nbsp;&nbsp;"serviceCode": "1"<br>
                &nbsp;&nbsp;&nbsp;&nbsp;}<br>
                &nbsp;&nbsp;"status_code":200,<br>
                &nbsp;&nbsp;"success":true,<br>
                &nbsp;&nbsp;"message_code":"success",<br>
                &nbsp;&nbsp;}<br>

                &nbsp;&nbsp;}<br>
            ]<br>
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