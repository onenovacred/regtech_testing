@extends('adminlte::page')

@section('title', 'GSTIN APIs')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class = "container">
    <div class="row">
      <div class = "col-md-4">
        <span class = "badge badge-dark"><h3>Corporate GSTIN APIs</h3></span>
      </div>
      <div class = "col-md-6">
        <span class = "badge badge-warning"><h4><u>GSTIN</u></h4></span><br>
        <p><b> Hitting URL : </b> http://regtechapi.in/api/corporate_gstin</p>
        <!-- <b>Request Method : POST</b><br> -->
        <b>Request Body : </b><br>
        {<br>   
        "corporate_gstin":"27AABCZ2858B1ZC"<br>
        }<br>

        <b>Success Response : </b><br>
        [
            {
            "corporate_gstin": { 
              "code": "200",
              "status": "success",  
              "response": {
                "gstin": "{@gstin_number}",
                "legal_name": "{@legal_name}",
                "jurisdiction": "{@jurisdiction}", "reg_date": "{@reg_date}
                "taxpayer_type": "{@taxpayer_type}",
                "status": "{@status}",
                "address": "{@address}",
                "business_type": "{@business_type}",
                "nature" : "{@nature}",
                "last_update": "{@last_update}",
                "state_code": "{@state_code}"
              },
            
            }
            "statusCode": "200"
          }
        ]

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