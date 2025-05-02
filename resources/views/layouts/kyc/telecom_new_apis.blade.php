@extends('adminlte::page')

@section('title', 'Telecom APIs')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class = "container">
    <div class="row">
      <div class = "col-md-4">
        <span class = "badge badge-dark"><h3>Telecom APIs</h3></span>
      </div>
      <div class = "col-md-6">
       <span class="badge badge-warning"><h4><u>Telecom</u></h4></span><br>
       <p><b> Hitting URL : </b>http://regtechapi.in/api/seachv4</p>
       <b>Request Method : POST </b><br>
       <b>Request Body : </b><br>
       {<br>   
       "client_ref_num": "sas40",<br>
       "mobile_number": "9975621654"<br>
       }<br>
       <b>Success Response : </b>
       <p class = "px-2">{<br>
           "telecom_details": {<br>
           "http_response_code": 200,<br> 
           "client_ref_num": "sas40",<br>
           "request_id": "bf01238b-f05b-4308-9630-96c92211139f",<br>
           "result_code": 101,<br>
           "message": "Report Generated Successful",<br>
           "result":{<br>&nbsp;&nbsp;
            "customer_details": {<br>&nbsp;&nbsp;&nbsp;&nbsp;
              "name": "",<br>&nbsp;&nbsp;&nbsp;&nbsp;
              "alternate_number": null,<br>&nbsp;&nbsp;&nbsp;&nbsp;
             },
             <br>&nbsp;&nbsp;
             "is_valid": true,<br>&nbsp;&nbsp;
             "subscriber_status": "CONNECTED",<br>&nbsp;&nbsp;
             "connection_status": {<br>&nbsp;&nbsp;&nbsp;&nbsp;
              "status_code": "DELIVERED",<br>&nbsp;&nbsp;&nbsp;&nbsp;
              "error_code_id": ""<br>&nbsp;&nbsp;&nbsp;&nbsp;
               },<br>&nbsp;&nbsp;
              "connection_type":"prepaid",<br>&nbsp;&nbsp; 
              "msisdn": {<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "msisdn_country_code": "IN",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "msisdn": "+919975621654",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "type": "MOBILE",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "mnc": "90",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "imsi": "404223085662992",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "mcc": "404",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "mcc_mnc": "40422"<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              },<br>&nbsp;&nbsp;
              "current_service_provider": {<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "network_prefix": "83780",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "network_name": "IDEA",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "network_region": "Maharashtra",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "mcc": "404",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "mnc": "22",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "country_prefix": "+91",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "country_code": "IN",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "country_name": "India"<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              },<br>&nbsp;&nbsp;
              "original_service_provider": {<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "network_prefix": "99756",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "network_name": "Airtel",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "network_region": "Maharashtra",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "mcc": "404",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "mnc": "90",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "country_prefix": "+91",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "country_code": "IN",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "country_name": "India"<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              },<br>&nbsp;&nbsp;
              "romaning_service_provider": {<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "network_prefix": "96651",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "network_name": "Airtel",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "network_region": "Maharashtra",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "mcc": "404",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "mnc": "90",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "country_prefix": "+91",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "country_code": "IN",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "country_name": "India"<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              },<br>&nbsp;&nbsp;
              "is_ported":true,<br>&nbsp;&nbsp;
              "last_ported_date": "",<br>&nbsp;&nbsp;
              "porting_history": []<br>&nbsp;&nbsp;&nbsp;&nbsp;
           }
           <br>
        },
       <br>
       "status_code": 200,<br>
       }<p>
  
     </div>
      <div class = "col-md">
            <a style = "color: white;"class = "btn btn-primary" onclick="history.back()" role = "button">Back</a>
        </div>

    </div>
</div> 
        
@stop


@section('custom_js')
@stop