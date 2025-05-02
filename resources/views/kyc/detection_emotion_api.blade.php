@extends('adminlte::page')

@section('title', 'Emoation API')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class = "container">
    <div class="row">
      <div class = "col-md-4">
        <span class = "badge badge-dark"><h3>Decated Emotion APIs</h3></span>
      </div>
      <div class = "col-md-6">
        <span class = "badge badge-warning"><h4><u>Decated Emotion</u></h4></span><br>
        <p><b> Hitting URL : </b> http://regtechapi.in/api/detection_emotion</p>
        <b>Request Body : </b><br>
        {<br>   
         "image_file":"happy.jpg"<br>
        }<br>
         <p><b>Success Response : </b><br>
          [<br>
                "statusCode": 200,<br/>
                "response": {<br/>
                       "emoation":"true"<br/>  
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