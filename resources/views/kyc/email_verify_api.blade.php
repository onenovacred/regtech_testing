@extends('adminlte::page')

@section('title', 'Email Verification APIs')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class = "container">
    <div class="row">
      <div class = "col-md-4">
        <span class = "badge badge-dark"><h3>Email Verification APIs</h3></span>
      </div>
      <div class = "col-md-6">
        <span class = "badge badge-warning"><h4><u>Email Verification</u></h4></span><br>
        <p><b> Hitting URL : </b> http://regtechapi.in/api/verify_email</p>
        <b>Request Body : </b><br>
        {<br>   
         "email_to_verify":"abhi@gmail.com"<br>
        }<br>
         <p><b>Success Response : </b><br>
          [<br>
                "statusCode": 200,<br/>
                "data": {<br/>
                        "email": "abhi@gmail.com",<br/>
                        "HTTPStatusCode": 200,<br/>
                        "RequestId": "eddd8f17-0e04-447c-b139-fa75a5cdce90",<br/>
                        "RetryAttempts": 0,<br/>
                        "verification_initiated": true,<br/>
                        "verification_status": "Pending"<br/>
                      }
                    <br>
                ]
       </p>
      </div>
      <div class = "col-md">
            <a style = "color: white;"class = "btn btn-primary" onclick="history.back()" role = "button">Back</a>
        </div>
      </div>
</div> 
@stop


@section('custom_js')
@stop