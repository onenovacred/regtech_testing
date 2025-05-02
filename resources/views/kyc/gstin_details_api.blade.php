@extends('adminlte::page')

@section('title', 'GSTIN APIs')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class = "container">
    <div class="row">
      <div class = "col-md-4">
        <span class = "badge badge-dark"><h3>GSTIN  APIs</h3></span>
      </div>
      <div class = "col-md-6">
        <span class = "badge badge-warning"><h4><u>GSTIN Details</u></h4></span><br>
        <p><b> Hitting URL : </b> http://regtechapi.in/api/gstin_details</p>
        <b>Request Body : </b><br>
        {<br>   
        "gstin_id":"27AABCZ2858B1ZC"<br>
        }<br>
        <b>Success Response : </b><br>
            {<br>
       "data": {<br>
        "Nature of Business Activities": "Service Provider and Others",<br>
        "Dealing in Goods and Services": "Goods Services HSN Description HSN Description
        998319 Other information technology services n.e.c
        998313 Information technology (IT) consulting and support services
        998314 Information technology (IT) design and development services
        HSN: Harmonized System of Nomenclature of Goods and Services",<br>
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