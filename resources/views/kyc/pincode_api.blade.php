@extends('adminlte::page')

@section('title', 'Pincode APIs')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class = "container">
    <div class="row">
      <div class = "col-md-4">
        <span class = "badge badge-dark"><h3>Pincode APIs</h3></span>
      </div>
      <div class = "col-md-6">
        <span class = "badge badge-warning"><h4><u>Pincode</u></h4></span><br>
        <p><b> Hitting URL : </b> http://regtechapi.in/api/pincode</p>
        <b>Request Body : </b><br>
        {<br>   
        "from_pin":"411006",<br>
        "to_pin":"411057"<br>
        }<br>
        <b>Success Response : </b><br>
            {<br>
       "data": {<br>
         "fromPin": "411006",<br>
         "toPin": "411057",<br>
         "distance":22,<br/>
      },<br>
    "statusCode": 200,<br>

}<br>
</div>
      <div class = "col-md">
            <a style = "color: white;"class = "btn btn-primary" onclick="history.back()" role = "button">Back</a>
        </div>

    </div>
</div> 
@stop


@section('custom_js')
@stop