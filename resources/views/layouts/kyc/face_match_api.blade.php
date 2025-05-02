@extends('adminlte::page')

@section('title', 'Face Match API')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class = "container">
    <div class="row">
      <div class = "col-md-4">
        <span class = "badge badge-dark"><h3>Face Match API</h3></span>
      </div>
      <div class = "col-md-6">
        <span class = "badge badge-warning"><h4><u>Face Match</u></h4></span><br>
        <p><b> Hitting URL : </b> http://regtechapi.in/api/face_match</p>
        <!-- <b>Request Method : POST</b><br> -->
        <b>Request Body : </b><br>
        {<br>   
        "doc_img":"{{@doc_img}}"<br>
        "selfie":"{{@selfie}}"<br>
        }<br>

        <b>Success Response : </b><br>
        [
          {
            "face_match": { 
              "code": "200",
              "status": "success",  
              "response": {
                "confidence": "100%"
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