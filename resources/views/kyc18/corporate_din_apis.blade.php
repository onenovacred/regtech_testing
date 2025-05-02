@extends('adminlte::page')

@section('title', 'DIN APIs')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class = "container">
    <div class="row">
      <div class = "col-md-4">
        <span class = "badge badge-dark"><h3>Corporate DIN APIs</h3></span>
      </div>
      <div class = "col-md-6">
        <span class = "badge badge-warning"><h4><u>DIN</u></h4></span><br>
        <p><b> Hitting URL : </b> http://regtechapi.in/api/corporate_din</p>
        <b>Request Method : POST</b><br>
        <b>Request Body : </b><br>
        {<br>   
        "id_number":"@{{din_number}}"<br>
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