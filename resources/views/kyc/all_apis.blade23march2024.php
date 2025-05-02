@extends('adminlte::page')

@section('title', 'All APIs')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class = "container">
    <div id = "accordion">
        <div class = "card">
            <div class = "card-header">
                <a class = "card-link" data-toggle = "collapse" href = "#Aadhaar">Aadhaar APIs</a>
            </div>
        <div id = "Aadhaar" class = "collapse" data-parent = "#accordion">
        <div class = "card-body">
            <div class = "row">
            <div class = "col-md-4">
                <span class = "badge badge-dark"><h3>Aadhaar APIs</h3></span>
            </div>
            <div class = "col-md-6">
                <span class = "badge badge-warning"><h4><u>Aadhaar Validation</u></h4></span><br>
                <p><b> Hitting URL : </b> http://regtechapi.in/api/aadhaar_validation</p>
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
                    <p><b> Hitting URL : </b> http://regtechapi.in/api/aadhaar_otp_genrate</p>
                    <b>Request Method : GET </b><br>
                    <b>Header : </b><br>
                    {<br>   
                    "AccessToken":"xxxxxxxxxxxxx"<br>
                    }<br>
                    <b>Request Body : </b><br>
                    {<br>   
                    "aadhaar_number":"868889041183"<br>
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
                    <p><b> Hitting URL : </b> http://regtechapi.in/api/aadhaar_otp_submit</p>
                    <b>Request Method : POST</b>
                    <b>Request Body :</b><br>
                    {<br>

                    "clientid": "@{{clientid}}",<br>
                    "otp": "@{{otp}}"<br>

                    }<br>
                    <b>Success Response : </b><br>
                    {<br>    "message": null,<br>
                    "success": true,<br>
                    "status_code": 200,<br>
                    "data": {<br>
                    "full_name": "Mohd.Asif Nazimuddin Sayyed",<br>
                    "has_image": true,<br>
                    "dob": "1995-10-04",<br>
                    "raw_xml": "https://aadhaar-api-docs.s3.amazonaws.com/docboyz/aadhaar_xml/474820200725131929442/474820200725131929442-2020-07-25-074929.xml?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Expires=432000&X-Amz-SignedHeaders=host&X-Amz-Credential=AKIARVQSU3FJ26BNVN6C%2F20200725%2Fap-south-1%2Fs3%2Faws4_request&X-Amz-Date=20200725T074929Z&X-Amz-Signature=b9e307b9511ae2b8ac3f5a9df2eba39f7e2fe9e24eb4225c641fb5549e8123cb",<br>
                    "address": {<br>
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
                    },<br>
                    "zip_data": "https://aadhaar-api-docs.s3.amazonaws.com/docboyz/aadhaar_xml/474820200725131929442/474820200725131929442-2020-07-25-074928.zip?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Expires=432000&X-Amz-SignedHeaders=host&X-Amz-Credential=AKIARVQSU3FJ26BNVN6C%2F20200725%2Fap-south-1%2Fs3%2Faws4_request&X-Amz-Date=20200725T074929Z&X-Amz-Signature=17669310952ee6b20b4371da6c69f20f2e97b8a922394cad095b2435d5a01e61",<br>
                    "share_code": "5929",<br>
                    "care_of": "",<br>
                    "zip": "411048",<br>
                    "face_status": false,<br>
                    "aadhaar_number": "592154824748",<br>
                    "profile_image": "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",<br>
                    "face_score": -1,<br>
                    "mobile_verified": false,<br>
                    "gender": "M",<br>
                    "client_id": "aadhaar_v2_UaMdUBdfmrSplknRSsep"<br>
                    },<br>
                    "message_code": "success"<br>
                }<br>
            </div>
            </div>
        </div>
        </div>
        </div>

        <!--PAN APIs-->
        <div class = "card">
            <div class = "card-header">
                <a class = "card-link" data-toggle = "collapse" href = "#PAN">PAN APIs</a>
            </div>
            <div id = "PAN" class = "collapse" data-parent = "#accordion">
                <div class = "card-body">
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
                <p><b> Hitting URL : </b>http://regtechapi.in/api/panupload</p>
                <b>Request form-data : </b><br>
                file – pancard image file<br>
                <br>
                <b>Success Response :</b>
                <br>
                <p>
                    "{\"data\":  {\"client_id\":  \"pan_photo_dfndubtlyasFUMojgfbw\",  \"pan_number\":  \"ARTPB4748P\",  \ "dob\":  \"04/07/1991\",  \"father_name\":  \"Hiralal  Chavan\",  \"full_name\":  \"Devanand Pannalal Sharma\",  \"strict_status\":  false,  \"strict_check\":  false,  \"individual_pan\":  true,  \"pan_confiden ce\":  99.0,  \"signature_confidence\":  0.0,  \"information_mismatch\":  [],  \"valid_pan\":  true},  \" status_code\":  200,  \"success\":  true,  \"message\":  null,  \"message_code\":  \"success\"}\n"
                </p>

                <!-- PAN INFO--->

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

                    <span class = "badge badge-warning"><h4><u>PAN Details</u></h4></span><br>
                    <p><b> Hitting URL : </b> http://regtechapi.in/api/pan_details_check</p>
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
                            &nbsp;&nbsp; "client_id": null,
                            "transactionId": "ZrRGcfiABRAK91NPE5ibBnqb",
                            "panNumber": "BPZPM1894M",
                            "maskedAadhar": "XXXXXXXX3390",
                            "lastFourDigitAadhar": "3390",
                            "typeOfHolder": "Individual or Person",
                            "name": "PRITESH LAXMAN MEHETRE",
                            "firstName": "PRITESH",
                            "middleName": "LAXMAN",
                            "lastName": "MEHETRE",
                            "gender": "M",
                            "dob": "18/04/1993",
                            "address": "Flat No. 3,Nilgiri nest - Pimple Gurav Pune - 411061 Maharashtra",
                            "city": "-",
                            "state": "Maharashtra",
                            "country": "INDIA",
                            "pincode": "411061",
                            "mobile_no": "9665189633",
                            "email": "priteshmehetre11@gmail.com",
                            "isValid": true,
                            "aadhaarSeedingStatus": true,
                            "serviceCode": "1",<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;}<br>
                            &nbsp;&nbsp;"status_code":200,  "success": true,
                             "message_code": "success"<br>
                            &nbsp;&nbsp;}<br>



                            &nbsp;&nbsp;}<br>
                        ]<br>
                    </p>
              </div>
                
                </div>
                </div>
            </div>
        </div>
    </div>

    <!--VOTER ID APIS-->
    <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#Voter" data-toggle="collapse">Ecredit</a>
        </div>
        <div id = "Voter" class = "collapse" data-parent="#accordion">
            <div class = "card-body">
                <div class="row">
                    <div class = "col-md-4">
                        <span class = "badge badge-dark"><h3>Ecredit APIs</h3></span>
                    </div>
                    <div class = "col-md-6">
                         <!-- VOTER ID UPLOAD -->
                         <span class = "badge badge-warning"><h4><u>Ecredit OTP</u></h4></span><br>
                        <p><b> Hitting URL : </b>http://regtechapi.in/api/ecreditsendOTP</p>
                        <b>Request Body : </b><br>
                        {<br>   
                        "phone_number":""<br>
                        }<br>
                        <b>Success Response :</b>
                        <br>
                        <p>
                        "{"success":  "OTP sent successfully"}\n"

                        </p>
                        <span class = "badge badge-warning"><h4><u>Ecredit_Report</u></h4></span><br>
                        <p><b> Hitting URL : </b>http://regtechapi.in/api/ecrediturl</p>
                        <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                        <b>Request Body : </b><br>
                        {<br>   
                        "fname":""<br>
                        "lname":""<br>
                        "phone_number":""<br>
                        "pan_num":""<br>
                        "dob":""<br>
                        "otp":""<br>
                        }<br>
                        <b>Success Response :</b><br>
                        {<br>
                       {
                        "Equifax_Report": {
                            "InquiryResponseHeader": {
                                "ClientID": "027FP27964",
                                "CustRefField": "DB-NIPL22110267",
                                "ReportOrderNO": "562166154",
                                "ProductCode": [
                                    "PCRLT"
                                ],
                                "SuccessCode": "1",
                                "Date": "2022-11-07",
                                "Time": "16:06:15"
                            },
                            "InquiryRequestInfo": {
                                "InquiryPurpose": "16",
                                "FirstName": "Tester",
                                "LastName": "tesr",
                                "InquiryPhones": [
                                    {
                                        "seq": "1",
                                        "PhoneType": [
                                            "M"
                                        ],
                                        "Number": "7776998208"
                                    }
                                ],
                                "IDDetails": [
                                    {
                                        "seq": "1",
                                        "IDType": "t",
                                        "IDValue": "BPZPM1894M",
                                        "Source": "Inquiry"
                                    }
                                ]
                            },
                            "Score": [
                                {
                                    "Type": "ERS",
                                    "Version": "3.1"
                                }
                            ],
                            "CCRResponse": {
                                "Status": "1",
                                "CIRReportDataLst": [
                                    {
                                        "InquiryResponseHeader": {
                                            "CustomerCode": "AFIB",
                                            "CustRefField": "DB-NIPL22110267",
                                            "ReportOrderNO": "562166154",
                                            "TranID": "4072023724",
                                            "ProductCode": [
                                                "PCRLT"
                                            ],
                                            "SuccessCode": "1",
                                            "Date": "2022-11-07",
                                            "Time": "16:06:14",
                                            "HitCode": "00"
                                        },
                                        "InquiryRequestInfo": {
                                            "InquiryPurpose": "Fleet Card",
                                            "FirstName": "Tester",
                                            "LastName": "tesr",
                                            "InquiryPhones": [
                                                {
                                                    "seq": "1",
                                                    "PhoneType": [
                                                        "M"
                                                    ],
                                                    "Number": "7776998208"
                                                }
                                            ],
                                            "IDDetails": [
                                                {
                                                    "seq": "1",
                                                    "IDType": "t",
                                                    "IDValue": "BPZPM1894M",
                                                    "Source": "Inquiry"
                                                }
                                            ],
                                            "CustomFields": [
                                                {
                                                    "key": "INQUERY_PRODUCT_CODE",
                                                    "value": "PCRLT"
                                                }
                                            ]
                                        },
                                        "Error": {
                                            "ErrorCode": "00",
                                            "ErrorDesc": "Consumer not found in bureau"
                                        }
                                    }
                                ]
                            }
                        },
                        "statusCode": "200"
                        }
                        }<br>

                

                            <!-- VOTER ID UPLOAD -->
                                <!-- <span class = "badge badge-warning"><h4><u>Voter ID Upload</u></h4></span><br>
                                <p><b> Hitting URL : </b>http://regtechapi.in/api/voter_upload</p>
                                <b>Request form-data : </b><br>
                                file – voter id image file<br>
                                <br>-
                                <b>Success Response :</b>
                                <br>
                                <p>
                                "{\"data\":  {\"client_id\":  \"ocr_voter_JJqCfxggzTMswegksvdp\",  \"ocr_fields\":  [{\"document_type
                                \":  \"voterid_front\",  \"full_name\":  {\"value\":  \"Rajesh\",  \"confidence\":  92.0},  \"age\":  {\" value\":  \"26\",  \"confidence\":  78.0},  \"care_of\":  {\"value\":  \"Saradaval\",  \"confidence\":  9 6.0},  \"dob\":  {\"value\":  \"1800-01-01\",  \"confidence\":  0.0},  \"doc\":  {\"value\":  \"2003-01- 01\",  \"confidence\":  95.0},  \"gender\":  {\"value\":  \"M\",  \"confidence\":  95.0},  \"epic_number\ ":  {\"value\":  \"MTG1947852\",  \"confidence\":  92.0}}]},  \"status_code\":  200,  \"success\":  true,
                                \"message\":  null,  \"message_code\":  \"success\"}\n"

                                </p> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!----Enach------->
    <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#Enach" data-toggle="collapse">Enach</a>
        </div>
        <div id = "Enach" class = "collapse" data-parent="#accordion">
            <div class = "card-body">
                <div class="row">
                    <div class = "col-md-4">
                        <span class = "badge badge-dark"><h3>Enach APIs</h3></span>
                    </div>
                    <div class = "col-md-6">
                         <!-- VOTER ID UPLOAD -->
                         <span class = "badge badge-warning"><h4><u>Seameless API</u></h4></span><br>
                        <p><b> Hitting URL : </b>http://regtechapi.in/api/search</p>
                        <b>Request Body : </b><br>
                        {<br>   
                        "seamlesstoken":""<br>
                        }<br>
                        <b>Success Response :</b>
                        <br>
                        <p>
                        "{
                        "statusCode": 200,
                        "Link": "https://regtechapi.in/enach_payment_seameless/7XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXf"
                    }\n"

                        </p>
                        <span class = "badge badge-warning"><h4><u>Non-seameless API</u></h4></span><br>
                        <p><b> Hitting URL : </b>http://regtechapi.in/api/search</p>
                        <b>Request Body : </b><br>
                        {<br>   
                        "accesstoken":""<br>
                        }<br>
                        <b>Success Response :</b>
                        <br>
                        <p>
                        "{
                        "statusCode": 200,
                        "Link": "https://regtechapi.in/e-nach-initiate-payments/7XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXf"
                    }\n"

                        </p>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!------Payment------------->
    <!----Enach------->
    <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#Payment" data-toggle="collapse">Payment Gateway</a>
        </div>
        <div id = "Payment" class = "collapse" data-parent="#accordion">
            <div class = "card-body">
                <div class="row">
                    <div class = "col-md-4">
                        <span class = "badge badge-dark"><h3>Payment Gateway APIs</h3></span>
                    </div>
                    <div class = "col-md-6">
                         <!-- VOTER ID UPLOAD -->
                         <span class = "badge badge-warning"><h4><u>Seameless API</u></h4></span><br>
                        <p><b> Hitting URL : </b>http://regtechapi.in/api/search</p>
                        <b>Request Body : </b><br>
                        {<br>   
                        "paymenttoken":""<br>
                        }<br>
                        <b>Success Response :</b>
                        <br>
                        <p>
                        "{
                        "statusCode": 200,
                        "Link": "https://regtechapi.in/initiate-payment-integrations/7XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXf"
                    }\n"

                        </p>
                       
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Equifax--->
    <!--Equifax Score Api Start--> 
 <div class = "card">
    <div class="card-header">
        <a class = "card-link" href = "#equifaxscore" data-toggle="collapse">CreditScoreOnly APIs</a>
    </div>
    <div id="equifaxscore" class = "collapse" data-parent="#equifaxscore">
        <div class = "card-body">
            <div class="row">
                <div class = "col-md-4">
                    <span class = "badge badge-dark"><h3>CreditScoreOnly APIs</h3></span>
                </div>
                <div class = "col-md-6">
                    <span class = "badge badge-warning"><h4><u>CreditScoreOnly APIs</u></h4></span><br>
                    <p><b> Hitting URL : </b>http://regtechapi.in/api/creditscoreonly</p>
                    <b>Header : </b><br>
                    {<br>   
                    "AccessToken":"xxxxxxxxxxxxx"<br>
                    }<br>
                    <b>Request Body : </b><br>
                    {<br>   
                    "FirstName":""<br>
                    "LastName":""<br>
                    "MobileNumber":""<br>
                    "IdValue":""<br>
                    "DOB":""<br>
                    
                    }<br>
                    <b>Success Response :</b><br>
                     {
                      "statusCode": 200,
                      "success": true,
                      "ScoreValue ": "497"
                     }
                    <br>

            

                <!-- VOTER ID UPLOAD -->
                    <!-- <span class = "badge badge-warning"><h4><u>Voter ID Upload</u></h4></span><br>
                    <p><b> Hitting URL : </b>http://regtechapi.in/api/voter_upload</p>
                    <b>Request form-data : </b><br>
                    file – voter id image file<br>
                    <br>-
                    <b>Success Response :</b>
                    <br>
                    <p>
                    "{\"data\":  {\"client_id\":  \"ocr_voter_JJqCfxggzTMswegksvdp\",  \"ocr_fields\":  [{\"document_type
                    \":  \"voterid_front\",  \"full_name\":  {\"value\":  \"Rajesh\",  \"confidence\":  92.0},  \"age\":  {\" value\":  \"26\",  \"confidence\":  78.0},  \"care_of\":  {\"value\":  \"Saradaval\",  \"confidence\":  9 6.0},  \"dob\":  {\"value\":  \"1800-01-01\",  \"confidence\":  0.0},  \"doc\":  {\"value\":  \"2003-01- 01\",  \"confidence\":  95.0},  \"gender\":  {\"value\":  \"M\",  \"confidence\":  95.0},  \"epic_number\ ":  {\"value\":  \"MTG1947852\",  \"confidence\":  92.0}}]},  \"status_code\":  200,  \"success\":  true,
                    \"message\":  null,  \"message_code\":  \"success\"}\n"

                    </p> -->
                </div>
            </div>
        </div>
    </div>
</div>
 <!---Equifax without otp------->
 <div class = "card">
    <div class = "card-header">
        <a class = "card-link" href = "#telecom" data-toggle="collapse">Ecredit Without Otp</a>
    </div>
    <div id = "telecom" class = "collapse" data-parent="#accordion">
        <div class = "card-body">
            <div class="row">
                <div class = "col-md-4">
                    <span class = "badge badge-dark"><h3>Ecredit Without OTP APIs</h3></span>
                </div>
                <div class = "col-md-6">
                    <span class = "badge badge-warning"><h4><u>Ecredit_Report</u></h4></span><br>
                    <p><b> Hitting URL : </b>http://regtechapi.in/api/ecredit</p>
                    <b>Header : </b><br>
                    {<br>   
                    "AccessToken":"xxxxxxxxxxxxx"<br>
                    }<br>
                    <b>Request Body : </b><br>
                    {<br>   
                    "fname":""<br>
                    "lname":""<br>
                    "phone_number":""<br>
                    "pan_num":""<br>
                    "dob":""<br>
                    
                    }<br>
                    <b>Success Response :</b><br>
                    {<br>
                   {
"Equifax_Report": {
    "InquiryResponseHeader": {
        "ClientID": "027FP27964",
        "CustRefField": "DB-NIPL22110267",
        "ReportOrderNO": "562166154",
        "ProductCode": [
            "PCRLT"
        ],
        "SuccessCode": "1",
        "Date": "2022-11-07",
        "Time": "16:06:15"
    },
    "InquiryRequestInfo": {
        "InquiryPurpose": "16",
        "FirstName": "Tester",
        "LastName": "tesr",
        "InquiryPhones": [
            {
                "seq": "1",
                "PhoneType": [
                    "M"
                ],
                "Number": "7776998208"
            }
        ],
        "IDDetails": [
            {
                "seq": "1",
                "IDType": "t",
                "IDValue": "BPZPM1894M",
                "Source": "Inquiry"
            }
        ]
    },
    "Score": [
        {
            "Type": "ERS",
            "Version": "3.1"
        }
    ],
    "CCRResponse": {
        "Status": "1",
        "CIRReportDataLst": [
            {
                "InquiryResponseHeader": {
                    "CustomerCode": "AFIB",
                    "CustRefField": "DB-NIPL22110267",
                    "ReportOrderNO": "562166154",
                    "TranID": "4072023724",
                    "ProductCode": [
                        "PCRLT"
                    ],
                    "SuccessCode": "1",
                    "Date": "2022-11-07",
                    "Time": "16:06:14",
                    "HitCode": "00"
                },
                "InquiryRequestInfo": {
                    "InquiryPurpose": "Fleet Card",
                    "FirstName": "Tester",
                    "LastName": "tesr",
                    "InquiryPhones": [
                        {
                            "seq": "1",
                            "PhoneType": [
                                "M"
                            ],
                            "Number": "7776998208"
                        }
                    ],
                    "IDDetails": [
                        {
                            "seq": "1",
                            "IDType": "t",
                            "IDValue": "BPZPM1894M",
                            "Source": "Inquiry"
                        }
                    ],
                    "CustomFields": [
                        {
                            "key": "INQUERY_PRODUCT_CODE",
                            "value": "PCRLT"
                        }
                    ]
                },
                "Error": {
                    "ErrorCode": "00",
                    "ErrorDesc": "Consumer not found in bureau"
                }
            }
        ]
    }
},
"statusCode": "200"
}
                    }<br>

            

                <!-- VOTER ID UPLOAD -->
                    <!-- <span class = "badge badge-warning"><h4><u>Voter ID Upload</u></h4></span><br>
                    <p><b> Hitting URL : </b>http://regtechapi.in/api/voter_upload</p>
                    <b>Request form-data : </b><br>
                    file – voter id image file<br>
                    <br>-
                    <b>Success Response :</b>
                    <br>
                    <p>
                    "{\"data\":  {\"client_id\":  \"ocr_voter_JJqCfxggzTMswegksvdp\",  \"ocr_fields\":  [{\"document_type
                    \":  \"voterid_front\",  \"full_name\":  {\"value\":  \"Rajesh\",  \"confidence\":  92.0},  \"age\":  {\" value\":  \"26\",  \"confidence\":  78.0},  \"care_of\":  {\"value\":  \"Saradaval\",  \"confidence\":  9 6.0},  \"dob\":  {\"value\":  \"1800-01-01\",  \"confidence\":  0.0},  \"doc\":  {\"value\":  \"2003-01- 01\",  \"confidence\":  95.0},  \"gender\":  {\"value\":  \"M\",  \"confidence\":  95.0},  \"epic_number\ ":  {\"value\":  \"MTG1947852\",  \"confidence\":  92.0}}]},  \"status_code\":  200,  \"success\":  true,
                    \"message\":  null,  \"message_code\":  \"success\"}\n"

                    </p> -->
                </div>
            </div>
        </div>
    </div>
</div>
<!---Equifax without otp end--->
     <!---Equifax with Pdf ------->
    <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#telecom1" data-toggle="collapse">Ecredit With Pdf</a>
        </div>
        <div id= "telecom1" class = "collapse" data-parent="#accordion">
            <div class = "card-body">
                <div class="row">
                    <div class = "col-md-4">
                        <span class = "badge badge-dark"><h3>Ecredit With Pdf</h3></span>
                    </div>
                    <div class = "col-md-6">
                        <span class = "badge badge-warning"><h4><u>Ecredit_Report</u></h4></span><br>
                        <p><b> Hitting URL : </b>http://regtechapi.in/api/ecreditv2</p>
                        <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                        <b>Request Body : </b><br>
                        {<br>   
                        "fname":""<br>
                        "lname":""<br>
                        "phone_number":""<br>
                        "pan_num":""<br>
                        "dob":""<br>
                        
                        }<br>
                        <b>Success Response :</b><br>
                        {<br>
                       {
                        {
                            "equifax": {
                                "Equifax_Report": {
                                    "InquiryResponseHeader": {
                                        "ClientID": "027FP27964",
                                        "CustRefField": "DB-A24010267",
                                        "ReportOrderNO": "1158442222",
                                        "ProductCode": [
                                            "PCRLT"
                                        ],
                                        "SuccessCode": "1",
                                        "Date": "2024-01-10",
                                        "Time": "16:36:47"
                                    },
                                    "InquiryRequestInfo": {
                                        "InquiryPurpose": "16",
                                        "FirstName": "GOVIND",
                                        "LastName": "KUMAR METHI",
                                        "InquiryPhones": [
                                            {
                                                "seq": "1",
                                                "PhoneType": [
                                                    "M"
                                                ],
                                                "Number": "9828033702"
                                            }
                                        ],
                                        "IDDetails": [
                                            {
                                                "seq": "1",
                                                "IDType": "t",
                                                "IDValue": "AEEPM7144M",
                                                "Source": "Inquiry"
                                            }
                                        ],
                                        "DOB": "11 /04 /1969"
                                    },
                                    "Score": [
                                        {
                                            "Type": "ERS",
                                            "Version": "3.1"
                                        }
                                    ],
                                    "CCRResponse": {
                                        "Status": "1",
                                        "CIRReportDataLst": [
                                            {
                                                "InquiryResponseHeader": {
                                                    "CustomerCode": "AFIB",
                                                    "CustRefField": "DB-A24010267",
                                                    "ReportOrderNO": "1158442222",
                                                    "TranID": "5839634254",
                                                    "ProductCode": [
                                                        "PCRLT"
                                                    ],
                                                    "SuccessCode": "1",
                                                    "Date": "2024-01-10",
                                                    "Time": "16:36:46",
                                                    "HitCode": "10",
                                                    "CustomerName": "AFIB"
                                                },
                                                "InquiryRequestInfo": {
                                                    "InquiryPurpose": "Fleet Card",
                                                    "FirstName": "GOVIND",
                                                    "LastName": "KUMAR METHI",
                                                    "InquiryPhones": [
                                                        {
                                                            "seq": "1",
                                                            "PhoneType": [
                                                                "M"
                                                            ],
                                                            "Number": "9828033702"
                                                        }
                                                    ],
                                                    "IDDetails": [
                                                        {
                                                            "seq": "1",
                                                            "IDType": "t",
                                                            "IDValue": "AEEPM7144M",
                                                            "Source": "Inquiry"
                                                        }
                                                    ],
                                                    "DOB": "11 /04 /1969",
                                                    "CustomFields": [
                                                        {
                                                            "key": "INQUERY_PRODUCT_CODE",
                                                            "value": "PCRLT"
                                                        }
                                                    ]
                                                },
                                                "Score": [
                                                    {
                                                        "Type": "ERS",
                                                        "Version": "3.1"
                                                    }
                                                ],
                                                "CIRReportData": {
                                                    "IDAndContactInfo": {
                                                        "PersonalInfo": {
                                                            "Name": {
                                                                "FullName": "GOVIND KUMAR METHI ",
                                                                "FirstName": "GOVIND ",
                                                                "MiddleName": "KUMAR ",
                                                                "LastName": "METHI "
                                                            },
                                                            "DateOfBirth": "1969-04-11",
                                                            "Gender": "Male",
                                                            "Age": {
                                                                "Age": "54"
                                                            },
                                                            "TotalIncome": "5000",
                                                            "Occupation": "SALARIED"
                                                        },
                                                        "IdentityInfo": {
                                                            "PANId": [
                                                                {
                                                                    "seq": "1",
                                                                    "ReportedDate": "2022-03-31",
                                                                    "IdNumber": "AEEPM7144M"
                                                                }
                                                            ],
                                                            "DriverLicense": [
                                                                {
                                                                    "seq": "1",
                                                                    "ReportedDate": "2012-08-31",
                                                                    "IdNumber": "9622240"
                                                                }
                                                            ]
                                                        },
                                                        "AddressInfo": [
                                                            {
                                                                "Seq": "1",
                                                                "ReportedDate": "2021-06-30",
                                                                "Address": "F 6/241 CHITRAKOOT SCHEME AJMER ROAD  JAIPUR",
                                                                "State": "RJ",
                                                                "Postal": "302006"
                                                            },
                                                            {
                                                                "Seq": "2",
                                                                "ReportedDate": "2020-04-18",
                                                                "Address": "R G A N COMPANY  NO-21 ACHROL HOUSE  CIVIL LIN JAIPUR IND",
                                                                "State": "RJ",
                                                                "Postal": "302006",
                                                                "Type": "Office"
                                                            },
                                                            {
                                                                "Seq": "3",
                                                                "ReportedDate": "2020-04-18",
                                                                "Address": "F 6/241 CHITRAKOOT SCHEME AJMER ROAD  JAIPUR",
                                                                "State": "RJ",
                                                                "Postal": "302021",
                                                                "Type": "Owns,Permanent"
                                                            },
                                                            {
                                                                "Seq": "4",
                                                                "ReportedDate": "2014-08-22",
                                                                "Address": "F 6/241 CHITRAKOOT SCHEME AJMER ROAD  JAIPUR",
                                                                "State": "RJ",
                                                                "Postal": "302021",
                                                                "Type": "Rents,Primary"
                                                            },
                                                            {
                                                                "Seq": "5",
                                                                "ReportedDate": "2013-01-18",
                                                                "Address": "R G A N COMPANY  R G A N COMPANY  NO-21 ACHROL HOUSE  CIVIL LIN JAIPUR IND",
                                                                "State": "RJ",
                                                                "Postal": "302006",
                                                                "Type": "Office"
                                                            }
                                                        ],
                                                        "PhoneInfo": [
                                                            {
                                                                "seq": "1",
                                                                "typeCode": "H",
                                                                "ReportedDate": "2020-04-18",
                                                                "Number": "09828033702"
                                                            },
                                                            {
                                                                "seq": "2",
                                                                "typeCode": "H",
                                                                "ReportedDate": "2021-06-30",
                                                                "Number": "819210009"
                                                            },
                                                            {
                                                                "seq": "3",
                                                                "typeCode": "M",
                                                                "ReportedDate": "2020-04-18",
                                                                "Number": "09828033702"
                                                            },
                                                            {
                                                                "seq": "4",
                                                                "typeCode": "M",
                                                                "ReportedDate": "2021-09-30",
                                                                "Number": "9828033702"
                                                            },
                                                            {
                                                                "seq": "5",
                                                                "typeCode": "T",
                                                                "ReportedDate": "2020-04-18",
                                                                "Number": "00002223201"
                                                            },
                                                            {
                                                                "seq": "6",
                                                                "typeCode": "T",
                                                                "ReportedDate": "2020-04-17",
                                                                "Number": "01412223201"
                                                            }
                                                        ],
                                                        "EmailAddressInfo": [
                                                            {
                                                                "seq": "1",
                                                                "ReportedDate": "2012-01-31",
                                                                "EmailAddress": "METHIGOVINDKUMAR@YAHOO.COM"
                                                            }
                                                        ]
                                                    },
                                                    "RetailAccountDetails": [
                                                        {
                                                            "seq": "1",
                                                            "id": "2047085740",
                                                            "AccountNumber": "0001014480000502688",
                                                            "Institution": "HDFC Bank Limited",
                                                            "AccountType": "Credit Card",
                                                            "OwnershipType": "Individual",
                                                            "Balance": "2949",
                                                            "Open": "Yes",
                                                            "HighCredit": "75192",
                                                            "LastPaymentDate": "2023-09-18",
                                                            "DateReported": "2023-10-31",
                                                            "DateOpened": "2021-09-28",
                                                            "CreditLimit": "500000",
                                                            "AccountStatus": "Current Account",
                                                            "source": "INDIVIDUAL",
                                                            "History48Months": [
                                                                {
                                                                    "key": "10-23",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "09-23",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "08-23",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "07-23",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "06-23",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "05-23",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "04-23",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "03-23",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "02-23",
                                                                    "PaymentStatus": "*",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "01-23",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "12-22",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "11-22",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "10-22",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "09-22",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "08-22",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "07-22",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "06-22",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "05-22",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "04-22",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "03-22",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "02-22",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "01-22",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "12-21",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "11-21",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "10-21",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "09-21",
                                                                    "PaymentStatus": "NEW",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                }
                                                            ]
                                                        },
                                                        {
                                                            "seq": "2",
                                                            "id": "2070823430",
                                                            "AccountNumber": "00000040429582187",
                                                            "Institution": "State Bank Of India",
                                                            "AccountType": "Auto Loan",
                                                            "OwnershipType": "Individual",
                                                            "Balance": "34978",
                                                            "Open": "Yes",
                                                            "SanctionAmount": "275000",
                                                            "DateReported": "2023-11-30",
                                                            "DateOpened": "2021-09-09",
                                                            "InterestRate": "8.0",
                                                            "RepaymentTenure": "36",
                                                            "InstallmentAmount": "8555",
                                                            "TermFrequency": "Monthly",
                                                            "CollateralValue": "861899",
                                                            "CollateralType": "Property",
                                                            "AccountStatus": "Standard",
                                                            "AssetClassification": "Standard",
                                                            "source": "INDIVIDUAL",
                                                            "History48Months": [
                                                                {
                                                                    "key": "11-23",
                                                                    "PaymentStatus": "STD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "STD"
                                                                },
                                                                {
                                                                    "key": "10-23",
                                                                    "PaymentStatus": "STD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "STD"
                                                                },
                                                                {
                                                                    "key": "09-23",
                                                                    "PaymentStatus": "STD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "STD"
                                                                },
                                                                {
                                                                    "key": "08-23",
                                                                    "PaymentStatus": "STD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "STD"
                                                                },
                                                                {
                                                                    "key": "07-23",
                                                                    "PaymentStatus": "STD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "STD"
                                                                },
                                                                {
                                                                    "key": "06-23",
                                                                    "PaymentStatus": "STD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "STD"
                                                                },
                                                                {
                                                                    "key": "05-23",
                                                                    "PaymentStatus": "STD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "STD"
                                                                },
                                                                {
                                                                    "key": "04-23",
                                                                    "PaymentStatus": "STD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "STD"
                                                                },
                                                                {
                                                                    "key": "03-23",
                                                                    "PaymentStatus": "STD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "STD"
                                                                },
                                                                {
                                                                    "key": "02-23",
                                                                    "PaymentStatus": "STD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "STD"
                                                                },
                                                                {
                                                                    "key": "01-23",
                                                                    "PaymentStatus": "STD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "STD"
                                                                },
                                                                {
                                                                    "key": "12-22",
                                                                    "PaymentStatus": "STD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "STD"
                                                                },
                                                                {
                                                                    "key": "11-22",
                                                                    "PaymentStatus": "STD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "STD"
                                                                },
                                                                {
                                                                    "key": "10-22",
                                                                    "PaymentStatus": "STD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "STD"
                                                                },
                                                                {
                                                                    "key": "09-22",
                                                                    "PaymentStatus": "STD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "STD"
                                                                },
                                                                {
                                                                    "key": "08-22",
                                                                    "PaymentStatus": "STD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "STD"
                                                                },
                                                                {
                                                                    "key": "07-22",
                                                                    "PaymentStatus": "STD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "STD"
                                                                },
                                                                {
                                                                    "key": "06-22",
                                                                    "PaymentStatus": "STD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "STD"
                                                                },
                                                                {
                                                                    "key": "05-22",
                                                                    "PaymentStatus": "STD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "STD"
                                                                },
                                                                {
                                                                    "key": "04-22",
                                                                    "PaymentStatus": "STD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "STD"
                                                                },
                                                                {
                                                                    "key": "03-22",
                                                                    "PaymentStatus": "STD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "STD"
                                                                },
                                                                {
                                                                    "key": "02-22",
                                                                    "PaymentStatus": "STD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "STD"
                                                                },
                                                                {
                                                                    "key": "01-22",
                                                                    "PaymentStatus": "STD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "STD"
                                                                },
                                                                {
                                                                    "key": "12-21",
                                                                    "PaymentStatus": "STD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "STD"
                                                                },
                                                                {
                                                                    "key": "11-21",
                                                                    "PaymentStatus": "STD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "STD"
                                                                },
                                                                {
                                                                    "key": "10-21",
                                                                    "PaymentStatus": "STD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "STD"
                                                                },
                                                                {
                                                                    "key": "09-21",
                                                                    "PaymentStatus": "NEW",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "STD"
                                                                }
                                                            ]
                                                        },
                                                        {
                                                            "seq": "3",
                                                            "id": "258053739",
                                                            "AccountNumber": "0005241826439337474",
                                                            "Institution": "SBI Cards and Payment Services Ltd",
                                                            "AccountType": "Credit Card",
                                                            "OwnershipType": "Individual",
                                                            "Balance": "0",
                                                            "PastDueAmount": "0",
                                                            "Open": "No",
                                                            "HighCredit": "62523",
                                                            "LastPaymentDate": "2021-10-02",
                                                            "DateReported": "2023-09-17",
                                                            "DateOpened": "2007-12-21",
                                                            "DateClosed": "2022-11-30",
                                                            "Reason": "Closed Account",
                                                            "TermFrequency": "Monthly",
                                                            "CreditLimit": "630000",
                                                            "AccountStatus": "Closed Account",
                                                            "source": "INDIVIDUAL",
                                                            "History48Months": [
                                                                {
                                                                    "key": "09-23",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "08-23",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "07-23",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "06-23",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "05-23",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "04-23",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "03-23",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "02-23",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "01-23",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "12-22",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "11-22",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "10-22",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "09-22",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "08-22",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "07-22",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "06-22",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "05-22",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "04-22",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "03-22",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "02-22",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "01-22",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "12-21",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "11-21",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "10-21",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "09-21",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "08-21",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "07-21",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "06-21",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "05-21",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "04-21",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "03-21",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "02-21",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "01-21",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "12-20",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "11-20",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "10-20",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "09-20",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "08-20",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "07-20",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "06-20",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "05-20",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "04-20",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "03-20",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "02-20",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "01-20",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "12-19",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "11-19",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "10-19",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                }
                                                            ]
                                                        },
                                                        {
                                                            "seq": "4",
                                                            "id": "243649109",
                                                            "AccountNumber": "5241330522904050",
                                                            "Institution": "Citibank",
                                                            "AccountType": "Credit Card",
                                                            "OwnershipType": "Individual",
                                                            "Balance": "0",
                                                            "PastDueAmount": "0",
                                                            "LastPayment": "6028",
                                                            "Open": "No",
                                                            "HighCredit": "129773",
                                                            "LastPaymentDate": "2022-07-04",
                                                            "DateReported": "2023-02-18",
                                                            "DateOpened": "2005-10-29",
                                                            "DateClosed": "2023-02-17",
                                                            "Reason": "Closed Account",
                                                            "InterestRate": "45.0",
                                                            "TermFrequency": "Monthly",
                                                            "CreditLimit": "48000",
                                                            "AccountStatus": "Closed Account",
                                                            "source": "INDIVIDUAL",
                                                            "History48Months": [
                                                                {
                                                                    "key": "02-23",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "01-23",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "12-22",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "11-22",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "10-22",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "09-22",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "08-22",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "07-22",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "06-22",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "05-22",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "04-22",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "03-22",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "02-22",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "01-22",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "12-21",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "11-21",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "10-21",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "09-21",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "08-21",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "07-21",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "06-21",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "05-21",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "04-21",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "03-21",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "02-21",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "01-21",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "12-20",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "11-20",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "10-20",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "09-20",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "08-20",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "07-20",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "06-20",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "05-20",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "04-20",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "03-20",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "02-20",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "01-20",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "12-19",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "11-19",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "10-19",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "09-19",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "08-19",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "07-19",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "06-19",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "05-19",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "04-19",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "03-19",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                }
                                                            ]
                                                        },
                                                        {
                                                            "seq": "5",
                                                            "id": "44206149",
                                                            "AccountNumber": "701537",
                                                            "Institution": "Citibank",
                                                            "AccountType": "Housing Loan",
                                                            "OwnershipType": "Individual",
                                                            "Balance": "0",
                                                            "PastDueAmount": "0",
                                                            "LastPayment": "10161",
                                                            "Open": "No",
                                                            "SanctionAmount": "800000",
                                                            "LastPaymentDate": "2021-06-15",
                                                            "DateReported": "2021-06-30",
                                                            "DateOpened": "2005-01-25",
                                                            "DateClosed": "2021-06-15",
                                                            "Reason": "Closed Account",
                                                            "RepaymentTenure": "180",
                                                            "TermFrequency": "Monthly",
                                                            "CollateralType": "Property",
                                                            "AccountStatus": "Closed Account",
                                                            "source": "INDIVIDUAL",
                                                            "History48Months": [
                                                                {
                                                                    "key": "06-21",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "05-21",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "04-21",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "03-21",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "02-21",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "01-21",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "12-20",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "11-20",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "10-20",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "09-20",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "08-20",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "07-20",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "06-20",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "05-20",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "04-20",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "03-20",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "02-20",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "01-20",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "12-19",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "11-19",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "10-19",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "09-19",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "08-19",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "07-19",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "06-19",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "05-19",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "04-19",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "03-19",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "02-19",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "01-19",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "12-18",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "11-18",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "10-18",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "09-18",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "08-18",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "07-18",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "06-18",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "05-18",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "04-18",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "03-18",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "02-18",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "01-18",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "12-17",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "11-17",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "10-17",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "09-17",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "08-17",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "07-17",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                }
                                                            ]
                                                        },
                                                        {
                                                            "seq": "6",
                                                            "id": "45099739",
                                                            "AccountNumber": "4386280223122007",
                                                            "Institution": "Citibank",
                                                            "AccountType": "Credit Card",
                                                            "OwnershipType": "Individual",
                                                            "Balance": "0",
                                                            "PastDueAmount": "0",
                                                            "Open": "No",
                                                            "LastPaymentDate": "2009-05-01",
                                                            "DateReported": "2021-04-17",
                                                            "DateOpened": "2007-11-29",
                                                            "DateClosed": "2012-02-18",
                                                            "Reason": "Closed Account",
                                                            "InterestRate": "17.88",
                                                            "TermFrequency": "Monthly",
                                                            "CreditLimit": "91000",
                                                            "AccountStatus": "Closed Account",
                                                            "source": "INDIVIDUAL",
                                                            "History48Months": [
                                                                {
                                                                    "key": "04-21",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "03-21",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "02-21",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "01-21",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "12-20",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "11-20",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "10-20",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "09-20",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "08-20",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "07-20",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "06-20",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "05-20",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "04-20",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "03-20",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "02-20",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "01-20",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "12-19",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "11-19",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "10-19",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "09-19",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "08-19",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "07-19",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "06-19",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "05-19",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "04-19",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "03-19",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "02-19",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "01-19",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "12-18",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "11-18",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "10-18",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "09-18",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "08-18",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "07-18",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "06-18",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "05-18",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "04-18",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "03-18",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "02-18",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "01-18",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "12-17",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "11-17",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "10-17",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "09-17",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "08-17",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "07-17",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "06-17",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "05-17",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                }
                                                            ]
                                                        },
                                                        {
                                                            "seq": "7",
                                                            "id": "581244211",
                                                            "AccountNumber": "4476929995902738",
                                                            "Institution": "Hongkong and Shanghai Banking Corporation Limited",
                                                            "AccountType": "Credit Card",
                                                            "OwnershipType": "Individual",
                                                            "Balance": "0",
                                                            "PastDueAmount": "0",
                                                            "Open": "No",
                                                            "HighCredit": "54328",
                                                            "LastPaymentDate": "2006-11-13",
                                                            "DateReported": "2013-12-31",
                                                            "DateOpened": "2006-05-19",
                                                            "DateClosed": "2008-03-18",
                                                            "Reason": "Closed Account",
                                                            "CreditLimit": "40000",
                                                            "AccountStatus": "Closed Account",
                                                            "source": "INDIVIDUAL",
                                                            "History48Months": [
                                                                {
                                                                    "key": "12-13",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "11-13",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "10-13",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "09-13",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "08-13",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "07-13",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "06-13",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "05-13",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "04-13",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "03-13",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "02-13",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "01-13",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "12-12",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "11-12",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "10-12",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "09-12",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "08-12",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "07-12",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "06-12",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "05-12",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "04-12",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "03-12",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "02-12",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "01-12",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                }
                                                            ]
                                                        },
                                                        {
                                                            "seq": "8",
                                                            "id": "70605781",
                                                            "AccountNumber": "930000466944",
                                                            "Institution": "Barclays Bank PLC",
                                                            "AccountType": "Credit Card",
                                                            "OwnershipType": "Individual",
                                                            "Balance": "0",
                                                            "PastDueAmount": "0",
                                                            "Open": "No",
                                                            "HighCredit": "0",
                                                            "DateReported": "2012-06-30",
                                                            "DateOpened": "2008-02-12",
                                                            "DateClosed": "2009-08-22",
                                                            "Reason": "Closed Account",
                                                            "TermFrequency": "Monthly",
                                                            "CreditLimit": "10000",
                                                            "AccountStatus": "Closed Account",
                                                            "source": "INDIVIDUAL",
                                                            "History48Months": [
                                                                {
                                                                    "key": "06-12",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "05-12",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "04-12",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "03-12",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "02-12",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "01-12",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "12-11",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "11-11",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "10-11",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "09-11",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "08-11",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "07-11",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "06-11",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "05-11",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "04-11",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "03-11",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "02-11",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "01-11",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                }
                                                            ]
                                                        },
                                                        {
                                                            "seq": "9",
                                                            "id": "59730158",
                                                            "AccountNumber": "0005101286924473301",
                                                            "Institution": "SBI Cards and Payment Services Ltd",
                                                            "AccountType": "Credit Card",
                                                            "OwnershipType": "Individual",
                                                            "Balance": "0",
                                                            "PastDueAmount": "0",
                                                            "Open": "No",
                                                            "HighCredit": "11623",
                                                            "LastPaymentDate": "2011-08-04",
                                                            "DateReported": "2012-05-31",
                                                            "DateOpened": "2007-12-21",
                                                            "DateClosed": "2011-08-30",
                                                            "Reason": "Closed Account",
                                                            "AccountStatus": "Closed Account",
                                                            "source": "INDIVIDUAL",
                                                            "History48Months": [
                                                                {
                                                                    "key": "05-12",
                                                                    "PaymentStatus": "CLSD",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "04-12",
                                                                    "PaymentStatus": "*",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "03-12",
                                                                    "PaymentStatus": "*",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "02-12",
                                                                    "PaymentStatus": "*",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "01-12",
                                                                    "PaymentStatus": "*",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "12-11",
                                                                    "PaymentStatus": "*",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "11-11",
                                                                    "PaymentStatus": "*",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "10-11",
                                                                    "PaymentStatus": "*",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "09-11",
                                                                    "PaymentStatus": "*",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "08-11",
                                                                    "PaymentStatus": "*",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "07-11",
                                                                    "PaymentStatus": "*",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "06-11",
                                                                    "PaymentStatus": "*",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "05-11",
                                                                    "PaymentStatus": "*",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "04-11",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "03-11",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "02-11",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "01-11",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "12-10",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "11-10",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "10-10",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "09-10",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                },
                                                                {
                                                                    "key": "08-10",
                                                                    "PaymentStatus": "000",
                                                                    "SuitFiledStatus": "*",
                                                                    "AssetClassificationStatus": "*"
                                                                }
                                                            ]
                                                        }
                                                    ],
                                                    "RetailAccountsSummary": {
                                                        "NoOfAccounts": "9",
                                                        "NoOfActiveAccounts": "2",
                                                        "NoOfWriteOffs": "0",
                                                        "TotalPastDue": "0.00",
                                                        "MostSevereStatusWithIn24Months": "Std",
                                                        "SingleHighestCredit": "75192.00",
                                                        "SingleHighestSanctionAmount": "275000.00",
                                                        "TotalHighCredit": "75192.00",
                                                        "AverageOpenBalance": "18963.50",
                                                        "SingleHighestBalance": "34978.00",
                                                        "NoOfPastDueAccounts": "0",
                                                        "NoOfZeroBalanceAccounts": "0",
                                                        "RecentAccount": "Credit Card on 28-09-2021",
                                                        "OldestAccount": "Housing Loan on 25-01-2005",
                                                        "TotalBalanceAmount": "37927.00",
                                                        "TotalSanctionAmount": "275000.00",
                                                        "TotalCreditLimit": "500000.0",
                                                        "TotalMonthlyPaymentAmount": "8555.00"
                                                    },
                                                    "ScoreDetails": [
                                                        {
                                                            "Type": "ERS",
                                                            "Version": "4.0",
                                                            "Name": "ERS4.0",
                                                            "Value": "843",
                                                            "ScoringElements": [
                                                                {
                                                                    "type": "RES",
                                                                    "seq": "1",
                                                                    "code": "703",
                                                                    "Description": "Total Utilization"
                                                                },
                                                                {
                                                                    "type": "RES",
                                                                    "seq": "2",
                                                                    "code": "702",
                                                                    "Description": "Total Credit Exposure"
                                                                },
                                                                {
                                                                    "type": "RES",
                                                                    "seq": "3",
                                                                    "code": "706",
                                                                    "Description": "Number of Inquiries"
                                                                }
                                                            ]
                                                        }
                                                    ],
                                                    "Enquiries": [
                                                        {
                                                            "seq": "0",
                                                            "Institution": "CREDITACCESS GRAMEEN LIMITED",
                                                            "Date": "2022-07-08",
                                                            "Time": "08:04",
                                                            "RequestPurpose": "00",
                                                            "Amount": "16000"
                                                        },
                                                        {
                                                            "seq": "1",
                                                            "Institution": "HDFC Bank Limited",
                                                            "Date": "2021-09-28",
                                                            "Time": "11:53",
                                                            "RequestPurpose": "10",
                                                            "Amount": "1000"
                                                        },
                                                        {
                                                            "seq": "2",
                                                            "Institution": "HDFCBANKeHDFCLTD",
                                                            "Date": "2019-09-25",
                                                            "Time": "13:08",
                                                            "RequestPurpose": "02",
                                                            "Amount": "2000000"
                                                        },
                                                        {
                                                            "seq": "3",
                                                            "Institution": "L & T Finance",
                                                            "Date": "2018-07-12",
                                                            "Time": "17:18",
                                                            "RequestPurpose": "00",
                                                            "Amount": "1000"
                                                        }
                                                    ],
                                                    "EnquirySummary": {
                                                        "Purpose": "ALL",
                                                        "Total": "4",
                                                        "Past30Days": "0",
                                                        "Past12Months": "0",
                                                        "Past24Months": "1",
                                                        "Recent": "2022-07-08"
                                                    },
                                                    "OtherKeyInd": {
                                                        "AgeOfOldestTrade": "228",
                                                        "NumberOfOpenTrades": "2",
                                                        "AllLinesEVERWritten": "0.00",
                                                        "AllLinesEVERWrittenIn9Months": "0",
                                                        "AllLinesEVERWrittenIn6Months": "0"
                                                    },
                                                    "RecentActivities": {
                                                        "AccountsDeliquent": "0",
                                                        "AccountsOpened": "0",
                                                        "TotalInquiries": "0",
                                                        "AccountsUpdated": "2"
                                                    }
                                                }
                                            }
                                        ]
                                    }
                                },
                                "statusCode": "200"
                            },
                            "equfax_report": "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NjA0IDAwMDAwIG4gCjAwMDAwMDA3MDcgMDAwMDAgbiAKMDAwMDAwMjk1NiAwMDAwMCBuIAowMDAwMDAzMDY1IDAwMDAwIG4gCjAwMDAwMDMxNzMgMDAwMDAgbiAKMDAwMDAwMzI4NCAwMDAwMCBuIAowMDAwMDEwNTI4IDAwMDAwIG4gCjAwMDAwMTA1ODggMDAwMDAgbiAKMDAwMDAxMDY0OCAwMDAwMCBuIAowMDAwMDEwNzA1IDAwMDAwIG4gCjAwMDAwMTA3NjIgMDAwMDAgbiAKMDAwMDAxMDg2NyAwMDAwMCBuIAowMDAwMDE0MDExIDAwMDAwIG4gCjAwMDAwMTQxMTYgMDAwMDAgbiAKMDAwMDAxODg4NSAwMDAwMCBuIAowMDAwMDE4OTkwIDAwMDAwIG4gCjAwMDAwMjI1NjAgMDAwMDAgbiAKMDAwMDAyMjY2NSAwMDAwMCBuIAp0cmFpbGVyCjw8Ci9TaXplIDI0Ci9Sb290IDEgMCBSCi9JbmZvIDUgMCBSCi9JRFs8Y2NmNzc1N2U5ZWViZWQyMGI2MmYyZTIyZWZhODg0OTI+PGNjZjc3NTdlOWVlYmVkMjBiNjJmMmUyMmVmYTg4NDkyPl0KPj4Kc3RhcnR4cmVmCjI1MDYzCiUlRU9GCg=="
                        }
  
             "statusCode": "200"
             }
                        }<br>

                

                    <!-- VOTER ID UPLOAD -->
                        <!-- <span class = "badge badge-warning"><h4><u>Voter ID Upload</u></h4></span><br>
                        <p><b> Hitting URL : </b>http://regtechapi.in/api/voter_upload</p>
                        <b>Request form-data : </b><br>
                        file – voter id image file<br>
                        <br>-
                        <b>Success Response :</b>
                        <br>
                        <p>
                        "{\"data\":  {\"client_id\":  \"ocr_voter_JJqCfxggzTMswegksvdp\",  \"ocr_fields\":  [{\"document_type
                        \":  \"voterid_front\",  \"full_name\":  {\"value\":  \"Rajesh\",  \"confidence\":  92.0},  \"age\":  {\" value\":  \"26\",  \"confidence\":  78.0},  \"care_of\":  {\"value\":  \"Saradaval\",  \"confidence\":  9 6.0},  \"dob\":  {\"value\":  \"1800-01-01\",  \"confidence\":  0.0},  \"doc\":  {\"value\":  \"2003-01- 01\",  \"confidence\":  95.0},  \"gender\":  {\"value\":  \"M\",  \"confidence\":  95.0},  \"epic_number\ ":  {\"value\":  \"MTG1947852\",  \"confidence\":  92.0}}]},  \"status_code\":  200,  \"success\":  true,
                        \"message\":  null,  \"message_code\":  \"success\"}\n"

                        </p> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!---Equifax with pdf end--->
     
       <!---Equifax Only PDf------->
       <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#telecom2" data-toggle="collapse">Ecredit Only PDF</a>
        </div>
        <div id = "telecom2" class = "collapse" data-parent="#accordion">
            <div class = "card-body">
                <div class="row">
                    <div class = "col-md-4">
                        <span class = "badge badge-dark"><h3>Ecredit Only PDF APIs</h3></span>
                    </div>
                    <div class = "col-md-6">
                        <span class = "badge badge-warning"><h4><u>Ecredit_Report</u></h4></span><br>
                        <p><b> Hitting URL : </b>http://regtechapi.in/api/ecreditv3</p>
                        <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                        <b>Request Body : </b><br>
                        {<br>   
                        "fname":""<br>
                        "lname":""<br>
                        "phone_number":""<br>
                        "pan_num":""<br>
                        "dob":""<br>
                        
                        }<br>
                        <b>Success Response :</b><br>
                        {<br>
                       
                        {<br/>
                        "status_code": 200,<br>  
                        "equfax_ecredit_report": "JVBERi0xLjcKMSAwIG9iago8PCAvVHlwZSAvQ2F0YWxvZwovT3V0bGluZXMgMiAwIFIKL1BhZ2VzIDMgMCBSID4+CmVuZG9iagoyIDAgb2JqCjw8IC9UeXBlIC9PdXRsaW5lcyAvQ291bnQgMCA+PgplbmRvYmoKMyAwIG9iago8PCAvVHlwZSAvUGFnZXMKL0tpZHMgWzYgMCBSCjE2IDAgUgoxOCAwIFIKMjAgMCBSCjIyIDAgUgpdCi9Db3VudCA1Ci9SZXNvdXJjZXMgPDwKL1Byb2NTZXQgNCAwIFIKL0ZvbnQgPDwgCi9GMSA4IDAgUgovRjIgOSAwIFIKL0YzIDEwIDAgUgo+PgovWE9iamVjdCA8PCAKL0kxIDExIDAgUgo+PgovRXh0R1N0YXRlIDw8IAovR1MxIDEyIDAgUgovR1MyIDEzIDAgUgovR1MzIDE0IDAgUgovR1M0IDE1IDAgUgo+Pgo+PgovTWVkaWFCb3ggWzAuMDAwIDAuMDAwIDU5NS4yODAgODQxLjg5MF0KID4+CmVuZG9iago0IDAgb2JqClsvUERGIC9UZXh0IC9JbWFnZUMgXQplbmRvYmoKNSAwIG9iago8PAovUHJvZHVjZXIgKP7/AGQAbwBtAHAAZABmACAAMAAuADgALgA2AAoAIAArACAAQwBQAEQARikKL0NyZWF0aW9uRGF0ZSAoRDoyMDI0MDExMDE2NTc1OSswNSczMCcpCi9Nb2REYXRlIChEOjIwMjQwMTEwMTY1NzU5KzA1JzMwJykKPj4KZW5kb2JqCjYgMCBvYmoKPDwgL1R5cGUgL1BhZ2UKL01lZGlhQm94IFswLjAwMCAwLjAwMCA1OTUuMjgwIDg0MS44OTBdCi9QYXJlbnQgMyAwIFIKL0NvbnRlbnRzIDcgMCBSCj4+CmVuZG9iago3IDAgb2JqCjw8IC9GaWx0ZXIgL0ZsYXRlRGVjb2RlCi9MZW5ndGggMjE3NSA+PgpzdHJlYW0KeJytWt9z4jgSfs9fobebvSoU/baUNzawCdkAOUKm6urmHlhwZl0HOAvO1M7+9dfGFjZGsjVsaqqgRkT9fd36utWSfUUw5xzVP3dfr7jAhCoUaYl5JBAlEgtJEGNYEoJ2MXq9+uPKjub/yl8a85YbdD2iaJBe/QtdEfgLhuqfAPTzHFFlsFASJhnMBUXzFbr+hSFqsETzV4T+8+l2Onl+GQ9n6HY2HIzmaDZ8ms7m6DPD5Kf/ovkDGs5z60KCXQIsis/COleYKWCkCKYsKoxzZLC2th9Hw8kcjQY3R1P5rIhgATa80wb9+fCmBl7BnoAbjQljp2ZozQxihIkeoT0a7omQ8AfinFIZlelsAJGaTLvZUaYwjcipxRN2lEottCBadrOzEfPRm4/GQRFTmBvexkndyOhG6qOp67tnir7uHSZnd/mPLP/RChOCSEF5GyQVhXCK48gaRsA3mo+AeGU+ApOiPOLHAZA9GOS5QfgWBSpVOV71CY6cDwKVIwWBVYNCMRJKoUk9zNL5CJhyLsNlAW2456AeEk56wKl/VtVIcXBAIskizIRBSkFCUF5UI19xsUkDpYoxfawtFAub/+l2/76Jd2iy2MQ36G76eTQZoF9fxv0ZGg/n96N25VtqkcRRFIE4I0w1fHNMdEnN6VJOrQiHijTWLqU/xbt9ul2s0Wj7mu42iyxJt+1kGAEZEF6x0RwLqKghbPK5RnI/ndEq3mbJa7IMIMI1iACMHIlECisWRoTne4cRfiKwYtlimaFBnC2S9b7OxC2BMs4KuCh6XpiedvG3JH3fFwqo7wLHmHin9ifdJY0xjhWNTq2clLT+cPg0jqgQ425nbHR8lO7TuhM+TgIywDDewslopgmHqs6CAywZhkU7p9RfJ4u26PrmfU4zyMvmzmwD4Js1fQWNniJZghxaCiMdm/n05+6QSdjK86pTN3K6MRllekT0KO2M2NF1H6OnxX7/lu6y3HvkdN83c5z+lqzd7sN2LylzrM/XAMVIDr2CODVy4r4U4W77mLz4FttLfZ1hlEv+epr9nhfxFCOn71B5BDPnBu7i7SredbsPdZ3lzOt2TtwfL9ZxeAB8dAa75Fu8+8cePYKGt/vYs/i+6YdwtCQAgQZfKEdvlmaHfWaZ+nLUN3N22A3Q7WK3cq+cb+KBaiFW54pJDRFX3JHfy+X72wHVydQ77+n3NEvR7S5eJZmfr3f6cAObjRsxErDnk/MpowHqoYMuO/RlG65GbyXzBofrWn9nR6puTkIBF1pX3VU18BHNqlRgtUGhGAml0KQeZul85COa1YpDwz0H9bBwtjadMm90lWhrOvur1S7e72+CmkwJTayBhhdKsTAmqJmSBBpCCl8aGytRVk/8729xOzbkw6HpLrE5ibCIwsAZg8QwzI9eet/hvBHY5JlpGShYGBFEQBCGNXReXgLP2SLr8F9wiiOpj/DCgKmwTlYIWDdG/PBP6R7qbge+pgeJWvwI9n2mwvAN/E+0xH8A3qNZnDca8epIo1SbMBA8Tlxq8x7ei5wRRmJtHLcdT7tks9h9PyI5iZeCs/AuwfnwtYa8k378X5C6ZnAeur0fzWf9X6fTOXq+vR+Oh6j/kF8vzab9AXroj55eZu0crSaPJM816b/ggI5bCD/J2UM7thWkxXYI0tv18/yWTvuxOciVqA78UpAW3yFIL75mh2LqxWeE0R5RPV6/DdMHK9VnVRBBFxDL6BKJ6rwyuA7dDYk64a1ES/hLJOrDn6E71EcTdDsdw+Hy32gy7cG5uX97P5s+ovvpy/MQ3Y4+jx7R42hSShWNJoOOcFm5WsIXyNVL+KEd+yjXEvsSufqwG3J141u5lviXyNWHD3IlhxOf7igXpVyh/VB54/PjclVAnjuO6T9UUUv4S+Tqw//4impJXiBRH8ngilpiXyJRH3YuUUYDK2qJf4lEffgOibZWVNCmBN8vkKgE8kL/zYpawl8iUR/+JRJtr6KW5AUS9ZEMrqIl9iUS9WE3JNpeRUv8SyTqw4cDiugR3WMsrIoy6GbzE0khUThjKJBfkER5hKOI/80qWsJbiYbgW4kKCJ5yXB02N/3uJqB+D2Gtg0SMdtzMtfYL7cXY+looPSjUVum+WAcX4xK7VHoI9lHpPuwfam9L/FLpQfhW6T58UDo/POw9f3jZuKkQgEcEqd2W2JHqbkQwjpkh1V1FNfARVz8if6TfoFCMhFJoUg+zdD7yEVc/FYeGew7qYeFsvfrhhkM4lePqZ/jHe/K6+BM9L9Nd/OXT/stPYZc/XHEcgR6ZBFs67P6DckhGk/f7kMCu0nAgcXgy0/FgUcvi9Y6SBHwpIsMe5xGICISnnUNXCAymRFYxoAxTGXYJJRjBSsp2/GT7FQ3X8SbeZvXbKHeaQ4WDDAeVQL0V5NygXeFZsv9fscyoh4azZ1hHJGpvrByCA9XNkFNb9RsaLfjp3Tj8lDsjiwU4w6YYFXf5L1myTv46fVRbN5ADugwwa6C8KB/++Zbu32sLVDfC89tFhxGO0eR981u8Q+krGm0hHrsk3nfVPA4ZyU7KhB2pigJnoP56klYDH1HzOIglalAoRkIpNKmHWTof+YiaV3FouOegHhbO1prHDMXcWfNm8RIyC/WXWfItyb53FTyoNUCWQUzE4XUPcXjdI+jGmUMvRKBTgUIBG/l5PjWYfPm0XuwzBA6vFt+hFHe/nlS6KjTWxtHL2gdppeRv0Em6U0hbQrV/en+5TN+hBqHpW7yNV43pDFoTJVvQj9Nf3laL7Gy+gBBSJgPmD+J1Aj5AqG4Q68pbxg0WMqpJ3Y5Uws4XJiJRJbRq4CPylkHHZRoUipFQCk3qYZbORz4ibysODfcc1EPC+QPvVAk48ako7JUq0I3mjmx/ft/kp6l/Vo91/w82mzPPCmVuZHN0cmVhbQplbmRvYmoKOCAwIG9iago8PCAvVHlwZSAvRm9udAovU3VidHlwZSAvVHlwZTEKL05hbWUgL0YxCi9CYXNlRm9udCAvVGltZXMtUm9tYW4KL0VuY29kaW5nIC9XaW5BbnNpRW5jb2RpbmcKPj4KZW5kb2JqCjkgMCBvYmoKPDwgL1R5cGUgL0ZvbnQKL1N1YnR5cGUgL1R5cGUxCi9OYW1lIC9GMgovQmFzZUZvbnQgL1RpbWVzLUJvbGQKL0VuY29kaW5nIC9XaW5BbnNpRW5jb2RpbmcKPj4KZW5kb2JqCjEwIDAgb2JqCjw8IC9UeXBlIC9Gb250Ci9TdWJ0eXBlIC9UeXBlMQovTmFtZSAvRjMKL0Jhc2VGb250IC9UaW1lcy1JdGFsaWMKL0VuY29kaW5nIC9XaW5BbnNpRW5jb2RpbmcKPj4KZW5kb2JqCjExIDAgb2JqCjw8Ci9UeXBlIC9YT2JqZWN0Ci9TdWJ0eXBlIC9JbWFnZQovV2lkdGggMjI4Ci9IZWlnaHQgNDcKL0NvbG9yU3BhY2UgL0RldmljZVJHQgovRmlsdGVyIC9EQ1REZWNvZGUKL0JpdHNQZXJDb21wb25lbnQgOAovTGVuZ3RoIDcwNzc+PgpzdHJlYW0K/9j/4AAQSkZJRgABAQEAYABgAAD/4QAiRXhpZgAATU0AKgAAAAgAAQESAAMAAAABAAEAAAAAAAD/2wBDAAIBAQIBAQICAgICAgICAwUDAwMDAwYEBAMFBwYHBwcGBwcICQsJCAgKCAcHCg0KCgsMDAwMBwkODw0MDgsMDAz/2wBDAQICAgMDAwYDAwYMCAcIDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAz/wAARCAAvAOQDASIAAhEBAxEB/8QAHwAAAQUBAQEBAQEAAAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIhMUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx8vP09fb3+Pn6/8QAHwEAAwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL/8QAtREAAgECBAQDBAcFBAQAAQJ3AAECAxEEBSExBhJBUQdhcRMiMoEIFEKRobHBCSMzUvAVYnLRChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6goOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsPExcbHyMnK0tPU1dbX2Nna4uPk5ebn6Onq8vP09fb3+Pn6/9oADAMBAAIRAxEAPwD9+N20Z9BX5g/H3/g5X8P/AAY+OHi7wfb/AAw1XXIvC2rXGlf2hFrMUMd20MjRs6qYyQNynua/Rj42fEW3+Efwh8UeKbwqLXw7pdzqUuTgbYYmkP8A6DX8m2s65deKNavdUvZGkvNTuJLy4djlnkkYux/MmscRUlBLlP3DwZ4Cy/iGeJq5pByp01FKza1d9dOyX4n7C/8AEVFop/5o3rX/AIP4f/jVH/EVJo2P+SN61/4P4f8A41Xyr/wRV/YC+G37bXiHx9dfFK9mttD8NW9pFZJDqn2F5riZpGY5zlgqRgY6DfX6Af8ADhr9kEf8xLVMdf8Akaz/AI1MfbSV0z67iLI/D7JsdPL8RhK0pxtdxcmtUnvfszvv+CZP/BYOH/gpF8TPEeg2Pw81HwvB4b06O+nv59TS5VmkkCJFtVFILAO2c/8ALM8c19NfGH9qH4c/s/RLJ448deFfCm5dyJqmpxWzyD/ZV2DN+Ar4H/as8PfDf/ggx+yL4n1z4Lw3UfjT4rT2ulabPf3xv/LKJK32hd2Rtijd2A+6zvGDkHFfib4u8V6x8R/Fd5rWuahqOva5qk3m3N5dytcXN3I3dmYklieBj8qJVnHR7ni5B4U5fxPiquY4CUsPgU7Rurzk0lzbvRJ3V2f0kXn/AAWa/Zjtbho3+MPhVivB2PK6n6FUINa3gr/grL+zj8QNTWz074xeCFuJDsVbq/FnuPYAzbQfwr84/wBnb/g2M1vx78I9O1nx38QpvCfiPU4FuDpFlpa3K6cGAZY5XaRd0gyNwUAKQQCetfAP7bv7JeqfsRftKeIfhtrWo2etXGi+VJFfW0ZjjuoZoxJGxQ5KNg8rkgFTgkYNEqtSKu0bZN4ZcHZxi6mX5dmFSVSCbfuq1k0rp2SaTfRn9TWk63Z+INNhvNPure8s7hA8U0MgkjkU9CGHBB9RWfq/xJ8PaDfva32uaRZ3UeN8M92kci5GRkE5GRzX4nf8G1n7T/ijw5+07qnwtk1G8vPBuu6Nc6nDYSyF4rC7geP97ECf3YdXcMFwGOwnkZr40/4KL/FVfj1+3Z8VvFG7z4b7xHc29rIed0Fufs8RHsY4V/CnKv7vMkeTgfBSvV4gr5NWr2hTgpqaW6k7RVr6PR/cf0+6P8RPD/iG9W20/WtKvrhgWWKC7SRyB1IAOa0dS1S10exkuby4htreFd0kkzhEQepJ4FfiF/wa+/BVfEf7UHj7xu1upi8K6FFp0T7fuz3c24nPrstiD7P719o/8HF3xj/4Vr/wTo1LRI5Al1461ay0ZQD8xjDm5lx7FICp/wB+tIzvHmZ8nnXAMcHxTDhrD1udycE5Wtbms3p5J3PtAfGHwnj/AJGbQf8AwPi/xrSXxdpJ0H+1V1KxbTACTdidfJABwfnzjg8detfyIy28aQs3lr8oz0r9kP8AgpRB/wAMgf8ABA34X/DNP9FvvFEek6fdwgbW3EHULo49DLGc/wC/Wca3Mmz6/ibwZp5XisFg6eJc54ipyW5bWivil8j9TB8YPCY/5mbQP/A+L/4qtI+L9KXQv7WOpWP9l4z9r89fJ67fv5x1469a/kRktUEbbYlZsHACckmv2O/4LAQf8Ml/8EXvg78I4/8AR7zWG0uyvIem/wCzwG6uGI7/AOkCMn3aiNZtN2HxF4Mwy3HYLL6eJc54ifL8NrRSvKW/Q/U7/hcPhMD/AJGbQf8AwPi/+KoPxg8Jj/mZtB+v26L/AOKr+SeOwWd0RIfMkkYIqqvLE8AAepr9ALD/AINof2g72yhm+1/DOHzUD7H1W43RkjODi3xkeg4pRrSeqR6Wc+C+TZTy/wBpZoqXNfl5o2va1/uufu9Y/FLwzql7Hb2/iDRbi4mIWOKO8jZ5CegAB5J9q1tX1m00HT5Lu9ureztYRl5ppBHGmeOSeB1r8hv+CaP/AAQQ+J37MP7aPg/4gePrnwNc+H/ChuLsRabezT3D3JhdITtaBFwrPvzu42DFeWf8HAn/AAUu/wCGgfiTJ8G/BuoNJ4L8H3X/ABPLiBjs1fUUOPKyPvRwHj/alyedik6e0aV5I+Nwvhvh8yzyGVZLilWp8vNOol7sFd3Xrpp6+p+2H/C4vCf/AEMug/jfRf8AxVXNP8f6Hq9pdXFrrGlXEFku+4kiukZYBzyxB+UcHr6Gv5KfFHg298D+I77R9Y02bTNV02YwXdpPHslt5QcFXXsR3B5FfpR/wbHalY6l8cfi14L1C3t7rTvE3hm3muLWZFaO5jimeJlZTwylbojB7EjFZ063NK1j6nivwTo5RlFTNYYpzUEnblWqbSunfs7n7Rf8Lg8J4H/FTaD/AOB8XP61a0X4h6D4kvVtbDWtJvrlgWEUF0kjkDqcAk1/Nv8A8FYP+Ce1x/wT/wD2pL7R7W1kbwT4kL6l4Zu3BOYN37y2Zu8kLELzyUMbd+PGf2c/jrr37LPxu8OePvCkq2ut+G7tbmIcqlyn3ZIHxjMckZZDnna2RyKHWs+Vo6sB4F0MxyuOY5ZjefmjeKcbXdtm76O+j7H9YzHI6/jnrXPz/FnwvaTSQzeItDjmjYq6NfRhlIOCCM9q/Jv/AIKS/wDBwhaeLfglo/hn4H3N5Za54o0yO41vWnTZN4fEiZezi6ZugSVaQfKgHyksQU+FP+CeP/BNLxx/wUa+KT2mjxtpnhewnVtd8TXURkhtM4bYmeZrhuoXOBkFioPNSre9yx1Pmsn8Iaryypmuf1vqtON7JrV23089kt2f0v6B4z0jxWs39l6pp+o/Z8eaLe4WXy85xu2k4zg4z6Vyml/tQfDnWviE3hOz8eeEbrxOkjQtpUWrQNd+YudyeWG3b1wcrjIxzXj0/wCxbo/7F/8AwT/8Z+CfgnpF1p+rf2HdNFcWn/IV1S6MLBpjKMF7lhkIeArbAAqgAfGV9FYr4Y1a6h1CGX4T6u+sWXgzS9HunnulvkSJdIhis2Y/ZrgTAvFNCizCaPbKRuJOy8z4vLuHcHjfazo1JckW1HTV2V7ta2v0Xk7tWP1sQ5H+FFYnw7XVIvAGiLrzRvri2EA1Bo/uNceWvmFfbdnFFOzPjpWjJxvsfKP/AAXk+L//AAqX/gmj49jjk8u88UfZtAt8HBb7RMqyD8YVlr+c3GK/Yz/g6Z+MAg8I/CrwFDN817fXevXcYPQQxiGLP1M8v4r7V+Obcjjv+lcOIl79j+2fAfK3heGliGta05S+S91flc+ivgR/wSU+PX7T/wALNL8a+DfAsOseG9Y8w2V3Lqtrb+bsdonISSQMAHQgHAzjI4xXbab/AMECf2nL7UreG4+HdjawTTIks/8AbtifIQsAz4EueASeOTivp79kb/g4Z8Afsrfsz+Cfh7b/AAx8XXi+FNJgsZbhL21VbmZVzLKBngPJvbH+1XpVr/wdI+C725jgh+EvjOWaeQRRIt/a5dycAde5IH407ULb6/15Hg5xxB4hfWa31fLoezvLlbim+W9k3729j55/4OSvE0OgfG/4UfDTT28vSfAvhMSxQKTtiM0nkqMZ6iO0X8D9a+af+CSfwSh/aA/4KL/C3QbuFZ9PttUOr3aMMo0dnG1wFYdwXRF567q9Y/4OGbLVY/8AgovcX2pWs1rFqnhnTZ7NWO4CPbIrqD0bbKJBxXG/8EVP2m/BX7J/7dul+JvH14NL0O60q60tNQaMvHp80piKPJtyQmI2TODt3gnjLUp/xte59NktOtQ8O7YJc1R0ZNW35pJt2tu02z+kbiJcf3RX4C/tsfssfE7/AIKhf8FFfjVr3wv0vR/EFr4V1mLw/cRNrNtazwC2hSEP5cjqxRpI5SHAwSGGeDX6Vftif8Fu/gh8Bfg3quo+F/G/h3x34tmtXXSNK0a6W8864YEIZXjJWONTgsWIO0EAFsA/hd+yx+2Z42/ZJ/aOtfid4fv2uNc+0SS6rDO5EOtxSvvmhnA6q5O7PVWCsOQK1rSi2k9j8p8IOE8+w1PGZvhafs6qhy0/aRdpO6clZ2fRK/d+R+gP/BOD9gH4qf8ABM67+Lnxo+KHh+z0O28K+Ab/APssx6lBdma5O2Q8RM23iFRk/wB/2r8pzLJcFpZmZ5pG8yR2OSWPJJPfJP61/U9+yx+0z4J/b3/Z0sfFvh9oNR0PXbdra/0+6VXks5cbZrW4Q5G5ckEHIYEEZVgT+Hf/AAWW/wCCWF5+wV8V/wDhJfC1pNN8KvFFyf7Pk5c6FcNkmydv7nUxMeqgqclctNen7qcdkfVeGHHssVn2Lw+erkxVTlSWy9y65Ens9W99dbH6Df8ABs/8H/8AhCf2G9W8VSx7bjxt4huJkfGN9vbqtun4b0mP/AjXzx/wdI/Gb+1fil8L/h/DL8mkWF1r12gPV5nEMOfcCGbr/er6N/4JZf8ABTD9nn4S/wDBPjwD4d1L4ieHvC+qeFdKFvqum6lP9nulugWeZkQjMqs7M6lN2QwHXIr8n/8Agqd+1ppv7an7bvizxxoLXEnhvbBpmjtOhjeS2gj2+ZtPKiSQyOAQCA4yAciipJKmkeVwXkeYY7xBxWbYyjKMKcptOSdt+SKV99NdOx5z+yh8Jm+O/wC0/wDD3wasZkTxH4hsrKcDn9yZl84/hGHPtX6F/wDB0F8W/wC0/i98LfANuyiPw/pFzrE8aHgPcSLDEMey28n0DGvJ/wDg3a/Z/vfir+3/AGvixrOSbRPhzp1xf3Fwy5ijup42t4Ez03kPM4/65k15t/wWu+L/APwub/gpd8SrqOTzLPQLmHQLcZyFFrEqyAen78zfnWcfdperP0TGSjmXH9ChFpxwlGUn5Tm+W3razPKf2G/hH/wvj9sj4Y+ETH51vrXiSzW6TGc26SCWb/yHG9fcH/Bzx8YP+Ej/AGmvh/4Iik3Q+E9Ak1CVAfuy3cuwZ99lsD9H964X/g3D+EX/AAsH/goSfEEsXmW3gXQLq/3nkLNOVtkH12STH8K8X/4K+fGD/hd3/BSP4q6tHJ5lvp+qjRLbByoSzRbdsexkR2+rGhe7S9S8R/woeINOn9nC0XL0lN2/GJ4N8O7fW5fHWlSeHdOudV12zuUvLO1t7M3kkkkJEo/cqrbwNm4gqRhTX3On/BV39u6NNotPFG0cf8k8/wDuetD/AINqPg//AMJz+3NrXiiWLda+CfDsrRsRwlxdSLEnsMxLPX7K/th/tTeFf2L/AIAeIPiB4okX7HpMWLe2RgJtRuWysVvF6u74HooyxwFJrSlTfLfmsfH+JnG2Fp59DJnl9PFTiopc17qU+iVu1vX5H50ftT/8FZPiJ+zx/wAEwvBOl+KNWdv2gvipp89zIfsS2M/h7T5JnAuGhVV8uQRFEjBAJfc3PlkH5P8A+CIP7MfgP4n/ALQf/CwPih4q8J6H4X8CTpPY2OsatBbyaxqXDRnZI4ZoouHJP3nMa5YBwPG9L0b4pf8ABW39tm6FqsepeNPG1xJcuZXZbHR7WMcBmAYxwQoFQcEsSMbnbn6Xf/g2O+PkrfNr/wALmz3OoXfPtn7N/nFTzSk+Y9X+z8i4fyqtlWIxcMJicT702lrFSfwx/upXjHru9z5y/wCCriaP/wAPE/itcaDqWnaxo+pasl/bXljcpcW8/nQRSNtdCVOHZgcHqDXsX/Buv4w/4Rj/AIKY6PZF9q+ItA1GwxnAYqEuB+XkH86+d/21/wBibxZ+wJ8X7fwP4yuNFutUutNj1WOXSpXkt2ikeWMDLoh3BomzxjpU3/BPn9ovT/2S/wBsrwL8RNWW8fSvDV1PJeLaR+ZNJFJbSwlVUkZJ8zpkAde1Z8zU7s+1x+W0sfwdPA5fU9snR5YSS+NqNk/LVI/dj/gtr8Hfhz8WP2DfE03xA1nT/DMnh8f2hoWrzqTJbagoIjjRR87+dzGyLklWJAyoI/nBQ5UcbeMmvoL9v7/goX47/wCCifxbj1bxA8tnodnKYtB8O2zmSDTg+AOAP3tw/G6TGSflXAwK9l+Jv/BDf4gfCP8A4J33Hxi1o3UPiyxlTUr/AMMBAX0/SCp3vJxn7QhKyOoO1Iw/Vgaqp+8lePQ+V4BwtPgvLKWCzzEpVMRNcsN1FvSy9ftPZP8AH5o/Yz+Gfgv4xftReCvC/wAQteu/DXhPXNRS0vb+2Ub1Lf6uPe3EYkfbGZMEJv3YIBNf0/fBj4L+Fv2fvhlpXhPwbotloPh/SIRFa2lsm1VHdmPJZmJLMzEsxJJJJNfyZlRImMblbjHY/wCeOevQ1/QB/wAEH/8Ago2f2v8A4A/8IR4o1DzviH8PoEgneZ/3msWH3Ibr1ZlwI5D/AHgrH/WAVph5L4WfNfSCyHH18LSzOhNujT0lDom3pO34O+2lup99fe4PeuTsfgd4M0rxxL4ntfCXhu28S3GTLq0emQpfSZ4O6YLvORwctzXWCk5P+7XUfyfGrOCag2r72E57CinHjtRVGXMj5B/bv/4I2fD3/goN8XbHxj4x8TeONOvtN01NLt7bSrm2it441kkkLYkhdtzM5yd2MAcDFeJ/8QvvwP8A+hz+KX/gfZf/ACLX6VelLtrJ01e7Pssv8QOIcDh44TCYucKcdEk1Zfgfmp/xC+/A/wD6HP4pf+B9l/8AItbXw4/4Nsvgp8N/iHoPiSHxN8R9Qm8P6jb6lHa3d7aNb3DwyLIqyBbcEqSoBAYEjuK/RHbTSec0KnG+x01PEziipBwnjZtPR69OvQ8Q/bN/4J8fDD9vHwrZ6b8QNCN3Ppm/+z9StZTb31huxu8uUfwnCkowZCVBIJANfBvjj/g1i8M3d/I/hz4teItOtc5SHUdKgvXX/gaNF/6DX6wgY69qXhqbpxb1Rx5Hx3n2UUvYZfiZQh23X3O9vkfkr4S/4NXfD9tcq2ufF/Xru3/ijsNFgtWYf7zPIP8Ax2vgz/gqN/wTY17/AIJ0fGtdN8y91jwLrm6Xw/rUyjdKFGXt5ioCrOmc8AK6kMAPmVf6XcbeteX/ALXv7J/hP9tH4F6z4B8X2vnafqke+C4RQLjTrhR+7uIW/hkQnOehBKnKsQc50YtWR97wt41Z5hcyhVzWs61F6Si0tE/tKyWq/HY/nz/4Ja/8FINc/wCCd/x4j1FmudQ8B+IHjg8R6ShzujHAuoV/57RZJH99dyHGVZf6EvFHhn4f/tzfs3yWd39g8WeAvHWmq6PE26O5hkAZJEbqrqdrKRhlZQeCOPxb1T/g2f8A2gLXU7qOz1z4a3lnFMyQTvqVzC00YJCs0f2chSQASuTgnGT1r7q/4I5/sW/tF/sEXmoeDfHN94J1v4Z35e7to7LVZ5rrRbo8sYUeBQYpT95Nww3zDksDNHnj7sj6fxWqcN5mo57k2MgsVCzaTs5WtZr+9H8dux4Rrv8Awas251KRtN+M99HZlyY0uvDiTSonYF1nUMw9dozjgCut+Gv/AAa3/D/SL+OTxZ8SvF+vwxkFrfT7WDTlf2LHzWx/ukH3r9Ts8fzpo+U1t7KHY/M6nizxZOHs3jJWtbRK9vW1zzn9mn9lHwH+yJ8NI/CXw/8AD9p4f0eNjJKIyzzXkpABlmlYl5HOB8zEnAAGAAK+M/Hn/Btd8HfiP441rxFqnjX4oyalr+oT6ldsL6zw0s0jSPj/AEbplj+FfokRxS9/92iUYvRnzeW8XZxgK88ThMRKM6nxSvrL1bufMv8AwT8/4JX+Af8AgnJN4qm8Hap4k1e58Wpbx3M2szQzPCkHmbFQxxR4BMpJBzkgdMV8/eJP+DZz4M+LvEmo6tf+NvinLfardy3tw/26y+eSRy7H/j17kmv0bJ7d6Mg0OmmrM68Px1n9DFVMbSxU1Vq2UpX1lZWSfofN3/BPj/gmJ4E/4Jv2HiiLwZqPiTVpPFklvJdz6xNDLIghDiNEMccYCjzGPIJ561V/b9/4JeeF/wDgoxfaCvjHxh450nSvDqu1tpej3NvDavM/DXDiSF2aQL8oJOFXOANzE/Tg4NA4o5Vy2PPXE2af2h/a3tpe3/n67W/LQ+aP+Cf/APwSw+G3/BOwa9ceD5Na1bVvERRbjU9Zlimuo4UHywxmONAse7LEYyxxuJ2rj6XI5/rRjn3oU81SSSsjhzLNMXmOIli8dUdSpLdvd6WPkn9vf/gjp8Of+ChPxP0nxZ4u1zxhpOpaRpv9louj3EEUcsQkeQFxJE5JDO3Qge1eF/8AEL58ECP+R0+KWfT7fZf/ACLX6VfxUg+/UunFu7Posv4/4hwGHjhMJi5wpx2SasvwPiT9kT/ggt8F/wBkX4zWfjmxm8T+KtY0oFtPj8QTwT29jMcfv0SOJMyjGFLE7c5ABwR9patpFvrmm3Fld28VzZ3cbQzRSIGSRGGCpHQggkEVaJ5xQTgVUYpaI8XNs+zDM66xOPqyqTSsm3svLsfm7rn/AAbF/AvVNZvLi28T/ErTbe5meRLWC/tTFbozEiNC1uzbVB2jcScDkk813H7LP/BBj4c/sffHXRfiB4R8efE6HWNEkb91Ne2j297Ey7ZIJlFsC0bDqAQQQCCGAI+6s5/CmkbqlU43ue5iPEPiOvQlhq+MnKElytOzTT6bDgcGnU1RjNOqj40KKKKAP//ZCmVuZHN0cmVhbQplbmRvYmoKMTIgMCBvYmoKPDwgL1R5cGUgL0V4dEdTdGF0ZQovQk0gL05vcm1hbAovY2EgMC42Nwo+PgplbmRvYmoKMTMgMCBvYmoKPDwgL1R5cGUgL0V4dEdTdGF0ZQovQk0gL05vcm1hbAovQ0EgMC42Nwo+PgplbmRvYmoKMTQgMCBvYmoKPDwgL1R5cGUgL0V4dEdTdGF0ZQovQk0gL05vcm1hbAovY2EgMQo+PgplbmRvYmoKMTUgMCBvYmoKPDwgL1R5cGUgL0V4dEdTdGF0ZQovQk0gL05vcm1hbAovQ0EgMQo+PgplbmRvYmoKMTYgMCBvYmoKPDwgL1R5cGUgL1BhZ2UKL01lZGlhQm94IFswLjAwMCAwLjAwMCA1OTUuMjgwIDg0MS44OTBdCi9QYXJlbnQgMyAwIFIKL0NvbnRlbnRzIDE3IDAgUgo+PgplbmRvYmoKMTcgMCBvYmoKPDwgL0ZpbHRlciAvRmxhdGVEZWNvZGUKL0xlbmd0aCAzMDcwID4+CnN0cmVhbQp4nJVbwY4bNxK95ysI7GXXgBiSTTa752Z74sSBYwceA8FukIPW6rGF1UjGSOPAf7/FFouSWkX5KYeR03j1WCySr6rF0g9GB+PU8d/HTz8YbYxRx3/f//yDHf9x/JeQjdfGtiq22plWBRe1872KjdVt26nHQd0jEBrYh5PxEnXQIdn1jXa9JUM/GtpGm67Z24kuvfignG+1bx3ZtroJnfqwUD++cqrX9M97pf7858vHYbHcqffDl83jTt09PTzMH7/96y/14Vf10wdh+nvahqbQkkcx6J5cGFntEevbp4f/Do9qc6+ef/y4eVrvtupG9YWWGGwXtA0XKD5sdvOVejFfzdcfB/X8IbEQSRN7ipsxx1xNoMDERsXOauI753o/fBzIOvtCLHnWL+ePC7VZK9fNTD8TKaPRtnfnlM44e2KQI+IJYuOliLz7MqyPw+LEsNR49mH5fb7dqduno7iYWkxC0K3pz4nerRbD9jgmv2yetsv1J/VmM1+PQQkzY+WgeNrIrpWCYoIUFNdr7y9uk8OEDoExYmBqXPvA/LL89JlX94YmT2tXC8xloszxZvkwMgWT/tNGmp31umvNpdn98bjcDbPN/f33p1cj23t1R4dht6TFKevuYhgdk+dYY7ujhV4NY7TSJrgcsP00295r3wmH6zDN/wyPm8OJPcxUnCg57WJ1g/+2We8+r77Rvvj2MB7dPF+Jqu06Td6dU3WBNn8lMrXhJ5E5C7hEVnVAXpwcz+i1tfbc6LdNGnf4OpCw3+3mu6etOOma+XMynH8a9jLDizHZbcXxGskkCgeaxvexO56QmDXTEPtc1wZ66LrzEZ4936ovtG0W892cUljKPsNCzXdqrnaP88WwWq4HtaIorNRyrXafBzXPSrUYdvPlaqu2w7gyl3PVjz/fWfVpmz5d+mS3LMl616oHFVpLy+HLkxU9IZctPTEkEE16QkYxrVh5QAmXCJtM7NMnWbdp3MPfsXqYPqTqgV0wtGlOXchPUBemrmNM50/GsuNC7MQaqBrQyfQE17FwVrbV/vCE2OvGOi5nrNWet3/eJbf7XXJzvFGrlVXwnW7aKysrOgfeNioEGtwJlRULIFpMBfrsvCCwRLT7hyK8Ndb7LiUiCgiJzvGRduS6D7HOks8wZYzen1Rije10by6Mn5TkRv17ONEh76l6jaZudTvfDbmsHBY3ggAG5+hTKK1er7e75e4pHW6qSm5fvST9Wf9vn4qHhTjpGtWkTroR5133Y0caTATvaSo34uRrpuPkU9xo6iqViqm+dJ0UBWN110l58NuX4aRQFSdes36TJp6TpzxrE3Ubhbrw2FKleYwTaM4K5Mzj6cXC9EItaDsxYjWHx4i9XG228mbxVNoHK1Rr7/5eD4/bz8svah+w1+vF8uty8TRfSfGq0hxVaPWdUrWeVAniXqkavx/mW9rpRzJBrzB/K6N+VX8q9Rf9Y5FUtqE3P9d0unOR1JaKgDb9f9RUjCehuhsdjaP2+taT9gpl3y/L7W5z8nrnO2EwZnE6kAo+qDavQX6wOh2MMrzphRVlJd7XMKeVG52bjuZTtTWnJZOlkaO7MNYET+8hFK+I4z3tyoD74wKlrniFPzFqEm8cT7X2NfOlVEhv9zh/Q+8+/SX/n52g/XXRb6jCuMobis5Fb6b4Pr3S4vyUpbW7wn/fmKt2A+Xkq3aDp/N0zW7wXXNV/JPGXhP/kOTtCv9Tyr8m/iH4q+If4nWnMXTXncbWXHcaW/ed0/j2pz9O9/NeGMfiUngrfL7dDpTSV/Ptdnn/cX7yEnMsjjX7Z6I0QugijBiaZRFDsyhiaJZEDM2CCKGLHGJoFkMM7a+Jd5FCDM1CiKFZBiF0EUEMzRKIoVkAMTTLH4Zm8YPQRfowNAsfhmbZw9Asehg6XnPSiuBB6CJ3GNpdddKy1Dmj+0b6HumJXl5eLVfDQvoqi4WuZi0LHYQuQoehWegwNAsdhmahw9AsdBC6CB2GZqHD0P6aeBehw9AsdBiahQ5CF6HD0Cx0GJqFDkOz0GFoFjoIXYQOQ7PQYWgWOgzNQoeh4zUnrQgdhC5Ch6HdNSetaBXpSgjS1x1m5hpRr2oW6RuhRtSsqkU3tWDdMq1uvPAtu4kzCd8klWmFL+0m9Cx0Vfp2JuFRelbGKn2YSXiUnqW0Su9nEh6kL9pbpW9mEh6lZ7Gu0ruZhEfpWd2r9JOr34xH6Tkd1OjtxPuMr9Of3JKX/FGln3if8Sg9J5wqvZlJeJC+ZKhq7E+/amU8Ss8prUrfzSQ8Ss85ENQcxqP0nDRBzWE8Ss9ZFtQcxoP0JS2DmsN4lJ7zOKg5jEfpOfGDmsN4lJ4rBVBzGI/Sx+8kw4nmML5Of9LgU2oRUHMYD9KX4gXUHMaj9O57yfBUcxgP0uf3wKZLt8DCfdh4hSkZtJ0OvXALNbbbGG+860PnbBelYqw6HN91ika1IcfWBqmCqw4zXoyKFrUxJpeoXPFVR0i3YqJBbQD5wjUHm3K4b4QbqJML1/SePkjWY5oQLpXGy9l39+PN21yMOGUA54SvEtLtrGiQdMULJfnt0yDiXdAmCJs6X8cpcY3q0dhf+4pGtSCcXRGXlQr7fgh8aWt+5etk0abmFl89i0a2166Vvv7uheV3fTPqzRl6f+36/Gm3GTsHpfVxfUefwvZ+U9kArou6kZoWf8832vKKmnTtKeyzs2GyQXVOeRjRZrzGFfbabW0HVGdf2wHV2UvX43l1Wqut1Mw4uR6XTH2vg9QjKN+klyWiuqtvhMSwv0kXTUKgYkcIxOb+XsR7qr1aIQ7CLXtZnppbfEUvGtUcuzRQzbl9z5+4rrVhph0AuYUq3fZ7wj8oGkh7a8qTFT3pdNuafQeAcYeuqsODs4bzA09+cKChB3046s0q/08k08ERmnP3Dt4ceE7dOx9cmtLRxnXt2HJ2Fs6ruhxSZ4jp+kOXAz847XJw1lKpKxywS10OjRvTWNX27sPtCT66sWJE8S713PmI44Mdy3UYHxuae4/jU4dwg/vT2EBZy+P4JnXSOBwfUluuwfGpCjMdjPf08hZcwPGkaz2JNIz3fuxKhPFt0DHi60WnQtse328htXRafL0CVSWmwddr7KQM+HoFOi9di++3QPvTdfh6pS6raPD1aml/WoevV0v7MzT4fmtjPwojio/py4WIr1ek/Rl7fL3Sz0CcubDf5L4I29OnEwqO7/VFZDmt2lfkFMWznML4LKcwPsspjM9yiuJZTmF8llMYn+UUxmc5RfEspzA+yymMz3IK47Ocwvgspyie5RTGZzmF8VlOYXyWUxif5RTFs5zC+CynMD7LKYzPcoriWU5hfJZTGJ/lFD5fWU47N8rEOfxi7wWLac36mSilELoIKYZmGcXQLKIYmiUUQhcBxdAsnxiaxRNDs3RC6CKcGJplE0OzaGJolkwMzYIJoYtcYmgWSwzNUomhWSgxNMskhC4iiaFZIjE0CySGZnmE0EUcMTRLI4ZmYcS0ipWtddpIv82xdtqpwepWtZj2dhSFq1mc93awyrVx1Jhzi24m4kNLKiN8RTltpciyWKWfNIIwHqRnHa3St2etFCMeoy/CW6UPMxEP0rNSV+lPL2ULHqRnaa/STxpBGA/Scy6o0k9aKRiP0ZfkUaU/vdYseJCes02NfnIpW/BV+kkzQk5PVfqJ94wH6TmfVenNTMSD9JwAq7GfNIIwHqMvGRPUnIIH6TnFgppT8CA952RQcwoepOckDmpOwYP0nPVBzSl4jL6UCaDmFDxIz3UFqDkFD9JzIQJqTsGD9Fy5gJpT8FX6k16HUuqAmlPwID3XRqDmFDxIz8UUqDkFj9HzS6mn8qXrhO/4Ko0gtklZS7i3Sz92d55Kv9Y3PWVmH71Y7TVUEkg/Qy4/excrvpqb550dbFHz8+1GLBBrA5zd/bJBjf9SY4c1vY6NeIV73Njx4vX4O/KtwNB34+hnBPP1ovwW/G54/Lr8OEjmXatDK1287xbiYtX8PWsIyQY196b9IBlec0dsB+GFNY3uG+E+V2wHyUZ9aukVNt15NwgvL+lwcEgvABvU3JK6QbJNzStnKCNPtI9tqGiMUfgK/3C6/w8WyTGfCmVuZHN0cmVhbQplbmRvYmoKMTggMCBvYmoKPDwgL1R5cGUgL1BhZ2UKL01lZGlhQm94IFswLjAwMCAwLjAwMCA1OTUuMjgwIDg0MS44OTBdCi9QYXJlbnQgMyAwIFIKL0NvbnRlbnRzIDE5IDAgUgo+PgplbmRvYmoKMTkgMCBvYmoKPDwgL0ZpbHRlciAvRmxhdGVEZWNvZGUKL0xlbmd0aCA0Njk1ID4+CnN0cmVhbQp4nKWdQW/kxhFG7/4VBHJJAgxDNrvZbN/sdRzbMOLF7gI5GD4oq1lHiFZaSNoY/vcpauurETnV2q+Ti+OMX9e0iuzia4olfjH0wzB0T/959+sX5x+++pt8GJecut+6ofuh+7nrfpF/ufxifPzPT/8p46fYD+PcTakPIXcp5D7E0uUc+jnm7u7YvWtAliH3S47d+y7PpY/jYJ9cyydLP8+fPhnD+okMyvP85AMJ5P6MGj0Pcx8k5ik6PjlFXz8p83CKfvpAou9nxUU6n7n3E+8m6UzA+3m/ftNN+dNAyWeMoXtz2f3l27Er/dK9edd1P//xze8fjl92L+6Ol1cP3YuLu8s//dK9+aH765t18DitR2GU0Usfpul89I8X9w/ugHnu5zScD3h58fv7483Dl91m1Dq5LJMsqZ+HhfgaDFgkLSFVv8YdU8vENxcPxy/dEfPQL6mcjwhDGA/uiFj6IP97NmIcDkN4OkIOZj/KeV7N8Dord0Atwy+ub++Pl5sfBOdAWPoyjOdDfvrt5nh3/6+rD93j2eANHXM/jc6R+f7m8uo/V5cfL67d00BOyrk4P9U/7q4ejgd3SJj6cXR+rtt371x+HHspGuf8V+9vP8qJ5h6eWiJeX9y8fbi6vXEH1VKgX9S5R6n207w6Xtzf3pxmN/TnFVWSN5WxizH2RU7ycRhkeUxjF+R8LBJUauPrJ8dIEt2XGM+/67ur+4fbu9+ffJdXvy3K2C9xkZIjJ1iYTx9cb78sl36anRR+9fbtmo7u9cPFw8f7bfrH5fmxL358/c1mQJLyl8b6AKngG17qRwqB/4IwSfXMz8xo9wUhyfk88BMKcu6E0BB/KU0/8CTFPjbMfwqpHxvmP8XQ5+fmv0/olIfHyzb9BYuUvfzMEdvxUZbAUvj4Udbfs2fEno/j47ql+bT0uWX+eZY13RC/rBc4Pn6SatiS/xRKU/5TnJvyn+bYlP+0hKb8p1Ka8j+vRbxh/rNoaUv+5xSa8j/LemnJ/7zkpvzn4TMVcc+v16uG+ec4NOU/y3ppyX+W9dKS/yzXwJb8L7JeWvK/iDm05H+R9dKS/0XWS0v+l2Vsyv8i66Ul/0XWS0v+yyp8DfMvsl5a8l9kQ9WS/yLrpSX/j47VcgBGyU7TEYA/yYEW53f86f7+KBux64v7+6t3by/ObBQOVRv/Z1egOBr6RNHmThwNc+JoeBNHw5oo2pyJo2FMHA1f4mjIEkdDlSjaRImjoUkcDUniaCgSR0OQOBp6RNEmRxwNNeJoiBFHQ4s4GlLE0VAiijYh4mjoEEdDhjgaKsTRECGKNg3iaEgQR0OBOBoCxNHQH46G/FC0qQ9HQ3w4GtrD0ZAejobycDSEh6JNdzgassPRUB2OhuhwNDSHu86b5JA4FIe8qn0SlDT0IhTOPbaPVw/dt1fXx0u9R+TqTW20rzccDb2haNMbjobecDT0hqOhNxRtesPR0BuOht5wNPSGo6E3FG16w9HQG46G3nA09IajoTccDb2haNMbjobecDT0hqOhNxwNveFo6A1Fm95wNPSGo6E3HA294WjoDUWb3nA09IajoTccDb3haOgNR0NvKNr0hqOhNxwNveFo6A1HQ284GnpD0aY3HA294WjoDUdDbzgaesNd501vSBx6w+EwFKmfS3B+szeUQ5hcS6mOWPYjYCrVEXk3wmxFKtg8Or/cHuaDy4f1CuP9ansbHnpTDZ8OLk+Ghw9Vw8eDy5PhIVDV8NPB5bnwZlzV8OHg8mR4KFo1/PYZBOPJ8HC62rk2hkPYPLJgXleb0LibEPjqhLbhIYLV8MPB5bnwZo7VdJaDy5PhoZrV8MvB5cnwcNNq+HxweTI8ZJYsI8aT4WG/ZBkxngwPXSbLiPFcePNrsowYT4aHkJNlxHgyPAyeLCPGk+Gh/NVVu5s9+Gr40d0jkDXHeDI8NhVkzTGeC2+7ELLmGE+Gx7aFrDnGk+GxzyFrjvFkeGyMyJpjPBkeOymy5hjPhbetF1lzjCfDY69G1hzjyfDY3JE1x3gyPHaDZM0xngyP7SNZc4yvhvefJSBrjvFceNugkjXHeDI8drRkzTGeDI8tMFlzjCfDY89M1hzjyfDYZJM1x3gyPHblZM0xngtv23iy5hhPhse+n6w5xpPhcaOArDnGk+FxZ4GsOcaT4XErgqw5xtfCj8W/d0EWndMA9gtwt4MsO6cB3Bfg1z9D6WN0noD/6u3bhz84A1KR6+7sPCqeQhynaZAklkE2Y9unb3AzZpDSm5xHn7++uL64eXvctRvghkxtjj99OD55NPvJiOok/37r3r+pfcH+oX4MqMZ/dfxwe/fgP9afsuwzivME/Pc39w9XDx/XR4jccfPQj6OTtBdXD1f/vLj5t5fplHMfl+V80Mt9iwYGzKkvg3NX7ZuPR5dPsZ+Cc156j9nbcamn4OF4d9zNDINqP/+rs0YQHJ5l6sPi3COpHs/avNYzbHc0bUxtWkGW+mG/OjEoLn2anKfPgrc40ygatzQ3A+EIjXIpz0wzEAYMsS+FbgbC4ZnWdgbnTDv7GgyQQjXNZDMQxtQycd4MpCOiXKvH4jcDbUu/jZBLwDw6VUAcZoju0axluHqe1TJcbwaK89po9z81A8Ukl47kHJlKM5CeBjFP/eC1ODnNQBgyj330mpz2zUDgoyAz2QyEw1NLhNsMhEG1FLhVSo9S9adpaAYa14UuP2mZlz5IrLC2zKWy7wWKk0jT8v/2AsVJStHypBcIH2x7gaL4ZfbaqbQXyDuFhlmKnJM/p22oDH2ZBvmWUS4kzsI76xqSSa6dkNUB+0d4JZVxyjQfhtUYR54P+fGQ0Xxcja4h/hyafl65gn3qK2P5oouL5KcxPXbm0bwU+tAw/ykNTfmf5qUp/9MyN+U/iny25D+GsSn/cSpN+Y9pbsp/zLEp/3FtCGyYf5L10pL/tQW8Jf8pxqb8J1kvLflPsl5a8r9KfEv+Z1kvLfmfpba35H/9vXZL/mdZLy35n5fUlP8s66Ul/1nWS0v+87Q05T+nuSn/WTymJf9Z1ktL/hdZLy35X8LclP8lxqb8L7JeWvK/5NKU/0XWS0v+yxib8l9kvbTkv6zPgTTMv4hAtuS/yHppyb8q07SeRpOzvXnsGPIGyHEoydnbVJuL1LSmdUFHR9S3D8KoZpG0ShZHQ7FIWgWLpFWvSFrliqRVrUhaxYqjoVUkrVJF0qpUJK1CRdKqUxwNmSJpVSmSVpEiadUoklaJImlVKI6GQJG06hNJqzyRtKoTSas4kbRqE0dDmkhalYmkVZhIWnWJpFWWOBqqRNIqSiStmkTSKkkkrYpE0ipIHA09ImmVI5JWNSJpFSOSVi0iaZUijoYSkbQKEUmrDpG0yhBJqwqRVxL1mlkGzY43nTqLvFFJLiyLcxf2vAkJGpSk7GbnZqKvQRwNDaJo0yCOhgZxNDSIo6FBHA0N4mhoEEWbBnE0NIijoUEcDQ3iaGgQRZsGcTQ0iKOhQRwNDeJoaBBHQ4Mo2jSIo6FBHA0N4mhoEEdDgzgaGkTRpkEcDQ3iaGgQR0ODOBoaRNGmQRwNDeJoaBBHQ4M4GhrE0dAgijYN4mhoEEdDgzgaGsTR0CCOhgZRtGkQR0ODOBoaxNHQII6GBnG06olc2uLo/cGZsG8ngqJUR4z7EdCU2oizphBTFbm4hMExud1zS8ZLmZ69tpNdeLhNNfz2uQjjyfCQoVr43cOSxpPhYU/V8NuHJY0nw0O3quG3D0saT4aHn1XD73rLwHPhTeiq4bcPSxpPhocBVsNvH5Y0ngwPZayG3z4saTwZHo5ZDb/rLQNPhoeUVsPvWrnAc+HNYqurdjt746vhN89/m/aSNcd4Mjw8maw5xpPhIdZkzTGeDA8TJ2uO8WR4qDtZc4znwpvrkzXHeDI8NgdkzTGeDI/dBFlzjCfDY/tB1hzjyfDYr5A1x3gyPDY4ZM0xngtvOyKy5hhfDe/+8p2tOcaT4bHnImuO8WR4bNLImmM8GR67OrLmGM+Ft20gWXOMJ8Nj30jWHOPJ8NhokjXHeDI8dqZkzTGeDI+tLFlzjCfDY+9L1hzjufC2WSZrjvFkeOyuyZpjfC38tqXCtuNkzTGeDI/9O1lzjCfDY8NP1hzjyfC4Q0DWHOO58HZLgaw5xpPhcQ+CrDnGk+Fx04KsOcaT4XGXg6w5xpPhcVuErDnGc+Hxi6FxfSzde2a80qk0Detj3M6z1XkY05S9WzXD+oi58+iO356E2zW1iZ23J2FEbWa79iTc3al9wVmbAQbU4j/XnhSyCJbXMfSZ9qQwy2bQaxzy2pM00WGRS3J2fjW4704Cv76fp3gNWtvmJOAp92V0TkT3qX89KM/8/E5vEgbVfvjz3iQ9NkG25kt2btXVDmZ1Xl5vEsbUpvXYm7S7iNqgFPrR6+gKyTvsIfUlOYek1o0SpOJOXrPMd7cf769ufvWGDKHPXrvMj7cX3gNxIUhZnJ3zft+KBH5Y+rQ4x+Kl2/CEYy6zS5Nz8p6/ZEkH1FL10ml4wphats4bnjCilqzztx/piFHkLAxOXZGL2ZjcU6SW4OrJW8twveFpzLNcFZzvsIYnb9Cc+sFrDqqdjXIFkBLprnavN0pPmOrczlujMKI2sV1nFPDatLzGKBzG2qTcxigMqs3ruS+qTW4ZhkqvTvVr9q1U+t60tW1qFZv33TisPUzDaB9dry3OpZ/S+lF+FAh7mdrpg7MX1T2JpJ88CSSflJxPcez/S5izCXCRnEme5nQKtZ3k+QS8H+zJ2Svc2g52Xktb2sbGSa4SchW2tjF8sG0bG2X/HIrX6fv5V0hVx9ZeIVUdUHmFFMvjD+nRvP5lPJrXP3VH8/q361gef4yO5vWvy9G8/nk5mp+HT2c5y+fclP/p8RWDfPwojtyS/7VDsiX/UVZuS/6jLKmW/Mdlasp/EsVvyX+SBdmS/yTrpSX/658DaMn/2nHfkv8k66Ul//P6es2G+a9/NaMl/7Osl5b8z6k05X+W9dKS/7mkpvznMTTlP8t6acl/Xq90DfPPIgot+c+yXlryL4rSlP9F1ktL/hdZLy35X8SlWvIvW8am/C+yXlryX4a5Kf9F1ktL/kscm/JfZL205F+sqSn/pcQ23xjG0HYBVnla8+o1j5Hvj6qO3z6uDHviaLgTRZs5cTS8iaNhTRwNZ6JoMyaOhi9xNGyJo+FKHA1T4mh4EkWbJXE0HImjYUgcDT/iaNgRRZsbcTTMiKPhRRwNK+JoOBFHw4go2nyIo2FDHA0X4miYEEfDgzgaFkTR5kAcDQPiaPgPR8N+OBruQ9FmPhwN7+FoWA9Hw3k4GsbD0fAdijbb4Wi4DkfDdDgansPRsByOhuNwVmCGQ16mHv2krL8z8Lq1mLdH1Qa7bsPBqjYUDLPhYBUbDlav4WDVGgqG1XCwSg0Hq9NwsCoNB6vRcLAKDQXDZzhYdYaD1WY4WGWGg9VlKBgqw8FqMhysIsPB6jEcrBrDwWoxFAyJ4WB1GA5WheFgNRgOVoHhYPUXCoa+cLDaCwervHCwugsHq7pQMMyFg1VcOFi9hYNVWzhYrYWDVVooGM7CwaosHKzGwsEqLBysvsLBqivchR62wtEqHHJwcvIaq+bD9ulkSEd1QNoPUPGoDoi7AZAPyVDyOur37zqy11z2Zf7sw9WQlWrw7XOOp7diUsFVbqrBdx1k9hJNKrjKUC347gnN0zs3K8HdX6JVg++6aOwVnVRwla1q8N3rkOyNnlRwlbNqzrfPZp5eAEoFV5mrBt8+mQmcDK7yVw2+fS4TOBlcZbEafPtUJnAuOOSyGnz3EiTFyeAqo9Xgu1cgKU4GV3klawtwMrjKLllbgJPBVY7J2gKcCw6ZJmsL8Frw7VOqkG+ytgAng6usk7UFOBlc5Z6sLcDJ4LoZIGsLcDK4bh7I2gKcC47NBllbgJPBdXNC1hbgZHDdzJC1BTgZXDc/ZG0BTgbXzRJZW4CTwXVzRdYW4FxwbMbI2gK8GnzxNm9kbQFOBtfNHllbgJPBdXNI1hbgZHDdTJK1BTgXHJtPsrYAJ4PrZpWsLcDJ4Lq5JWsLcDK4bobJ2gKcDK6bZ7K2ACeD62abrC3AueDYnJO1BTgZXDfzZG0BXg2+bX3RzT9ZW4CTwfVmAVlbgJPB9eYCWVuAk8H1ZgRZW4Bzwe3mBVlcjOfC29tj+sn7IzXVfqnS5+I8Rh6nZQ7LEMI0hjAM258EL/RIfVroxil7qYs/weprnWoz9N/qVAtfezlLLfpZ09R/AdvvEpcKZW5kc3RyZWFtCmVuZG9iagoyMCAwIG9iago8PCAvVHlwZSAvUGFnZQovTWVkaWFCb3ggWzAuMDAwIDAuMDAwIDU5NS4yODAgODQxLjg5MF0KL1BhcmVudCAzIDAgUgovQ29udGVudHMgMjEgMCBSCj4+CmVuZG9iagoyMSAwIG9iago8PCAvRmlsdGVyIC9GbGF0ZURlY29kZQovTGVuZ3RoIDM0OTYgPj4Kc3RyZWFtCnicpVzbjhy3EX3XVzSQl8SAOrxf9Gav4liGYAuSgDwYfpjsjuSBVrPC7iiG/j7FEat3ml1FF20Dvo3O6Wazqg4PmzXzRM1Kqenyn/fvn2w/fP1v+NCl6KffJzX9OP0yTb/Cf9w80ec/vvwn8K2blQ6TC3PSavImzsblKQYABDfd76d3A5Ck4pyimz5OWlk1a6WXj27hI5Nn679+pE35CGgxhIsP4FLkU9brBw9jiOny+vjRxfWDj3Mw6fH6jx/A9Tcjk16MGD/15M1QiUFQT/3d28nGMzHGNBtrp7c30z+/11Oe0/T23TT98vcXx4fT4fT5dLg7PvvHr9PbH6d/vS28CBCdeN7V4XT47+744ZKjdfp6swSjNX5LerV7OK0IMGgTMk94/nlP3iCa2TmzxX/78e7z8fRsWpFgihJMMHuTF8fT/n7fjAxJ3J1e70771YTp7GdvDEycn4NKxLMAgyRw4/r50/64v6Fvwg3LKBWfav2UJAUFz5QJUr6EY8YYO2uozA367ZdP+2fT1f3+5nCarnb3N2SETJoz5P6G/bJNASToOFtNTNur3ZePezamIB8mBsFtkAAZFzKRz/U2JIebieebHECG1jDjkQxPfkoxQs5zdm7LUP6p0mQ0uRlm84yb4avbu4cmz2oOBFABH4iM+fn34/7+4bfDp+mcDRQ1xDknIjIvjjeH/x1uPu9uqTQIyc82EE/1n/vDaf+UpEQ7g0xtKXfv3pH4YGaYE1Y8yPBwE/Fmd7wu2kmSuCkgVapGiX2a1/vdw6VGq3m7FkNy26wnW64FSa6dTzMsGZOBys+QwbCqvrmMkYNi0ISK/HB4ON3df7m4F7XyL1cxs4d/f4QHBjV//OB2fTNYDWGtI2bj+rpMx/TmtDt9fnhGhozjXr1885ycejEBp11KMDbMOQ4MyQQ3pxwHCNmcl14xwRrIBZsHCA7SIqgBQgyzTwPT6pSbvRqYVmdhQTN2gAApbUEw5YQETiZ4OQFSeNZpINIeykmrgUh7WMWVGYi0P68SA5EOphjIgUgH7+eYByIdEuiVHoh0WRuDHYg0pPbs/UCkI+iuiwORLpbN5oFIJ3AEVg9EGjQJbPRApBMsONoPRDqD71dpINLZetgHDUQ6w7qZR6QyZ/CbbiDSsFlKsIkZCLVWYADBM4wwIix6amRNgS3a2c0NMADp3EC4tYaV2oaBeMPSCKttHgi4Nhp2W3pkcTSwkms7EHJtIiD9SMxNBpcUR2JujYcVdSTm1ltYUkdibpOGNXUk5k5l8FojMXfgjHwcibkL4FbU0ML91T9pD/lIOdGHhz1s4m53Dw+Hd9e7jZNF/8XxvyHNlwyNzkuEXmyXDI2eS4ZGwyVCL25LhkarJUOjzxKhF5MlQ6PDkqHRXsnQ6K1E6MVYydDoqmRotFQyNPopEXoxUzI0OikZGm2UCL14KBkaDZQMje5JhkbrJEIvvkmGRtMkQ6NjEqEXuyRDo1eSodEoydDokmSquVgkIRz9kRCO5kgGX5yREI62SAhHTySEoyGSwRc3JISjFRLC0QcJ4WiCZPDFAQnhaH+EcPQ+MvhifIRwdD1COFoe4QL61a8oqKlAvOV98/lwmr4/3O5v6usm0u1wbNrtyNDodkToxe3I0Oh2ZGh0OyL04nZkaHQ7MjS6HRF6cTsyNLodGRrdjgyNbkeEXtyODI1uR4ZGtyNDo9sRoRe3I0Oj25Gh0e2I0IvbkaHR7cjQ6HZkaHQ7IvTidmRodDsyNLodEXpxOzI0uh0ZGt2ODI1uR6aai9sRwtHtCOHodmTwxe0I4eh2hHB0O0I4uh0ZfHE7Qji6HSEc3Y4Qjm5HBl/cjhCObkcIR7cjgy9uRwhHtyOEo9uRJsHZsPiSC4k4oFbuqVkfHlfTwjNsy6jGhWeYhoHmhWfollENDMvQcA9FmRieoRsGGhmeoVpGNTP8c+SWUQ0Nz0gNA00Nz4gtoxobnhFaRjU3PMO3jGpwunm1YqDJ6ebVmlGNTjev1oxqdrp5tWZUw9PLK73qfUHT08urhlGNTy+vGkY1P728WjPQAPXyqmFUE9TLq4ZRjVAvrxpGNUO9vFoz0BD18qphVFPUy6uGUY1RL6/WDDRHvbxqGNUgdfMqUSapm1drRjVK3bxaMRaz1E2shlINUzezGko1Td3UWlPQOHVzq6FU89RNroZSDVQ3uxpKNVHd9FpT0Eh186uhVDPVTbCGUg1VN8Miaaq6KbamoLHq5lhDqeaqm2MNpRqsbo6tKWiyujnWUKrR6uZYQ6lmq5tjK0p9veQj6HEm2vu+vb4+/Y0iwBKsNdHd51wM2eScfVYm2jY7K9nPWRH9at/tbnfH6z3dGcmOsXSVkj1u7CB/uiMNIXcDrv+Qvf7r/ae7+xPdgegdkC3RD8j1LSPPWlj605b3w93x/Qf4e9odbyieMSAixGS/+W13fP/b7jB9tzt+OBzfU1wNFjMR7XRXd/fwhJvT1Upz4FJ0Jg5zXx4+HmBayJzgHm/TYY0E7rmYDmv2WXod1t4kWHvJnk++w7pYRx+JrQ7bYe3B3BQrL888blydDmt2WEaBkoAykCSw87BwE0JKdVi7oGfn/2yHtQvlGxMDHdYOnGoRVSJnOh3WLpUe0YEOaxftrKhvDLziO6zZmWA7rJ0DUKA7rAPZYe0sbGoSIT9lXbRUNNkZ5vKMnWG+w9ppWLXVn+qwdirM1gx3WMPmcY5U3zjfYe00GBiqc5zpsHZKgWiPdVizE9HrsGanoNdhzT7NQIe1LvoLSQ6rN/g0wzVY2wS23//VBmubyvc2Lhqs8YN1g7UNX/0v5UrKbBApZH0AlSfmj+jFzunc1G1hJ+MjUXhEC9X5e00sQanVZl3HANt7I7+B0WXHOjAi48qGNQ4Qoj1/Y0JMsKpsV/MAwcDaH9QAwZfNamdWN4RU9qoD01rKIxs7QHBlp+oGCKHsU/0AIZdd6kCkvSl71IFIe192qAOR9qnsTwciHRSUQxyIdLBlbzoQ6RDKznQg0rDzgH3pQKSjKbvSgUhHV/akA5GOsexIByKNQgZbbKMI03FucKQIVs3BEI6D7YVE/YOwOE0sn+2pwlfxk6FR+kToRfdkaBQ9GRoVT4Re5E6GRq2ToVHoZGhUORF6kTgZGvVNhkZxk6FR2UToRdZkaNQ0GRoFTYRe1EyGRimToVHHZGgUMRF6UTAZGuVLhkbtkmVs1SHYZipLCN1jpxLFgn2m88ReZtvUhLIF+3mQAqlsydAoWyL0IlsyNMqWDI2yJUIvsiVDo2zJ0ChbMjTKlgi9yJYMjbIlQ6NsydAoWyL0IlsyNMqWDI2yJUIvsiVDo2zJ0ChbMjTKlgi9yJYMjbIlQ6NsidBVTkyCP4+ExpVzCUtJCs/YvH6pssIzVMNAaWEZ5VDCUvLCM1LLqBLDM2LDQJnhGaFlVKnhGb5lVLnhGa5lVMnhGbZhoOzwjDbmKD08o405yk83rwwlQd28MpQMdfPKUFLUzStDyVE3rwwlSd28MpQsdfPKUNLUzStDyVM3rwwlUd28MpRMdfPKUFLVzasVo/olA0STiFd+3IGdCeUlKSGG2Sr4y4WQnaN0MeQZMnPLo8/qUBu54W3P6pDBja85q0Mp5W6weZONBO76vbM640AiLbGn/oOzOmP1DMlATdr99e3uywPFgXTTgXDA5XhuevXyigoON7720Azx3LiaMzOEc0MiX0ZjIMuxNXWWRR6ZIcn4OVPnWdsjM4yng5XFEC+i2QTgxkUdmSGHG5ZRIHtQzSRJO9A/4s0NWcg62zlnIpEvj8woXjKwJyPyuT1dq7Fk79OeeiGeu/4r8mytxlHnPEfquHBztoaE0piniIx8RZytIQcmOhgiLbdnazUk7MNzycLPLnvupYOZFXW2tpx7USQPqyt1vsYdkZU5KOcqRHVRR2QYTG5s2xMyZHADaw7IEM4NizofwzD6cP6BvO2WnzofQ1L5gZ8gPR/DaHIP056P1d+kK2dh3qfz8RQooFHLJ7dT8PnsbrQ1c1IXP1P3+MHmpwAfr1M/eLwMOAYf1ONVlv+Hi7Q3l1xmO7zH0TxeZz287c2pR7rIQQPbgPxXzwC1Lk0iF2eA+MH6DFCrAOv24I8swbgDpDvL3ZzslR+fi52bbU/qIBCwkMoJXoNVHxiSKb/PVXJXSrAKtozODhBs+WEyN0AAC2WSHyBkSBQ1MK2upIAZmFYHKatcGiBEN+eQ5QSvoAZgRZMTLGwV9UCkoSTnaAciXbr7gh+IdABH4uNApMvvnbnciXRz0l1rtWyxyN6FP/hNjlquHP0bqlRFYCxTGbiWqAxcy1MExtKUgWtZysC1JGXgWo4iMJaiDFzLUAauJSgCY/nJwLX0ZOBadjJwLTkRGMtNBq6lJosg/vTt7N3wd8FrlXFksspEYKwyGbhWmQxcq0wExiqTgWuVycC1ymTgWmUiMFaZDFyrTAauVSYCY5XJwLXKZOBaZTJwrTIRGKtMBq5VJkv+Wik+zjoQu4bN20isFpbQvozEimEJ7btIrBqW0L6KxMphCe2bSKwelrB5EVkriCOU99uaqiKWoFtCrSSWoBoCVhP7DLkl1IpiCakl1KpiCbEhYGX1cklT1dXLJU1VWC+XNFVlvVzSVKX1cklT1Va+IhbobwdRcMhxS3VIPV78/8xkC4QKZW5kc3RyZWFtCmVuZG9iagoyMiAwIG9iago8PCAvVHlwZSAvUGFnZQovTWVkaWFCb3ggWzAuMDAwIDAuMDAwIDU5NS4yODAgODQxLjg5MF0KL1BhcmVudCAzIDAgUgovQ29udGVudHMgMjMgMCBSCj4+CmVuZG9iagoyMyAwIG9iago8PCAvRmlsdGVyIC9GbGF0ZURlY29kZQovTGVuZ3RoIDIzMjQgPj4Kc3RyZWFtCnicrVtNbyM3Er3PryCwwCIbQAy/m/TNXzNxVjMZWAL2EOQgWO1EiC05UiuB//0WJZJqSUWpRsgcJJt+VfWarHrFZvd8EFwIwfqfy98+HA8+foJB4xvL/maC/cR+YexX+GH6QW7+3P8Ee224kI5pbbmHb6sarkxgplFcWM+WLXv+FowXDfeNYa/MOcGlEmXkhTkbuG62I1LFETBqnOsNgCP0KpN3pwVvpOp5zyM7705Lbpzaed8NgPdDVjRPx8yxKz4giRDArvdmzHSzMWyC5U54Np6yHz5KFjj8+MzYL99dPz11//rPr2z8E7sf9w08RFT22ABmzUohlXdBGdNoLWTfXGrFnZFgHzYLemR/M3mZzJ/aK7ZnBcttmhM0f35r51eoRY3nl0UfriSshGnqAe4mXYsa1Pw/tm+LZddOr7DJc5o7K46NHuarbtatu9lifsVGNw/sdrKcrjAPFvLfNcceJvMp+zp5f23nHRu1y79mTy1qb2KdmmP7YTdFl6vG+Otk1aEGNYJ36xbF1whdvy7W866SDhby3wZsHrt22R4wy0bGcdUgmfcIS3yFrrEL3Bj1DUlR4xXT9CAlik2NlhKiGUg1QI2gql3QiJFEFt0Fx4NB5nj8/gYFd7tsp7Nuk3LoCgnFG41k+rCSAi5ILi0ybSk/K2uq4NIkkmlHYbKB8BzaQjUMZlOdibvDHCgW3nLtJLY8Ug5Qi0bzpkGkRPiBMOhq1ma4lmfVGb59Waxw6XFWcyOQjPn573m7XP0+e2ObbMBMjeReoao1nf01m64nL2gaQAOTAbmq/y1nXTtATUzDnUSua/H8jOK1AxFG6i2JB7o8tYkYQfuJAowa1aYAU6mySrWreWwnq0WvbUHvPto4QYHrIJmFKxUi7n8cNyGw4LnWMm5/Rv0Vkh6ECtGQH2erbrF870XCNmnFi+MatD7uT7hyu4GX/WBCc++QCYQtQ5wMNuom3Xq1P/nCwf5E1G1vh6O7PQNoC6oJdYPv99DWc6VPUNtHNw4S01DRwWxqjYZWUnEpqLwVbNtisySijd9sOYhoZ3nwZN5egzCeWKA9NOztuA9U3lrCHyyVt4Y081JT0daC2J7gDdvSfUnzsM874f0Ab+BKzanMOsQrA6Xj6XjQCNg10/GwJQn6RO4e4oPa3g8Q8VZabsOJ/D3Ea1AefSLLjuZ/oyEW7gKUx/R0tWo7zKABLQ1Is799maxWs+enyZF0J8mxkNnGI+34e0xviOikN0R00hsiOukNDZ31hohOekNEJ70hopPeENFJb2jorDdEdNIbIjrpDRGd9IaITmpDQ2etIaKT0hDRSWeI6KQyRHTSGBo6KwwRnfSFOt9bsYCbVimRXf5oDfc5H2cv7TRtUlDBqFnjgkFDZ8GgobNg0NBZMEjoIhg0dBYMGjoLBg2dBYOGzoJBQhfBoKGzYNDQWTBo6CwYNHQWDBK6CAYNnQWDhs6CQUNnwaChs2CQ0EUwaOgsGLTayTVv4h04ciMp7EAqtO4h161GzgWEGaB4HU8eEAE7cJ+FoupeD1A80X1Wlqp7NUDxRPdZiqruD45MMp7mvmhXzf3RaVnCV91LVOyq7vfZFzzRfVbHqnsxQPFE91lOq3MfBiie6D7rb9W9H6B4mvsi2FX3zQDFE91nha+6dwMUT3SfW0LVvR2geKL73EOImlPwRPe56RA1p+Bp7kuXImpOwRPd57ZG1JyCJ7rPfZCoOQVfdY/ez1M1p+CJ7nOnJWpOwdPcl9ZM1JyCJ7rPvZyoOQVPcP/Dp5Fkv63it4rf6UFqPGdtrGOvsIGQkCemjLzAiOBWbkfimWx5trobYM/RoU6OTfwWXLr4VHn3uXmCfjj4+GlHwXJ1QGE7QqVwSJ3m6Xik9mQ8zx36HkB1Qg8uD6FOm04rFOt/AqEoStsjaxMs9z6duSsmQUrS2t/P/1zPlrO2dzAN9sZWHvsb5yCXZDwKd6ZhUnPh9fa1A/SdhkhhSz+WqAlI9o3aP9ft/Kk9HV8KwZ1ThYBSGmqGxkBG6ZSqTqH3nPnMLESVtKGwsAZIeNo0wAILEeok9p5q4dGhw3jblOhmOyWk6E2A5tTUo49nr2eiG2j+VokS3UN0E0jRjYq7fVGP/hhzYNWxr+vl22J1hogVURt2iwBFLIIlEYmmQZ5YhO2DqxI/Z73VXINyIlmPKkEv6y1wlMjTvl03RbmWdE+RsXSvhS7pXot9+3h/9zC+vr29H43Yp8frz/f3X9jw4fPD+P7uNK2S/4kWkv/VCcn5X2OlhFID2M8Kf4ZDroLEAamCKodcBTUOwl/1nkWj4UsZpPBIGdTClzKohhenY5fMz/l4nPm12CXzqwnp+s8kBPcbB7vPXg+I9+7OXlINBnhr5NGvOh24VEOKfFE11GL/ePfxlt1M5n+w4ex11rXTM5OQSyBxuaQEqtMglBzA5lD5MxxyCSQOl5RAjYOUV1afDl9KIIW/pASq4c/kYCmBnIQXlEA99rkCzBWg4G4mPkT+9grQYvPC5lFsTewHKfJFFVCLHSvg5vrLf9v4w3BM7QGJyiUFUGOihAybArDEHpA4XFIANQ5SX51rQaUAUvhLCqAWXihiD8g5eEEB1Kd/84/WBSR8x0fi314DEpg75LUcQ+wCKfJFNVCLPWT/ZmP2cTaf7N+KnOoAicclBVCjAQXgB5sXHIkdIHG4pABqHGRzJc80oFIAKfwlBVALfy7/SgHkBLygAKqX3s/+ylmIEYErZXrHB3lkd1hghOem6b1Xvxv4J85CjGh4c0BhO0KlcEid5ul45J84C9lxOLg8hDptOk+ehcTS0fndbeQs5J2N1q+vk+U77UQE9uHcQxo28YVY2u1wughtJQ9YFpLugiXMmva2xLeAcrS7YBnfxNS2TmC86Hovr+LhbeABZjGH94FLo2nhIYsa+K1+/ZNVx7Rgd5P31WkW0MWg+FVhIeNqBkmiEW29UWdoQM/4vJh3v58homNlQMRLiGioPK31GSJQDxQim/8JBJXRX5cgaKc0YOohTJXHY/vUf4H8TJvXGhh47IXY4XDvaWfOxhp+7+Xwkjw19N5ReVljErosRA29/wgkT1cNfXyg8X/ZuqR4CmVuZHN0cmVhbQplbmRvYmoKeHJlZgowIDI0CjAwMDAwMDAwMDAgNjU1MzUgZiAKMDAwMDAwMDAwOSAwMDAwMCBuIAowMDAwMDAwMDc0IDAwMDAwIG4gCjAwMDAwMDAxMjAgMDAwMDAgbiAKMDAwMDAwMDQxNiAwMDAwMCBuIAowMDAwMDAwNDUzIDAwMDAwIG4gCjAwMDAwMDA2MDQgMDAwMDAgbiAKMDAwMDAwMDcwNyAwMDAwMCBuIAowMDAwMDAyOTU1IDAwMDAwIG4gCjAwMDAwMDMwNjQgMDAwMDAgbiAKMDAwMDAwMzE3MiAwMDAwMCBuIAowMDAwMDAzMjgzIDAwMDAwIG4gCjAwMDAwMTA1MjcgMDAwMDAgbiAKMDAwMDAxMDU4NyAwMDAwMCBuIAowMDAwMDEwNjQ3IDAwMDAwIG4gCjAwMDAwMTA3MDQgMDAwMDAgbiAKMDAwMDAxMDc2MSAwMDAwMCBuIAowMDAwMDEwODY2IDAwMDAwIG4gCjAwMDAwMTQwMTAgMDAwMDAgbiAKMDAwMDAxNDExNSAwMDAwMCBuIAowMDAwMDE4ODg0IDAwMDAwIG4gCjAwMDAwMTg5ODkgMDAwMDAgbiAKMDAwMDAyMjU1OSAwMDAwMCBuIAowMDAwMDIyNjY0IDAwMDAwIG4gCnRyYWlsZXIKPDwKL1NpemUgMjQKL1Jvb3QgMSAwIFIKL0luZm8gNSAwIFIKL0lEWzw4MTU5MDI5YTlmZjA5ZWQwMzg4Y2MzMjFlMzQ3NWM1MT48ODE1OTAyOWE5ZmYwOWVkMDM4OGNjMzIxZTM0NzVjNTE+XQo+PgpzdGFydHhyZWYKMjUwNjIKJSVFT0YK"
                       <br/>},
                       
                       <br>
                        }<br>

                

                    <!-- VOTER ID UPLOAD -->
                        <!-- <span class = "badge badge-warning"><h4><u>Voter ID Upload</u></h4></span><br>
                        <p><b> Hitting URL : </b>http://regtechapi.in/api/voter_upload</p>
                        <b>Request form-data : </b><br>
                        file – voter id image file<br>
                        <br>-
                        <b>Success Response :</b>
                        <br>
                        <p>
                        "{\"data\":  {\"client_id\":  \"ocr_voter_JJqCfxggzTMswegksvdp\",  \"ocr_fields\":  [{\"document_type
                        \":  \"voterid_front\",  \"full_name\":  {\"value\":  \"Rajesh\",  \"confidence\":  92.0},  \"age\":  {\" value\":  \"26\",  \"confidence\":  78.0},  \"care_of\":  {\"value\":  \"Saradaval\",  \"confidence\":  9 6.0},  \"dob\":  {\"value\":  \"1800-01-01\",  \"confidence\":  0.0},  \"doc\":  {\"value\":  \"2003-01- 01\",  \"confidence\":  95.0},  \"gender\":  {\"value\":  \"M\",  \"confidence\":  95.0},  \"epic_number\ ":  {\"value\":  \"MTG1947852\",  \"confidence\":  92.0}}]},  \"status_code\":  200,  \"success\":  true,
                        \"message\":  null,  \"message_code\":  \"success\"}\n"

                        </p> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!---Equifax Only Pdf end--->
    <!---Equifax score only--->
    <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#telecomee" data-toggle="collapse">Ecredit Score</a>
        </div>
        <div id = "telecomee" class = "collapse" data-parent="#accordion">
            <div class = "card-body">
                <div class="row">
                    <div class = "col-md-4">
                        <span class = "badge badge-dark"><h3>Ecredit Score</h3></span>
                    </div>
                    <div class = "col-md-6">
                        <span class = "badge badge-warning"><h4><u>Ecredit Score</u></h4></span><br>
                        <p><b> Hitting URL : </b>http://regtechapi.in/api/ecredit_score</p>
                        <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                        <b>Request Body : </b><br>
                        {<br>   
                        "fname":""<br>
                        "lname":""<br>
                        "phone_number":""<br>
                        "pan_num":""<br>
                        "dob":""<br>
                        
                        }<br>
                        <b>Success Response :</b><br>
                        {<br>
                       {
                            "Score": {
                            "data": {
                                "Name": "PRITESHMEHETRE",
                                "ScoreDetails": "790"
                            }
                        },
                        "statusCode": "200"
   
                        }<br>}

                

                    <!-- VOTER ID UPLOAD -->
                        <!-- <span class = "badge badge-warning"><h4><u>Voter ID Upload</u></h4></span><br>
                        <p><b> Hitting URL : </b>http://regtechapi.in/api/voter_upload</p>
                        <b>Request form-data : </b><br>
                        file – voter id image file<br>
                        <br>-
                        <b>Success Response :</b>
                        <br>
                        <p>
                        "{\"data\":  {\"client_id\":  \"ocr_voter_JJqCfxggzTMswegksvdp\",  \"ocr_fields\":  [{\"document_type
                        \":  \"voterid_front\",  \"full_name\":  {\"value\":  \"Rajesh\",  \"confidence\":  92.0},  \"age\":  {\" value\":  \"26\",  \"confidence\":  78.0},  \"care_of\":  {\"value\":  \"Saradaval\",  \"confidence\":  9 6.0},  \"dob\":  {\"value\":  \"1800-01-01\",  \"confidence\":  0.0},  \"doc\":  {\"value\":  \"2003-01- 01\",  \"confidence\":  95.0},  \"gender\":  {\"value\":  \"M\",  \"confidence\":  95.0},  \"epic_number\ ":  {\"value\":  \"MTG1947852\",  \"confidence\":  92.0}}]},  \"status_code\":  200,  \"success\":  true,
                        \"message\":  null,  \"message_code\":  \"success\"}\n"

                        </p> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    



    <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#Voter" data-toggle="collapse">Voter ID APIs</a>
        </div>
        <div id = "Voter" class = "collapse" data-parent="#accordion">
            <div class = "card-body">
                <div class="row">
                    <div class = "col-md-4">
                        <span class = "badge badge-dark"><h3>Voter ID APIs</h3></span>
                    </div>
                    <div class = "col-md-6">
                        <span class = "badge badge-warning"><h4><u>Voter ID Verification</u></h4></span><br>
                        <p><b> Hitting URL : </b>http://regtechapi.in/api/voter_validation</p>
                        <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                        <b>Request Body : </b><br>
                        {<br>   
                        "voter_number":""<br>
                        }<br>
                        <b>Success Response :</b><br>
                        {<br>
                        "data": {<br>
                        "relation_type": "F",<br>
                        "gender": "M",<br>
                        "age": "29",<br>
                        "epic_no": "NLN2089555",<br>
                        "client_id": "bkpkzGyssQ",<br>
                        "dob": "1990-08-31",<br>
                        "relation_name": "KALEEN BHAIYA",<br>
                        "name": "MUNNA BHAIYA",<br>
                        "area": "Mirzapur",<br>
                        "state": "Uttar Pradesh",<br>
                        "house_no": "Tripathi Haveli"<br>
                        },<br>
                        "status_code": 200,<br>
                        "message": "",<br>
                        "success": true<br>
                        }<br>

                

                    <!-- VOTER ID UPLOAD -->
                        <span class = "badge badge-warning"><h4><u>Voter ID Upload</u></h4></span><br>
                        <p><b> Hitting URL : </b>http://regtechapi.in/api/voter_upload</p>
                        <b>Request form-data : </b><br>
                        file – voter id image file<br>
                        <br>-
                        <b>Success Response :</b>
                        <br>
                        <p>
                        "{\"data\":  {\"client_id\":  \"ocr_voter_JJqCfxggzTMswegksvdp\",  \"ocr_fields\":  [{\"document_type
                        \":  \"voterid_front\",  \"full_name\":  {\"value\":  \"Rajesh\",  \"confidence\":  92.0},  \"age\":  {\" value\":  \"26\",  \"confidence\":  78.0},  \"care_of\":  {\"value\":  \"Saradaval\",  \"confidence\":  9 6.0},  \"dob\":  {\"value\":  \"1800-01-01\",  \"confidence\":  0.0},  \"doc\":  {\"value\":  \"2003-01- 01\",  \"confidence\":  95.0},  \"gender\":  {\"value\":  \"M\",  \"confidence\":  95.0},  \"epic_number\ ":  {\"value\":  \"MTG1947852\",  \"confidence\":  92.0}}]},  \"status_code\":  200,  \"success\":  true,
                        \"message\":  null,  \"message_code\":  \"success\"}\n"

                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--DL APIS-->
    <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#DL" data-toggle = "collapse">Driving License APIs</a>
        </div>
        <div id = "DL" class = "collapse" data-parent="#accordion">
            <div class = "card-body">
                <div class="row">
                  <div class = "col-md-4">
                    <span class = "badge badge-dark"><h3>Driving License APIs</h3></span>
                  </div>
                  <div class = "col-md-6">
                    <span class = "badge badge-warning"><h4><u>DL Verification</u></h4></span><br>
                    <p><b> Hitting URL : </b> http://regtechapi.in/api/license_validation</p>
                    <b>Header : </b><br>
                    {<br>   
                    "AccessToken":"xxxxxxxxxxxxx"<br>
                    }<br>
                    <b>Request Body : </b><br>
                    {<br>   
                    "license_number":"UP20 20150000000"<br>
                    "dob":"DD/MM/YYYY"<br>
                    }<br>
                    <b>Success Response : </b><br>
                        {<br>
                    "data": {<br>
                    "temporary_address": "TRIPATHI HAVELI, MIRZAPUR",<br>
                    "father_or_husband_name": "KALEEN BHAIYA",<br>
                    "doe": "2032-07-23",<br>
                    "temporary_zip": "231001",<br>
                    "permanent_address": "TRIPATHI HAVELI, MIRZAPUR",<br>
                    "doi": "2012-07-24",<br>
                    "client_id": "dIysSjHnIG",<br>
                    "citizenship": "IND",<br>
                    "dob": "1990-08-31",<br>
                    "permanent_zip": "231001",<br>
                    "gender": "Male",<br>
                    "license_number": "UP20 20150000000",<br>
                    "name": "MUNNA BHAIYA",<br>
                    "state": "UP",<br>
                    "ola_name": "DISTRICT TRANSPORT OFFICE, MIRZAPUR",<br>
                    "ola_code": "UP20"<br>
                    },<br>
                    "status_code": 200,<br>
                    "message": "",<br>
                    "success": true<br>
                    }<br>
                    


                    <!-- DL Upload -->
                    <span class = "badge badge-warning"><h4><u>DL Upload</u></h4></span><br>
                    <p><b> Hitting URL : </b>http://regtechapi.in/api/driving_upload</p>
                    <br>
                    <b>Header : </b><br>
                    {<br>   
                    "AccessToken":"xxxxxxxxxxxxx"<br>
                    }<br>
                    <b>Request form-data : </b><br>
                    front – driving license front image file<br>
                    back - driving license back image file<br>
                    <br>
                    <b>Success Response :</b>
                    <br>
                    <p>
                        "{\"data\":  {\"document_type\":  null,  \"license_number\":  {\"value\":  \"MH13  20100006214\",  \"con fidence\":  80.0},  \"dob\":  {\"value\":  \"1991-07-
                        04\",  \"confidence\":  90.0},  \"image_url\":  null},  \"status_code\":  200,  \"success\":  true,  \"mes sage\":  null,  \"message_code\":  \"success\"}\n"
                    </p>
                   </div>
                </div>
            </div>
        </div>
    </div>

    <!--RC APIS-->
    <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#RC" data-toggle = "collapse">RC APIs</a>
        </div>
        <div id = "RC" class = "collapse" data-parent = "#accordion">
            <div class = "card-body">
                <div class="row">
                  <div class = "col-md-4">
                    <span class = "badge badge-dark"><h3>RC APIs</h3></span>
                  </div>
                  <div class = "col-md-6">
                    <span class = "badge badge-warning"><h4><u>RC Verification</u></h4></span><br>
                    <p><b> Hitting URL : </b> http://regtechapi.in/api/rc_validation</p>
                    <b>Header : </b><br>
                    {<br>   
                    "AccessToken":"xxxxxxxxxxxxx"<br>
                    }<br>
                    <b>Request Body : </b><br>
                    {<br>   
                    "rc_number":"mh11at9556"<br>
                    }<br>
                    <p><b>Success Response : </b><br>
                        [<br>
                            
                        &nbsp;&nbsp;&nbsp;{<br>
                        &nbsp;&nbsp;&nbsp;"rc_validation": {<br> &nbsp;&nbsp;&nbsp;"data": {<br>
                        &nbsp;&nbsp;&nbsp;"client_id": "rc_szGFosDXfTUuoejqRwLt", <br>
                        &nbsp;&nbsp;&nbsp;"rc_number": "mh11at9556",<br>
                        &nbsp;&nbsp;&nbsp;"registration_date": "2010-03-22",<br>
                        &nbsp;&nbsp;&nbsp;"owner_name": "BHARAT BHALKE",<br>
                        &nbsp;&nbsp;&nbsp;"present_address": "",<br>
                        &nbsp;&nbsp;&nbsp;"permanent_address": "",<br>
                        &nbsp;&nbsp;&nbsp;"mobile_number": "",<br>
                        &nbsp;&nbsp;&nbsp;"vehicle_category": "",<br>
                        &nbsp;&nbsp;&nbsp;"vehicle_chasi_number": "ME121C021A20XXXXX",<br> 
                        &nbsp;&nbsp;&nbsp;"vehicle_engine_number": "21C20XXXXX",<br> 
                        &nbsp;&nbsp;&nbsp;"maker_description": "",<br>
                        &nbsp;&nbsp;&nbsp;"maker_model": "INDIA YAMAHA MOTOR PVT LTD / YAMAHA FZ S",
                        <br>
                        &nbsp;&nbsp;&nbsp;"body_type": "", <br>
                        &nbsp;&nbsp;&nbsp;"fuel_type": "PETROL",<br>
                        &nbsp;&nbsp;&nbsp;"color": "",<br>
                        &nbsp;&nbsp;&nbsp;"norms_type": "NOT AVAILABLE",<br>
                        &nbsp;&nbsp;&nbsp;"fit_up_to": "2025-03-21",<br>
                        &nbsp;&nbsp;&nbsp;"financer": "",<br>
                        &nbsp;&nbsp;&nbsp;"insurance_company": "",<br> 
                        &nbsp;&nbsp;&nbsp;"insurance_policy_number": "",<br>
                        &nbsp;&nbsp;&nbsp;"insurance_upto": "2020-10-04",<br> 
                        &nbsp;&nbsp;&nbsp;"manufacturing_date": "",<br>
                        &nbsp;&nbsp;&nbsp;"registered_at": "SATARA, MAHARASHTRA", "latest_by": null,<br>
                        &nbsp;&nbsp;&nbsp;"less_info": true, "tax_upto": "1800-01-01",<br> 
                        &nbsp;&nbsp;&nbsp;"cubic_capacity": null,<br>
                        &nbsp;&nbsp;&nbsp;"vehicle_gross_weight": null,<br>
                         
                        &nbsp;&nbsp;&nbsp;"no_cylinders": null,<br>
                        &nbsp;&nbsp;&nbsp;"seat_capacity": null,<br>
                        &nbsp;&nbsp;&nbsp;"sleeper_capacity": null,<br>
                        &nbsp;&nbsp;&nbsp;"standing_capacity": null,<br>
                        &nbsp;&nbsp;&nbsp;"wheelbase": null,<br> 
                        &nbsp;&nbsp;&nbsp;"unladen_weight": null,<br>
                        &nbsp;&nbsp;&nbsp;"vehicle_category_description": null,<br>
                        &nbsp;&nbsp;&nbsp;"pucc_number": null,<br>
                        &nbsp;&nbsp;&nbsp;"pucc_upto": null,<br>
                        &nbsp;&nbsp;&nbsp;"masked_name": false<br>
                        &nbsp;&nbsp;&nbsp;},<br>
                        &nbsp;&nbsp;&nbsp;"status_code": 200, "success": true, "message": null,<br>
                        &nbsp;&nbsp;&nbsp;"message_code": "success"<br>
                        &nbsp;&nbsp;&nbsp;},<br>
                        &nbsp;&nbsp;&nbsp;"statusCode": null<br>
                        &nbsp;&nbsp;&nbsp;}<br>
                        &nbsp;&nbsp;]<br>
                    </p>
                    <!-- <span class = "badge badge-warning"><h4><u>RC Full</u></h4></span><br>
                    <p><b> Hitting URL : </b> http://regtechapi.in/api/</p>
                    <b>Request Body : </b><br>
                    {<br>   
                    "rc_number":"mh11at9556"<br>
                    }<br>
                    <p><b>Success Response : </b><br>
                        [<br>
                            
                        &nbsp;&nbsp;&nbsp;{<br>
                        &nbsp;&nbsp;&nbsp;"rc_validation": {<br> &nbsp;&nbsp;&nbsp;"data": {<br>
                        &nbsp;&nbsp;&nbsp;"client_id": "rc_szGFosDXfTUuoejqRwLt", <br>
                        &nbsp;&nbsp;&nbsp;"rc_number": "mh11at9556",<br>
                        &nbsp;&nbsp;&nbsp;"registration_date": "2010-03-22",<br>
                        &nbsp;&nbsp;&nbsp;"owner_name": "BHARAT BHALKE",<br>
                        &nbsp;&nbsp;&nbsp;"present_address": "",<br>
                        &nbsp;&nbsp;&nbsp;"permanent_address": "",<br>
                        &nbsp;&nbsp;&nbsp;"mobile_number": "",<br>
                        &nbsp;&nbsp;&nbsp;"vehicle_category": "",<br>
                        &nbsp;&nbsp;&nbsp;"vehicle_chasi_number": "ME121C021A20XXXXX",<br> 
                        &nbsp;&nbsp;&nbsp;"vehicle_engine_number": "21C20XXXXX",<br> 
                        &nbsp;&nbsp;&nbsp;"maker_description": "",<br>
                        &nbsp;&nbsp;&nbsp;"maker_model": "INDIA YAMAHA MOTOR PVT LTD / YAMAHA FZ S",
                        <br>
                        &nbsp;&nbsp;&nbsp;"body_type": "", <br>
                        &nbsp;&nbsp;&nbsp;"fuel_type": "PETROL",<br>
                        &nbsp;&nbsp;&nbsp;"color": "",<br>
                        &nbsp;&nbsp;&nbsp;"norms_type": "NOT AVAILABLE",<br>
                        &nbsp;&nbsp;&nbsp;"fit_up_to": "2025-03-21",<br>
                        &nbsp;&nbsp;&nbsp;"financer": "",<br>
                        &nbsp;&nbsp;&nbsp;"insurance_company": "",<br> 
                        &nbsp;&nbsp;&nbsp;"insurance_policy_number": "",<br>
                        &nbsp;&nbsp;&nbsp;"insurance_upto": "2020-10-04",<br> 
                        &nbsp;&nbsp;&nbsp;"manufacturing_date": "",<br>
                        &nbsp;&nbsp;&nbsp;"registered_at": "SATARA, MAHARASHTRA", "latest_by": null,<br>
                        &nbsp;&nbsp;&nbsp;"less_info": true, "tax_upto": "1800-01-01",<br> 
                        &nbsp;&nbsp;&nbsp;"cubic_capacity": null,<br>
                        &nbsp;&nbsp;&nbsp;"vehicle_gross_weight": null,<br>
                        &nbsp;&nbsp;&nbsp;"Tag": "VC4",<br>
                        &nbsp;&nbsp;&nbsp;"no_cylinders": null,<br>
                        &nbsp;&nbsp;&nbsp;"seat_capacity": null,<br>
                        &nbsp;&nbsp;&nbsp;"sleeper_capacity": null,<br>
                        &nbsp;&nbsp;&nbsp;"standing_capacity": null,<br>
                        &nbsp;&nbsp;&nbsp;"wheelbase": null,<br> 
                        &nbsp;&nbsp;&nbsp;"unladen_weight": null,<br>
                        &nbsp;&nbsp;&nbsp;"vehicle_category_description": null,<br>
                        &nbsp;&nbsp;&nbsp;"pucc_number": null,<br>
                        &nbsp;&nbsp;&nbsp;"pucc_upto": null,<br>
                        &nbsp;&nbsp;&nbsp;"masked_name": false<br>
                        &nbsp;&nbsp;&nbsp;},<br>
                        &nbsp;&nbsp;&nbsp;"status_code": 200, "success": true, "message": null,<br>
                        &nbsp;&nbsp;&nbsp;"message_code": "success"<br>
                        &nbsp;&nbsp;&nbsp;},<br>
                        &nbsp;&nbsp;&nbsp;"statusCode": null<br>
                        &nbsp;&nbsp;&nbsp;}<br>
                        &nbsp;&nbsp;]<br>
                    </p> -->
                  </div>
                </div>
            </div>
        </div>
    </div>


    <!--CORPORATE APIS-->
    <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#CIN" data-toggle = "collapse">CIN APIs</a>
        </div>

        <div id = "CIN" class = "collapse" data-parent = "#accordion">
        <div class = "card-body">
            <div class="row">
              <div class = "col-md-4">
                <span class = "badge badge-dark"><h3>Corporate CIN APIs</h3></span>
              </div>
              <div class = "col-md-6">
                <span class = "badge badge-warning"><h4><u>CIN</u></h4></span><br>
                <p><b> Hitting URL : </b> http://regtechapi.in/api/corporate_cin</p>
                <b>Header : </b><br>
                {<br>   
                "AccessToken":"xxxxxxxxxxxxx"<br>
                }<br>
                <b>Request Body : </b><br>
                {<br>   
                "corporate_cin":"U72900PN2018PTC180125"<br>
                }<br>
                <p><b>Success Response : </b><br>
                    [<br>
                        
                    &nbsp;&nbsp;&nbsp;{<br>
                    &nbsp;&nbsp;&nbsp;"corporate_cin": {<br> 
                    &nbsp;&nbsp;&nbsp;"data": {<br>
                    &nbsp;&nbsp;&nbsp;"client_id": "corporate_cin_wdDJojPsekbnkswTGxYk", <br>
                    &nbsp;&nbsp;&nbsp;"cin_number": "U72900PN2018PTC180125",<br>
                    &nbsp;&nbsp;&nbsp;"company_name": "ZAPFIN TEKNOLOGIES PRIVATE LIMITED",<br>
                    &nbsp;&nbsp;&nbsp;"incorporation_date": "2018-11-09",<br>
                    &nbsp;&nbsp;&nbsp;"phone_number": "+918470067555",<br>
                    &nbsp;&nbsp;&nbsp;"company_address": "11B, Aditya Business Center$SN-1A,Kondhwa,                &nbsp;&nbsp;&nbsp;&nbsp;Khurd$PUNE$Pune$Maharashtra$411048$India$",<br>    
                    &nbsp;&nbsp;&nbsp;"email": "ashokonly@gmail.com",<br>
                    &nbsp;&nbsp;&nbsp;"company_class": "PRIV",<br>
                    &nbsp;&nbsp;&nbsp;"zip": "411048",<br>
                    &nbsp;&nbsp;&nbsp;"directors": [<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;{<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;"din_number": "00517254",<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;"director_name": "ASHOK KUMAR"<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;},<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;{<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;"din_number": "08862561",<br> 
                    &nbsp;&nbsp;&nbsp;&nbsp;"director_name": "PRASHANT KUMAR"<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;}<br>
                    ],<br>
                    "authorized_capital": "2500000",<br>
                    "paid_up_capital": "1628370",<br>
                    "last_agm_date": "2019-09-30",<br>
                    "last_bs_date": "2019-03-31", <br>"company_status": "Active", <br>"listed_status": "Unlisted"<br>
                    },<br>
                    "status_code": 200,<br> "success": true,<br> "message": null,<br>
                    "message_code": "success"<br>
                    },<br>
                    "statusCode": null<br>

                    &nbsp;&nbsp;&nbsp;}<br>
                    ]<br>
                    </p>                
                </div>
                </div>
            </div>
        </div>
    </div>


    <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#DIN" data-toggle = "collapse">DIN APIs</a>
        </div>
        <div id = "DIN" class = "collapse" data-parent = "#accordion">
            <div class = "card-body">
                <div class="row">
                    <div class = "col-md-4">
                        <span class = "badge badge-dark"><h3>Corporate DIN APIs</h3></span>
                    </div>
                    <div class = "col-md-6">
                        <span class = "badge badge-warning"><h4><u>DIN</u></h4></span><br>
                        <p><b> Hitting URL : </b> http://regtechapi.in/api/corporate_din</p>
                        <b>Request Method : POST</b><br>
                        <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                        <b>Request Body : </b><br>
                        {<br>   
                        "id_number":"@{{din_number}}"<br>
                        }<br>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#GSTIN" data-toggle = "collapse">GSTIN APIs</a>
        </div>
        <div id = "GSTIN" class = "collapse" data-parent = "#accordion">
            <div class = "card-body">
                <div class="row">
                    <div class = "col-md-4">
                        <span class = "badge badge-dark"><h3>Corporate GSTIN APIs</h3></span>
                    </div>
                    <div class = "col-md-6">
                        <span class = "badge badge-warning"><h4><u>GSTIN</u></h4></span><br>
                        <p><b> Hitting URL : </b> http://regtechapi.in/corporate_gstin</p>
                        <!-- <b>Request Method : POST</b><br> -->
                        <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                        <b>Request Body : </b><br>
                        {<br>   
                        "corporate_gstin":"27AABCZ2858B1ZC"<br>
                        }<br>
                        <b>Success Response : </b><br>
                        [
                            {
                                "corporate_gstin": { 
                                "code": "200",
                                "status": "success",  
                                "response": {
                                    "gstin": "{{@gstin_number}}",
                                    "legal_name": "{{@legal_name}}",
                                    "jurisdiction": "{{@jurisdiction}}", "reg_date": "{{@reg_date}}",
                                    "taxpayer_type": "{{@taxpayer_type}}",
                                    "status": "{{@status}}",
                                    "address": "{{@address}}",
                                    "business_type": "{{@business_type}}",
                                    "nature" : "{{@nature}}",
                                    "last_update": "{{@last_update}}",
                                    "state_code": "{{@state_code}}"
                                },
                            
                            }
                            "statusCode": "200"
                        }
                        ]
                    </div>               
                </div>
            </div>
        </div>
    </div>

    <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#GSTINCONF" data-toggle = "collapse">GSTIN With Confidence APIs</a>
        </div>
        <div id = "GSTINCONF" class = "collapse" data-parent = "#accordion">
            <div class = "card-body">
                <div class="row">
                    <div class = "col-md-4">
                        <span class = "badge badge-dark"><h3>GSTIN With Confidence APIs</h3></span>
                    </div>
                    <div class = "col-md-6">
                        <span class = "badge badge-warning"><h4><u>GSTIN With Confidence</u></h4></span><br>
                        <p><b> Hitting URL : </b> http://regtechapi.in/api/gstin_pan_confidence</p>
                        <!-- <b>Request Method : POST</b><br> -->
                        <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                        <b>Request Body : </b><br>
                        {<br>   
                            "corporate_gstin":"{{@gstin_number}}",<br>
                            "name":"{{@name}}",<br>
                            "mobile_number":"{{@mobile_number}}",<br>
                            "address":"{{@address}}",<br>
                            "state":"{{@state}}",<br>
                            "city":"{{@city}}",<br>
                            "pincode":"{{@pincode}}",<br>
                        }<br>
                        <b>Success Response : </b><br>
                        [
                            {
                                "corporate_gstin": { 
                                "code": "200",
                                "status": "success",  
                                "response": {
                                    "gstin": "{{@gstin_number}}",
                                    "legal_name": "{{@legal_name}}",
                                    "jurisdiction": "{{@jurisdiction}}", "reg_date": "{{@reg_date}}",
                                    "taxpayer_type": "{{@taxpayer_type}}",
                                    "status": "{{@status}}",
                                    "address": "{{@address}}",
                                    "business_type": "{{@business_type}}",
                                    "nature" : "{{@nature}}",
                                    "last_update": "{{@last_update}}",
                                    "state_code": "{{@state_code}}"
                                },                            
                            }
                            "confidence": "100%",
                            "statusCode": "200"
                        }
                        ]
                    </div>               
                </div>
            </div>
        </div>
    </div>


    <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#passport" data-toggle = "collapse">Passport APIs</a>
        </div>
        <div id = "passport" class = "collapse" data-parent = "#accordion">
            <div class = "card-body">
                <div class="row">
                    <div class = "col-md-4">
                        <span class = "badge badge-dark"><h3>Passport APIs</h3></span>
                    </div>
                    <div class = "col-md-6">
                        <!-- <span class = "badge badge-warning"><h4><u>Passport Create Client</u></h4></span><br>
                        <p><b> Hitting URL : </b>http://regtechapi.in/api/</p>
                        <b>Request Method : POST </b><br>
                        <p><b>Success Response : </b><br>
                        &nbsp;&nbsp;{<br>
                        &nbsp;&nbsp;"data": {<br>
                        &nbsp;&nbsp;"client_id": "takdTqhCxo"<br>
                        &nbsp;&nbsp;},<br>
                        &nbsp;&nbsp;"status_code": 201,<br>
                        &nbsp;&nbsp;"message": "",<br>
                        &nbsp;&nbsp;"success": true<br>
                        &nbsp;&nbsp;}    <br>         
                        </p> -->


                        <span class = "badge badge-warning"><h4><u>Passport Upload</u></h4></span><br>
                        <p><b> Hitting URL : </b> http://regtechapi.in/api/passport_upload</p>
                        <b>Request Method : POST </b><br>
                        <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                        <b>Request Body : </b><br>
                        {<br>   
                        file – passport image file,<br>
                        }<br>
                        <b>Success Response : </b>
                        <p>
                        {<br>
                        "data": {<br>
                        "doe": "2020-09-15",<br>
                        "dob": "1990-08-31",<br>
                        "father": "KALEEN BHAIYA",<br>
                        "given_name": "MUNNA BHAIYA",<br>
                        "mrz_line_1": "PPINDBHAIYA&lt;&lt;MUNNA&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;",<br>
                        "old_passport_num": "F0233736",<br>
                        "file_num": "UPHM00597710",<br>
                        "client_id": "TTJmMxbZQi",<br>
                        "place_of_issue": "MIRZAPUR",<br>
                        "spouse": "",<br>
                        "country_code": "IND",<br>
                        "address": "TRIPATHI HAVELI, MIRZAPUR",<br>
                        "surname": "BAGGA",<br>
                        "mrz_line_2": "J0933933<1IND9008319M2009155<<<<<<<<<<<<<<04",<br>
                        "passport_num": "J0933836",<br>
                        "doi": "2010-10-15",<br>
                        "old_doi": "2005-10-15",<br>
                        "gender": "MALE",<br>
                        "nationality": "INDIAN",<br>
                        "place_of_birth": " MIRZAPUR",<br>
                        "mother": "BEENA TRIPATHI",<br>
                        "old_place_of_issue": "MIRZAPUR",<br>
                        "pin": "231001",<br>
                        "verified": null<br>
                        },<br>
                        "status_code": 200,<br>
                        "message": "",<br>
                        "success": true<br>
                        }<br></p>
                 
                        <!-- <span class = "badge badge-warning"><h4><u>Verify Passport</u></h4></span><br>
                        <p><b> Hitting URL : </b> http://regtechapi.in/api/passport_verification</p>
                        <b>Request Method : POST </b><br>
                        {<br>   
                        "client_id": "@{{client_id}}",<br>
                        }<br>
                        
                        <p><b>Success Response : </b><br>
                         {<br>
                        "data": {<br>
                        "doe": "2020-09-15",<br>
                        "dob": "1990-08-31",<br>
                        "father": "KALEEN BHAIYA",<br>
                        "given_name": "MUNNA BHAIYA",<br>
                        "mrz_line_1": "PPINDBHAIYA&lt;&lt;MUNNA&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;&lt;",<br>
                        "old_passport_num": "F0233736",<br>
                        "file_num": "UPHM00597710",<br>
                        "client_id": "TTJmMxbZQi",<br>
                        "place_of_issue": "MIRZAPUR",<br>
                        "spouse": "",<br>
                        "country_code": "IND",<br>
                        "address": "TRIPATHI HAVELI, MIRZAPUR",<br>
                        "surname": "BAGGA",<br>
                        "mrz_line_2": "J0933933<1IND9008319M2009155<<<<<<<<<<<<<<04",<br>
                        "passport_num": "J0933836",<br>
                        "doi": "2010-10-15",<br>
                        "old_doi": "2005-10-15",<br>
                        "gender": "MALE",<br>
                        "nationality": "INDIAN",<br>
                        "place_of_birth": " MIRZAPUR",<br>
                        "mother": "BEENA TRIPATHI",<br>
                        "old_place_of_issue": "MIRZAPUR",<br>
                        "pin": "231001",<br>
                        "passport_validity": true<br>
                            },<br>
                            "status_code": 200,<br>
                            "message": "Passport Verified.",<br>
                            "success": true<br>
                        }       
                        </p> -->

                        <span class = "badge badge-warning"><h4><u>Passport Verification</u></h4></span><br>
                        <p><b> Hitting URL : </b> http://regtechapi.in/api/passport_verification</p>
                        <b>Request Method : POST </b><br>
                        <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                        {<br>   
                        "id_number": "PN1067476812641",<br>
                        "dob": "1991-07-04",<br>
                        }<br>
                        
                        <p><b>Success Response : </b><br>
                        {<br>
                        "data": {<br>
                        "client_id": "passport_ZsjzNvqEbyFoehLmDgne",<br>
                        "passport_number": "L8060347",<br>
                        "full_name": "DOMINIC D'COSTA ANTHONY",<br>
                        "dob": "1991-07-04",<br>
                        "date_of_application": "2014-01-04",<br>
                        "file_number": "PN1067476812641"<br>
                    },<br>
                    "status_code": 200,<br>
                    "success": true,<br>
                    "message": null,<br>
                    "message_code": "success"<br>
                    }<br>
                   </div>               
                </div>     
            </div>   
        </div>
    </div>

    <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#credit" data-toggle = "collapse">Credit Report API</a>
        </div>
        <div class = "collapse" id = "credit" data-parent = "#accordion">
            <div class = "card-body">
                <div class="row">
                      <div class = "col-md-4">
                        <span class = "badge badge-dark"><h3>Credit Report APIs</h3></span>
                      </div>
                      <div class = "col-md-6">
                        <span class = "badge badge-warning"><h4><u>Credit Report 1 - CRIF</u></h4></span><br>
                        <p><b> Hitting URL : </b> http://regtechapi.in/api/crif</p>
                        <b>Request Method : POST </b><br>
                        <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                        <b>Request Body : </b><br>
                        {<br>   
                        "fullname":""<br>
                        "pancard_no":""<br>
                        "otp":""<br>
                        "phone":""<br>
                        "dob":""<br>
                        }<br>

                        <p><b>Success Response : </b><br>
                            {<br>
                            "status": "success",<br>
                            "unique_id": "EXT17012464996663408657403",<br>
                            "data": {<br>
                            "request_meta": {<br>
                            "gender": "male",<br>
                            "dob": "XXXX-XX-XX",<br>
                            "pan_card": "XXXXXXXXXX",<br>
                            "mobile_number": "XXXXXXXXXX",<br>
                            "full_name": "XXXXX XXX",<br>
                            "home": {<br>
                                "zipcode": "175024",<br>
                                "address": {<br>
                                    "line2": "Address line 2",<br>
                                    "line1": "Address line 1"<br>
                                },<br>
                                "city": "hyderabad"<br>
                                },<br>
                            "allowed_for_awesomeui": "yes"<br>
                            },<br>
                            "crif_report_id": "",<br>
                            "file": {<br>
                            "response_xml": "",<br>
                            "html_report": ""<br>
                            },<br>
                            "credit_account": {<br>
                            "enquiry": "",<br>
                            "account": ""<br>
                            }<br>
                        }<br>
                        }<br>
                        </p>  

                        <span class = "badge badge-warning"><h4><u>Credit Report 2 - Equifax</u></h4></span><br>
                        <p><b> Hitting URL : </b> http://regtechapi.in/api/equifax</p>
                        <b>Request Method : POST </b><br>
                        <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                        <b>Request Body : </b><br>
                        {<br>   
                        "FirstName":""<br>
                        "LastName":""<br>
                        "ContactNo":""<br>
                        "IDValue":""<br>
                        }<br>

                        <p><b>Success Response : </b><br>
                        {<br>
                            "Equifax_Report":{<br>
                                "InquiryResponseHeader": {<br>
                                    "ClientID": "@{{ClientID}}",<br>
                                    "CustRefField": "@{{CustRefField}}",<br>
                                    "ReportOrderNO": "@{{ReportOrderNO}}",<br>
                                    "ProductCode": [<br>
                                        "@{{ProductCode}}"<br>
                                    ],<br>
                                    "SuccessCode": "1",<br>
                                    "Date": "@{{Date}}",<br>
                                    "Time": "@{{Time}}"<br> 
                                }<br>
                                "InquiryRequestInfo": {<br>
                                    "InquiryPurpose": "00",<br>
                                    "FirstName": "@{{FirstName}}",<br>
                                    "InquiryPhones": [<br>
                                        {<br>
                                            "seq": "1",<br>
                                            "PhoneType": [<br>
                                                "M"<br>
                                            ],<br>
                                            "Number": "@{{Number}}"<br>
                                        }<br>
                                    ],<br>
                                    "IDDetails": [<br>
                                        {<br>
                                            "seq": "1",<br>
                                            "IDType": "T",<br>
                                            "IDValue": "@{{IDValue}}",<br>
                                            "Source": "@{{Source}}"<br>
                                        }<br>
                                    ]<br>
                                },<br>
                                "Score": [<br>
                                    {<br>
                                        "Type": "ERS",<br>
                                        "Version": "3.1"<br>
                                    }<br>
                                ],<br>
                                "CCRResponse": {<br>
                                    "Status": "1",<br>
                                    "CIRReportDataLst": [<br>
                                        {<br>
                                            "InquiryResponseHeader": {<br>
                                                "CustomerCode": "@{{CustomerCode}}",<br>
                                                "CustRefField": "@{{CustRefField}}",<br>
                                                "ReportOrderNO": "@{{ReportOrderNO}}",<br>
                                                "ProductCode": [<br>
                                                    "@{{ProductCode}}"<br>
                                                ],<br>
                                                "SuccessCode": "1",<br>
                                                "Date": "@{{Date}}",<br>
                                                "Time": "@{{Time}}",<br>
                                                "HitCode": "@{{HitCode}}",<br>
                                                "CustomerName": "@{{CustomerName}}"<br>
                                            },<br>
                                            "InquiryRequestInfo": {<br>
                                                "InquiryPurpose": "@{{InquiryPurpose}}",<br>
                                                "FirstName": "@{{FirstName}}",<br>
                                                "InquiryPhones": [<br>
                                                    {<br>
                                                        "seq": "1",<br>
                                                        "PhoneType": [<br>
                                                            "M"<br>
                                                        ],<br>
                                                        "Number": "@{{Number}}"<br>
                                                    }<br>
                                                ],<br>
                                                "IDDetails": [<br>
                                                    {<br>
                                                        "seq": "1",<br>
                                                        "IDType": "T",<br>
                                                        "IDValue": "@{{IDValue}}",<br>
                                                        "Source": "@{{Source}}"<br>
                                                    }<br>
                                                ],<br>
                                                "CustomFields": [<br>
                                                    {
                                                        "key": "@{{key}}",<br>
                                                        "value": "@{{value}}"<br>
                                                    }<br>
                                                ]<br>
                                            },<br>
                                            "Score": [<br>
                                                {<br>
                                                    "Type": "ERS",<br>
                                                    "Version": "3.1"<br>
                                                }<br>
                                            ],<br>
                                            "CIRReportData": {<br>
                                                "IDAndContactInfo": {<br>
                                                    "PersonalInfo": {<br>
                                                        "Name": {<br>
                                                            "FullName": "@{{FullName}}"<br>
                                                        },<br>
                                                        " AliasName": {},<br>
                                                        "DateOfBirth": "@{{DateOfBirth}}",<br>
                                                        "Gender": "@{{Gender}}",<br>
                                                        "Age": {<br>
                                                            "Age": "@{{Age}}"<br>
                                                        },<br>
                                                        "PlaceOfBirthInfo": {}<br>
                                                    },<br>
                                                    "IdentityInfo": {<br>
                                                        "PANId": [<br>
                                                            {<br>
                                                                "seq": "1",<br>
                                                                "ReportedDate": "@{{ReportedDate}}",<br>
                                                                "IdNumber": "@{{IdNumber}}"<br>
                                                            }<br>
                                                        ],<br>
                                                        "VoterID": [<br>
                                                            {<br>
                                                                "seq": "1",<br>
                                                                "ReportedDate": "@{{ReportedDate}}",<br>
                                                                "IdNumber": "@{{IdNumber}}"<br>
                                                            }<br>
                                                        ],<br>
                                                        "NationalIDCard": [<br>
                                                            {<br>
                                                                "seq": "1",<br>
                                                                "ReportedDate": "@{{ReportedDate}}",<br>
                                                                "IdNumber": "@{{IdNumber}}"<br>
                                                            }<br>
                                                        ]<br>
                                                    },<br>
                                                    "AddressInfo": [<br>
                                                        {<br>
                                                            "Seq": "1",<br>
                                                            "ReportedDate": "@{{ReportedDate}}",<br>
                                                            "Address": "@{{Address}}",<br>
                                                            "State": "@{{State}}",<br>
                                                            "Postal": "@{{Postal}}"<br>
                                                        }<br>
                                                    ],<br>
                                                    "PhoneInfo": [<br>
                                                        {<br>
                                                            "seq": "1",<br>
                                                            "typeCode": "M",<br>
                                                            "ReportedDate": "@{{ReportedDate}}",<br>
                                                            "Number": "@{{Number}}"<br>
                                                        }<br>
                                                    ]<br>
                                                },<br>
                                                "RetailAccountDetails": [<br>
                                                    {<br>
                                                        "seq": "1",<br>
                                                        "AccountNumber": "@{{AccountNumber}}",<br>
                                                        "Institution": "@{{Institution}}",<br>
                                                        "AccountType": "@{{AccountType}}",<br>
                                                        "OwnershipType": "@{{OwnershipType}}",<br>
                                                        "Balance": "@{{Balance}}",<br>
                                                        "PastDueAmount": "@{{PastDueAmount}}",<br>
                                                        "Open": "Yes",<br>
                                                        "SanctionAmount": "@{{SanctionAmount}}",<br>
                                                        "DateReported": "@{{DateReported}}",<br>
                                                        "DateOpened": "@{{DateOpened}}",<br>
                                                        "InterestRate": "@{{InterestRate}}",<br>
                                                        "CollateralValue": "@{{CollateralValue}}",<br>
                                                        "AccountStatus": "@{{AccountStatus}}",<br>
                                                        "AssetClassification": "@{{AssetClassification}}",<br>
                                                        "source": "@{{source}}",<br>
                                                        "History48Months": [<br>
                                                            {<br>
                                                                "key": "@{{key}}",<br>
                                                                "PaymentStatus": "NEW",
                                                                "SuitFiledStatus": "*",
                                                                "AssetClassificationStatus": "@{{AssetClassificationStatus}}"<br>
                                                            }<br>
                                                        ]<br>
                                                    }<br>
                                                ],<br>
                                                "RetailAccountsSummary": {<br>
                                                    "NoOfAccounts": "2",<br>
                                                    "NoOfActiveAccounts": "1",<br>
                                                    "NoOfWriteOffs": "0",<br>
                                                    "TotalPastDue": "0.00",<br>
                                                    "SingleHighestCredit": "0.00",<br>
                                                    "SingleHighestSanctionAmount": "@{{SingleHighestSanctionAmount}}",<br>
                                                    "TotalHighCredit": "0.00",<br>
                                                    "AverageOpenBalance": "@{{AverageOpenBalance}}",<br>
                                                    "SingleHighestBalance": "@{{SingleHighestBalance}}",<br>
                                                    "NoOfPastDueAccounts": "@{{NoOfPastDueAccounts}}",<br>
                                                    "NoOfZeroBalanceAccounts": "@{{NoOfZeroBalanceAccounts}}",<br>
                                                    "RecentAccount": "@{{RecentAccount}}",<br>
                                                    "OldestAccount": "@{{OldestAccount}}",<br>
                                                    "TotalBalanceAmount": "@{{TotalBalanceAmount}}",<br>
                                                    "TotalSanctionAmount": "TotalSanctionAmount",<br>
                                                    "TotalCreditLimit": "@{{TotalCreditLimit}}",<br>
                                                    "TotalMonthlyPaymentAmount": "@{{TotalMonthlyPaymentAmount}}"<br>
                                                },<br>
                                                "ScoreDetails": [<br>
                                                    {<br>
                                                        "Type": "ERS",<br>
                                                        "Version": "3.1",<br>
                                                        "Name": "@{{Name}}",<br>
                                                        "Value": "@{{Value}}",<br>
                                                        "ScoringElements": [<br>
                                                            {<br>
                                                                "type": "RES",<br>
                                                                "seq": "1",<br>
                                                                "Description": "@{{Description}}"<br>
                                                            }<br>
                                                        ]<br>
                                                    }<br>
                                                ],<br>
                                                "Enquiries": [<br>
                                                    {<br>
                                                        "seq": "0",<br>
                                                        "Institution": "@{{Institution}}",<br>
                                                        "Date": "@{{Date}}",<br>
                                                        "Time": "@{{Time}}",<br>
                                                        "RequestPurpose": "@{{RequestPurpose}}",<br>
                                                        "Amount": "@{{Amount}}"<br>
                                                    }<br>
                                                ],<br>
                                                "EnquirySummary": {<br>
                                                    "Purpose": "@{{Purpose}}",<br>
                                                    "Total": "@{{Total}}",<br>
                                                    "Past30Days": "@{{Past30Days}}",<br>
                                                    "Past12Months": "@{{Past12Months}}",<br>
                                                    "Past24Months": "@{{Past24Months}}",<br>
                                                    "Recent": "@{{Recent}}"<br>
                                                },<br>
                                                "OtherKeyInd": {<br>
                                                    "AgeOfOldestTrade": "@{{AgeOfOldestTrade}}",<br>
                                                    "NumberOfOpenTrades": "0",<br>
                                                    "AllLinesEVERWritten": "0.00",<br>
                                                    "AllLinesEVERWrittenIn9Months": "0",<br>
                                                    "AllLinesEVERWrittenIn6Months": "0"<br>
                                                },<br>
                                                "RecentActivities": {<br>
                                                    "AccountsDeliquent": "0",<br>
                                                    "AccountsOpened": "0",<br>
                                                    "TotalInquiries": "7",<br>
                                                    "AccountsUpdated": "0"<br>
                                                }<br>
                                            }<br>
                                        }<br>
                                    ]<br>
                                }<br>
                            },<br>
                            "statusCode": "200"<br>
                        }<br>
                        </p>  
                        
                        <span class = "badge badge-warning"><h4><u>Generate OTP</u></h4></span><br>
                        <p><b> Hitting URL : </b> http://regtechapi.in/api/generate-otp</p>
                        <b>Request Method : POST </b><br>
                        <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                        <b>Request Body : </b><br>
                        {<br>   
                        "phone": @{{phone}}<br>
                        }<br>
                        <p><b>Success Response : </b><br>
                            
                        &nbsp;&nbsp;{<br>
                        &nbsp;&nbsp;"data": { <br>
                        &nbsp;&nbsp;"client_id": @{{client_id}},<br>
                        &nbsp;&nbsp;"operator": @{{operator}},<br>
                        &nbsp;&nbsp;"otp_sent": "true"<br>
                        &nbsp;&nbsp;"if_number": "true"<br>
                        &nbsp;&nbsp;},<br>
                        &nbsp;&nbsp;"status_code": 200,<br> 
                        &nbsp;&nbsp;"message_code": success,<br> 
                        &nbsp;&nbsp;"message": "OTP generated",<br>
                        &nbsp;&nbsp;"success": "true"<br>
                        &nbsp;&nbsp;}<br>
                        </p>

                      </div>
                </div>
            </div>
        </div>
    </div>

     <!--Udyam APIS-->
     <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#udyam" data-toggle = "collapse">Udyam </a>
        </div>
        <div id = "udyam" class = "collapse" data-parent="#accordion">
            <div class = "card-body">
                <div class="row">
                  <div class = "col-md-4">
                    <span class = "badge badge-dark"><h3>Udyam Registration Details</h3></span>
                  </div>
                  <div class = "col-md-6">
                  <span class = "badge badge-warning"><h4><u>Udyam Search</u></h4></span><br>
        <p><b> Hitting URL : </b> http://regtechapi.in/api/udyamsearch</p>
        <b>Header : </b><br>
        {<br>   
        "AccessToken":"xxxxxxxxxxxxx"<br>
        }<br>
        <b>Request Body : </b><br>
        {<br>   
        "udyamNumber":"UDYAM-MH-26-01944567"<br>
        }<br>

        <p><b>Success Response : </b><br>
            [<br>
                &nbsp;&nbsp;{<br>
                    "status_code":200<br>
                &nbsp;&nbsp;"response":  {<br>
                &nbsp;&nbsp;"essentials": {<br>
                &nbsp;&nbsp;"udyamNumber":"UDYAM-MH-26-01944567"<br>
                &nbsp;&nbsp;&nbsp;&nbsp;}<br>
                &nbsp;&nbsp;"essentials": {<br>
                &nbsp;&nbsp;"result": {
            "generalInfo": {
                "udyamRegistrationNumber": "UDYAM-MH-26-0194830",
                "nameOfEnterprise": "M/S ZAPFIN TEKNOLOGIES PRIVATE LIMITED",
                "majorActivity": "TRADING[For availing benefits of Priority Sector Lending(PSL) ONLY]",
                "organisationType": "Private Limited Company",
                "socialCategory": "General",
                "dateOfIncorporation": "09/11/2018",
                "dateOfCommencementOfProductionBusiness": "09/11/2018",
                "dic": "PUNE",
                "msmedi": "MUMBAI",
                "dateOfUdyamRegistration": "14/12/2021",
                "typeOfEnterprise": "Micro"
            },
            "enterpriseType": [
                {
                    "dataYear": "2021-22",
                    "classificationYear": "2023-24",
                    "enterpriseType": "Micro",
                    "classificationDate": "09/05/2023"
                },
                {
                    "dataYear": "2020-21",
                    "classificationYear": "2022-23",
                    "enterpriseType": "Micro",
                    "classificationDate": "26/06/2022"
                },
                {
                    "dataYear": "2019-20",
                    "classificationYear": "2021-22",
                    "enterpriseType": "Micro",
                    "classificationDate": "14/12/2021"
                }
            ],
            "unitsDetails": [],
            "officialAddressOfEnterprise": {
                "flatDoorBlockNo": "105",
                "nameOfPremisesBuilding": "Hermes wave Central Avenue Road",
                "villageTown": "Kalyani Nagar",
                "block": "Kalyani Nagar",
                "roadStreetLane": "Kalyani Nagar Pune",
                "city": "pune",
                "state": "MAHARASHTRA",
                "pin": "411014",
                "district": "PUNE,",
                "mobile": "84*****555",
                "email": "ashokonly@gmail.com"
            },
            "nationalIndustryClassificationCodes": [
                {
                    "nic2Digit": "66 - Other financial activities",
                    "nic4Digit": "6619 - Activities auxiliary to financial service activities n.e.c.",
                    "nic5Digit": "66190 - Activities auxiliary to financial service activities n.e.c.",
                    "activity": "Services",
                    "date": "14/12/2021"
                }
            ],
            "pdfUrl": "https://persist.signzy.tech/api/files/565734329/download/d4f351fcab044ccd9c233d948eef392e106ecab1653a45faa1c5a249cad18eb9.pdf"
        }"<br>
                &nbsp;&nbsp;&nbsp;&nbsp;}<br>
              



                &nbsp;&nbsp;}<br>
            ]<br>
        </p>
                    


                   
                   </div>
                </div>
            </div>
        </div>
    </div>

     <!--Udyog APIS-->
     <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#udyog" data-toggle = "collapse">Udyog Aadhaar</a>
        </div>
        <div id = "udyog" class = "collapse" data-parent="#accordion">
            <div class = "card-body">
                <div class="row">
                  <div class = "col-md-4">
                    <span class = "badge badge-dark"><h3>Udhyog Aadhar APIs</h3></span>
                  </div>
                  <div class = "col-md-6">
                  <span class = "badge badge-warning"><h4><u>Udhyog Aadhar</u></h4></span><br>
        <p><b> Hitting URL : </b> http://regtechapi.in/api/udyogaadhaars</p>
        <b>Header : </b><br>
        {<br>   
        "AccessToken":"xxxxxxxxxxxxx"<br>
        }<br>
        <b>Request Body : </b><br>
        {<br>   
        "uamnumber":"MH26E0170657"<br>
        }<br>

        <p><b>Success Response : </b><br>
            [<br>
                &nbsp;&nbsp;{<br>
                    "status_code":200<br>
                &nbsp;&nbsp;"response":  {<br>
                &nbsp;&nbsp;"essentials": {<br>
                &nbsp;&nbsp;"uamNumber":"MH26E0170657"<br>
                &nbsp;&nbsp;&nbsp;&nbsp;}<br>
                &nbsp;&nbsp;"essentials": {<br>
                &nbsp;&nbsp;"result": {
                    "uamNumber": "MH26E0170657",
            "nameofEnterprise": "ZAPFIN TEKNOLOGIES PRIVATE LIMITED",
            "majorActivity": "SERVICES",
            "socialCategory": "GENERAL",
            "enterpriseType": "SMALL",
            "dateofCommencement": "09/11/2018",
            "dicName": "PUNE",
            "state": "MAHARASHTRA",
            "appliedDate": "18/09/2019",
            "modifiedDate": "N/A",
            "validTillDate": "30/06/2022.",
            "nic2Digit": "66-OTHER FINANCIAL ACTIVITIES",
            "nic4Digit": "6619-ACTIVITIES AUXILIARY TO FINANCIAL SERVICE ACTIVITIES N.E.C.",
            "nic5DigitCode": "66190-ACTIVITIES AUXILIARY TO FINANCIAL SERVICE ACTIVITIES N.E.C.",
            "status": "ACTIVE"
        }"<br>
                &nbsp;&nbsp;&nbsp;&nbsp;}<br>
              



                &nbsp;&nbsp;}<br>
            ]<br>
        </p>
                    


                   
                   </div>
                </div>
            </div>
        </div>
    </div>

    <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#bank_verification" data-toggle = "collapse">Bank's APIs</a>
        </div>
        <div class = "collapse" id = "bank_verification" data-parent = "#accordion">
            <div class = "card-body">
                <div class="row">
                    <div class = "col-md-4">
                        <span class = "badge badge-dark"><h3>Bank Verification APIs</h3></span>
                    </div>
                <div class = "col-md-6">
                    <span class = "badge badge-warning"><h4><u>Bank Verification</u></h4></span><br>
                    <p><b> Hitting URL : </b> http://regtechapi.in/api/bank_verification</p>
                    <b>Request Method : POST </b><br>
                    <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                    <b>Request Body : </b><br>
                    {<br>
                    "id_number": "589402010002932",<br>
                    "ifsc": "UBIN0558940"<br>
                    }<br>
                    <p><b>Success Response : </b><br>
                     &nbsp;&nbsp;{<br>
                     &nbsp;&nbsp;"data": {<br>
                     &nbsp;&nbsp;"account_number": "01234567890",<br>
                     &nbsp;&nbsp;"full_name": "MUNNA BHAIYA",<br>
                     &nbsp;&nbsp;"client_id": "takdTqhCxo",<br>
                     &nbsp;&nbsp;"amount_deposited": 1.00,<br>
                     &nbsp;&nbsp;"account_exists": true<br>
                     &nbsp;&nbsp;},<br>
                     &nbsp;&nbsp;"status_code": 200,<br>
                     &nbsp;&nbsp;"message": "",<br>
                     &nbsp;&nbsp;"success": true<br>
                     &nbsp;&nbsp;}<br>
                    </p>
                </div>
        </div>
        <div class = "card-header">
            <a class = "card-link" href = "#bank_verification" data-toggle = "collapse">Bank Statement APIs</a>
        </div>
        <div class = "collapse" id = "bank_verification" data-parent = "#accordion">
            <div class = "card-body">
                <div class="row">
                    <div class = "col-md-4">
                        <span class = "badge badge-dark"><h3>Bank Statement APIs</h3></span>
                    </div>
                <div class = "col-md-6">
                    <span class = "badge badge-warning"><h4><u>Bank Statement</u></h4></span><br>
                    <p><b> Hitting URL : </b> http://regtechapi.in/api/bank_details</p>
                    <b>Request Method : POST </b><br>
                    <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                    <b>Request Body : </b><br>
                    {<br>
                    "file": "bank_statement-hdfc.pdf",<br>
                    "bank": "HDFC"<br>
                    "accounttype": "SAVING",<br>
                    "password": "******"<br>
                    }<br>
                    <p><b>Success Response : </b><br>
                     &nbsp;&nbsp;{<br>
                     &nbsp;&nbsp;"response": {<br>
                     &nbsp;&nbsp;"amount": "73569.78",<br>
                     &nbsp;&nbsp;"balanceAfterTransaction": "73569.78",<br>
                     &nbsp;&nbsp;"bank": "SBI_8771610002382",<br>
                     &nbsp;&nbsp;"batchID": null,<br>
                     &nbsp;&nbsp;"category": "OPENING_BALANCE",<br>
                     &nbsp;&nbsp;"dateTime": "01/01/2017",<br>
                     &nbsp;&nbsp;"description":"OPENING BALANCE",<br>
                     &nbsp;&nbsp;"remark": ""<br>
                     &nbsp;&nbsp;"transactionId": ""<br>
                     &nbsp;&nbsp;"transactionNumber": ""<br>
                     &nbsp;&nbsp;"type": "CREDIT"<br>
                     &nbsp;&nbsp;"valueDate": ""<br>
                     &nbsp;&nbsp;},<br>
                     &nbsp;&nbsp;"status_code": 200,<br>
                     &nbsp;&nbsp;"message": "",<br>
                     &nbsp;&nbsp;"success": true<br>
                     &nbsp;&nbsp;}<br>
                    </p>
                </div>
        </div>
        <div class = "card-header">
            <a class = "card-link" href = "#bank_verification" data-toggle = "collapse">Bank Analyser APIs</a>
        </div>
        <div class = "collapse" id = "bank_verification" data-parent = "#accordion">
            <div class = "card-body">
                <div class="row">
                    <div class = "col-md-4">
                        <span class = "badge badge-dark"><h3>Bank Analyser APIs</h3></span>
                    </div>
                <div class = "col-md-6">
                    <span class = "badge badge-warning"><h4><u>Bank Analyser For India</u></h4></span><br>
                    <p><b> Hitting URL : </b> http://regtechapi.in/api/bank_anlyser</p>
                    <b>Request Method : POST </b><br>
                    <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                    <b>Request Body : </b><br>
                    {<br>
                    "file": "bank_statement-hdfc.pdf",<br>
                    "bank": "HDFC"<br>
                    "accounttype": "SAVING",<br>
                    "password": "******"<br>
                    "country": "INDIA"<br>
                    }<br>
                    <p><b>Success Response : </b><br>
                     &nbsp;&nbsp;{<br>
                     &nbsp;&nbsp;"response": {<br>
                     &nbsp;&nbsp;"atm_withdrawls": "[]",<br>
                     &nbsp;&nbsp;"averageMonthlyBalance": "[{",<br>
                     &nbsp;&nbsp;"netAverageBalance": "28935.33",<br>
                     &nbsp;&nbsp;"monthAndYear": "Jan 2017",<br>
                     &nbsp;&nbsp;"dayBalanceMap": "{",<br>
                     &nbsp;&nbsp;"1": "74869.78",<br>
                     &nbsp;&nbsp;"5":"52734.78",<br>
                     &nbsp;&nbsp;"10": "35900.6"<br>
                     &nbsp;&nbsp;"15": "35150.6"<br>
                     &nbsp;&nbsp;"20": "35144.85"<br>
                     &nbsp;&nbsp;"25": "144.85"<br>
                     &nbsp;&nbsp;"30": "14.85"<br>
                     &nbsp;&nbsp;},<br>
                     &nbsp;&nbsp;},<br>
                     &nbsp;&nbsp;],<br>
                     &nbsp;&nbsp;"averageMonthlyBalance": "[{",<br>
                     &nbsp;&nbsp;"netAverageBalance": "28935.33",<br>
                     &nbsp;&nbsp;"monthAndYear": "Jan 2017",<br>
                     &nbsp;&nbsp;},<br>
                     &nbsp;&nbsp;],<br>
                     &nbsp;&nbsp;"cash_deposits": "[]",<br>
                     &nbsp;&nbsp;"expenses": "[{",<br>
                     &nbsp;&nbsp;"amount": "6500.33",<br>
                     &nbsp;&nbsp;"bank": "",<br>
                     &nbsp;&nbsp;"category": "CREDIT_CARD_PAYMENT",<br>
                     &nbsp;&nbsp;"date": "2017-01-04T00:00:00Z",<br>
                     &nbsp;&nbsp;"description": "50100013343731 -TPT-CREDIT CARD MONEY",<br>
                     &nbsp;&nbsp;"merchantType": "",<br>
                     &nbsp;&nbsp;"mode": "INTERNET_FUND_TRANSFER",<br>
                     &nbsp;&nbsp;"monthAndYear": "",<br>
                     &nbsp;&nbsp;"partyName": "xyz",<br>
                     &nbsp;&nbsp;"purpose": "CREDIT_CARD_PAYMENT",<br>
                     &nbsp;&nbsp;"total": " ",<br>
                     &nbsp;&nbsp;},<br>
                     &nbsp;&nbsp;],<br>
                     &nbsp;&nbsp;"high_value_transactions": "[{",<br>
                     &nbsp;&nbsp;"amount": "35000",<br>
                     &nbsp;&nbsp;"balanceAfterTranscation": "144.85",<br>
                     &nbsp;&nbsp;"bank": "",<br>
                     &nbsp;&nbsp;"date": "2017-01-04T00:00:00Z",<br>
                     &nbsp;&nbsp;"description": "50100013343731 -TPT-CREDIT CARD MONEY",<br>
                     &nbsp;&nbsp;"category": "OTHER",<br>
                     &nbsp;&nbsp;"type": "DEBIT",<br>
                     &nbsp;&nbsp;},<br>
                     &nbsp;&nbsp;],<br>
                     &nbsp;&nbsp;"incomes": "[{",<br>
                     &nbsp;&nbsp;"amount": "6500.33",<br>
                     &nbsp;&nbsp;"balanceAfterTransaction": "32786.85",<br>
                     &nbsp;&nbsp;"bank": "",<br>
                     &nbsp;&nbsp;"category": "SALARY",<br>
                     &nbsp;&nbsp;"date": "2017-01-04T00:00:00Z",<br>
                     &nbsp;&nbsp;"description": "50100013343731 -TPT-CREDIT CARD MONEY",<br>
                     &nbsp;&nbsp;"isSalary": "true",<br>
                     &nbsp;&nbsp;"isSalaryCheck": "true",<br>
                     &nbsp;&nbsp;"mode": "SALARY",<br>
                     &nbsp;&nbsp;"monthAndYear": "",<br>
                     &nbsp;&nbsp;"partyName": "",<br>
                     &nbsp;&nbsp;"purpose": "SALARY",<br>
                     &nbsp;&nbsp;"total": " ",<br>
                     &nbsp;&nbsp;"transactionType": "CREDIT",<br>
                     &nbsp;&nbsp;},<br>
                     &nbsp;&nbsp;],<br>
                     &nbsp;&nbsp;"internalTransactionList": "[]",<br>
                     &nbsp;&nbsp;"investments": "[]",<br>
                     &nbsp;&nbsp;"minimum_balances": "[{",<br>
                     &nbsp;&nbsp;"amount": "35000",<br>
                     &nbsp;&nbsp;"balanceAfterTranscation": "144.85",<br>
                     &nbsp;&nbsp;"bank": "",<br>
                     &nbsp;&nbsp;"date": "2017-01-04T00:00:00Z",<br>
                     &nbsp;&nbsp;"description": "6680614962/PAYTM",<br>
                     &nbsp;&nbsp;"category": "TRANSFER_TO_WALLET",<br>
                     &nbsp;&nbsp;"transactionType": "DEBIT",<br>
                     &nbsp;&nbsp;},<br>
                     &nbsp;&nbsp;],<br>
                     &nbsp;&nbsp;"missingMonths": "[]",<br>
                     &nbsp;&nbsp;"money_received_transactions": "[{",<br>
                     &nbsp;&nbsp;"amount": "1300",<br>
                     &nbsp;&nbsp;"balanceAfterTranscation": "74869.78",<br>
                     &nbsp;&nbsp;"bank": "",<br>
                     &nbsp;&nbsp;"date": "2017-01-04T00:00:00Z",<br>
                     &nbsp;&nbsp;"description": "6680614962/PAYTM",<br>
                     &nbsp;&nbsp;"category": "IMPS",<br>
                     &nbsp;&nbsp;"monthAndYear": "",<br>
                     &nbsp;&nbsp;"total": "",<br>
                     &nbsp;&nbsp;"transactionType": "DEBIT",<br>
                     &nbsp;&nbsp;},<br>
                     &nbsp;&nbsp;],<br>
                     &nbsp;&nbsp;},<br>
                     &nbsp;&nbsp;"status_code": 200,<br>
                     &nbsp;&nbsp;"message": "",<br>
                     &nbsp;&nbsp;"success": true<br>
                     &nbsp;&nbsp;}<br>
                    </p>
                </div></br>
                <div class = "col-md-6">
                    <span class = "badge badge-warning"><h4><u>Bank Analyser For Philippines</u></h4></span><br>
                    <p><b> Hitting URL : </b> http://regtechapi.in/api/bank_anlyser_psd</p>
                    <b>Request Method : POST </b><br>
                    <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                    <b>Request Body : </b><br>
                    {<br>
                    "file": "bank_statement.pdf",<br>
                    "bank": "SECURITY BANK"<br>
                    "accounttype": "SAVING",<br>
                    "password": "******"<br>
                    "country": "Philippines"<br>
                    }<br>
                    <p><b>Success Response : </b><br>
                     &nbsp;&nbsp;{<br>
                     &nbsp;&nbsp;"response": {<br>
                     &nbsp;&nbsp;"atm_withdrawls": "[]",<br>
                     &nbsp;&nbsp;"averageMonthlyBalance": "[{",<br>
                     &nbsp;&nbsp;"netAverageBalance": "28935.33",<br>
                     &nbsp;&nbsp;"monthAndYear": "Jan 2017",<br>
                     &nbsp;&nbsp;"dayBalanceMap": "{",<br>
                     &nbsp;&nbsp;"1": "74869.78",<br>
                     &nbsp;&nbsp;"5":"52734.78",<br>
                     &nbsp;&nbsp;"10": "35900.6"<br>
                     &nbsp;&nbsp;"15": "35150.6"<br>
                     &nbsp;&nbsp;"20": "35144.85"<br>
                     &nbsp;&nbsp;"25": "144.85"<br>
                     &nbsp;&nbsp;"30": "14.85"<br>
                     &nbsp;&nbsp;},<br>
                     &nbsp;&nbsp;},<br>
                     &nbsp;&nbsp;],<br>
                     &nbsp;&nbsp;"averageMonthlyBalance": "[{",<br>
                     &nbsp;&nbsp;"netAverageBalance": "28935.33",<br>
                     &nbsp;&nbsp;"monthAndYear": "Jan 2017",<br>
                     &nbsp;&nbsp;},<br>
                     &nbsp;&nbsp;],<br>
                     &nbsp;&nbsp;"cash_deposits": "[]",<br>
                     &nbsp;&nbsp;"expenses": "[{",<br>
                     &nbsp;&nbsp;"amount": "6500.33",<br>
                     &nbsp;&nbsp;"bank": "",<br>
                     &nbsp;&nbsp;"category": "CREDIT_CARD_PAYMENT",<br>
                     &nbsp;&nbsp;"date": "2017-01-04T00:00:00Z",<br>
                     &nbsp;&nbsp;"description": "50100013343731 -TPT-CREDIT CARD MONEY",<br>
                     &nbsp;&nbsp;"merchantType": "",<br>
                     &nbsp;&nbsp;"mode": "INTERNET_FUND_TRANSFER",<br>
                     &nbsp;&nbsp;"monthAndYear": "",<br>
                     &nbsp;&nbsp;"partyName": "xyz",<br>
                     &nbsp;&nbsp;"purpose": "CREDIT_CARD_PAYMENT",<br>
                     &nbsp;&nbsp;"total": " ",<br>
                     &nbsp;&nbsp;},<br>
                     &nbsp;&nbsp;],<br>
                     &nbsp;&nbsp;"high_value_transactions": "[{",<br>
                     &nbsp;&nbsp;"amount": "35000",<br>
                     &nbsp;&nbsp;"balanceAfterTranscation": "144.85",<br>
                     &nbsp;&nbsp;"bank": "",<br>
                     &nbsp;&nbsp;"date": "2017-01-04T00:00:00Z",<br>
                     &nbsp;&nbsp;"description": "50100013343731 -TPT-CREDIT CARD MONEY",<br>
                     &nbsp;&nbsp;"category": "OTHER",<br>
                     &nbsp;&nbsp;"type": "DEBIT",<br>
                     &nbsp;&nbsp;},<br>
                     &nbsp;&nbsp;],<br>
                     &nbsp;&nbsp;"incomes": "[{",<br>
                     &nbsp;&nbsp;"amount": "6500.33",<br>
                     &nbsp;&nbsp;"balanceAfterTransaction": "32786.85",<br>
                     &nbsp;&nbsp;"bank": "",<br>
                     &nbsp;&nbsp;"category": "SALARY",<br>
                     &nbsp;&nbsp;"date": "2017-01-04T00:00:00Z",<br>
                     &nbsp;&nbsp;"description": "50100013343731 -TPT-CREDIT CARD MONEY",<br>
                     &nbsp;&nbsp;"isSalary": "true",<br>
                     &nbsp;&nbsp;"isSalaryCheck": "true",<br>
                     &nbsp;&nbsp;"mode": "SALARY",<br>
                     &nbsp;&nbsp;"monthAndYear": "",<br>
                     &nbsp;&nbsp;"partyName": "",<br>
                     &nbsp;&nbsp;"purpose": "SALARY",<br>
                     &nbsp;&nbsp;"total": " ",<br>
                     &nbsp;&nbsp;"transactionType": "CREDIT",<br>
                     &nbsp;&nbsp;},<br>
                     &nbsp;&nbsp;],<br>
                     &nbsp;&nbsp;"internalTransactionList": "[]",<br>
                     &nbsp;&nbsp;"investments": "[]",<br>
                     &nbsp;&nbsp;"minimum_balances": "[{",<br>
                     &nbsp;&nbsp;"amount": "35000",<br>
                     &nbsp;&nbsp;"balanceAfterTranscation": "144.85",<br>
                     &nbsp;&nbsp;"bank": "",<br>
                     &nbsp;&nbsp;"date": "2017-01-04T00:00:00Z",<br>
                     &nbsp;&nbsp;"description": "6680614962/PAYTM",<br>
                     &nbsp;&nbsp;"category": "TRANSFER_TO_WALLET",<br>
                     &nbsp;&nbsp;"transactionType": "DEBIT",<br>
                     &nbsp;&nbsp;},<br>
                     &nbsp;&nbsp;],<br>
                     &nbsp;&nbsp;"missingMonths": "[]",<br>
                     &nbsp;&nbsp;"money_received_transactions": "[{",<br>
                     &nbsp;&nbsp;"amount": "1300",<br>
                     &nbsp;&nbsp;"balanceAfterTranscation": "74869.78",<br>
                     &nbsp;&nbsp;"bank": "",<br>
                     &nbsp;&nbsp;"date": "2017-01-04T00:00:00Z",<br>
                     &nbsp;&nbsp;"description": "6680614962/PAYTM",<br>
                     &nbsp;&nbsp;"category": "IMPS",<br>
                     &nbsp;&nbsp;"monthAndYear": "",<br>
                     &nbsp;&nbsp;"total": "",<br>
                     &nbsp;&nbsp;"transactionType": "DEBIT",<br>
                     &nbsp;&nbsp;},<br>
                     &nbsp;&nbsp;],<br>
                     &nbsp;&nbsp;},<br>
                     &nbsp;&nbsp;"status_code": 200,<br>
                     &nbsp;&nbsp;"message": "",<br>
                     &nbsp;&nbsp;"success": true<br>
                     &nbsp;&nbsp;}<br>
                    </p>
                </div>
        </div>
            </div>
        </div>
    </div>

    <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#face_match" data-toggle = "collapse">Face Match APIs</a>
        </div>
        <div class = "collapse" id = "face_match" data-parent = "#accordion">
            <div class = "card-body">
                <div class="row">
                    <div class = "col-md-4">
                        <span class = "badge badge-dark"><h3>Face Match API</h3></span>
                    </div>
                <div class = "col-md-6">
                    <span class = "badge badge-warning"><h4><u>Face Match</u></h4></span><br>
                    <p><b> Hitting URL : </b> http://regtechapi.in/api/face_match</p>
                    <b>Request Method : POST </b><br>
                    <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                    <b>Request Body : </b><br>
                    {<br>
                    "doc_img": "{{@doc_img}}",<br>
                    "selfie": "{{@selfie}}"<br>
                    }<br>
                    <p><b>Success Response : </b><br>
                     &nbsp;&nbsp;{<br>
                     &nbsp;&nbsp;"code": 200<br>
                     &nbsp;&nbsp;"status": "success"<br>
                     &nbsp;&nbsp;"response": {<br>
                     &nbsp;&nbsp;"confidence": "100%",<br>
                     &nbsp;&nbsp;},<br>
                     &nbsp;&nbsp;"status_code": 200,<br>
                     &nbsp;&nbsp;}<br>
                    </p>
                </div>
        </div>
            </div>
        </div>
    </div>



    <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#telecom" data-toggle = "collapse">Telecom APIs</a>
        </div>
        <div class = "collapse" id = "telecom" data-parent = "#accordion">
            <div class = "card-body">
                <div class="row">
                    <div class = "col-md-4">
                        <span class = "badge badge-dark"><h3>Telecom APIs</h3></span>
                    </div>
                <div class = "col-md-6">
                    <span class = "badge badge-warning"><h4><u>Telecom Generate OTP</u></h4></span><br>
                    <p><b> Hitting URL : </b> http://regtechapi.in/api/telecom/generate-otp</p>
                    <b>Request Method : POST </b><br>
                    <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                    <b>Request Body : </b><br>
                    {<br>   
                    "id_number": "9840115789"<br>
                    }<br>
                    <p><b>Success Response : </b><br>
                        
                    &nbsp;&nbsp;{<br>
                    &nbsp;&nbsp;"data": { <br>
                    &nbsp;&nbsp;"client_id": "telecom_FSuewlwSuVZzfBAiEgqq",<br>
                    &nbsp;&nbsp;"operator": "vi",<br>
                    &nbsp;&nbsp;"otp_sent": "true"<br>
                    &nbsp;&nbsp;"if_number": "true"<br>
                    &nbsp;&nbsp;},<br>
                    &nbsp;&nbsp;"status_code": 200,<br> 
                    &nbsp;&nbsp;"message_code": success,<br> 
                    &nbsp;&nbsp;"message": "OTP generated",<br>
                    &nbsp;&nbsp;"success": "true"<br>
                    &nbsp;&nbsp;}<br>
                    </p>


                    <span class = "badge badge-warning"><h4><u>Telecom OTP Submit</u></h4></span><br>
                    <p><b> Hitting URL : </b> http://regtechapi.in/api/telecom/submit-otp</p>
                    <b>Request Method : POST </b><br>
                    <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                    <b>Request Body : </b><br>
                    {<br>   
                    "client_id": "@{{client_id}}",<br>
                    "otp": "@{{otp}}"<br>
                    }<br>
                    <b>Success Response : </b>
                    <p class = "px-2">{<br>
                        "data": {<br>
                        "client_id": "telecom_vKTrdfluunadpDzxocIH",<br>
                        "mobile_number": "9404758963",<br>
                        "address": "SAPTASUR A-404, D.S.K. VISHWA  TALUKA HAWELI,Vadgaon Budruk,PUNE, DHAYARI, Maharashtra, 411041",<br>
                        "city": "DHAYARI",<br>
                        "state": "Maharashtra",<br>
                        "pin_code": "411041",<br>
                        "full_name": "DEVANAND KUMAR",<br>
                        "dob": "1966-11-02",<br>
                        "parsed_dob": "1966-11-02",<br>
                        "user_email": null,<br>
                        "operator": "vi",<br>
                        "billing_type": "prepaid",<br>
                        "alternate_phone": "8745125987",<br>
                        "extra_fields": null<br>
                        },
                        "status_code": 200,<br>
                        "success": true,<br>
                        "message": "Success",<br>
                        "message_code": "success"<br>
                        }</p>    
                        <br>

                        <span class = "badge badge-warning"><h4><u>Telecom EPFO Without OTP Details</u></h4></span><br>
                        <p><b> Hitting URL : </b> http://regtechapi.in/api/epfo</p>
                        <b>Request Method : POST </b><br>
                        <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                        <b>Request Body : </b><br>
                        {<br>   
                        "name": "@{{name}}",<br>
                        "company": "@{{company}}"<br>
                        }<br>
                        <b>Success Response : </b>
                        <p class = "px-2">{<br>
                            "data": {<br>
                                "search_data": [<br>
                                    {<br>    
                                        "confidence": "@{{confidence}}"",<br>
                                        "name": "@{{name}}",<br>
                                        "company": "@{{company}}",<br>
                                        "company_code": "@{{company_code}}",<br>
                                        "unique": "@{{unique}}",<br>
                                        "filing_data": [,<br>
                                            {<br>
                                                "month": "@{{month}}"",<br>
                                                "trrn": "@{{trrn}}",<br>
                                                "date": "@{{date}}"<br>
                                            },<br> 
                                        ],<br>
                                    },<br>    
                                ],<br>  
                            },<br/>
                            "status_code": 200,<br>
                            "success": true,<br>
                            "message": "Success",<br>
                            "message_code": "success"<br>
                            }
                        </p>    
                        <br>

                        <span class = "badge badge-warning"><h4><u>Telecom UAN Details</u></h4></span><br>
                        <p><b> Hitting URL : </b> http://regtechapi.in/api/uan</p>
                        <b>Request Method : POST </b><br>
                        <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                        <b>Request Body : </b><br>
                        {<br>   
                        "mobile_number": "@{{mobile_number}}"<br>
                        }<br>
                        <b>Success Response : </b>
                        <p class = "px-2">{<br>
                            "data": {<br>
                            "pf_uan": "@{{pf_uan}}"",<br>
                            "client_id": "@{{client_id}}"<br>
                            },<br/>
                            "status_code": 200,<br>
                            "success": true,<br>
                            "message": "Success",<br>
                            "message_code": "success"<br>
                            }
                        </p>    
                        <br>

                        <span class = "badge badge-warning"><h4><u>Telecom Company Search</u></h4></span><br>
                        <p><b> Hitting URL : </b> http://regtechapi.in/api/company_search</p>
                        <b>Request Method : POST </b><br>
                        <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                        <b>Request Body : </b><br>
                        {<br>   
                        "company": "@{{company}}",<br>
                        "search_size": "@{{search_size}}"<br>
                        }<br>
                        <b>Success Response : </b>
                        <p class = "px-2">{<br>
                            "data": {<br>
                                "search_data": [<br>
                                    {<br>    
                                        "confidence": "@{{confidence}}"",<br>
                                        "company": "@{{company}}",<br>
                                        "company_code": "@{{company_code}}",<br>
                                        "addres": "@{{addres}}",<br>
                                        "office": "@{{office}}",<br>
                                    }<br>
                                ]<br>  
                            },<br/>
                            "status_code": 200,<br>
                            "success": true,<br>
                            "message": "Success",<br>
                            "message_code": "success"<br>
                            }
                        </p>    
                        <br>

                        <span class = "badge badge-warning"><h4><u>Telecom Company Details</u></h4></span><br>
                        <p><b> Hitting URL : </b> http://regtechapi.in/api/company_details</p>
                        <b>Request Method : POST </b><br>
                        <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                        <b>Request Body : </b><br>
                        {<br>   
                        "company_code": "@{{company_code}}",<br>
                        "filing_data_size": "@{{filing_data_size}}"<br>
                        }<br>
                        <b>Success Response : </b>
                        <p class = "px-2">{<br>
                            "data": {<br>
                                "search_data": [<br>
                                    {<br>    
                                        "company": "@{{company}}",<br>
                                        "company_code": "@{{company_code}}",<br>
                                        "addres": "@{{addres}}",<br>
                                        "office": "@{{office}}",<br>
                                        "name_as_per_pan": "@{{name_as_per_pan}}",<br>
                                        "pan_status": "@{{pan_status}}",<br>
                                        "section_applicable": "@{{section_applicable}}",<br>
                                        "primary_business_activity": "@{{primary_business_activity}}",<br>
                                        "esic_code": "@{{esic_code}}",<br>
                                        "cin": "@{{cin}}",<br>
                                        "lin": "@{{lin}}",<br>
                                        "ownership_type": "@{{ownership_type}}",<br>
                                        "date_of_setup_of_establishment": "@{{date_of_setup_of_establishment}}",<br>
                                        "pin_code": "@{{pin_code}}",<br>
                                        "city": "@{{city}}",<br>
                                        "district": "@{{district}}",<br>
                                        "state": "@{{state}}",<br>
                                        "country": "@{{country}}",<br>
                                        "epfo_office_name": "@{{epfo_office_name}}",<br>
                                        "epfo_office_address": "@{{epfo_office_address}}",<br>
                                        "zone": "@{{zone}}",<br>
                                        "region": "@{{region}}",<br>
                                        "filing_data": [,<br>
                                            {<br>
                                                "date": "@{{date}}"",<br>
                                                "amount": "@{{amount}}",<br>
                                                "month": "@{{month}}",<br>
                                                "wage_month": "@{{wage_month}}"",<br>
                                                "no_of_employees": "@{{no_of_employees}}",<br>
                                                "ecr": "@{{ecr}}"<br>
                                            },<br> 
                                        ],<br>    
                                    }<br>
                                ]<br>  
                            },<br/>
                            "status_code": 200,<br>
                            "success": true,<br>
                            "message": "Success",<br>
                            "message_code": "success"<br>
                            }
                        </p>    
                        <br>
                </div>
        </div>
            </div>
        </div>
    </div>

    






</div>      
@stop


@section('custom_js')
@stop