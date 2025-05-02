@extends('adminlte::page')

@section('title', 'Pancard APIs')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class = "container">
    <div class="row">
      <div class = "col-md-4">
        <span class = "badge badge-dark"><h3>Search V2 APIs</h3></span>
      </div>
      <div class = "col-md-6">
      <span class = "badge badge-warning"><h4><u>PAN Details</u></h4></span><br>
                    <p><b> Hitting URL : </b> http://regtechapi.in/api/search_v2</p>
                    <b>Header : </b><br>
                    {<br>   
                    "AccessToken":"xxxxxxxxxxxxx"<br>
                    }<br>
                    <b>Request Body : </b><br>
                    {<br>   
                    "pano":"BXXXXXXXXM"<br>
                    }<br>

                    <p><b>Success Response : </b><br>
                        [<br>
                            &nbsp;&nbsp;{<br>
                            &nbsp;&nbsp;"statusCode": 200 {<br>
                            &nbsp;&nbsp;"response": {<br>
                            &nbsp;&nbsp;   "statusCode": 200,
                            "message": "Details downloaded successfully",
                            "success": true,
                            "kycDetails": {
                                "personalIdentifiableData": {
                                    "personalDetails": {
                                        "searchkyclite": null,
                                        "pan": "AHEPP2012J",
                                        "maskedAadhaar": "XXXXXXXX5758",
                                        "lastFourDigit": "5758",
                                        "typeOfHolder": "Individual or Person",
                                        "fullName": "PRASHANT  KUMAR",
                                        "firstName": "PRASHANT",
                                        "middleName": "",
                                        "lastName": "KUMAR",
                                        "mobNum": "7762912451",
                                        "email": "prashant61_2000@yahoo.com",
                                        "dob": "09/03/1975",
                                        "address": "D4-101, Bramha Suncity Wadgaon Sheri Wadgaon Sheri Wadgaon Sheri Pune None null",
                                        "city": "Pune",
                                        "state": null,
                                        "country": "INDIA",
                                        "pincode": "None",
                                        "gender": "M",
                                        "isValid": true,
                                        "aadhaarSeedingStatus": true,
                                        "serviceCode": "1"
                                    }
                                }
                            }
                            &nbsp;&nbsp;&nbsp;&nbsp;}<br>
                            &nbsp;&nbsp;}<br>



                            &nbsp;&nbsp;}<br>
                        ]<br>
                    </p>

        <span class = "badge badge-warning"><h4><u>Search Kyc</u></h4></span><br>
        <p><b> Hitting URL : </b> http://regtechapi.in/api/ckycSearch</p>
        <b>Header : </b><br>
        {<br>   
        "AccessToken":"xxxxxxxxxxxxx"<br>
        }<br>
        <b>Request Body : </b><br>
        {<br>   
        "pano":"CDEPD3027M"<br>
        "dob":"1996-09-03"<br>
        }<br>
       

        <p><b>Success Response : </b><br>
            [<br>
                &nbsp;&nbsp;{<br>
                &nbsp;&nbsp;"pancard":  {<br>
                &nbsp;&nbsp;"response": {<br>
                &nbsp;&nbsp;"ckycNo":"30084056964342", <br> &nbsp;&nbsp;"pan":"CDEPD3027M",
                <br> &nbsp;&nbsp;"fullName":"MR UMESH BALASO DAMAME",<br>
                <br> &nbsp;&nbsp;"mobNum":"8830369298",<br>
                <br> &nbsp;&nbsp;"address":"PANDURANG NIVAS,MAIN ROAD,SANGLI",<br>
                <br> &nbsp;&nbsp;"permCity":"SANGLI",<br>
                <br> &nbsp;&nbsp;"permDist":"SANGLI",<br>
                <br> &nbsp;&nbsp;"permState":"MH",<br>
                <br> &nbsp;&nbsp;"permPin":"416301",<br>
                <br> &nbsp;&nbsp;"corresLine1":"PANDURANG NIVAS,MAIN ROAD,SANGLI",<br>
                <br> &nbsp;&nbsp;"corresCity":"SANGLI",<br>
                <br> &nbsp;&nbsp;"corresDist":"SANGLI",<br>
                <br> &nbsp;&nbsp;"corresState":"MH",<br>
                <br> &nbsp;&nbsp;"corresPin":"416301",<br>
                &nbsp;&nbsp;"category":"person"<br>
                &nbsp;&nbsp;&nbsp;&nbsp;}<br>
                &nbsp;&nbsp;"status_code":200, "success":TRUE, "message":NULL, "message_code":"success"<br>
                &nbsp;&nbsp;}<br>,
                "statusCode":NULL<br>



                &nbsp;&nbsp;}<br>
            ]<br>
        </p>


        <!-- PAN Upload -->
          
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