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
        {{-- <span class = "badge badge-warning"><h4><u>GSTIN</u></h4></span><br>
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
                "gstin": "{{@gstin_number}}",
                "legal_name": "{{@legal_name}}",
                "jurisdiction": "{{@jurisdiction}}", "reg_date": "{{@reg_date}}",
                "taxpayer_type": "{{@taxpayer_type}}",
                "status": "{{@status}}",
                "address": "{{@address}}",
                "business_type": "{{@business_type}}",
                "nature" : "{{@nature}}",
                "last_update": "{{@last_update}}",
                "state_code": "{{@state_code}}"
              },
            
            }
            "statusCode": "200"
          }
        ]
        <br/> --}}
        <br/>
        <span class = "badge badge-warning"><h4><u>GSTIN</u></h4></span><br>
        <p><b> Hitting URL : </b>http://regtechapi.in/api/seachv4</p>
        <!-- <b>Request Method : POST</b><br> -->
        <b>Request Body : </b><br>
        {<br>   
        "corporate_gstin":"27AABCZ2858B1ZC"<br>
        }<br>

        <b>Success Response : </b><br>
        [
          <p class = "px-2">{<br>
            "corporate_gstin": {<br>&nbsp;&nbsp;
            "code": 200,<br>&nbsp;&nbsp; 
            "status": "success",<br>&nbsp;&nbsp;
            "response":{<br>&nbsp;&nbsp;&nbsp;&nbsp;
              "request_id": "aclb6dae-4a28-46d5-9b91-f8dc837833ba",<br>&nbsp;&nbsp;&nbsp;&nbsp;
              "gstin": "27AABCZ2858B1ZC",<br>&nbsp;&nbsp;&nbsp;&nbsp;
              "legal_name": "ZAPFIN TEKNOLOGIES PRIVATE LIMITED",<br>&nbsp;&nbsp;&nbsp;&nbsp;
              "trade_name": "ZAPFIN TEKNOLOGIES PRIVATE LIMITED",<br>&nbsp;&nbsp;&nbsp;&nbsp;
              "taxpayer_type": "Regular",<br>&nbsp;&nbsp;&nbsp;&nbsp;
              "reg_date": "11/01/2019",<br>&nbsp;&nbsp;&nbsp;&nbsp;
              "state_code": "MHCG1200",<br>&nbsp;&nbsp;&nbsp;&nbsp;
              "nature": "Supplier of Services",<br>&nbsp;&nbsp;&nbsp;&nbsp;
              "jurisdiction": "RANGE-V",<br>&nbsp;&nbsp;&nbsp;&nbsp;
              "business_type": "Private Limited Company",<br>&nbsp;&nbsp;&nbsp;&nbsp;
              "last_update": "18/05/2023",<br>&nbsp;&nbsp;&nbsp;&nbsp;
              "address": {<br>&nbsp;&nbsp;&nbsp;&nbsp;
               "addr1": "OFFICE NO.105, SR.NO.212, PLOT NO.C/59, Harmesh Waves",<br>&nbsp;&nbsp;&nbsp;&nbsp;
               "addr2": "Central Avenue Road",<br>&nbsp;&nbsp;&nbsp;&nbsp;
               "locality": "Kalyani Nagar",<br>&nbsp;&nbsp;&nbsp;&nbsp;
               "pin": "411006",<br>&nbsp;&nbsp;&nbsp;&nbsp;
               "state": "Maharashtra",<br>&nbsp;&nbsp;&nbsp;&nbsp;
               "city": "Pune",<br>&nbsp;&nbsp;&nbsp;&nbsp;
               "district": "Pune",<br>&nbsp;&nbsp;&nbsp;&nbsp;
               "nature": "Supplier of Services",<br>&nbsp;&nbsp;&nbsp;&nbsp;
               "lat": "18.546572",<br>&nbsp;&nbsp;&nbsp;&nbsp;
               "long": "73.900896"<br>&nbsp;&nbsp;&nbsp;&nbsp;
              },
              <br>&nbsp;&nbsp;
              "add_address": [],<br>&nbsp;&nbsp;&nbsp;&nbsp;
              "status": "Active"<br>&nbsp;&nbsp;&nbsp;&nbsp;
            }
            <br>
         },
         </p>
         "status_code": 200,<br>&nbsp;&nbsp;&nbsp;&nbsp;
         }<br/>
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