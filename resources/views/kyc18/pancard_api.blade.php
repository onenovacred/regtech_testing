@extends('adminlte::page')

@section('title', 'Pancard APIs')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class = "container">
    <div class="row">
      <div class = "col-md-4">
        <span class = "badge badge-dark"><h3>Pan Card APIs</h3></span>
      </div>
      <div class = "col-md-6">
        <span class = "badge badge-warning"><h4><u>PAN Verification</u></h4></span><br>
        <p><b> Hitting URL : </b> http://regtechapi.in/api/pancard</p>
        <b>Header : </b><br>
        {<br>   
        "AccessToken":"xxxxxxxxxxxxx"<br>
        }<br>
        <b>Request Body : </b><br>
        {<br>   
        "pan_number":"ARTPB4748P"<br>
        }<br>

        <p><b>Success Response : </b><br>
            [<br>
                &nbsp;&nbsp;{<br>
                &nbsp;&nbsp;"pancard":  {<br>
                &nbsp;&nbsp;"data": {<br>
                &nbsp;&nbsp;"client_id":"pan_WkNzvNBotdVtlscFqbur", "pan_number":"ARTPB4748P",<br> &nbsp;&nbsp;"full_name":"DEVANAND PANNALAL SHARMA",<br>
                &nbsp;&nbsp;"category":"person"<br>
                &nbsp;&nbsp;&nbsp;&nbsp;}<br>
                &nbsp;&nbsp;"status_code":200, "success":TRUE, "message":NULL, "message_code":"success"<br>
                &nbsp;&nbsp;}<br>,
                "statusCode":NULL<br>



                &nbsp;&nbsp;}<br>
            ]<br>
        </p>


        <!-- PAN Upload -->
        <span class = "badge badge-warning"><h4><u>Pancard Upload</u></h4></span><br>
        <p><b> Hitting URL : </b>http://regtechapi.docboyz.in/api/panupload</p>
        <b>Header : </b><br>
        {<br>   
        "AccessToken":"xxxxxxxxxxxxx"<br>
        }<br>
        <b>Request form-data : </b><br>
        file – pancard image file<br>
        <br>
        <b>Success Response :</b>
        <br>
        <p>
            "{\"data\":  {\"client_id\":  \"pan_photo_dfndubtlyasFUMojgfbw\",  \"pan_number\":  \"ARTPB4748P\",  \ "dob\":  \"04/07/1991\",  \"father_name\":  \"Hiralal  Chavan\",  \"full_name\":  \"Devanand Pannalal Sharma\",  \"strict_status\":  false,  \"strict_check\":  false,  \"individual_pan\":  true,  \"pan_confiden ce\":  99.0,  \"signature_confidence\":  0.0,  \"information_mismatch\":  [],  \"valid_pan\":  true},  \" status_code\":  200,  \"success\":  true,  \"message\":  null,  \"message_code\":  \"success\"}\n"
        </p>
        <span class = "badge badge-warning"><h4><u>PAN Info</u></h4></span><br>
        <p><b> Hitting URL : </b> http://regtechapi.in/api/pancard_details</p>
        <b>Header : </b><br>
        {<br>   
        "AccessToken":"xxxxxxxxxxxxx"<br>
        }<br>
        <b>Request Body : </b><br>
        {<br>   
        "pan_number":"BPZPM1894M"<br>
        }<br>

        <p><b>Success Response : </b><br>
            [<br>
                &nbsp;&nbsp;{<br>
                &nbsp;&nbsp;"pancard":  {<br>
                &nbsp;&nbsp;"data": {<br>
                &nbsp;&nbsp;"panNumber":"BPZPM1894M",<br> &nbsp;&nbsp;"fullName":"PRITESH LAXMAN MEHETRE",<br> &nbsp;&nbsp;"isValid":"true",<br> &nbsp;&nbsp;"firstName":"PRITESH",<br> &nbsp;&nbsp;"middleName":"LAXMAN",<br> &nbsp;&nbsp;"lastName":"MEHETRE",<br> &nbsp;&nbsp;"title":"Shri",<br> &nbsp;&nbsp;"panStatusCode":"E",<br> &nbsp;&nbsp;"panStatus":"Valid",<br> &nbsp;&nbsp;"aadhaarSeedingStatus":"Aadhaar seeding is Successful",<br> &nbsp;&nbsp;"aadhaarSeedingStatusCode":"Y",<br> &nbsp;&nbsp;"lastUpdatedOn":"18/08/2017",<br>
                &nbsp;&nbsp;&nbsp;&nbsp;}<br>
                &nbsp;&nbsp;"status_code":200<br>
                &nbsp;&nbsp;}<br>



                &nbsp;&nbsp;}<br>
            ]<br>
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