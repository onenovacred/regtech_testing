@extends('adminlte::page')

@section('title', 'Dedupe API')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class = "container">
    <div class="row">
      <div class = "col-md-4">
        <span class = "badge badge-dark"><h3>Dedupe API</h3></span>
      </div>
      <div class = "col-md-6">
        <span class = "badge badge-warning"><h4><u>Dedupe</u></h4></span><br>
        <p><b> Hitting URL : </b>http://regtechapi.in/api/dedupe_s3</p>
        <b>Request Body : </b><br>
        {<br>   
             bucket_name:"",<br/>
             prefix:"",<br/>
             aws_access_key_id:"",<br/>
             aws_secret_access_key:"",<br/>
             region_name:"",<br/>
        }<br>
         <p><b>Success Response : </b><br>
          [<br>
                "statusCode": 200,<br/>
                "data": {<br/>
                          "deleted_files":[
                            <br/>
                            "C:\Users\user\Downloads\video\video1.mp4",<br/>
                            "C:\Users\user\Downloads\image\shirt.jpg",<br/>
                            "C:\Users\user\Downloads\profile\users.jpeg",<br/>
                          ]<br/>
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