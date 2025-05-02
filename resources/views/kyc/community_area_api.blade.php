@extends('adminlte::page')

@section('title', 'Company Product APIs')

@section('content_header')
@stop

@section('content')
<div class = "container">
    <div class="row">
      <div class = "col-md-4">
        <span class = "badge badge-dark"><h3>Community Area APIs</h3></span>
      </div>
      <div class = "col-md-6">
        <span class = "badge badge-warning"><h4><u>Community Area</u></h4></span><br>
        <p><b> Hitting URL : </b> http://regtechapi.in/api/community_area</p>
        <b>Header : </b><br>
        {<br>   
        "AccessToken":"xxxxxxxxxxxxx"<br>
        }<br>
        <b>Request Body : </b><br>
        {<br>   
        "latitude":"18.5538",<br>
        "longitude":"73.9477",<br>
        }<br>
        <p><b>Success Response : </b><br>
            [<br>
                &nbsp;&nbsp;"data":{<br>
                        "page": "community Domminated Area",<br/>
                        "temple_count":20,<br/>
                        "church_count":2,<br/>
                        "mosque_count":0,<br/>
                        "gurudwara_count":0,<br/>
                        "Timestamp":1721895266.7208543,<br/>
                    }<br/>
                "status_code":200<br>
            ]<br>
        </p>
           <div class = "col-md">
            <a style = "color: white;"class = "btn btn-primary" onclick="history.back()" role = "button">Back</a>
        </div>

     </div>
</div> 
@stop


@section('custom_js')
@stop