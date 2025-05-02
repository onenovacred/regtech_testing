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
        <span class = "badge badge-warning"><h4><u>Search Kyc</u></h4></span><br>
        <p><b> Hitting URL : </b>http://regtechapi.in/api/search</p>
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
                &nbsp;&nbsp;"statusCode":200,<br/>    
                &nbsp;&nbsp;"response": {<br>
                &nbsp;&nbsp;"kycStatus": 200,<br/>
                &nbsp;&nbsp;"message": "Details downloaded successfully",<br/>
                &nbsp;&nbsp;"success":true,<br/>
                &nbsp;&nbsp;"kycDetails":{<br/>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"personalIdentifiableData":{<br/>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"personalDetails":{<br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"fullName":"UMESH BALASO DAMAME",<br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"mobNum":"8830369298",<br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"email": "umeshbalasodamame@gmail.com",<br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"dob": "18/04/1993",<br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br/> 
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;} <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br/>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
                <br/>
                &nbsp;&nbsp;}
            <br/>
        ]
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