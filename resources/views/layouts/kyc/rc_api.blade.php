@extends('adminlte::page')

@section('title', 'RC APIs')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class = "container">
    <div class="row">
      <div class = "col-md-4">
        <span class = "badge badge-dark"><h3>RC APIs</h3></span>
      </div>
      <div class = "col-md">
        <span class = "badge badge-warning"><h4><u>RC Verification</u></h4></span><br>
        <p><b> Hitting URL : </b>http://regtechapi.in/api/seachv4</p>
        <b>Header : </b><br>
        {<br>   
        "AccessToken":"xxxxxxxxxxxxx"<br>
        }<br>
        <b>Request Body : </b><br>
        {<br>   
        "rc_number":"mh11at9556"<br>
        }<br>
        <p><b>Success Response : </b><br>
            [<br>
                
            &nbsp;&nbsp;&nbsp;{<br>
            &nbsp;&nbsp;&nbsp;"rc_validation": {<br> &nbsp;&nbsp;&nbsp;"data": {<br>
            &nbsp;&nbsp;&nbsp;"client_id": "rc_szGFosDXfTUuoejqRwLt", <br>
            &nbsp;&nbsp;&nbsp;"rc_number": "mh11at9556",<br>
            &nbsp;&nbsp;&nbsp;"registration_date": "2010-03-22",<br>
            &nbsp;&nbsp;&nbsp;"owner_name": "BHARAT BHALKE",<br>
            &nbsp;&nbsp;&nbsp;"present_address": "",<br>
            &nbsp;&nbsp;&nbsp;"permanent_address": "",<br>
            &nbsp;&nbsp;&nbsp;"mobile_number": "",<br>
            &nbsp;&nbsp;&nbsp;"vehicle_category": "",<br>
            &nbsp;&nbsp;&nbsp;"vehicle_chasi_number": "ME121C021A20XXXXX",<br> 
            &nbsp;&nbsp;&nbsp;"vehicle_engine_number": "21C20XXXXX",<br> 
            &nbsp;&nbsp;&nbsp;"maker_description": "",<br>
            &nbsp;&nbsp;&nbsp;"maker_model": "INDIA YAMAHA MOTOR PVT LTD / YAMAHA FZ S",
            <br>
            &nbsp;&nbsp;&nbsp;"body_type": "", <br>
            &nbsp;&nbsp;&nbsp;"fuel_type": "PETROL",<br>
            &nbsp;&nbsp;&nbsp;"color": "",<br>
            &nbsp;&nbsp;&nbsp;"norms_type": "NOT AVAILABLE",<br>
            &nbsp;&nbsp;&nbsp;"fit_up_to": "2025-03-21",<br>
            &nbsp;&nbsp;&nbsp;"financer": "",<br>
            &nbsp;&nbsp;&nbsp;"insurance_company": "",<br> 
            &nbsp;&nbsp;&nbsp;"insurance_policy_number": "",<br>
            &nbsp;&nbsp;&nbsp;"insurance_upto": "2020-10-04",<br> 
            &nbsp;&nbsp;&nbsp;"manufacturing_date": "",<br>
            &nbsp;&nbsp;&nbsp;"registered_at": "SATARA, MAHARASHTRA", "latest_by": null,<br>
            &nbsp;&nbsp;&nbsp;"less_info": true, "tax_upto": "1800-01-01",<br> 
            &nbsp;&nbsp;&nbsp;"cubic_capacity": null,<br>
            &nbsp;&nbsp;&nbsp;"vehicle_gross_weight": null,<br>
             
            &nbsp;&nbsp;&nbsp;"no_cylinders": null,<br>
            &nbsp;&nbsp;&nbsp;"seat_capacity": null,<br>
            &nbsp;&nbsp;&nbsp;"sleeper_capacity": null,<br>
            &nbsp;&nbsp;&nbsp;"standing_capacity": null,<br>
            &nbsp;&nbsp;&nbsp;"wheelbase": null,<br> 
            &nbsp;&nbsp;&nbsp;"unladen_weight": null,<br>
            &nbsp;&nbsp;&nbsp;"vehicle_category_description": null,<br>
            &nbsp;&nbsp;&nbsp;"pucc_number": null,<br>
            &nbsp;&nbsp;&nbsp;"pucc_upto": null,<br>
            &nbsp;&nbsp;&nbsp;"masked_name": false<br>
            &nbsp;&nbsp;&nbsp;},<br>
            &nbsp;&nbsp;&nbsp;"status_code": 200, "success": true, "message": null,<br>
            &nbsp;&nbsp;&nbsp;"message_code": "success"<br>
            &nbsp;&nbsp;&nbsp;},<br>
            &nbsp;&nbsp;&nbsp;"statusCode": null<br>
            &nbsp;&nbsp;&nbsp;}<br>
            &nbsp;&nbsp;]<br>
        </p>

        <span class = "badge badge-warning"><h4><u>RC Verification Lite</u></h4></span><br>
        <p><b> Hitting URL : </b> http://regtechapi.in/api/rc_validationlite</p>
        <b>Header : </b><br>
        {<br>   
        "AccessToken":"xxxxxxxxxxxxx"<br>
        }<br>
        <b>Request Body : </b><br>
        {<br>   
        "rc_number":"MH17BE1013"<br>
        }<br>
        <p><b>Success Response : </b><br>
            [<br>
                
            &nbsp;&nbsp;&nbsp;{<br>
            &nbsp;&nbsp;&nbsp;"rc_validation": {<br> &nbsp;&nbsp;&nbsp;"data": {<br>
            &nbsp;&nbsp;&nbsp;"rc_number": "MH17BE1013",<br>
            &nbsp;&nbsp;&nbsp;"registration_date": "9/2014",<br>
            &nbsp;&nbsp;&nbsp;"owner_name": "P**I** L**X** M**H**",<br>
            &nbsp;&nbsp;&nbsp;"vehicle_category": "",<br>
            &nbsp;&nbsp;&nbsp;"fuel_type": "PETROL",<br>
            &nbsp;&nbsp;&nbsp;"fit_up_to": "2029-11-12",<br>
            &nbsp;&nbsp;&nbsp;"insurance_upto": "2017-05-02",<br> 
            &nbsp;&nbsp;&nbsp;"registered_at": "SRIRAMPUR, Maharashtra", "latest_by": null,<br>   
            &nbsp;&nbsp;&nbsp;"pucc_upto": null,<br>
            &nbsp;&nbsp;&nbsp;},<br>
            &nbsp;&nbsp;&nbsp;"status_code": 200, "success": true, "message": null,<br>
            &nbsp;&nbsp;&nbsp;"message_code": "success"<br>
            &nbsp;&nbsp;&nbsp;},<br>
            &nbsp;&nbsp;&nbsp;"statusCode": null<br>
            &nbsp;&nbsp;&nbsp;}<br>
            &nbsp;&nbsp;]<br>
        </p>


        
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