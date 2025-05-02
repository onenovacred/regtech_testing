@extends('adminlte::page')

@section('title', 'CIN APIs')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class = "container">
    <div class="row">
      <div class = "col-md-4">
        <span class = "badge badge-dark"><h3>Corporate CIN APIs</h3></span>
      </div>
      <div class = "col-md-6">
        <span class = "badge badge-warning"><h4><u>CIN</u></h4></span><br>
        <p><b> Hitting URL : </b> http://regtechapi.in/api/corporate_cin</p>
        <b>Request Body : </b><br>
        {<br>   
        "corporate_cin":"U72900PN2018PTC180125"<br>
        }<br>
        <p><b>Success Response : </b><br>
            [<br>
                
            &nbsp;&nbsp;&nbsp;{<br>
            &nbsp;&nbsp;&nbsp;"corporate_cin": {<br> 
            &nbsp;&nbsp;&nbsp;"data": {<br>
            &nbsp;&nbsp;&nbsp;"client_id": "corporate_cin_wdDJojPsekbnkswTGxYk", <br>
            &nbsp;&nbsp;&nbsp;"cin_number": "U72900PN2018PTC180125",<br>
            &nbsp;&nbsp;&nbsp;"company_name": "ZAPFIN TEKNOLOGIES PRIVATE LIMITED",<br>
            &nbsp;&nbsp;&nbsp;"incorporation_date": "2018-11-09",<br>
            &nbsp;&nbsp;&nbsp;"phone_number": "+918470067555",<br>
            &nbsp;&nbsp;&nbsp;"company_address": "11B, Aditya Business Center$SN-1A,Kondhwa,                &nbsp;&nbsp;&nbsp;&nbsp;Khurd$PUNE$Pune$Maharashtra$411048$India$",<br>    
            &nbsp;&nbsp;&nbsp;"email": "ashokonly@gmail.com",<br>
            &nbsp;&nbsp;&nbsp;"company_class": "PRIV",<br>
            &nbsp;&nbsp;&nbsp;"zip": "411048",<br>
            &nbsp;&nbsp;&nbsp;"directors": [<br>
            &nbsp;&nbsp;&nbsp;&nbsp;{<br>
            &nbsp;&nbsp;&nbsp;&nbsp;"din_number": "00517254",<br>
            &nbsp;&nbsp;&nbsp;&nbsp;"director_name": "ASHOK KUMAR"<br>
            &nbsp;&nbsp;&nbsp;&nbsp;},<br>
            &nbsp;&nbsp;&nbsp;&nbsp;{<br>
            &nbsp;&nbsp;&nbsp;&nbsp;"din_number": "08862561",<br> 
            &nbsp;&nbsp;&nbsp;&nbsp;"director_name": "PRASHANT KUMAR"<br>
            &nbsp;&nbsp;&nbsp;&nbsp;}<br>
            ],<br>
            "authorized_capital": "2500000",<br>
            "paid_up_capital": "1628370",<br>
            "last_agm_date": "2019-09-30",<br>
            "last_bs_date": "2019-03-31", <br>"company_status": "Active", <br>"listed_status": "Unlisted"<br>
            },<br>
            "status_code": 200,<br> "success": true,<br> "message": null,<br>
            "message_code": "success"<br>
            },<br>
            "statusCode": null<br>

            &nbsp;&nbsp;&nbsp;}<br>
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