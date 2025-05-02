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
                <br/>
                <span class = "badge badge-warning"><h4><u>Aadhar Card OCR</u></h4></span><br>
                <p><b> Hitting URL : </b>http://regtechapi.in/api/aadharcard_ocr</p>
                <b>Header : </b><br>
                {<br>   
                "AccessToken":"xxxxxxxxxxxxx"<br>
                }<br>
                <b>Request Body : </b><br>
                {<br>   
                "file":image file<br>
                }<br>
                <b>Success Response : </b><br>
                    {<br/>
                        "status_code": 200,<br/>
                        "aadharcard": {<br/> &nbsp;&nbsp;&nbsp;
                                "aadhar_number": "781437028915",
                                "date_of_birth": "24/03/2002",
                                "gender": "Female",
                                "name": "Hitashri Tushar Patil",
                                "raw_ocr_texts": [
                                    "&",
                                    "- ETGIC",
                                    "3110549",
                                    "HRd HRONK",
                                    "Unique Identification Authority of India",
                                    "Government of India",
                                    "attain water / Enrollment No. : 2006/18015/49027",
                                    "To",
                                    "Hitashri Tushar Patil",
                                    "first and HIGH",
                                    "STATION RAOD",
                                    "S.T. BUS STHANAK SAMOR",
                                    "Shindkheda",
                                    "Dhule",
                                    "Maharashtra - 425406",
                                    "9421616385",
                                    "KA581754631FH",
                                    "58176463",
                                    "3114cm shell / Your Aadhaar No. :",
                                    "7814 3702 8915",
                                    ", 3110059",
                                    "X",
                                    "HRE HOR",
                                    "Government of India",
                                    "from and TRIN",
                                    "Hitashri Tushar Patil",
                                    "and afte/DOB: 24/03/2002",
                                    "Fill Female",
                                    "7814 3702 8915",
                                    "Hold"
                                ]
                        }<br/>
                    }&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><br/>
                    <span class = "badge badge-warning"><h4><u>Extract Aadhar Card</u></h4></span><br>
                    <p><b> Hitting URL : </b>http://regtechapi.in/api/extract_aadharcard_text</p>
                    <b>Header : </b><br>
                    {<br>   
                    "AccessToken":"xxxxxxxxxxxxx"<br>
                    }<br>
                    <b>Request Body : </b><br>
                    {<br>   
                    "file":image file<br>
                    }<br>
                    <b>Success Response : </b><br>
                    {
                        "status_code": 200,
                        "aadharcard": {
                            "detected_text": "3THT HRT TTR Upique Identification uthoribzof India Government of India TIT Enrollmeni No_ 2006/18015/49027 Hhtashri Tushar Patil DTe STATIO  RAOD BUS STHANAK Savoa shindktda Uhule Kaharashin 425400 n E Aana 314cTTHTET ;4145 Aadhaar No. 7814 3702 8915 T_ HU, Ht 368 2 Badd7TG Hhashr Tushar Patli 57RArta DOB: 74T32C02 F (Fennl 7814 3702 8915 AleT 3TUR , Alett 3138 truji Your",
                            "extracted_info": {
                                "date_of_birth": null,
                                "aadhar_number": "7",
                                "name": "o"
                            }
                        }
                    }&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><br/>
    
                    <!---Mask Aadhar Card.--->
                    <span class = "badge badge-warning"><h4><u>Aadhar Card Mask</u></h4></span><br>
                    <p><b> Hitting URL : </b>http://regtechapi.in/api/aadharcard_mask</p>
                    <b>Header : </b><br>
                    {<br>   
                    "AccessToken":"xxxxxxxxxxxxx"<br>
                    }<br>
                    <b>Request Body : </b><br>
                    {<br>   
                    "file":image file<br>
                    }<br>
                    <b>Success Response : </b><br>
                        {<br/>
                            "status_code": 200,<br/>
                            "aadharcard": {<br/>
                                "data":"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",<br/>
                                "success":true <br/>
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br/>
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
                    <span class = "badge badge-warning"><h4><u>Extract PAN Card</u></h4></span><br>
                    <p><b> Hitting URL : </b> http://regtechapi.in/api/extract_pancard_text</p>
                    <b>Header : </b><br>
                    {<br>   
                    "AccessToken":"xxxxxxxxxxxxx"<br>
                    }<br>
                    <b>Request Body : </b><br>
                    {<br>   
                    "file":"BFAPL9762A"<br>
                    }<br>

                    <p><b>Success Response : </b><br>
                        {<br>
                            "status_code": 200,<br/>
                            "pancard": {<br/> &nbsp;&nbsp;&nbsp;
                                 "detected_text": "314*r fatt HRT TErR INCOME TAX DEPARTMENT GOVT OF INDIA T2IT4T Td 4GHT #T3 Permanent Account Number Card BFAPL9762A 774 Name SELHUVO LOHE Fl %13T4 ! Father $ Name CHINEYI LOHE 16012020 Tq ltal Date of Birth det 10/09/2001 87en Signature",<br/>&nbsp;&nbsp;&nbsp;&nbsp;
                                 "extracted_info": {<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                     "date_of_birth": "10/09/2001",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                     "pan_number": "BFAPL9762A"<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                 }<br/>
                           }&nbsp;&nbsp;&nbsp;<br/>
                         
                     } &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
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
                    <span class = "badge badge-warning"><h4><u>Pan Card OCR</u></h4></span><br>
                    <p><b> Hitting URL : </b>http://regtechapi.in/api/pancard_ocr</p>
                    <b>Header : </b><br>
                    {<br>   
                    "AccessToken":"xxxxxxxxxxxxx"<br>
                    }<br>
                    <b>Request Body : </b><br>
                    {<br>   
                    "file":image_file<br>
                    }<br>
                    <b>Success Response : </b><br>
                        {<br>
                                "date_of_birth": "10/09/2001",
                                "name": "SELHUVO LOHE",
                                "pan_number": "BFAPL9762A",
                                "raw_ocr_texts": [
                                    "37121052 FORHIST",
                                    "HRR TROOK",
                                    "INCOME TAX DEPARTMENT",
                                    "GOVT. OF INDIA",
                                    "and",
                                    "Ferreit This",
                                    "Permanent Account Number Card",
                                    "BFAPL9762A",
                                    "714 / Name",
                                    "SELHUVO LOHE",
                                    "furt 314 / Father's Name",
                                    "CHINEYI LOHE",
                                    "16012020",
                                    "arial",
                                    "Date of Birth",
                                    "3.Lone",
                                    "10/09/2001",
                                    "/ Signature"
                                ]
                        } &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
                    </p> 
                    <span class = "badge badge-warning"><h4><u>By PAN Card</u></h4></span><br>
                    <p><b> Hitting URL : </b> http://regtechapi.in/api/bypan</p>
                    <b>Header : </b><br>
                    {<br>   
                    "AccessToken":"xxxxxxxxxxxxx"<br>
                    }<br>
                    <b>Request Body : </b><br>
                    {<br>   
                    "bypan_id":"AABCZ2858B"<br>
                    }<br>
                     <p><b>Success Response : </b><br>
                        [<br>
                            &nbsp;&nbsp;{<br>
                            &nbsp;&nbsp;"data": {<br>
                            &nbsp;&nbsp;"SNO":"1",<br> 
                            &nbsp;&nbsp;"GSTIN":"06AAJCC5200A1ZF",<br> 
                            &nbsp;&nbsp;"GSTIN_STATUS":"Active",<br>
                            &nbsp;&nbsp;"STATE":"Haryana",<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;}<br>
                            &nbsp;&nbsp;"statusCode":200<br>
                            &nbsp;&nbsp;}<br>
                        ]<br>
                    </p> 
                    <span class = "badge badge-warning"><h4><u>PAN TO GST</u></h4></span><br>
                    <p><b> Hitting URL : </b>http://regtechapi.in/api/pantogst</p>
                    <p><b>Request Method : POST</b></p>
                    <p><b>Header</b> :{<br/>
                      "AccessToken":"xxxxxxxxxxxxx"<br/>
                    }
                    </p>
                    <p>
                    <b>Request Body</b> :{<br/>
                      "pancard_number":"868889041183"<br/>
                      }<br/>
                    </p>
                    <p><b>Success Response : </b><br>
                    &nbsp;&nbsp;{<br>
                    &nbsp;&nbsp;"response": [<br>
                        {<br/>
                            "stjCd": "UP1596",<br/>
                            "lgnm": "CRACIONS DIGITAL TECHNOLOGIES PRIVATE LIMITED",<br/>
                            "stj": "Ghaziabad Sector-1",<br/>
                            "dty": "Regular",<br/>
                            "adadr": [],<br/>
                            "cxdt": "",<br/>
                            "gstin": "09AAJCC5200A1Z9",
                            "nba": [<br/>
                                "Supplier of Services"<br/>
                            ],<br/>
                            "lstupdt": "28/02/2024",<br/>
                            "rgdt": "10/06/2021",<br/>
                            "ctb": "Private Limited Company",<br/>
                            "pradr": {<br/>
                                "addr": {<br/>
                                    "bnm": "MAHENDRA ENCLAVE",<br/>
                                    "st": "NEAR KARTE HOSPITAL CHOWK",<br/>
                                    "loc": "GHAZIABAD",<br/>
                                    "bno": "B-24",<br/>
                                    "dst": "Ghaziabad",<br/>
                                    "lt": "",<br/>
                                    "locality": "",<br/>
                                    "pncd": "201001",<br/>
                                    "landMark": "",<br/>
                                    "stcd": "Uttar Pradesh",<br/>
                                    "geocodelvl": "NA",<br/>
                                    "flno": "",<br/>
                                    "lg": ""<br/>
                                },<br/>
                                "ntr": "Supplier of Services"<br/>
                            },
                            "sts": "Active",<br/>
                            "tradeNam": "CRACIONS DIGITAL TECHNOLOGIES PRIVATE LIMITED",<br/>
                            "ctjCd": "YE0103",<br/>
                            "ctj": "RANGE - 3",<br/>
                            "einvoiceStatus": "No"<br/>
                        },<br/>
                        {<br/>
                            "stjCd": "HR049",<br/>
                            "lgnm": "CRACIONS DIGITAL TECHNOLOGIES PRIVATE LIMITED",<br/>
                            "stj": "Gurgaon (East) Ward 4",<br/>
                            "dty": "Regular",<br/>
                            "adadr": [],<br/>
                            "cxdt": "",<br/>
                            "gstin": "06AAJCC5200A1ZF",<br/>
                            "nba": [<br/>
                                "Supplier of Services"<br/>
                            ],<br/>
                            "lstupdt": "15/02/2024",<br/>
                            "rgdt": "18/01/2024",<br/>
                            "ctb": "Private Limited Company",<br/>
                            "pradr": {<br/>
                                "addr": {<br/>
                                    "bnm": "Bestech Park View Ananda",<br/>
                                    "loc": "Gurugram",
                                    "st": "New Sector Road",<br/>
                                    "bno": "Bestech Park View Ananda",<br/>
                                    "dst": "Gurugram",<br/>
                                    "lt": "28.391131",<br/>
                                    "locality": "Sector 81",<br/>
                                    "pncd": "122004",<br/>
                                    "landMark": "",<br/>
                                    "stcd": "Haryana",<br/>
                                    "geocodelvl": "Building",<br/>
                                    "flno": "villa no-02",
                                    "lg": "76.9519460000001"<br/>
                                },<br/>
                                "ntr": "Supplier of Services"<br/>
                            },<br/>
                            "tradeNam": "CRACIONS DIGITAL TECHNOLOGIES PRIVATE LIMITED",<br/>
                            "sts": "Active",<br/>
                            "ctjCd": "ZO0603",<br/>
                            "ctj": "R-38",<br/>
                            "einvoiceStatus": "No"<br/>
                        }<br/>
                    ]<br/>
                    &nbsp;&nbsp;"status_code": 200,<br>
                    &nbsp;&nbsp;"message_code": "success",<br>
                    &nbsp;&nbsp;"success": true<br>
                    }        
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
            <a class = "card-link" href = "#Voter3" data-toggle="collapse">Ecredit</a>
        </div>
        <div id = "Voter3" class = "collapse" data-parent="#accordion">
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
    <!---ESIGN--------->
    <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#Esign" data-toggle="collapse">E-Sign</a>
        </div>
        <div id = "Esign" class = "collapse" data-parent="#accordion">
            <div class = "card-body">
                <div class="row">
                    <div class = "col-md-4">
                        <span class = "badge badge-dark"><h3>E-Sign APIs</h3></span>
                    </div>
                    <div class = "col-md-6">
                         <!-- VOTER ID UPLOAD -->
                         <span class = "badge badge-warning"><h4><u>E-Sign API</u></h4></span><br>
                        <p><b> Hitting URL : </b>http://regtechapi.in/api/search</p>
                        <b>Request Body : </b><br>
                        {<br>   
                        "token":""<br>
                        }<br>
                        <b>Success Response :</b>
                        <br>
                        <p>
                        "{
                        "statusCode": 200,
                        "Link": "https://regtechapi.in/esign/666XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXRRRf"
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
                        <span class = "badge badge-warning"><h4><u>VoterId Extract</u></h4></span><br>
                        <p><b> Hitting URL : </b>http://regtechapi.in/api/extract_voterId_text</p>
                        <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                        <b>Request Body : </b><br>
                        {<br>   
                        "file":image_file,<br>
                         }<br>
                        <b>Success Response : </b><br>
                            {<br/>
                                "status_code": 200,<br/>
                                "voterid": {<br/> &nbsp;&nbsp;&nbsp;
                                    "detected_text": "HT Aaft 34iT ELECTION COMMISSION OF INDIA Taent 5et %U5 4 ELectTOR Photo IDENTITY CARD GDNO225185 Aaa # T4 44 TT 31377 ELECTOR'S NAME PREM RAJ THAKUR f7 =t AM @ & 337 FATHER'S NAME KISHAN DEV THAKUR F+ut Sex 9h / Male T # ariu/:y 15/02/1985 DATE OF BIRTHIAGE",
                                    "extracted_info": {<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        "name": PREM RAJ THAKUR,<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        "voter_id":GDNO225185<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    }<br/>
                                }<br/>
                           } &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><br/>
                           <span class = "badge badge-warning"><h4><u>VoterId OCR</u></h4></span><br>
                           <p><b> Hitting URL : </b>http://regtechapi.in/api/voter_ocr</p>
                           <b>Header : </b><br>
                           {<br>   
                           "AccessToken":"xxxxxxxxxxxxx"<br>
                           }<br>
                           <b>Request Body : </b><br>
                           {<br>   
                           "file":image_file<br>
                           }<br>
                           <b>Success Response : </b><br>
                             { <br/>
                                    "name": "PREM RAJ THAKUR",
                                    "raw_ocr_texts": [
                                        "ELECTION COMMISSION OF INDIA",
                                        "added sict ELECTOR PHOTO IDENTITY CARD",
                                        "GDN0225185",
                                        "Raleth anT 714 : 44 TIT oligit",
                                        "ELECTOR'S NAME : PREM RAJ THAKUR",
                                        "14dl and HIH",
                                        ": 1972 ca dight",
                                        "FATHER'S NAME : KISHAN DEV THAKUR",
                                        "FIT / Sex",
                                        ": you / Male",
                                        "WITH at",
                                        "DATE OF BIRTH/AGE :",
                                        "15/02/1985"
                                    ],
                                    "voter_id_number": "GDN0225185"
                                }&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><br/>
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
                     <br/>
                    <span class = "badge badge-warning"><h4><u>Driving License Extract</u></h4></span><br>
                    <p><b> Hitting URL : </b>http://regtechapi.in/api/extract_driving_text</p>
                    <b>Header : </b><br>
                    {<br>   
                    "AccessToken":"xxxxxxxxxxxxx"<br>
                    }<br>
                    <b>Request Body : </b><br>
                    {<br>   
                    "file":image_file<br>
                    }<br>
                    <b>Success Response : </b><br>
                        {<br/>
                            "status_code": 200,<br/>
                            "driving_license": {<br/> &nbsp;&nbsp;&nbsp;
                                "detected_text":"ThE UNION OF INDIA MAHARASHTRA STATE MOtoR DRIVING LICENCE DL No MHO3 20080022135 DOI 24-01-2007 Valid Till 23-01-2027 (Nt) 09-03-2011 (Tr) AED 15-03-2008 FO88 { Q) AUTHORISATION TO DRIVE FOLLOWING CLASS Of VEHICLES THROUGHOUT INDia cov DOI MCWG 24-01-2007 LMV 24-01-2007 TRANS 10-03-2008 DOB 01-12-1987 BG Name BABU KHAN SDWd JABBAR KHAN Kd KAMLA RAMAN NAGAR, BAIGANWADL Govahdl MumBAL 1 PBU N Ah 4ono4} LID % Signature/Thumb EUNRDg MHOJ 2008261 Impression 0t Hokder Fhre",<br/>
                                "extracted_info": {<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    "Valid Till": "23-01-2027",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    "birth_date": "01-12-1987 B",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    "name": "Kiran Kumari TF Taful DOB: 01/01/2003",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                }<br/>
                            }<br/>
                        }&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><br/>
                        <span class = "badge badge-warning"><h4><u>Driving License OCR</u></h4></span><br>
                        <p><b> Hitting URL : </b>http://regtechapi.in/api/drivingLicense_ocr</p>
                        <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                        <b>Request Body : </b><br>
                        {<br>   
                        "file":image_file<br>
                        }<br>
                        <b>Success Response : </b><br>
                                {<br/>
                                    "birth_date": "01-12-1987",
                                    "dl_no": "MH03 20080022135",
                                    "expiry_date": "23-01-2027",
                                    "name": "",
                                    "raw_ocr_texts": [
                                        "THE UNION OF INDIA",
                                        "MAHARASHTRA STATE MOTOR DRIVING LICENCE",
                                        "DL No MH03 20080022135",
                                        "DOI : 24-01-2007",
                                        "- was",
                                        "Valid Till : 23-01-2027 (NT)",
                                        "09-03-2011 (TR)",
                                        "AED 15-03-2008",
                                        "FORM 7",
                                        "AUTHORISATION TO DRIVE FOLLOWING CLASS",
                                        "RULE 16 (2)",
                                        "OF VEHICLES THROUGHOUT INDIA",
                                        "COV",
                                        "DOI",
                                        "MCWG",
                                        "24-01-2007",
                                        "LMV 24-01-2007",
                                        "TRANS 10-03-2008",
                                        "DOB : 01-12-1987",
                                        "BG",
                                        "Name",
                                        "BABU KHAN",
                                        "S/D/W of JABBAR KHAN",
                                        "Add KAMLA RAMAN NAGAR, BAIGANWADI,",
                                        "R",
                                        "GOVANDI, MUMBAI.",
                                        "PIN 400043",
                                        "ABUKHAN",
                                        "Signature & ID of",
                                        "Signature/Thumb",
                                        "Issuing Authority MH03 2008261",
                                        "Impression of Holder"
                                    ]
                                }&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><br/>
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

   <!--RC BULK APIS-->
 <div class = "card">
    <div class = "card-header">
        <a class = "card-link" href = "#RCBULK" data-toggle = "collapse">RC BULK APIs</a>
    </div>
    <div id = "RCBULK" class = "collapse" data-parent = "#accordion">
        <div class = "card-body">
            <div class="row">
              <div class = "col-md-4">
                <span class = "badge badge-dark"><h3>RC BULK APIs</h3></span>
              </div>
              <div class = "col-md-6">
                <span class = "badge badge-warning"><h4><u>RC BULK Verification</u></h4></span><br>
                <p><b> Hitting URL : </b>https://dev.regtechapi.in/api/rc_validation_bulk</p>
                <b>Header : </b><br>
                {<br>   
                "AccessToken":"xxxxxxxxxxxxx"<br>
                }<br>
                <b>Request Body : </b><br>
                {<br>   
                "rc_number":"{Only Upload RC Number Excel File}"<br>
                }<br>
                <p><b>Success Response : </b><br>
                    [<br>
                        
                    &nbsp;&nbsp;&nbsp;{<br>
                    &nbsp;&nbsp;&nbsp;"rc_validation": {<br> &nbsp;&nbsp;&nbsp;"data": {<br>
                    &nbsp;&nbsp;&nbsp;"client_id": "", <br>
                    &nbsp;&nbsp;&nbsp;"rc_number": "GJ23AT9611",<br>
                    &nbsp;&nbsp;&nbsp;"registration_date": "2010-03-22",<br>
                    &nbsp;&nbsp;&nbsp;"owner_name": "JALORI ILYAS",<br>
                    &nbsp;&nbsp;&nbsp;"owner_number": "4",<br>
                    &nbsp;&nbsp;&nbsp;"present_address": "SANGHARIYAT FALI , NR.BALAPIR DARGAH,ADALAJ, Gandhinagar -382421",<br>
                    &nbsp;&nbsp;&nbsp;"permanent_address": "SANGHARIYAT FALI , NR.BALAPIR DARGAH,ADALAJ, Gandhinagar -382421",<br>
                    &nbsp;&nbsp;&nbsp;"mobile_number": "",<br>
                    &nbsp;&nbsp;&nbsp;"vehicle_category": "LGV",<br>
                    &nbsp;&nbsp;&nbsp;"vehicle_chasi_number": "MC263ERCODC269246",<br> 
                    &nbsp;&nbsp;&nbsp;"vehicle_engine_number": "E483CDDC605788",<br> 
                    &nbsp;&nbsp;&nbsp;"maker_description": "",<br>
                    &nbsp;&nbsp;&nbsp;"maker_model": "10.59 XP E HSD RHD",
                    <br>
                    &nbsp;&nbsp;&nbsp;"body_type": "OPEN", <br>
                    &nbsp;&nbsp;&nbsp;"fuel_type": "PETROL",<br>
                    &nbsp;&nbsp;&nbsp;"color": "GOLDENBROW",<br>
                    &nbsp;&nbsp;&nbsp;"norms_type":null,<br>
                    &nbsp;&nbsp;&nbsp;"fit_up_to":null,<br>
                    &nbsp;&nbsp;&nbsp;"financer": "L&T FINANCE SERVICE LTD",<br>
                    &nbsp;&nbsp;&nbsp;"insurance_company": "",<br> 
                    &nbsp;&nbsp;&nbsp;"insurance_policy_number": "",<br>
                    &nbsp;&nbsp;&nbsp;"insurance_upto":null,<br> 
                    &nbsp;&nbsp;&nbsp;"manufacturing_date": "3/2013",<br>
                    &nbsp;&nbsp;&nbsp;"registered_at":null,<br/>
                    &nbsp;&nbsp;&nbsp;"cubic_capacity":95,<br>
                    &nbsp;&nbsp;&nbsp;"vehicle_gross_weight":7200,<br>
                     
                    &nbsp;&nbsp;&nbsp;"no_cylinders":5,<br>
                    &nbsp;&nbsp;&nbsp;"seat_capacity":3,<br>
                    &nbsp;&nbsp;&nbsp;"sleeper_capacity":0,<br>
                    &nbsp;&nbsp;&nbsp;"standing_capacity":0,<br>
                    &nbsp;&nbsp;&nbsp;"wheelbase": 3350,<br> 
                    &nbsp;&nbsp;&nbsp;"unladen_weight":3600,<br>
                    &nbsp;&nbsp;&nbsp;"vehicle_category_description": null,<br>
                    &nbsp;&nbsp;&nbsp;"pucc_number": GJ00100440010105,<br>
                    &nbsp;&nbsp;&nbsp;"pucc_upto": 01/05/2024,<br>
                    &nbsp;&nbsp;&nbsp;"masked_name": false,<br>
                    &nbsp;&nbsp;&nbsp;"permit_issue_date": 18-Nov-2022,<br>
                    &nbsp;&nbsp;&nbsp;"permit_number": GJ2022-GP-2759H,<br>
                    &nbsp;&nbsp;&nbsp;"permit_type": Goods Permit[LGV],<br>
                    &nbsp;&nbsp;&nbsp;"permit_valid_from": 18-Nov-2022,<br>
                    &nbsp;&nbsp;&nbsp;"permit_valid_upto": null,<br>
                    &nbsp;&nbsp;&nbsp;"national_permit_issued_by":null,<br>
                    &nbsp;&nbsp;&nbsp;"national_permit_number":null,<br>
                    &nbsp;&nbsp;&nbsp;"national_permit_upto": false,<br>
                    &nbsp;&nbsp;&nbsp;"blacklist_status":NA,<br>
                    &nbsp;&nbsp;&nbsp;"blacklist_details":NA,<br>
                    &nbsp;&nbsp;&nbsp;"rto_code": GJ-23,<br>
                    &nbsp;&nbsp;&nbsp;"latest_by":17/01/2024,<br>
                    &nbsp;&nbsp;&nbsp;"tax_upto":LTT,<br>
                    &nbsp;&nbsp;&nbsp;"noc_details":NA,<br>
                    &nbsp;&nbsp;&nbsp;"number":GJ23AT9611,<br>
                    &nbsp;&nbsp;&nbsp;"rc_status":ACTIVE,<br>
                    &nbsp;&nbsp;&nbsp;"authority":GANDHINAGAR, Gujarat,<br>
                    &nbsp;&nbsp;&nbsp;"non_use_to":null,<br>
                    &nbsp;&nbsp;&nbsp;"non_use_from":null,<br>
                    &nbsp;&nbsp;&nbsp;"non_use_status":NA,<br>
                    &nbsp;&nbsp;&nbsp;},<br>
                    &nbsp;&nbsp;&nbsp;"data": {<br>
                        &nbsp;&nbsp;&nbsp;"client_id":null, <br>
                        &nbsp;&nbsp;&nbsp;"rc_number": "UP62CM5124",<br>
                        &nbsp;&nbsp;&nbsp;"registration_date": "02/10/2022",<br>
                        &nbsp;&nbsp;&nbsp;"owner_name": "ADITYA KUMAR",<br>
                        &nbsp;&nbsp;&nbsp;"owner_number": "1",<br>
                        &nbsp;&nbsp;&nbsp;"present_address": "58 HAIDARPUR , .,, Jaunpur -222141",<br>
                        &nbsp;&nbsp;&nbsp;"permanent_address": "58 HAIDARPUR , .,, Jaunpur -222141",<br>
                        &nbsp;&nbsp;&nbsp;"mobile_number": "",<br>
                        &nbsp;&nbsp;&nbsp;"vehicle_category": "2WN",<br>
                        &nbsp;&nbsp;&nbsp;"vehicle_chasi_number": "MD625AF92N1K1XXXX",<br> 
                        &nbsp;&nbsp;&nbsp;"vehicle_engine_number": "AF9KN18112XX",<br> 
                        &nbsp;&nbsp;&nbsp;"maker_description": "",<br>
                        &nbsp;&nbsp;&nbsp;"maker_model": "TVS RAIDER",
                        <br>
                        &nbsp;&nbsp;&nbsp;"body_type": "2 WHEELER", <br>
                        &nbsp;&nbsp;&nbsp;"fuel_type": "PETROL",<br>
                        &nbsp;&nbsp;&nbsp;"color": "WICKED BLACK",<br>
                        &nbsp;&nbsp;&nbsp;"norms_type": "",<br>
                        &nbsp;&nbsp;&nbsp;"fit_up_to": "",<br>
                        &nbsp;&nbsp;&nbsp;"financer": "L&T FINANCE SERVICE LTD",<br>
                        &nbsp;&nbsp;&nbsp;"insurance_company": "Bajaj Allianz General Insurance Co. Ltd.",<br> 
                        &nbsp;&nbsp;&nbsp;"insurance_policy_number": "OG-23-1321-1826-00000707",<br>
                        &nbsp;&nbsp;&nbsp;"insurance_upto": "",<br> 
                        &nbsp;&nbsp;&nbsp;"manufacturing_date": "9/2022",<br>
                        &nbsp;&nbsp;&nbsp;"registered_at": "",<br> 
                        &nbsp;&nbsp;&nbsp;"cubic_capacity":124.8,<br>
                        &nbsp;&nbsp;&nbsp;"vehicle_gross_weight":253,<br>
                         
                        &nbsp;&nbsp;&nbsp;"no_cylinders":1,<br>
                        &nbsp;&nbsp;&nbsp;"seat_capacity":2,<br>
                        &nbsp;&nbsp;&nbsp;"sleeper_capacity":0,<br>
                        &nbsp;&nbsp;&nbsp;"standing_capacity":0,<br>
                        &nbsp;&nbsp;&nbsp;"wheelbase":1326,<br> 
                        &nbsp;&nbsp;&nbsp;"unladen_weight": 123,<br>
                        &nbsp;&nbsp;&nbsp;"vehicle_category_description": null,<br>
                        &nbsp;&nbsp;&nbsp;"pucc_number":"Newv4",<br>
                        &nbsp;&nbsp;&nbsp;"pucc_upto":01/10/2023,<br>
                        &nbsp;&nbsp;&nbsp;"masked_name": false<br>
                        &nbsp;&nbsp;&nbsp;"permit_issue_date":null,<br>
                        &nbsp;&nbsp;&nbsp;"permit_number":null,<br>
                        &nbsp;&nbsp;&nbsp;"permit_type":null,<br>
                        &nbsp;&nbsp;&nbsp;"permit_valid_from":null,<br>
                        &nbsp;&nbsp;&nbsp;"permit_valid_upto": null,<br>
                        &nbsp;&nbsp;&nbsp;"national_permit_issued_by":null,<br>
                        &nbsp;&nbsp;&nbsp;"national_permit_number":null,<br>
                        &nbsp;&nbsp;&nbsp;"national_permit_upto":null,<br>
                        &nbsp;&nbsp;&nbsp;"blacklist_status":NA,<br>
                        &nbsp;&nbsp;&nbsp;"blacklist_details":NA,<br>
                        &nbsp;&nbsp;&nbsp;"rto_code":UP-62,<br>
                        &nbsp;&nbsp;&nbsp;"latest_by":17/01/2024,<br>
                        &nbsp;&nbsp;&nbsp;"tax_upto":LTT,<br>
                        &nbsp;&nbsp;&nbsp;"noc_details":NA,<br>
                        &nbsp;&nbsp;&nbsp;"number":UP62CM5124,<br>
                        &nbsp;&nbsp;&nbsp;"rc_status":ACTIVE,<br>
                        &nbsp;&nbsp;&nbsp;"authority":JAUNPUR, Uttar Pradesh,<br>
                        &nbsp;&nbsp;&nbsp;"non_use_to":null,<br>
                        &nbsp;&nbsp;&nbsp;"non_use_from":null,<br>
                        &nbsp;&nbsp;&nbsp;"non_use_status":NA,<br>
                        &nbsp;&nbsp;&nbsp;},<br/>
                    &nbsp;&nbsp;&nbsp;"status_code": 200,<br/> 
                    &nbsp;&nbsp;&nbsp;"success": true,<br/> 
                    &nbsp;&nbsp;&nbsp;"message": null,<br>
                    &nbsp;&nbsp;&nbsp;"message_code": "success"<br>
                    &nbsp;&nbsp;&nbsp;},<br>
                    &nbsp;&nbsp;&nbsp;"statusCode": null<br>
                    &nbsp;&nbsp;&nbsp;}<br>
                    &nbsp;&nbsp;]<br>
                </p>
              </div>
            </div>
        </div>
    </div>
 </div>

   <!--RC BULK APIS END-->
    <!--PAN Card BULK APIS-->
    <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#PANBULK" data-toggle = "collapse">PAN BULK APIs</a>
        </div>
        <div id = "PANBULK" class = "collapse" data-parent = "#accordion">
            <div class = "card-body">
                <div class="row">
                  <div class = "col-md-4">
                    <span class = "badge badge-dark"><h3>PAN BULK APIs</h3></span>
                  </div>
                  <div class = "col-md-6">
                    <span class = "badge badge-warning"><h4><u>PAN BULK Verification</u></h4></span><br>
                    <p><b> Hitting URL : </b>https://dev.regtechapi.in/api/rc_validation_bulk</p>
                    <b>Header : </b><br>
                    {<br>   
                    "AccessToken":"xxxxxxxxxxxxx"<br>
                    }<br>
                    <b>Request Body : </b><br>
                    {<br>   
                    "pan_no":"{Only Upload PAN Number Excel File}"<br>
                    }<br>
                    <p><b>Success Response : </b><br>
                        [<br>
                            
                        &nbsp;&nbsp;&nbsp;{<br>
                        &nbsp;&nbsp;&nbsp;"pancard": {<br> &nbsp;&nbsp;&nbsp;"data": {<br>
                        &nbsp;&nbsp;&nbsp;"client_id": "", <br>
                        &nbsp;&nbsp;&nbsp;"transactionId": "88446f92-0f0f-40fe-ad12-557a6a0d88d2", <br>
                        &nbsp;&nbsp;&nbsp;"panNumber": "AAJCC5200A",<br>
                        &nbsp;&nbsp;&nbsp;"maskedAadhar":null,<br>
                        &nbsp;&nbsp;&nbsp;"lastFourDigitAadhar":null,<br>
                        &nbsp;&nbsp;&nbsp;"typeOfHolder": "Company",<br>
                        &nbsp;&nbsp;&nbsp;"name": "CRACIONS DIGITAL TECHNOLOGIES PRIVATE LIMITED",<br>
                        &nbsp;&nbsp;&nbsp;"firstName": "",<br>
                        &nbsp;&nbsp;&nbsp;"middleName": "",<br>
                        &nbsp;&nbsp;&nbsp;"lastName": "",<br>
                        &nbsp;&nbsp;&nbsp;"gender": "null",<br> 
                        &nbsp;&nbsp;&nbsp;"dob": "02/06/2021",<br> 
                        &nbsp;&nbsp;&nbsp;"address": "B-24 MAHENDRA ENCLAVE Ghaziabad GHAZIABAD  201001 Uttar Pradesh",<br>
                        &nbsp;&nbsp;&nbsp;"city": null,<br>
                        &nbsp;&nbsp;&nbsp;"state": "Uttar Pradesh", <br>
                        &nbsp;&nbsp;&nbsp;"country": "INDIA",<br>
                        &nbsp;&nbsp;&nbsp;"pincode": "201001",<br>
                        &nbsp;&nbsp;&nbsp;"mobile_no": null,<br>
                        &nbsp;&nbsp;&nbsp;"email": null,<br>
                        &nbsp;&nbsp;&nbsp;"isValid": true,<br>
                        &nbsp;&nbsp;&nbsp;"aadhaarSeedingStatus": false,<br>
                        &nbsp;&nbsp;&nbsp;"serviceCode": "1"
                        <br>
                        &nbsp;&nbsp;&nbsp;},<br>
                        &nbsp;&nbsp;&nbsp;"data": {<br>
                            &nbsp;&nbsp;&nbsp;"client_id": "", <br>
                            &nbsp;&nbsp;&nbsp;"transactionId": "b828bc70-e4db-43d5-aac5-f9932ca64681", <br>
                            &nbsp;&nbsp;&nbsp;"panNumber": "BXYPK8385G",<br>
                            &nbsp;&nbsp;&nbsp;"maskedAadhar":"XXXXXXXX4871",<br>
                            &nbsp;&nbsp;&nbsp;"lastFourDigitAadhar":4871,<br>
                            &nbsp;&nbsp;&nbsp;"typeOfHolder": "Individual or Person",<br>
                            &nbsp;&nbsp;&nbsp;"name": "VISHAL RAMESH KAMBLE",<br>
                            &nbsp;&nbsp;&nbsp;"firstName": "VISHAL",<br>
                            &nbsp;&nbsp;&nbsp;"middleName": "RAMESH",<br>
                            &nbsp;&nbsp;&nbsp;"lastName": "KAMBLE",<br>
                            &nbsp;&nbsp;&nbsp;"gender": "M",<br> 
                            &nbsp;&nbsp;&nbsp;"dob": "27/11/1988",<br> 
                            &nbsp;&nbsp;&nbsp;"address": "CHAVHAN VASTI ANAND NAGAR 39 AUNDH ROAD KHADKI Botanical Garden S.O (Pune) Pune City PUNE 411020 Maharashtra",<br>
                            &nbsp;&nbsp;&nbsp;"city":"PUNE",<br>
                            &nbsp;&nbsp;&nbsp;"state": "Maharashtra", <br>
                            &nbsp;&nbsp;&nbsp;"country": "INDIA",<br>
                            &nbsp;&nbsp;&nbsp;"pincode": "411020",<br>
                            &nbsp;&nbsp;&nbsp;"mobile_no": 9021025357,<br>
                            &nbsp;&nbsp;&nbsp;"email":"kamblevishal2m@gmail.com",<br>
                            &nbsp;&nbsp;&nbsp;"isValid": true,<br>
                            &nbsp;&nbsp;&nbsp;"aadhaarSeedingStatus":true,<br>
                            &nbsp;&nbsp;&nbsp;"serviceCode": "1"
                            &nbsp;&nbsp;&nbsp;},<br/>
                        &nbsp;&nbsp;&nbsp;"status_code": 200,<br/> 
                        &nbsp;&nbsp;&nbsp;"success": true,<br/> 
                        &nbsp;&nbsp;&nbsp;"message": null,<br>
                        &nbsp;&nbsp;&nbsp;"message_code": "success"<br>
                        &nbsp;&nbsp;&nbsp;},<br>
                        &nbsp;&nbsp;&nbsp;"statusCode": null<br>
                        &nbsp;&nbsp;&nbsp;}<br>
                        &nbsp;&nbsp;]<br>
                    </p>
                  </div>
                </div>
            </div>
        </div>
     </div>
    
       <!--PAN Card BULK APIS END-->
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
                    <span class = "badge badge-warning"><h4><u>CIN Basic</u></h4></span><br>
                    <p><b> Hitting URL : </b> http://regtechapi.in/api/corporate_cin</p>
                    <b>Request Body : </b><br>
                    {<br>   
                    "cin_number":"L65190GJ1994PLC021012"<br>
                    }<br>
                    <p><b>Success Response : </b><br>
                        [<br>
                            
                        &nbsp;&nbsp;&nbsp;{<br>
                            "corporate_cin": {<br/>
                            &nbsp;&nbsp;&nbsp;"data": {<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"cin": "L65190GJ1994PLC021012",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"numberOfMembers": "",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"subCategory": "NON-GOVERNMENT COMPANY",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"classType": "PUBLIC",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"companyType": "INDIAN COMPANY",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"companyName": "ICICI BANK LIMITED",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "paidUpCapital": "14038147356",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"authorisedCapital": "25000000000",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"whetherListed": "LISTED",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"dateOfIncorporation": "05/01/1994",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"registrationNumber": "021012",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"registeredAddress": "ICICI BANK TOWER, OLD PADRA ROAD, VADODARA",
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"registeredDisctrict": "VADODARA",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"registeredState": ["GUJARAT","GJ"],<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"registeredCity": "VADODARA",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"registeredPincode": "390007",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"registeredCountry": "INDIA",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"activeCompliance": "",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"category": "COMPANY LIMITED BY SHARES",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"status": "ACTIVE",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"rocOffice": "ROC AHMEDABAD",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"addressOtherThanRegisteredOffice": "ICICI BANK TOWER, NEAR CHAKLI CIRCLE, OLD PADRA ROAD, VADODARA, VADODARA, GUJARAT, INDIA, 390007",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"emailId": "*****nysecretary@icicibank.com",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"natureOfBusiness": "",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"noOfDirectors": "14",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"statusForEfiling": "ACTIVE"<br/>
                            }&nbsp;&nbsp;&nbsp;
                            },<br/>
                            "statusCode": 200,<br/>
                            "success": true<br/>
                        }
                        ]<br>
                    </p> 
                    <span class = "badge badge-warning"><h4><u>CIN Advance</u></h4></span><br>
                    <p><b> Hitting URL : </b> http://regtechapi.in/api/corporate_cin</p>
                    <b>Request Body : </b><br>
                    {<br>   
                     "cinNumber":"L65190GJ1994PLC021012"<br>
                    }<br>
                     <p><b>Success Response : </b><br>
                      [<br>
                      &nbsp;&nbsp;&nbsp;"corporate_cin": {<br> 
                      &nbsp;&nbsp;&nbsp;"data": {<br>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"cin": "L65190GJ1994PLC021012",<br>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"numberOfMembers": "",<br>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"subCategory": "NON-GOVERNMENT COMPANY",<br>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"class": "PUBLIC",<br>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"companyType": "INDIAN COMPANY",<br>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"companyName": "ICICI BANK LIMITED",<br>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"paidUpCapital": "14038147356",<br>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"authorisedCapital": "25000000000",<br>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"whetherListed": "LISTED",<br>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"dateOfIncorporation": "05/01/1994",<br>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"lastAgmDate": "30/08/2023",<br>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"registrationNumber": "021012",<br>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"registeredAddress": "ICICI BANK TOWER",<br>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"activeCompliance": "",<br>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"suspendedAtStockExchange": "",<br>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"balanceSheetDate": "31/03/2023",<br>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"category": "COMPANY LIMITED BY SHARES",<br>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"status": "ACTIVE",<br>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"rocOffice": "ROC AHMEDABAD",<br>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"countryOfIncorporation": "INDIAN",<br>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"descriptionOfMainDivision": "",<br>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"addressOtherThanRegisteredOffice": "ICICI BANK TOWER",<br/>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"emailId": "*****nysecretary@icicibank.com",<br/>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"natureOfBusiness": "",<br/>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "noOfDirectors": "14",<br/>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"statusForEfiling": "ACTIVE",<br/>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"statusUnderCirp": "",<br/>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"pan": "",<br/>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"directors": [<br/>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{<br/>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"din": "05180796",<br/>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"designation": "DIRECTOR",<br/>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"dateOfAppointment": "23/01/2022",<br/>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"address": "*****, HARYANA, INDIA, 122009",<br/>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"name": "VIBHA PAUL RISHI",<br/>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"whetherDscRegistered": "",<br/>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"dscExpiryDate": "-",<br/>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"pan": "*****1495E",<br/>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"fatherName": "**** *** ****",<br/>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"dob": "19/06/1960",<br/>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"splitAddress": {<br/>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"district": [<br/>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"GURGAON"<br/>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;],<br/>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"state": [<br/>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[<br/>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"HARYANA",<br/>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"HR"<br/>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]<br/>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;],<br/>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"city": [<br/>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"GURGAON"<br/>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;],<br/>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"pincode": "122009",<br/>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"country": [<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"IN",<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"IND",<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"INDIA"<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;],<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"addressLine": "INDIA"<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;},<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"otherDirectorships": {<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"listOfLLPs": [],<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"listOfCompanies": [<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{<br/>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"cin": "L24220MH1945PLC004598",<br/>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"companyName": "ASIAN PAINTS LIMITED",<br/>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"beginDate": "23/01/2022",<br/>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"endDate": "-"<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;},<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{<br/>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"cin": "L24239MH1939PLC002893",<br/>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"companyName": "TATA CHEMICALS LIMITED",<br/>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"beginDate": "23/01/2022",<br/>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"endDate": "-"<br/>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;},<br/>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;],<br/>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"din": "05180796"<br/>
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;},<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"splitAddress": {<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"district": [<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"VADODARA"<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;],<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"state": [<br/>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[<br/>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"GUJARAT",<br/>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"GJ"<br/>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]<br/>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;],<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"city": [<br/>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"VADODARA"<br/>
                         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;],<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"pincode": "390007",<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"country": [<br/>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"IN",<br/>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"IND",<br/>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"INDIA"<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;],<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"addressLine": "ICICI BANK TOWER,NEAR CHAKLI CIRCLE<br/>
                      },<br>
                      "status_code": 200,<br> 
                      "success": true,<br> 
                      },<br>
                      }&nbsp;&nbsp;&nbsp;<br>
                      ]&nbsp;&nbsp;&nbsp;<br>
                   </p>              
                </div>
                </div>
            </div>
        </div>
    </div>
<!--Company Product Details-->
  <div class = "card">
    <div class = "card-header">
        <a class = "card-link" href = "#CompanyDetails1" data-toggle = "collapse">Company Product  APIs</a>
    </div>
    <div id = "CompanyDetails1" class = "collapse" data-parent = "#accordion">
        <div class = "card-body">
            <div class="row">
              <div class = "col-md-4">
                <span class = "badge badge-dark"><h3>Company Product APIs</h3></span>
              </div>
              <div class = "col-md-6">
                <span class = "badge badge-warning"><h4><u>Company Product</u></h4></span><br>
                <p><b> Hitting URL : </b>http://regtechapi.in/api/company-products</p>
                <b>Header : </b><br>
                {<br>   
                "AccessToken":"xxxxxxxxxxxxx"<br>
                }<br>
                <b>Request Body : </b><br>
                {<br>   
                "companyName":""<br>
                "flrsLicenseNo":""<br>
                }<br>
                <p><b>Success Response : </b><br>
                    [<br>
                    {&nbsp;&nbsp;&nbsp;&nbsp;<br/>
                        "status_code": 200,<br>
                        "company_details": [<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;{<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"companyDetails": {<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "Information": {<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"apptypedesc": "New Registration",<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"companyname": "CHITALE DUDH SANKLAN KENDRA SAVLAJ",<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"displayrefid": "30201115106914080",<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"districtname": "Sangli",<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"fboid": 73666334,<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"licenseactiveflag": true,<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"licensecategoryid": 3,<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"licensecategoryname": "Registration",<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"licenseno": "21520313000881",<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"premiseaddress": "A/p:Savlaj Tal : Tasgaon Dist: Sangli",<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"premisepincode": 416311,<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"refid": 106914080,<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"statename": "Maharashtra",<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"statusdesc": "License Issued",<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"talukname": "Tasgaon",<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"villagename": null<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; },<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "products": [<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{<br/>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"activeFlag": true,<br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp"categoryName": null,<br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp"fpvsProductId": null,<br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp"indexVal": null,<br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp"kindOfBusinessType": null,<br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp"manufacturFlag": false,<br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp"productId": 1,<br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp"productName": "01 - Dairy products and analogues,",<br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp"productNamef": null,<br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp"rcProductId": 56286710,<br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp"refId": 106914080,<br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp"subCategoryId": null,<br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp"subCategoryName": null<br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;],<br/>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"refId": 106914080<br>
                                <br>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]<br/>
              &nbsp;&nbsp;&nbsp;&nbsp;}<br/>
             ]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </p>
              </div>
            </div>
        </div>
    </div>
  </div>

<!--Company Product Details End-->
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
                                    "gstin": "{@gstin_number}",
                                    "legal_name": "{@legal_name}",
                                    "jurisdiction": "{@jurisdiction}", "reg_date": "{@reg_date}",
                                    "taxpayer_type": "{@taxpayer_type}",
                                    "status": "{@status}",
                                    "address": "{@address}",
                                    "business_type": "{@business_type}",
                                    "nature" : "{@nature}",
                                    "last_update": "{@last_update}",
                                    "state_code": "{@state_code}"
                                },
                            
                            }
                            "statusCode": "200"
                        }
                        ]
                        <br/>
                        <br/>
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
                        <br/>
                      <span class = "badge badge-warning"><h4><u>BASIC GSTIN</u></h4></span><br>
                      <p><b> Hitting URL : </b>http://regtechapi.in/api/gstverification</p>
                      <p><b>Request Method : POST</b></p>
                      <p><b>Header</b> :{<br/>
                        "AccessToken":"xxxxxxxxxxxxx"<br/>
                      }
                      </p>
                      <p>
                      <b>Request Body</b> :{<br/>
                        "gstin_number":"08AABCM1857H2ZF"<br/>
                        }<br/>
                      </p>
                      <p><b>Success Response : </b><br>
                      &nbsp;&nbsp;{<br>
                      &nbsp;&nbsp;"response":{<br>
                          "stjCd": "RJ812",<br/>
                          "lgnm": "MEGHA FINLOAN PRIVATE LIMITED",<br/>
                          "stj": "Circle-I, Jaipur III, AC / CTO Ward",<br/>
                          "dty": "Regular",<br/>
                          "adadr": [<br/>
                            {<br/>
                                  "addr": {<br/>
                                      "bnm": "HP HONDA",<br/>
                                      "st": "NEAR NAGAR PALIKA",<br/>
                                      "loc": "NAWALGARH",<br/>
                                      "bno": "WARD NO. 7",<br/>
                                      "dst": "Jhunjhunu",<br/>
                                      "lt": "",<br/>
                                      "locality": "",<br/>
                                      "pncd": "333042",<br/>
                                      "landMark": "",<br/>
                                      "stcd": "Rajasthan",<br/>
                                      "geocodelvl": "NA",<br/>
                                      "flno": "",<br/>
                                      "lg": ""
                                      <br/>
                                     },
                                       <br/>
                                       "ntr": "Supplier of Services"<br/>
                                  },<br/>
                              {<br/>
                                  "addr": {<br/>
                                      "bnm": "JAIN MARKET",<br/>
                                      "st": "OPPOSITE PAHARIYA TOWER, STATION ROAD",<br/>
                                      "loc": "SIKAR",<br/>
                                      "bno": ".",<br/>
                                      "dst": "Sikar",<br/>
                                      "lt": "",<br/>
                                      "locality": "",<br/>
                                      "pncd": "332001",<br/>
                                      "landMark": "",<br/>
                                      "stcd": "Rajasthan",<br/>
                                      "geocodelvl": "NA",<br/>
                                      "flno": "1ST FLOOR",<br/>
                                      "lg": ""<br/>
                                  },<br/>
                                  "ntr": "Supplier of Services"<br/>
                              }<br/>
                          ],<br/>
                          "cxdt": "",<br/>
                          "gstin": "08AABCM1857H2ZF",<br/>
                          "nba": [<br/>
                              "Supplier of Services"<br/>
                          ],<br/>
                          "lstupdt": "03/07/2023",<br/>
                          "rgdt": "16/08/2017",<br/>
                          "ctb": "Private Limited Company",<br/>
                          "pradr": {<br/>
                              "addr": {<br/>
                                  "bnm": "PARIJAT BUILDING",<br/>
                                  "st": "ASHOK MARG",<br/>
                                  "loc": "C-SCHEME",<br/>
                                  "bno": "9",<br/>
                                  "dst": "Jaipur",<br/>
                                  "lt": "",<br/>
                                  "locality": "",<br/>
                                  "pncd": "302001",<br/>
                                  "landMark": "",<br/>
                                  "stcd": "Rajasthan",<br/>
                                  "geocodelvl": "NA",<br/>
                                  "flno": "2nd floor O-12",<br/>
                                  "lg": ""<br/>
                              },<br/>
                              "ntr": "Supplier of Services"<br/>
                          },<br/>
                          "sts": "Active",<br/>
                          "ctjCd": "WM0802",<br/>
                          "tradeNam": "MEGHA FINLOAN PRIVATE LIMITED",<br/>
                          "ctj": "GST RANGE-XXXVII",<br/>
                          "einvoiceStatus": "Yes"<br/>
                      }<br/>
                      &nbsp;&nbsp;"status_code": 200,<br/>
                      &nbsp;&nbsp;"message_code": "success",<br/>
                      &nbsp;&nbsp;"success": true<br/>
                      }
                    </p>
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
                            "corporate_gstin":"{@gstin_number}",<br>
                            "name":"{@name}}",<br>
                            "mobile_number":"{@mobile_number}",<br>
                            "address":"{@address}",<br>
                            "state":"{@state}",<br>
                            "city":"{@city}",<br>
                            "pincode":"{@pincode}",<br>
                        }<br>
                        <b>Success Response : </b><br>
                        [
                            {
                                "corporate_gstin": { 
                                "code": "200",
                                "status": "success",  
                                "response": {
                                    "gstin": "{@gstin_number}",
                                    "legal_name": "{@legal_name}",
                                    "jurisdiction": "{@jurisdiction}", "reg_date": "{@reg_date}",
                                    "taxpayer_type": "{@taxpayer_type}",
                                    "status": "{@status}",
                                    "address": "{@address}",
                                    "business_type": "{@business_type}",
                                    "nature" : "{@nature}",
                                    "last_update": "{@last_update}",
                                    "state_code": "{@state_code}"
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
                        <span class = "badge badge-warning"><h4><u>Passport OCR</u></h4></span><br>
                        <p><b> Hitting URL : </b>http://regtechapi.in/api/passport_ocr</p>
                        <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                        <b>Request Body : </b><br>
                        {<br>   
                        "file":passport_image_file<br>
                        }<br>
                        <b>Success Response : </b><br>
                            {<br/>
                                "status_code": 200,<br/>
                                "passport_verification": {<br/> &nbsp;&nbsp;&nbsp;
                                    "mrz_info": {<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        "date_of_birth_yymmdd":761015,<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        "expiration_date_yymmdd":270309,<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        "gender":"M",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        "mrz_type":"TD3",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        "nationality":"IND",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        "number":"N9372097<",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    },<br/>
                                    &nbsp;&nbsp;&nbsp;&nbsp;"valid_document":true <br/>
                        &nbsp;&nbsp;&nbsp;}<br/>
                           } &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><br/>

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
        <span class = "badge badge-warning"><h4><u>Udyam Search v2</u></h4></span><br>
        <p><b> Hitting URL : </b>http://regtechapi.in/api/udyamdetails</p>
        <b>Header : </b><br>
        {<br>   
        "AccessToken":"xxxxxxxxxxxxx"<br>
        }<br>
        <b>Request Body : </b><br>
        {<br>   
        "UdyamRegNumber":"UDYAM-MH-26-0194834"<br>
        }<br>

        <p><b>Success Response : </b><br>
            [<br>
                &nbsp;&nbsp;{<br>
                "status_code":200<br>
                &nbsp;&nbsp;"response":  {<br>
                &nbsp;&nbsp;"essentials":{<br>
                &nbsp;&nbsp;"udyamNumber":"UDYAM-MH-26-0194834"<br>
                &nbsp;&nbsp;&nbsp;&nbsp;}<br>
                &nbsp;&nbsp;"essentials": {<br>
                &nbsp;&nbsp;"result": {<br/>
                &nbsp;&nbsp;&nbsp;&nbsp;"generalInfo": {<br/>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"udyamRegistrationNumber": "UDYAM-MH-26-0194834",<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"gender": "Male",<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"majorActivity": "TRADING",<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"nameOfEnterprise": "OMKARESHWAR COMPUTER",<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"organisationType": "Proprietary",<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"socialCategory": "General",<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"dateOfIncorporation": "27/10/2015",<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"dateOfCommencementOfProductionBusiness": "",<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"dic": null,<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"msmedi": null,<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"dateOfUdyamRegistration": null,<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"typeOfEnterprise": null<br>
               &nbsp;&nbsp;&nbsp;&nbsp;},<br/>
               &nbsp;&nbsp;&nbsp;&nbsp;"enterpriseType": [<br>
                &nbsp;&nbsp;&nbsp;&nbsp;{<br/>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"dataYear": null,<br/>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"classificationYear": "111/2",<br/>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"enterpriseType": "RAMCHANDRA COMPLEX",<br/>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"classificationDate": "BHOSARI",<br/>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"sn": "1",<br/>           
                &nbsp;&nbsp;&nbsp;&nbsp;},<br>
             ],<br/>
            &nbsp;&nbsp;&nbsp;"unitsDetails": [<br/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{<br/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"sn": null,<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"unitName": "OMKARESHWAR COMPUTER",<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"flat": "111/2",<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"building": "RAMCHANDRA COMPLEX",<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"villageTown": "BHOSARI",<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"block": "MIDC-S-BLOCK",<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"road": "INDRAYANI NAGAR",<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"city": "PUNE",<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"pin": "411044",<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"state": "MAHARASHTRA",<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"district": "PUNE"<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>
            ],<br>
            &nbsp;&nbsp;&nbsp;"officialAddressOfEnterprise": {<br/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"flatDoorBlockNo": null,<br/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"nameOfPremisesBuilding": null,<br/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"villageTown": null,<br/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"block": null,<br/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"roadStreetLane": null,<br/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"city": null,<br/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"state": null,<br/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"pin": null,<br/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"district": null,<br/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"mobile": null,<br/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"email": null<br/>
            },<br/>
            &nbsp;&nbsp;&nbsp;"nationalIndustryClassificationCodes": [<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{<br/>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"nic2Digit":null,<br/>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"nic4Digit":null,<br/>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"nic5Digit":null,<br/>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"activity":null,<br/>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"date": null<br/>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br>
                &nbsp;&nbsp;&nbsp;],<br/>
             }<br>
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
            <a class = "card-link" href = "#bank_verification1" data-toggle = "collapse">Bank's APIs</a>
        </div>
        <div class = "collapse" id = "bank_verification1" data-parent = "#accordion">
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
          </div>
        </div> 
    </div>
    <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#bank_verification3" data-toggle = "collapse">Bank Analyser APIs</a>
        </div>
        <div class = "collapse" id = "bank_verification3" data-parent = "#accordion">
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
                    <span class = "badge badge-warning"><h4><u>Bank Analyser</u></h4></span><br>
                    <p><b> Hitting URL : </b> http://regtechapi.in/api/bank_analyser_new</p>
                    <b>Request Method : POST </b><br>
                    <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                    <b>Request Body : </b><br>
                    {<br>
                    "bankStemt": "bank_statement.pdf",<br>
                    "bankName": "Hdfc Bank"<br>
                    "accountType": "SAVING",<br>
                    "password": "******"<br>
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
             </div>
            </div>
        </div> 
    </div>     
    <div class="card">
        <div class = "card-header">
            <a class = "card-link" href = "#bank_verification2" data-toggle = "collapse">Bank Statement APIs</a>
        </div>
        <div class = "collapse" id = "bank_verification2" data-parent = "#accordion">
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
           </div>
        </div>
    </div>  
    <div class="card">
        <div class = "card-header">
            <a class = "card-link" href = "#bank_reader2" data-toggle = "collapse">Bank Statement Reader APIs</a>
        </div>
        <div class = "collapse" id = "bank_reader2" data-parent = "#accordion">
            <div class = "card-body">
                <div class="row">
                    <div class = "col-md-4">
                        <span class = "badge badge-dark"><h3>Bank Statement Reader APIs</h3></span>
                    </div>
                  <div class = "col-md-6">
                    <span class = "badge badge-warning"><h4><u>Bank Statement Reader</u></h4></span><br>
                    <p><b> Hitting URL : </b> http://regtechapi.in/api/bankstatement_reader</p>
                    <b>Request Method : POST </b><br>
                    <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                    <b>Request Body : </b><br>
                    {<br>
                    "bankStmt": "bank_statement-hdfc.pdf",<br>
                    "BankName": "HDFC"<br>
                    "accountType": "SAVING",<br>
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
           </div>
        </div>
    </div>  
    <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#telecom12" data-toggle = "collapse">Telecom APIs</a>
        </div>
        <div class = "collapse" id = "telecom12" data-parent = "#accordion">
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
                    "doc_img": "{@doc_img}",<br>
                    "selfie": "{@selfie}"<br>
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
                    <br/>
                </div>
               </div>
            </div>
        </div>
    </div>
    <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#face_detection" data-toggle = "collapse">Face Detection APIs</a>
        </div>
        <div class = "collapse" id = "face_detection" data-parent = "#accordion">
            <div class = "card-body">
                <div class="row">
                    <div class = "col-md-4">
                        <span class = "badge badge-dark"><h3>Face Detection API</h3></span>
                    </div>
                <div class = "col-md-6">
                    <span class = "badge badge-warning"><h4><u>Face Detection</u></h4></span><br>
                    <p><b> Hitting URL : </b> http://regtechapi.in/api/detection_face</p>
                    <b>Request Body : </b><br>
                    {<br>   
                    "file":"happy.jpg"</br>
                    }<br>
                    <b>Success Response : </b><br>
                      {<br>
                      "data": {<br>
                         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<br/>
                       },<br>
                     "statusCode": 200,<br>
                  }<br>
                </div>
               </div>
            </div>
        </div>
    </div>
    <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#image_scanner" data-toggle = "collapse">Image Scanner APIs</a>
        </div>
        <div class = "collapse" id = "image_scanner" data-parent = "#accordion">
            <div class = "card-body">
                <div class="row">
                    <div class = "col-md-4">
                        <span class = "badge badge-dark"><h3>Image Scanner API</h3></span>
                    </div>
                <div class = "col-md-6">
                    <span class = "badge badge-warning"><h4><u>Image Scanner</u></h4></span><br>
                    <p><b> Hitting URL : </b> http://regtechapi.in/api/image_scanner</p>
                    <b>Request Body : </b><br>
                    {<br>   
                    "file":"happy.jpg"</br>
                    }<br>
                    <b>Success Response : </b><br>
                      {<br>
                      "data": {<br>
                                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<br/>
                       },<br>
                     "statusCode": 200,<br>
                  }<br>
                </div>
               </div>
            </div>
        </div>
    </div>
    <!---ckycSearch Advance APIs-->
    <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#kycsearchAdvance" data-toggle = "collapse">ckycSearch Advance APIs</a>
        </div>
        <div class = "collapse" id = "kycsearchAdvance" data-parent = "#accordion">
            <div class = "card-body">
                <div class="row">
                    <div class = "col-md-4">
                        <span class = "badge badge-dark"><h3>ckycSearch Advance APIs</h3></span>
                    </div>
                <div class = "col-md-6">
                    <span class = "badge badge-warning"><h4><u>ckycSearch Advance APIs</u></h4></span><br>
                    <p><b> Hitting URL : </b>http://regtechapi.in/api/ckyc_searchadvance</p>
                    <b>Request Method : POST </b><br>
                    <b>Header : </b><br>
                    {<br>
                    "AccessToken":"xxxxxxxxxxxxx"<br>
                    }<br>
                    <b>Request Body : </b><br>
                    {<br>
                        "pano":HUHPS7607K,<br/>
                        "client_ref_num":7856,<br/>
                        "dob":12-02-1999,<br/>
                        "identifier_type":PAN<br/>
                    }<br>
                    <p><b>Success Response : </b><br>
                        [<br>
                        &nbsp;&nbsp;{<br>
                        &nbsp;&nbsp;"statusCode":200 {<br>
                        &nbsp;&nbsp;"response": {<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;"status": "VALID",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;"kycStatus":"null",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;"message":"Details downloaded successfully.",<br />
                        &nbsp;&nbsp;&nbsp;"kycDetails": {<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"personalIdentifiableData": {<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"personalDetails": {<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"constitution_type": "Individual",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"account_type": "Normal",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"ckyc_no": "60042994549621",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"prefix": "MR",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"firstName": "HARSHIT",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"lastName": "SINGH",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"fullName": "MR HARSHIT SINGH",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"maiden_prefix":null,<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"maiden_fname": null,<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"maiden_mname":null,<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"maiden_lname":null,<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"maiden_fullname":null,<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"father_or_spouse_flag":null,<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"father_prefix": "MR",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"father_fname": "Balram",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"father_mname":null,<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"father_lname": "Singh",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"father_fullname": "MR Balram Singh",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"mother_prefix": "MRS",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"mother_fname":"ANITA",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"mother_mname":null,<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"mother_lname": "SINGH",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"mother_fullname": "MRS ANITA  SINGH",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"mobNum": "9450367613",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"pan": "HUHPS7607K",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"email": "luckyharshit741@gmail.com",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"dob": "12-02-1999",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"age": "25",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"gender": "M",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"permLine1": "S/O: BALRAM SINGH,934,RAJENDRA NAGAR UTTARI",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"permLine2": "JATEPUR",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"perm_line3": "NEAR KRISHNA NAGAR",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"permCity": "Gorakhpur",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"permDist": "Gorakhpur",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"permState": "Uttar Pradesh",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "permPin": "273001",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "permCountry": "IN",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "permPoa": "E-KYC Authentication",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "perm_corres_sameflag": "Y",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"corresLine1": "S/O: BALRAM SINGH,934,RAJENDRA NAGAR UTTARI",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"corresLine2": "JATEPUR",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"corres_line3": "NEAR KRISHNA NAGAR",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"corresCity": "Gorakhpur",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        "corresDist": "Gorakhpur",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"corresState": "Uttar Pradesh",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"corresPin": "273001",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"corresCountry": "IN",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"corresPoa": "09",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"resi_std_code": "522",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"resi_tel_num": "7734945195",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"off_tel_num":null,<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"off_std_code": "0",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"remarks":null,<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"dec_date":"02-11-2023",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"dec_place":"Gorakhpur",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"doc_sub":"06",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"kyc_date":"********",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"kyc_name":"********",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"kyc_designation":"********",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"kyc_branch":"********",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"kyc_empcode":"********",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"org_name":"********",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"org_code":"********",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        "numIdentity": "1",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"numRelated": "0",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"numImages": "3",<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"related_person_details":null,<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"identity_details": {<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"identity":{<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"sequence_no": "1",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"ident_type": "H",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"ident_num": "XXXXXXXX4191",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"idver_status": "N",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;},<br>
    
                           <br>
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;},</br>
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"image_details": {<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"image": [<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"sequence_no": "1",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"image_type": "pdf",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"image_code": "PAN",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"global_flag": "Global",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"branch_code": "02",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"image_data":"JVBERi0xLjQNJeLjz9MNCjEgMCBv",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"image_url":"https:/ap-south-1amazonaws.com/digitap-ckyc"<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;},<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"sequence_no": "2",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"image_type": "JPG",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "image_code": "Photograph",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"global_flag": "Global",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"branch_code": "02",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"image_data":"/9j/4AAQSkZJRgABAQAAAQABAAD/",
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"image_url":"https://s3.ap-south-1.amazonaws.com/digitap-ckyc"
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;},
                           <br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"sequence_no": "3",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"image_type": "pdf",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "image_code": "Proof of Possession of Aadhaar",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"global_flag": "Global",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"branch_code": "02",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"image_data":"/9j/4AAQSkZJRgABAQAAAQABAAD/G",
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"image_url":"https://s3.ap-south-1.amazonaws.com/digitap-ckyc"
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;},<br>
                      
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;}<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;}<br />
                        ]<br>
                    </p>
                 </div>
               </div>
            </div>
        </div>
    </div>

    <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#landrecord" data-toggle = "collapse">Land Record API</a>
        </div>
        <div class = "collapse" id = "landrecord" data-parent = "#accordion">
            <div class = "card-body">
                <div class="row">
                    <div class = "col-md-4">
                        <span class = "badge badge-dark"><h3>Land Record API</h3></span>
                    </div>
                <div class = "col-md-6">
                    <span class = "badge badge-warning"><h4><u>Land Record</u></h4></span><br>
                    <p><b> Hitting URL : </b> http://regtechapi.in/api/land</p>
                    <b>Request Body : </b><br>
                    {<br>   
                    "Url":"https://bhunaksha.cg.nic.in/"</br>
                    "OP":4</br>
                    "GstStateCode":22</br>
                    "Levels":"55,01,01,058"</br>
                    "X_Coordinate":-1985.1836332116745</br>
                    "Y_Coordinate":3625.746517505414</br>
                    }<br>
                    <b>Success Response : </b><br>
                      {<br>
                    "data": {<br>
                         "ID": "j0V_En5ASJKhg-rScbanMA",<br/>
                         "PNIU": "null",<br/>
                         "attrs": "null",<br/>
                         "gisCode": 550101.058,<br/>
                         "has_data": "Y",<br/>
                         "info": "धारणाधिकार : शासकीय भूमि\nक्षेत्रफल : 97.6810 हेक्टेयर\nक्षेत्रफल(वर्ग फुट) : 10514295.0000\nसिंचित क्षेत्रफल : 0.0000\nअसिंचित क्षेत्रफल : 97.6810\n\nखसरा नंबर  : 3/1/क/1\n नाम  :छ .ग. शासन (राजस्व विभाग)\nपिता का नाम   : null\n पता  : \n\nशामिल खसरा : 3/1/द/2(0.0000 हेकॿटेयर), 3/1/द/3(0.0000 हेकॿटेयर), 3/1/द/3(0.0000 हेकॿटेयर),\n",<br/>
                         "pdf_base64": "+mscCzJkoqOlk+Vnpaeqd/hbWLgqqHiquO0frWxOrJ2fvd4v3lJ1QrRHJJXodim8mfeZh7st+1p9Cq2ubbETQTIUYjIToiFjwXECsRNE41aYVq0e3SAyYDMFsw7Pzs4/Lj8v7y9v728vny7PPs+v769vr2UXlPc5Nw0drQTmZLnK2ZwdK+HyocdoRyaXJl7P3k9v7ylaCM6fbc9Pzs+v729vryhI149Pvm+v7y+v7u9fzc5evP+P7i+v7q+v7m5ujc0dS93+LE+PnT/fym/v7i+vrg/v7m/v7q3NzK/v7u8/Pl/v7y/v72+vry/v76+vr29/W7/v3D/v3M/v3U9fTMxsWn/v3c8e2Rz8yV0c+t7uzJ9fTc+vnmw7xr2NF7/vi3s7CI3Nip7+u58+/D+vnq7u3gxsW6+vnu0Mh139aKv7qQ0s2kvLV9y8OI5N2r6OK29PPs+e6n7+Wn3NOb/fTC/vri59ubysKY/PTM3de46ePD/vrm1smU+vPW8+3S9+mz+OvF/PTc/vnq/vnu/vryU01C/fTj39zXs6+q/vr2qaGd083K/",<br/>
                         "plotInfoLinks": "<strong>Reports</strong> :<br><a target=\"bhumap\" href=\"22/plotreportCG.jsp?state=22&giscode=550101.058&plotno=3/1/क/1\"  >खसरा नक्शा</a><br /><a target=\"bhumap\" href=\"https://revenue.cg.nic.in/bhuiyanuser/User/Selection_Report_For_KhasraDetail.aspx?villno=550101.058&khasrano=3/1/क/1\"  >खसरा  विवरण</a><br />",<br/>
                         "xmin": "-2309.4335258031",<br/>
                         "ymin": "3280.217235246",<br/>
                         "xmax": "-1436.9552907749",<br/>
                         "ymax": "4306.862607357",<br/>
                         "plotNo": "3/1/क/1" <br/>  
                      },<br>
                  "statusCode": 200,<br>
                  }<br>
                 </div>
               </div>
            </div>
        </div>
    </div>
    <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#CommunityArea" data-toggle = "collapse">Community Area API</a>
        </div>
        <div class = "collapse" id = "CommunityArea" data-parent = "#accordion">
            <div class = "card-body">
                <div class="row">
                    <div class = "col-md-4">
                        <span class = "badge badge-dark"><h3>Community Area API</h3></span>
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
                 </div>
               </div>
            </div>
        </div>
    </div>
    <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#detectionemotion" data-toggle = "collapse">Detection Emotion API</a>
        </div>
        <div class = "collapse" id = "detectionemotion" data-parent = "#accordion">
            <div class = "card-body">
                <div class="row">
                    <div class = "col-md-4">
                        <span class = "badge badge-dark"><h3>Detection Emotion API</h3></span>
                    </div>
                <div class = "col-md-6">
                    <span class = "badge badge-warning"><h4><u>Detection Emotion</u></h4></span><br>
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
               </div>
            </div>
        </div>
    </div>

    <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#pincodeapi" data-toggle = "collapse">Pincode API</a>
        </div>
        <div class = "collapse" id = "pincodeapi" data-parent = "#accordion">
            <div class = "card-body">
                <div class="row">
                    <div class = "col-md-4">
                        <span class = "badge badge-dark"><h3>Pincode API</h3></span>
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
               </div>
            </div>
        </div>
    </div>

    <!--Address  Apis -->
       <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#addressapis" data-toggle = "collapse">Address APIs</a>
        </div>
        <div class = "collapse" id = "addressapis" data-parent = "#accordion">
            <div class = "card-body">
                <div class="row">
                    <div class = "col-md-4">
                        <span class = "badge badge-dark"><h3>Address APIs</h3></span>
                    </div>
                <div class = "col-md-6">
                    <span class = "badge badge-warning"><h4><u>Verify Address API</u></h4></span><br>
                    <p><b> Hitting URL:</b> http://regtechapi.in/api/verify_address</p>
                    <b>Request Method : POST </b><br>
                    <b>Header : </b><br>
                    {<br>
                    "AccessToken":"xxxxxxxxxxxxx"<br>
                    }<br>
                    <b>Request Body : </b><br>
                    {<br>
                        "address":"Kamal Baug Society, Wagholi,Pune, Maharashtra, 412207",<br/>
                    }<br>
                    <p><b>Success Response : </b><br>
                        [<br>
                        &nbsp;&nbsp;{<br>
                        &nbsp;&nbsp;"status_code":200,<br/>
                        &nbsp;&nbsp;"data": {<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;"input_address": "Kamal Baug Society, Wagholi,Pune, Maharashtra, 412207",<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;"match": "67 % matched",,<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;"verified_address": "Kamal Baug Society, Wagholi, Haveli, Pune, Maharashtra, 412207, IND",<br/>
                        &nbsp;&nbsp;}<br>
                        &nbsp;&nbsp;}<br/>
                        ]<br>
                    </p>
                    <br/>
                    <span class = "badge badge-warning"><h4><u>Get Place API</u></h4></span><br>
                    <p><b> Hitting URL </b>:http://regtechapi.in/api/get_place</p>
                    <b>Request Method : POST </b><br>
                    <b>Header : </b><br>
                    {<br>
                    "AccessToken":"xxxxxxxxxxxxx"<br>
                    }<br>
                    <b>Request Body : </b><br>
                    {<br>
                        "longitude":25.5647,<br/>
                        "latitude":83.9777,<br/>
                    }<br>
                    <p><b>Success Response : </b><br>
                        [<br>
                        &nbsp;&nbsp;{<br>
                        &nbsp;&nbsp;"status_code":200,<br/>
                        &nbsp;&nbsp;"data": [<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"label": "Arctic Ocean",<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"point": [
                                    25.5647,
                                    83.9777
                                ]
                                <br/>
                         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
                            <br>
                        &nbsp;&nbsp;]<br>
                        &nbsp;&nbsp;}<br/>
                        ]<br>
                    </p>
                    <br/>
                    <span class = "badge badge-warning"><h4><u>Create Geofence API</u></h4></span><br>
                    <p><b> Hitting URL </b>:http://regtechapi.in/api/create_geofence</p>
                    <b>Request Method : POST </b><br>
                    <b>Header : </b><br>
                    {<br>
                    "AccessToken":"xxxxxxxxxxxxx"<br>
                    }<br>
                    <b>Request Body : </b><br>
                    {<br>
                        "longitude":25.5647,<br/>
                        "latitude":83.9777,<br/>
                        "radius":100,<br/>
                    }<br>
                    <p><b>Success Response : </b><br>
                        [<br>
                        &nbsp;&nbsp;{<br>
                        &nbsp;&nbsp;"status_code":200,<br/>
                        &nbsp;&nbsp;"data":{<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;"CreateTime": "Thu, 28 Mar 2024 05:36:22 GMT",<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;"GeofenceId": "ee96ea7b-51ef-47e2-87a3-c1b0fb0c535a",<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;"UpdateTime": "Thu, 28 Mar 2024 05:36:22 GMT"<br/>
                        }<br>
                        &nbsp;}<br/>
                        ]<br>
                    </p>
                    <br/>
                    <span class = "badge badge-warning"><h4><u>Auto Complete API</u></h4></span><br>
                    <p><b> Hitting URL </b>:http://regtechapi.in/api/autocomplete</p>
                    <b>Request Method : POST </b><br>
                    <b>Header : </b><br>
                    {<br>
                    "AccessToken":"xxxxxxxxxxxxx"<br>
                    }<br>
                    <b>Request Body : </b><br>
                    {<br>
                        "text":"Wagholi",<br/>
                        "maxResult":15,<br/>
                    }<br>
                    <p><b>Success Response : </b><br>
                        [<br>
                        &nbsp;&nbsp;{<br>
                        &nbsp;&nbsp;"status_code":200,<br/>
                        &nbsp;&nbsp;"data":[<br>
                        &nbsp;&nbsp;&nbsp;{
                            &nbsp;&nbsp;&nbsp;"sn": 1, <br/>
                            &nbsp;&nbsp;&nbsp; "address": "Wagholi, Haveli, Pune, Maharashtra, IND" <br/>
                        &nbsp;&nbsp;&nbsp;},
                            <br/>
                            &nbsp;&nbsp;&nbsp;{
                                &nbsp;&nbsp;&nbsp;"sn": 2,<br>
                                &nbsp;&nbsp;&nbsp; "address": "Wagholi BK, Washim Sub-District, Washim, Maharashtra, IND"<br/>
                                &nbsp;&nbsp;&nbsp;},
                            <br/>
                            &nbsp;&nbsp;&nbsp;{
                                &nbsp;&nbsp;&nbsp; "sn": 3,<br>
                                &nbsp;&nbsp;&nbsp;"address": "Wagholi Gaon, Wagholi, Haveli, Pune, Maharashtra, IND"<br>
                                &nbsp;&nbsp;&nbsp;},
                            <br/>
                            &nbsp;&nbsp;&nbsp;{
                                &nbsp;&nbsp;&nbsp;"sn": 4,<br>
                                &nbsp;&nbsp;&nbsp;"address": "Wagholi Gaon-Burunjwadi, Wagholi, Haveli, Pune, Maharashtra, IND"<br>
                                &nbsp;&nbsp;&nbsp;},
                            <br/>
                            &nbsp;&nbsp;&nbsp;{
                                &nbsp;&nbsp;&nbsp; "sn": 5,<br>
                                &nbsp;&nbsp;&nbsp;"address": "Wagholi Siddharth Nagar, Wagholi, Haveli, Pune, Maharashtra, IND"<br>
                                &nbsp;&nbsp;&nbsp;},
                            <br/>
                            &nbsp;&nbsp;&nbsp;{
                                &nbsp;&nbsp;&nbsp;"sn": 6,<br>
                                &nbsp;&nbsp;&nbsp;"address": "Wagholi Gaon-Wagheshwar Nagar, Wagholi, Haveli, Pune, Maharashtra, IND"<br>
                                &nbsp;&nbsp;&nbsp;
                             },
                            <br/>
                            &nbsp;&nbsp;&nbsp;{
                                &nbsp;&nbsp;&nbsp;"sn": 7,<br>
                                &nbsp;&nbsp;&nbsp;"address": "Wagholi Gayran, Wagholi, Haveli, Pune, Maharashtra, IND"<br>
                                &nbsp;&nbsp;&nbsp;},
                            <br/>
                            &nbsp;&nbsp;&nbsp;{
                                &nbsp;&nbsp;&nbsp;"sn": 8,<br>
                                &nbsp;&nbsp;&nbsp;"address": "Wagholi KH, Washim Sub-District, Washim, Maharashtra, IND"<br>
                                &nbsp;&nbsp;&nbsp;},
                            <br/>
                            &nbsp;&nbsp;&nbsp;{
                                &nbsp;&nbsp;&nbsp;"sn": 9,<br>
                                &nbsp;&nbsp;&nbsp; "address": "Wagholi, Achalpur Sub-District, Amravati, Maharashtra, IND"<br>
                                &nbsp;&nbsp;&nbsp;},
                            <br/>
                            &nbsp;&nbsp;&nbsp;{
                                &nbsp;&nbsp;&nbsp;"sn": 10,<br>
                                &nbsp;&nbsp;&nbsp;"address": "Wagholi, Alibag Sub-District, Raigarh, Maharashtra, IND"<br>
                                &nbsp;&nbsp;&nbsp;},
                            <br/>
                            &nbsp;&nbsp;&nbsp;{
                                &nbsp;&nbsp;&nbsp;"sn": 11,<br>
                                &nbsp;&nbsp;&nbsp;"address": "Wagholi, Amravati Sub-District, Amravati, Maharashtra, IND"<br>
                                &nbsp;&nbsp;&nbsp;},
                            <br/>
                            &nbsp;&nbsp;&nbsp;{
                                &nbsp;&nbsp;&nbsp;"sn": 12,<br>
                                &nbsp;&nbsp;&nbsp;"address": "Wagholi, Ashti, Wardha, Maharashtra, IND"<br>
                            },
                            <br/>
                            &nbsp;&nbsp;&nbsp;{
                                &nbsp;&nbsp;&nbsp;"sn": 13,<br>
                                &nbsp;&nbsp;&nbsp;"address": "Wagholi, Ausa, Latur, Maharashtra, IND"<br>
                                &nbsp;&nbsp;&nbsp;}, 
                            <br/>
                            &nbsp;&nbsp;&nbsp;{
                                &nbsp;&nbsp;&nbsp;"sn": 14,<br>
                                &nbsp;&nbsp;&nbsp;"address": "Wagholi, Chakur, Latur, Maharashtra, IND"<br>
                                &nbsp;&nbsp;&nbsp;}, 
                            <br/>
                            &nbsp;&nbsp;&nbsp;{
                                &nbsp;&nbsp;&nbsp;"sn": 15,<br>
                                &nbsp;&nbsp;&nbsp;"address": "Wagholi, Deoli, Wardha, Maharashtra, IND"<br>
                                &nbsp;&nbsp;&nbsp;}
                            <br/>
                        ]<br>
                        &nbsp;}<br/>
                        ]<br>
                    </p>
                    <span class = "badge badge-warning"><h4><u>Get Coordinate API</u></h4></span><br>
                    <p><b> Hitting URL </b>:http://regtechapi.in/api/get_coordinate</p>
                    <b>Request Method : POST </b><br>
                    <b>Header : </b><br>
                    {<br>
                    "AccessToken":"xxxxxxxxxxxxx"<br>
                    }<br>
                    <b>Request Body : </b><br>
                    {<br>
                        "address":"Pune Municipal Corporation Building, Shivaji Nagar Road, Shivaji Nagar, Pune - 411005",<br/>
                    }<br>
                    <p><b>Success Response : </b><br>
                        {<br>
                        &nbsp;&nbsp;"status_code":200,<br/>
                        &nbsp;&nbsp;"data":[<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;{
                            &nbsp;&nbsp;&nbsp;&nbsp;"label": "Pune Municipal Corporation Bus Station, Shivaji Nagar, Pune, Maharashtra, 411005, IND",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;"point": [<br/>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;73.85362,<br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;18.52308<br>
                                &nbsp;&nbsp;&nbsp;&nbsp;],<br/>
                                &nbsp;&nbsp;&nbsp;&nbsp;"relevance": 0.8644<br/>
                             &nbsp;&nbsp;&nbsp;&nbsp;},<br/>
                             &nbsp;&nbsp;&nbsp;&nbsp;{<br/>
                                &nbsp;&nbsp;&nbsp;&nbsp;"label": "411005, Shivaji Nagar, Pune, Maharashtra, IND",<br/>
                                &nbsp;&nbsp;&nbsp;&nbsp;"point": [<br/>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;73.849710855391,<br/>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;18.530368214544<br/>
                                    &nbsp;&nbsp;&nbsp;&nbsp;],<br/>
                                    &nbsp;&nbsp;&nbsp;&nbsp; "relevance": 0.8514<br/>
                                  &nbsp;&nbsp;&nbsp;&nbsp;},<br/>
                                  &nbsp;&nbsp;&nbsp;&nbsp;{<br/>
                                    &nbsp;&nbsp;&nbsp;&nbsp;"label": "411005, Pune, Maharashtra, IND",<br/>
                                    &nbsp;&nbsp;&nbsp;&nbsp;"point": [<br/>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;73.852267565,<br/>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;18.529425<br/>
                                        &nbsp;&nbsp;&nbsp;&nbsp;],<br/>
                                        &nbsp;&nbsp;&nbsp;&nbsp; "relevance": 0.8369<br/>
                                      &nbsp;&nbsp;&nbsp;&nbsp;},<br/>
                             ]<br>
                        }<br>
                    </p>
                 </div>
               </div>
            </div>
        </div>
      </div>

      <div class = "card">
        <div class = "card-header">
            <a class = "card-link" href = "#bhunakshaApi" data-toggle = "collapse">Bhunaksha APIs</a>
        </div>
        <div class = "collapse" id = "bhunakshaApi" data-parent = "#accordion">
            <div class = "card-body">
                <div class="row">
                    <div class = "col-md-4">
                        <span class = "badge badge-dark"><h3>Bhunaksha APIs</h3></span>
                    </div>
                <div class = "col-md-6">
                    <span class = "badge badge-warning"><h4><u>GOA API</u></h4></span><br>
                    <p><b> Hitting URL : </b>http://regtechapi.in/bhunaksha</p>
                    <b>Request Method : POST </b><br>
                    <b>Request Body : </b><br>
                    {<br>   
                      "state":"goa"<br>
                      "District":" ",<br>
                      "Taluka":" ",<br>
                      "Village":" ",<br>
                      "Sheetno":" ",<br>
                      "Plotno":" "<br>
                    }<br>
            
                    <p><b>Success Response : </b><br>
                        [<br>
                            &nbsp;&nbsp;{<br>
                            &nbsp;&nbsp;"status_code":200,<br/>    
                            &nbsp;&nbsp;"data": {<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;"Giscode":"01,30010002,40113000,000VILLAGE",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;"Plotinfo":"Taluka Name : BARDEZ \n Village Name :Aldona \nSubdiv No :10\nOccupants Names: 1).Michael Jeremias Da Rocha 2).Denisa Espyie Da Rocha 3). Macberth Jude Simon Da Rocha 4).Malcolm Timothy Feleciano Da Rocha \nTotal Area:1600.00 sq.m.",<br/>    
                            &nbsp;&nbsp;&nbsp;&nbsp;"Plotno":"01,30010002,40113000,000VILLAGE",<br/>
                            &nbsp;&nbsp;&nbsp;}<br/>
                          }<br/> 
                        ]<br>
                    </p>
                    <br/>
                    <span class = "badge badge-warning"><h4><u>Odisha API</u></h4></span><br>
                    <p><b> Hitting URL : </b>http://regtechapi.in/bhunaksha</p>
                    <b>Request Method : POST </b><br>
                    <b>Request Body : </b><br>
                    {<br>   
                      "state":"odisha"<br>
                      "District":" ",<br>
                      "Tehsil":" ",<br>
                      "Ri":" ",<br>
                      "Village":" ",<br>
                      "Sheetno":" ",<br>
                      "Plotno":" "<br>
                    }<br>
            
                    <p><b>Success Response : </b><br>
                        [<br>
                            &nbsp;&nbsp;{<br>
                            &nbsp;&nbsp;"status_code":200,<br/>    
                            &nbsp;&nbsp;"data": {<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;"Giscode":"4,1,1,1,01",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;"Plotinfo":"ପୂର୍ବାଞ୍ଚଳ ରେଳ ବିଭାଗ ।\nରକବା  : 2.7 ଏକର୍  , 0 ହେକ୍ଟର  \n\n",<br/>    
                            &nbsp;&nbsp;&nbsp;&nbsp;"Plotno":"30",<br/>
                            &nbsp;&nbsp;&nbsp;}<br/>
                          }<br/> 
                        ]<br>
                    </p>
                    <br/>
                    <span class = "badge badge-warning"><h4><u>Rajasthan API</u></h4></span><br>
                    <p><b> Hitting URL : </b>http://regtechapi.in/bhunaksha</p>
                    <b>Request Method : POST </b><br>
                    <b>Request Body : </b><br>
                    {<br>   
                      "state":"rajasthan"<br>
                      "District":" ",<br>
                      "Tehsil":" ",<br>
                      "Ri":" ",<br>
                      "Halkas":" ",<br>
                      "Village":" ",<br>
                      "Sheetno":" ",<br>
                      "Plotno":" "<br>
                    }<br>
            
                    <p><b>Success Response : </b><br>
                        [<br>
                            &nbsp;&nbsp;{<br>
                            &nbsp;&nbsp;"status_code":200,<br/>    
                            &nbsp;&nbsp;"data": {<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;"Giscode":"01,002,0745,02920,11035,001",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;"Plotinfo":"क्षेत्रफल: 51.6100 Hectare\nखाता संख्या :624\n1.) वन विभाग हिस्सा- पूर्ण वन-विभाग",<br/>    
                            &nbsp;&nbsp;&nbsp;&nbsp;"Plotno":"2000",<br/>
                            &nbsp;&nbsp;&nbsp;}<br/>
                          }<br/> 
                        ]<br>
                    </p>
                     <br/>
                    <span class = "badge badge-warning"><h4><u>Jharkhand API</u></h4></span><br>
                    <p><b> Hitting URL : </b>http://regtechapi.in/bhunaksha</p>
                    <b>Request Method : POST </b><br>
                    <b>Request Body : </b><br>
                    {<br>   
                      "state":"jharkhand"<br>
                      "District":" ",<br>
                      "Circle":" ",<br>
                      "Halka":" ",<br>
                      "Sheetno":" ",<br>
                      "Plotno":" "<br>
                      "Mauza":" "<br>
                    }<br>
            
                    <p><b>Success Response : </b><br>
                        [<br>
                            &nbsp;&nbsp;{<br>
                            &nbsp;&nbsp;"status_code":200,<br/>    
                            &nbsp;&nbsp;"data": {<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;"Giscode":"02,02,02,0012,null",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;"Plotinfo":"खतियान :\nरजिस्टर 2 : \n क्षेत्रफल  : 1.0 एकड़ 20.0 डिसमील",<br/>    
                            &nbsp;&nbsp;&nbsp;&nbsp;"Plotno":"139",<br/>
                            &nbsp;&nbsp;&nbsp;}<br/>
                          }<br/> 
                        ]<br>
                    </p>
                    <br/>
                    <span class = "badge badge-warning"><h4><u>Kerala API</u></h4></span><br>
                    <p><b> Hitting URL : </b>http://regtechapi.in/bhunaksha</p>
                    <b>Request Method : POST </b><br>
                    <b>Request Body : </b><br>
                    {<br>   
                      "state":"kerala"<br>
                      "District":" ",<br>
                      "Taluk":" ",<br>
                      "Village":" ",<br>
                      "Blockno":" ",<br>
                      "Surveyno":" "<br>
                      "Subdivno":" "<br>
                    }<br>
            
                    <p><b>Success Response : </b><br>
                        [<br>
                            &nbsp;&nbsp;{<br>
                            &nbsp;&nbsp;"status_code":200,<br/>    
                            &nbsp;&nbsp;"data": {<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;"Giscode":"050507",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;"Plotinfo":{<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"Area_details":"Area : Hectare : 0, Are : 3, Square Metre:1",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"Owner_details":"1 : ഏലിയാമ്മ, പത്രോസ്‌ ഭാര്യ -\nകട്ടേത്ത്‌ പറമ്പില്‍ \n2 : പത്രോസ്‌യോഹന്നാന്‍,null -\nഇലഞ്ഞാടിയില്‍",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"Remark":"Area : Hectare : 0, Are : 3, Square Metre:1"<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;},<br/>    
                            &nbsp;&nbsp;&nbsp;&nbsp;"Plotno":"3"<br/>
                            &nbsp;&nbsp;&nbsp;}<br/>
                          }<br/> 
                        ]<br>
                    </p>
                    <br/>
                    <span class = "badge badge-warning"><h4><u>Lakshadweep API</u></h4></span><br>
                    <p><b> Hitting URL : </b>http://regtechapi.in/bhunaksha</p>
                    <b>Request Method : POST </b><br>
                    <b>Request Body : </b><br>
                    {<br>   
                      "state":"lakshadweep"<br>
                      "District":" ",<br>
                      "Taluk":" ",<br>
                      "Village":" ",<br>
                      "Survey":" ",<br>
                      "Plotno":" "<br>
                     }<br>
            
                    <p><b>Success Response : </b><br>
                        [<br>
                            &nbsp;&nbsp;{<br>
                            &nbsp;&nbsp;"status_code":200,<br/>    
                            &nbsp;&nbsp;"data": {<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;"Giscode":"01,05,015,30",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;"Plotinfo":"\nPlot no:30/3\nArea:26.80\n-------\n\nLandName: Vadak Pandaram\n\nOwner : Abdul Rahmankoya haji \nFamily Name: Pichiyath\nFather's Name: Nil\n\nOwner : Muthubi \nFamily Name: Nil\nFather's Name: Koyakidavkoya Pichiyath\n\nOwner : Sarifommabi \nFamily Name: Nil\nFather's Name: KoyakidavKoyaPichiyath\n\nOwner : Ayshabi \nFamily Name: Nil\nFather's Name: KoyakidavkoyaPichiyath\n",<br/>    
                            &nbsp;&nbsp;&nbsp;&nbsp;"Plotno":"30/3",<br/>
                            &nbsp;&nbsp;&nbsp;}<br/>
                          }<br/> 
                        ]<br>
                    </p>
            
                    <br/>
                    <span class = "badge badge-warning"><h4><u>Uttar Pradesh API</u></h4></span><br>
                    <p><b> Hitting URL : </b>http://regtechapi.in/bhunaksha</p>
                    <b>Request Method : POST </b><br>
                    <b>Request Body : </b><br>
                    {<br>   
                      "state":"up"<br>
                      "District":" ",<br>
                      "Tehsil":" ",<br>
                      "Village":" ",<br>
                      "Plotno":" "<br>
                     }<br>
            
                    <p><b>Success Response : </b><br>
                        [<br>
                            &nbsp;&nbsp;{<br>
                            &nbsp;&nbsp;"status_code":200,<br/>    
                            &nbsp;&nbsp;"data": {<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;"Giscode":"137,00730,117944",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;"Plotinfo":"खाता संख्या : 00039 खसरा संख्या:63 क्षेत्रफल(हे.) : 0.967 \n\nखातेदार का नाम :- 00039\n1 :- नाम :रामचन्द्र संरक्षक का नाम: मुरली सिह निवास स्थान:नि,भटपुरा सकेनिया",<br/>    
                            &nbsp;&nbsp;&nbsp;&nbsp;"Plotno":"63",<br/>
                            &nbsp;&nbsp;&nbsp;}<br/>
                          }<br/> 
                        ]<br>
                    </p>
            
                    <br/>
                    <span class = "badge badge-warning"><h4><u>Chhattisgarh API</u></h4></span><br>
                    <p><b> Hitting URL : </b>http://regtechapi.in/bhunaksha</p>
                    <b>Request Method : POST </b><br>
                    <b>Request Body : </b><br>
                    {<br>   
                      "state":"chhattisgarh"<br>
                      "District":"",<br>
                      "Tehsil":"",<br>
                      "Ri":" ",<br>
                      "Village":"",<br>
                      "Plotno":" "<br>
                     }<br>
            
                    <p><b>Success Response : </b><br>
                        [<br>
                            &nbsp;&nbsp;{<br>
                            &nbsp;&nbsp;"status_code":200,<br/>    
                            &nbsp;&nbsp;"data": {<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;"Giscode":"46,04,01,032",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;"Plotinfo":"धारणाधिकार : शासकीय भूमि\nक्षेत्रफल : 2.0000 हेक्टेयर\nसिंचित क्षेत्रफल : 2.0000\nअसिंचित क्षेत्रफल: 0.0000\n\nखसरा नंबर: 23\n नाम:शासकीय भूमि\nपिता का नाम : null\n पता :\n\n",<br/>    
                            &nbsp;&nbsp;&nbsp;&nbsp;"Plotno":"23",<br/>
                            &nbsp;&nbsp;&nbsp;}<br/>
                          }<br/> 
                        ]<br>
                    </p>
            
                    <br/>
                    <span class = "badge badge-warning"><h4><u>Bihar API</u></h4></span><br>
                    <p><b> Hitting URL : </b>http://regtechapi.in/bhunaksha</p>
                    <b>Request Method : POST </b><br>
                    <b>Request Body : </b><br>
                    {<br>   
                      "state":"bihar"<br>
                      "District":"",<br>
                      "Subdiv":"",<br>
                      "Circle":"",<br>
                      "Mauza":" ",<br>
                      "Surveytype":" ",<br>
                      "Mapinstance":" ",<br>
                      "sheetno":"",<br>
                      "Plotno":" "<br>
                     }<br>
            
                    <p><b>Success Response : </b><br>
                        [<br>
                            &nbsp;&nbsp;{<br>
                            &nbsp;&nbsp;"status_code":200,<br/>    
                            &nbsp;&nbsp;"data": {<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;"Giscode":"07,01,04,0338,CS,06,00",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;"Plotinfo":"रकवा: 2.000 एकड़0.000 डिसमिल \n\nखेसरा नंबर: 37\nरैयत का नाम :सदानंद राय \nपिता/पति नाम : रव्वी राय\nजाति : \nनिवास स्थान : आमगछि टोला कुरमी null\n\nखेत चौहदी :\nपु.-\nप.-\nउ.-निज\nद.-मोo वोची\n\nलगान :\nभूमि का वर्गीकरण :",<br/>    
                            &nbsp;&nbsp;&nbsp;&nbsp;"Plotno":"37",<br/>
                            &nbsp;&nbsp;&nbsp;}<br/>
                          }<br/> 
                        ]<br>
                    </p>
                 </div>
               </div>
            </div>
        </div>
      </div>
</div>  
@stop


@section('custom_js')
@stop