@extends('adminlte::page')

@section('title', 'Aadhaar APIs')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class = "container">
    <div class="row">
      <div class = "col-md-4">
        <span class = "badge badge-dark"><h3>Aadhaar APIs</h3></span>
      </div>
      <div class = "col-md-6">
        <span class = "badge badge-warning"><h4><u>Aadhaar Validation</u></h4></span><br>
        <p><b> Hitting URL : </b>http://regtechapi.in/api/seachv4</p>
        <b>Request Method : POST </b><br>
        <b>Header : </b><br>
        {<br>   
        "AccessToken":"xxxxxxxxxxxxx"<br>
        }<br>
        <b>Request Body : </b><br>
        {<br>   
        "aadhaar_number":"868889041183"<br>
        }<br>

        <p><b>Success Response : </b><br>
            [<br>
                &nbsp;&nbsp;{<br>
                &nbsp;&nbsp;"aadhaar_validation": { "data": {<br>
                &nbsp;&nbsp;"client_id": "aadhaar_validation_aIqubluqVsnmhWcebctf", "age_range": "&nbsp;&nbsp;30-40",<br>
                &nbsp;&nbsp;"aadhaar_number": "868889041183", "state": "Maharashtra",<br>
                &nbsp;&nbsp;"gender": "M", "last_digits": "693", "is_mobile": true, "less_info": false<br>
                &nbsp;&nbsp;},<br>
                &nbsp;&nbsp;"status_code": 200, "success": true, "message": null,<br>
                &nbsp;&nbsp;"message_code": "success"<br>
                &nbsp;&nbsp;},<br>
                &nbsp;&nbsp;"statusCode": null<br>
                &nbsp;&nbsp;}<br>
            ]<br>
        </p>


        <!-- Aadhaar OTP Generate -->
        <span class = "badge badge-warning"><h4><u>Aadhaar OTP generate</u></h4></span><br>
        <p><b> Hitting URL : </b>http://regtechapi.in/api/seachv4</p>
        <b>Request Method : POST</b><br>
        <b>Header : </b><br>
        {<br>   
        "AccessToken":"xxxxxxxxxxxxx"<br>
        }<br>
        <b>Request Body : </b><br>
        {<br>   
        "otp_aadhar_number":"868889041183"<br>
        }<br>
        <b>Success Response : </b><br>
        {<br>
    "message_code": "success",<br>
    "success": true,<br>
    "status_code": 200,<br>
    "data": {<br>
        "otp_sent": true,<br>
        "if_number": true,<br>
        "client_id": "aadhaar_v2_UaMdUBdfmrSplknRSsep",<br>
        "valid_aadhaar": true<br>
    },<br>
    "message": "OTP Sent."<br>
}<br>
 
        <!-- Aadhaar OTP Submit -->
        <span class = "badge badge-warning"><h4><u>Aadhaar OTP Submit</u></h4></span>
        <p><b> Hitting URL : </b>http://regtechapi.in/api/seachv4</p>
        <b>Request Method : POST</b>
        <b>Header : </b><br>
        {<br>   
        "AccessToken":"xxxxxxxxxxxxx"<br>
        }<br>
        <b>Request Body :</b><br>
        {<br>

        "client_id": "@{{clientid}}",<br>
        "otp_aadhar": "@{{otp_aadhar}}"<br>

        }<br>
        <b>Success Response : </b><br>
{<br> 
    "data": {<br>
        "full_name": "Mohd.Asif Nazimuddin Sayyed",<br>
        "has_image": true,<br>
        "dob": "1995-10-04",<br>
        "raw_xml": "https://aadhaar-api-docs.s3.amazonaws.com/docboyz/aadhaar_xml/474820200725131929442/474820200725131929442-2020-07-25-074929.xml?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Expires=432000&X-Amz-SignedHeaders=host&X-Amz-Credential=AKIARVQSU3FJ26BNVN6C%2F20200725%2Fap-south-1%2Fs3%2Faws4_request&X-Amz-Date=20200725T074929Z&X-Amz-Signature=b9e307b9511ae2b8ac3f5a9df2eba39f7e2fe9e24eb4225c641fb5549e8123cb",<br>
        "loc": "kondhwa khurd",<br>
        "vtc": "Pune City",<br>
        "street": "S.N.54 Bhagyoday Nagar",<br>
        "dist": "Pune",<br>            
        "landmark": "jamatul salehat madrsha",<br>
        "po": "N I B M",<br>
        "house": "Flat n.9 Basera Complex",<br>
        "subdist": "Pune City",<br>
        "country": "India",<br>
        "state": "Maharashtra"<br>
        "zip_data": "https://aadhaar-api-docs.s3.amazonaws.com/docboyz/aadhaar_xml/474820200725131929442/474820200725131929442-2020-07-25-074928.zip?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Expires=432000&X-Amz-SignedHeaders=host&X-Amz-Credential=AKIARVQSU3FJ26BNVN6C%2F20200725%2Fap-south-1%2Fs3%2Faws4_request&X-Amz-Date=20200725T074929Z&X-Amz-Signature=17669310952ee6b20b4371da6c69f20f2e97b8a922394cad095b2435d5a01e61",<br>
        "share_code": "5929",<br>
        "care_of": "",<br>
        "zip": "411048",<br>
        "face_status": false,<br>
        "aadhaar_number": "592154824748",<br>
        "profile_image": "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",<br>
        "face_score": -1,<br>
        "mobile_verified": false,<br>
        "reference_id": "339020231124102133200",<br/>
        "aadhaar_pdf": null,<br/>
        "gender": "M",<br>
        "client_id": "aadhaar_v2_UaMdUBdfmrSplknRSsep",<br>
        "status": "success_aadhaar",<br/>
        "uniqueness_id": "6d4a394351af74394eb8f69e7e7f1d69aa6d4bb3c97fedd4cbb9f11886c2107a",<br/>
    },<br>
    "message_code": "success",<br>
    "status_code": 200,<br>
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