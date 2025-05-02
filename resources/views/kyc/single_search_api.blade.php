@extends('adminlte::page')

@section('title', 'Search APIs')

@section('content_header')
  
@stop
@section('content')
<div class= "container">
    <div class ="col-md">
        <a style = "color: white;"class = "btn btn-primary float-right" onclick="history.back()" role = "button">Back</a>
    </div>
    <div class="row">
      <div class = "col-md-4">
        <span class = "badge badge-dark"><h3>RC APIs</h3></span>
      </div>
      <div class = "col-md">
        <span class = "badge badge-warning"><h4><u>RC Verification</u></h4></span><br>
        <p><b> Hitting URL : </b>http://regtechapi.in/api/seachv4</p>
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
        <span class = "badge badge-warning"><h4><u>RC Verification Lite</u></h4></span><br>
        <p><b> Hitting URL : </b> http://regtechapi.in/api/seachv4</p>
        <b>Header : </b><br>
        {<br>   
        "AccessToken":"xxxxxxxxxxxxx"<br>
        }<br>
        <b>Request Body : </b><br>
        {<br>   
        "Rc_Number":"MH17BE1013"<br>
        }<br>
        <p><b>Success Response : </b><br>
            [<br>
                
            &nbsp;&nbsp;&nbsp;{<br>
            &nbsp;&nbsp;&nbsp;"rc_validation": {<br> &nbsp;&nbsp;&nbsp;"data": {<br>
            &nbsp;&nbsp;&nbsp;"rc_number": "MH17BE1013",<br>
            &nbsp;&nbsp;&nbsp;"registration_date": "9/2014",<br>
            &nbsp;&nbsp;&nbsp;"owner_name": "P**I** L**X** M**H**",<br>
            &nbsp;&nbsp;&nbsp;"vehicle_category": "",<br>
            &nbsp;&nbsp;&nbsp;"fuel_type": "PETROL",<br>
            &nbsp;&nbsp;&nbsp;"fit_up_to": "2029-11-12",<br>
            &nbsp;&nbsp;&nbsp;"insurance_upto": "2017-05-02",<br> 
            &nbsp;&nbsp;&nbsp;"registered_at": "SRIRAMPUR, Maharashtra", "latest_by": null,<br>   
            &nbsp;&nbsp;&nbsp;"pucc_upto": null,<br>
            &nbsp;&nbsp;&nbsp;},<br>
            &nbsp;&nbsp;&nbsp;"status_code": 200, "success": true, "message": null,<br>
            &nbsp;&nbsp;&nbsp;"message_code": "success"<br>
            &nbsp;&nbsp;&nbsp;},<br>
            &nbsp;&nbsp;&nbsp;"statusCode": null<br>
            &nbsp;&nbsp;&nbsp;}<br>
            &nbsp;&nbsp;]<br>
        </p>
      </div>
    </div>
    <div class="row mt-2">
        <div class = "col-md-4">
            <span class = "badge badge-dark">
                <h3>Voter ID APIs</h3>
            </span>
        </div>
        <div class = "col-md-6">
           <span class = "badge badge-warning">
                <h4><u>Voter ID Verification</u></h4>
            </span><br>
            <p><b> Hitting URL : </b>http://regtechapi.in/api/seachv4</p>
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
              <span class = "badge badge-warning"><h4><u>VoterId OCR</u></h4></span><br>
              <p><b> Hitting URL : </b>http://regtechapi.in/api/seachv4</p>
              <b>Header : </b><br>
              {<br>   
              "AccessToken":"xxxxxxxxxxxxx"<br>
              }<br>
              <b>Request Body : </b><br>
              {<br>   
              "file":image_file<br>
              "file_type":voterid<br>
              }<br>
              <b>Success Response : </b><br>
              {<br/>
                  "status_code": 200,<br/>
                  "voterid": {<br/> &nbsp;&nbsp;&nbsp;
                      "name": "PREM RAJ THAKUR",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      "raw_ocr_texts": [<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          "ELECTION COMMISSION OF INDIA",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          "added sict ELECTOR PHOTO IDENTITY CARD",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          "GDN0225185",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          "Raleth anT 714 : 44 TIT oligit",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          "ELECTOR'S NAME : PREM RAJ THAKUR",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          "14dl and HIH",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          ": 1972 ca dight",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          "FATHER'S NAME : KISHAN DEV THAKUR",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          "FIT / Sex",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          ": you / Male",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          "WITH at",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          "DATE OF BIRTH/AGE :",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          "15/02/1985"<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      ],<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      "voter_id_number": "GDN0225185"<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  }<br/>
             } &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><br/>
             <span class = "badge badge-warning"><h4><u>Voter ID Upload</u></h4></span><br>
             <p><b> Hitting URL : </b>http://regtechapi.in/api/seachv4</p>
             <b>Request form-data : </b><br>
             voterid_file – voter id image file<br>
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
    <!--SearchKyclite Start-->
    <div class="row mt-2">
        <div class = "col-md-4">
            <span class = "badge badge-dark">
                <h3>SearchKyc APIs</h3>
            </span>
        </div>
        <div class = "col-md-6">
           <span class = "badge badge-warning">
                <h4><u>SearchKyclite</u></h4>
            </span><br>
            <p><b> Hitting URL :</b>http://regtechapi.in/api/seachv4 </p>
            <b>Header : </b><br>
            {<br>   
            "AccessToken":"xxxxxxxxxxxxx"<br>
            }<br>
            <b>Request Body : </b><br>
            {<br>   
            "pano":"CDEPD3027M"<br>
            "dob":"1996-09-03"<br>
            }<br>
           
    
            <p><b>Success Response : </b><br>
                [<br>
                    &nbsp;&nbsp;{<br>
                    &nbsp;&nbsp;"statusCode":200,<br/>    
                    &nbsp;&nbsp;"response": {<br>
                    &nbsp;&nbsp;"kycStatus": 200,<br/>
                    &nbsp;&nbsp;"message": "Details downloaded successfully",<br/>
                    &nbsp;&nbsp;"success":true,<br/>
                    &nbsp;&nbsp;"kycDetails":{<br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"personalIdentifiableData":{<br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"personalDetails":{<br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"pan": "AOXPK6831J",<br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"maskedAadhaar": "XXXXXXXX7179",",<br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"lastFourDigit": "7179",<br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"typeOfHolder": "Individual or Person",<br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"fullName": "PANKAJ MAHADEO KHARALKAR",
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"firstName": "PANKAJ",<br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"lastName": "KHARALKAR",<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"mobNum": "9867151413",<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"email": "pankaj21in@gmail.com",<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"dob": "19/06/1980",<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"gender": "M",<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"address": "1005, Niraj park",<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"city": "Kalyan City H.O",<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"state": "Maharashtra",<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"country": "INDIA",<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"pincode": "421301"<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;} <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}
                    <br/>
                    &nbsp;&nbsp;}
                <br/>
            ]
            </p>
    
    
        </div>
    </div>
    <!--SearchKyclite End-->
    <div class="row mt-2">
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
  
          "client_id": "@{clientid}",<br>
          "otp_aadhar": "@{otp_aadhar}"<br>
  
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
          "profile_image": "/9j/4AAQSkZJRgABAgAAAQABAAD/2wBDAAgtCep//Z",<br>
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
      <span class = "badge badge-warning"><h4><u>Aadhar Card OCR</u></h4></span><br>
      <p><b> Hitting URL : </b>http://regtechapi.in/api/seachv4</p>
      <b>Header : </b><br>
      {<br>   
      "AccessToken":"xxxxxxxxxxxxx"<br>
      }<br>
      <b>Request Body : </b><br>
      {<br>   
      "file":image file<br>
      "file_type":aadharcard<br>
      }<br>
      <b>Success Response : </b><br>
      {<br/>
        "status_code": 200,
        "aadharcard": {<br/> &nbsp;&nbsp;&nbsp;
            "aadhar_number": "781437028915",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            "date_of_birth": "24/03/2002",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            "gender": "Female",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            "name": "Hitashri Tushar Patil",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            "raw_ocr_texts": [<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "&",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "- ETGIC",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "3110549",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "HRd HRONK",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "Unique Identification Authority of India",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "Government of India",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "attain water / Enrollment No. : 2006/18015/49027",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "To",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "Hitashri Tushar Patil",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "first and HIGH",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "STATION RAOD",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "S.T. BUS STHANAK SAMOR",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "Shindkheda",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "Dhule",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "Maharashtra - 425406",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "9421616385",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "KA581754631FH",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "58176463",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "3114cm shell / Your Aadhaar No. :",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "7814 3702 8915",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                ", 3110059",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "X",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "HRE HOR",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "Government of India",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "from and TRIN",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "Hitashri Tushar Patil",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "and afte/DOB: 24/03/2002",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "Fill Female",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "7814 3702 8915",<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                "Hold"<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            ]<br/>
        }<br/>
    
    }<br/>
     }&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><br/>

           <!---Mask Aadhar Card.--->
           <span class = "badge badge-warning"><h4><u>Aadhar Card Mask</u></h4></span><br>
           <p><b> Hitting URL : </b>http://regtechapi.in/api/seachv4</p>
           <b>Header : </b><br>
           {<br>   
           "AccessToken":"xxxxxxxxxxxxx"<br>
           }<br>
           <b>Request Body : </b><br>
           {<br>   
           "file":image file<br>
           "file_type":aadhar_card<br>
           }<br>
           <b>Success Response : </b><br>
               {<br/>
                   "status_code": 200,<br/>
                   "aadharcard": {<br/>
                       "data":"ll"
                       "success":true <br/>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br/>
               }<br>

     </div>
     </div>
     <div class="row mt-2">
            <div class="col-md-4">
                <span class = "badge badge-dark"><h3>Driving License APIs</h3></span>
            </div>
            <div class="col-md">
                <span class = "badge badge-warning"><h4><u>DL Verification</u></h4></span><br>
                <p><b> Hitting URL : </b>http://regtechapi.in/api/seachv4</p>
                <b>Request Body : </b><br>
                {<br>   
                "license_number":"UP20 20150000000"<br>
                "dob":"DD/MM/YYYY"<br>
                }<br>
                <b>Success Response : </b><br>
                   {<br>
                "data":{<br>
                "license_number": "MH1220180035461",<br>
                "dob": "16-09-1976",<br>
                "name": "RAJESH KUMAR BHASKAR",<br>
                "father_or_husband_name": "SARDAWAL RAM BHASKAR",<br>
                "blood_group": "B+",<br>
                "profile_image": "data:image/png;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/",<br>
                "permanent_address": "S N0-45/3 ASTVINAYAK NAGAR  SADGURU SOC DATTA MANDIR CHANDAN NAGAR KHARDI ROAD  PUNE  411014",<br>
                "state": "MAHARASHTRA",<br>
                "district": "PUNE",<br>
                "permanent_zip": 411014,<br>
                "country": "",<br>
                "type": "NA",<br>
                "non_transport_doi": "",<br>
                "non_transport_doe": false,<br>
                "transport_doi": "14-08-2018",<br>
                "transport_doe": "13-08-2021",<br>
                "ola_code": "MH12",<br>
                "cov": "LMV-TR",<br>
                "issue_date": "14-08-2018"<br>
            },<br>
            "status_code": 200,<br>
             }<br>
             <span class = "badge badge-warning"><h4><u>Driving License OCR</u></h4></span><br>
             <p><b> Hitting URL : </b>http://regtechapi.in/api/seachv4</p>
             <b>Header : </b><br>
             {<br>   
             "AccessToken":"xxxxxxxxxxxxx"<br>
             }<br>
             <b>Request Body : </b><br>
             {<br>   
             "file":image_file<br>
             "file_type":drivinglicense<br>
             }<br>
             <b>Success Response : </b><br>
             {<br/>
                "status_code": 200,<br/>
                "driving_license": {<br/> &nbsp;&nbsp;&nbsp;
                    "birth_date": "01-12-1987",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    "dl_no": "MH03 20080022135",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    "expiry_date": "23-01-2027",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    "name": "",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    "raw_ocr_texts": [<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        "THE UNION OF INDIA",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        "MAHARASHTRA STATE MOTOR DRIVING LICENCE",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        "DL No MH03 20080022135",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        "DOI : 24-01-2007",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        "- was",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        "Valid Till : 23-01-2027 (NT)",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        "09-03-2011 (TR)",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        "AED 15-03-2008",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        "FORM 7",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        "AUTHORISATION TO DRIVE FOLLOWING CLASS",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        "RULE 16 (2)",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        "OF VEHICLES THROUGHOUT INDIA",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        "COV",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        "DOI",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        "MCWG",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        "24-01-2007",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        "LMV 24-01-2007",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        "TRANS 10-03-2008",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        "DOB : 01-12-1987",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        "BG",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        "Name",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        "BABU KHAN",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        "S/D/W of JABBAR KHAN",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        "Add KAMLA RAMAN NAGAR, BAIGANWADI,",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        "R",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        "GOVANDI, MUMBAI.",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        "PIN 400043",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        "ABUKHAN",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        "Signature & ID of",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        "Signature/Thumb",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        "Issuing Authority MH03 2008261",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        "Impression of Holder"<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    ]<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                }<br/>
            }&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
               <!-- DL Upload -->
         <span class = "badge badge-warning"><h4><u>DL Upload</u></h4></span><br>
          <p><b> Hitting URL : </b>http://regtechapi.in/api/seachv4</p>
           <b>Request form-data : </b><br>
         dl_front – driving license front image file<br>
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
     <br/>
     <div class="row mt-2">
        <div class="col-md-4">
            <span class = "badge badge-dark"><h3>Udyam Search</h3></span>
        </div>
        <div class="col-md-6">
            <span class = "badge badge-warning"><h4><u>Udyam Search</u></h4></span><br>
            <p><b> Hitting URL : </b> http://regtechapi.in/api/seachv4</p>
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
            <br/>
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
    <div class="row mt-2">
        <div class="col-md-4">
            <span class = "badge badge-dark"><h3>Udyog Aadhar</h3></span>
        </div>
        <div class="col-md-6">
            <span class = "badge badge-warning"><h4><u>Udyog Aadhar</u></h4></span><br>
            <p><b> Hitting URL : </b> http://regtechapi.in/api/seachv4</p>
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
                    "statusCode":200<br>
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
    <br/>
    <div class="row mt-2">
        <div class="col-md-4">
            <span class = "badge badge-dark"><h3>UPI Validation APIs</h3></span>
        </div>
        <div class="col-md-6">
            <span class="badge badge-warning"><h4><u>UPI Validation</u></h4></span><br>
                <p><b> Hitting URL :</b>http://regtechapi.in/api/seachv4</p>
                <b>Header : </b><br>
                {<br>
                "AccessToken":"xxxxxxxxxxxxx"<br>
                }<br>
                <b>Request Body : </b><br>
                {<br>
                "name":"{name}"<br>
                "upi_id":"{upi_id}"<br>
                "order_id":"{order_id}"<br>
                }<br>
               <p> <b>Success Response :</b><br>
                {<br>
                "data": {<br>
                    "upi":null,<br>
                    "orderId":"",<br>
                    "account_details": {<br>
                    "account_status": "ACTIVE",<br>
                    "beneficiary_name": "RAKESH KUMAR",<br>
                    "beneficiary_vpa": "rakeshkumar942@ybl"<br>
                    },<br>
                    "mode": "UPI_VALIDATE",<br>
                    "utr": "NA",<br>
                    "amount": "0.00",<br>
                    "commission": "0.00",<br>
                    "charge": "0.00",<br>
                    "tax": "0.00",<br>
                    "created_at": 1699245624 <br>
                    },<br>
                    "statusCode": 200 <br>
                }
               </p>
               <br>                
       </div>
    </div> 
    <div class="row mt-2">
    <div class="col-md-4">
        <span class = "badge badge-dark"><h3>Pan card APIs</h3></span>
    </div>
    <div class="col-md-6">
        <span class="badge badge-warning"><h4><u>Pan Card OCR</u></h4></span><br>
              <p><b> Hitting URL :</b>http://regtechapi.in/api/seachv4</p>
                <b>Header : </b><br>
                    {<br>   
                    "AccessToken":"xxxxxxxxxxxxx"<br>
                    }<br>
                    <b>Request Body : </b><br>
                    {<br>   
                     "file":image_file<br>
                     "file_type":pancard<br>
                    }<br>
                    <b>Success Response : </b><br>
                    {<br>
                        "status_code": 200,<br/>
                        "pancard": {<br/> &nbsp;&nbsp;&nbsp;
                                  "date_of_birth": "10/09/2001",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  "name": "SELHUVO LOHE",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  "pan_number": "BFAPL9762A",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  "raw_ocr_texts": [<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                     "37121052 FORHIST",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                     "HRR TROOK",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                     "INCOME TAX DEPARTMENT",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                     "GOVT. OF INDIA",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                     "and",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                     "Ferreit This",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                     "Permanent Account Number Card",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                     "BFAPL9762A",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                     "714 / Name",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                     "SELHUVO LOHE",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                     "furt 314 / Father's Name",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                     "CHINEYI LOHE",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                     "16012020",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                     "arial",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                     "Date of Birth",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                     "3.Lone",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                     "10/09/2001",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                     "/ Signature"<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                 ]<br/>
                       }&nbsp;&nbsp;&nbsp;<br/>
                     
                 } &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
                   </p>  
                   
                    <span class = "badge badge-warning"><h4><u>PAN  Verification</u></h4></span><br>
                    <p><b> Hitting URL : </b> http://regtechapi.in/api/seachv4</p>
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
                    <span class = "badge badge-warning"><h4><u>PAN Info</u></h4></span><br>
                    <p><b> Hitting URL : </b> http://regtechapi.in/api/seachv4</p>
                    <b>Header : </b><br>
                    {<br>   
                    "AccessToken":"xxxxxxxxxxxxx"<br>
                    }<br>
                    <b>Request Body : </b><br>
                    {<br>   
                    "pancard_num":"BPZPM1894M"<br>
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
                    <p><b> Hitting URL : </b> http://regtechapi.in/api/seachv4</p>
                    <b>Header : </b><br>
                    {<br>   
                    "AccessToken":"xxxxxxxxxxxxx"<br>
                    }<br>
                    <b>Request Body : </b><br>
                    {<br>   
                    "pancardNo":"BPZPM1894M"<br>
                    }<br>
            
                    <p><b>Success Response : </b><br>
                        {
                            "pancard": {
                                "data": {
                                    "client_id": null,
                                    "transactionId": "13ec5510-f41b-4e9d-8e9c-adeffcb62fec",
                                    "panNumber": "AOWPC4453K",
                                    "maskedAadhar": "XXXXXXXX0473",
                                    "lastFourDigitAadhar": "0473",
                                    "typeOfHolder": "Individual or Person",
                                    "name": "LOKESH  CHAUDHARY",
                                    "firstName": "LOKESH",
                                    "middleName": "",
                                    "lastName": "CHAUDHARY",
                                    "gender": "M",
                                    "dob": "28/08/1989",
                                    "address": "Villa - 03 Bestech Park View Ananda, Sector - 81 Sikanderpur B.O Badha(113) GURGAON 122004 Haryana",
                                    "city": "GURGAON",
                                    "state": "Haryana",
                                    "country": "INDIA",
                                    "pincode": "122004",
                                    "mobile_no": "9930906840",
                                    "email": "chaudhary.lokesh@gmail.com",
                                    "isValid": true,
                                    "aadhaarSeedingStatus": true,
                                    "serviceCode": null
                                }
                            },
                            "status_code": 200,
                            "success": true,
                            "message_code": "success"
                        }
                    </p>
                    <span class = "badge badge-warning"><h4><u>PAN TO GST</u></h4></span><br>
                    <p><b> Hitting URL : </b>http://regtechapi.in/api/seachv4</p>
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
                    <span class = "badge badge-warning"><h4><u>PAN CARD</u></h4></span><br>
                    <p><b> Hitting URL : </b>http://regtechapi.in/api/seachv4</p>
                    <p><b>Request Method : POST</b></p>
                    <p><b>Header</b> :{<br/>
                      "AccessToken":"xxxxxxxxxxxxx"<br/>
                    }
                    </p>
                    <p>
                    <b>Request Body</b> :{<br/>
                      "pan_no":""<br/>
                      }<br/>
                    </p>
                    <p><b>Success Response : </b><br>
                        {<br/>
                            &nbsp;&nbsp; "pancard": {<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "data": {<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"client_id": null,<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"transactionId": "978de36f-6fe2-4092-bf3b-63d5c53f7bb9",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"panNumber": "AAJCC5200A",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "maskedAadhar": "",,<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "lastFourDigitAadhar": "",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"typeOfHolder": "Company",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "name": "CRACIONS DIGITAL TECHNOLOGIES PRIVATE LIMITED",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"firstName": "",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"middleName": "",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"lastName": "",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"gender": null,<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "dob": "02/06/2021",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"address": "B-24 MAHENDRA ENCLAVE Ghaziabad H.O Uttar Pradesh",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "city": "GHAZIABAD",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"state": "Uttar Pradesh",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"country": "INDIA",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"pincode": "201001",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"mobile_no": "9930906840",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"email": "lokesh@kyckart.com",<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"isValid": true,<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "aadhaarSeedingStatus": false,<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"serviceCode": null<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}<br/>
                            },<br/>
                            &nbsp;&nbsp;"status_code": 200,<br/>
                            &nbsp;&nbsp;"success": true,<br/>
                            &nbsp;&nbsp;"message_code": "success"<br/>
                        } 
                          
                    </p>
                    <span class = "badge badge-warning"><h4><u>PAN Verification</u></h4></span><br>
                    <p><b> Hitting URL : </b> http://regtechapi.in/api/seachv4</p>
                    <b>Header : </b><br>
                    {<br>   
                    "AccessToken":"xxxxxxxxxxxxx"<br>
                    }<br>
                    <b>Request Body : </b><br>
                    {<br>   
                    "pan_number":"ARTPB4748P"<br>,
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
            <span class = "badge badge-warning"><h4><u>PAN Info</u></h4></span><br>
            <p><b> Hitting URL : </b> http://regtechapi.in/api/seachv4</p>
        <b>Header : </b><br>
        {<br>   
        "AccessToken":"xxxxxxxxxxxxx"<br>
        }<br>
        <b>Request Body : </b><br>
        {<br>   
        "pan_number":"AOWPC4453K"<br>,
        }<br>

        <p><b>Success Response : </b><br>
            [<br>
                &nbsp;&nbsp;{<br>
                &nbsp;&nbsp;"pancard":  {<br>
                &nbsp;&nbsp;"data": {<br>
                &nbsp;&nbsp;"panNumber":"AOWPC4453K",<br> &nbsp;&nbsp;"fullName":"LOKESH ",<br> &nbsp;&nbsp;"isValid":"true",<br> &nbsp;&nbsp;"firstName":"LOKESH",<br> &nbsp;&nbsp;"middleName":"LAXMAN",<br> &nbsp;&nbsp;"lastName":"CHAUDHARY",<br> &nbsp;&nbsp;"title":"Shri",<br> &nbsp;&nbsp;"panStatusCode":"E",<br> &nbsp;&nbsp;"panStatus":"Valid",<br> &nbsp;&nbsp;"aadhaarSeedingStatus":"Aadhaar seeding is Successful",<br> &nbsp;&nbsp;"aadhaarSeedingStatusCode":"Y",<br> &nbsp;&nbsp;"lastUpdatedOn":"18/08/2017",<br>
                &nbsp;&nbsp;&nbsp;&nbsp;}<br>
                &nbsp;&nbsp;"status_code":200<br>
                &nbsp;&nbsp;}<br>



                &nbsp;&nbsp;}<br>
            ]<br>
        </p>
        <span class = "badge badge-warning"><h4><u>PAN Card Details</u></h4></span><br>
        <p><b> Hitting URL : </b> http://regtechapi.in/api/seachv4</p>
        <b>Header : </b><br>
        {<br>   
        "AccessToken":"xxxxxxxxxxxxx"<br>
        }<br>
        <b>Request Body : </b><br>
        {<br>   
        "pan_no":"BPZPM1894M"<br>,
        "dob":"1989-08-28"
        }<br>

        <p><b>Success Response : </b><br>
            [<br>
            {
                "pancard": {<br/>
                    "data": {<br/>
                        "client_id": null,<br/>
                        "transactionId": "e0de4277-1215-4219-9676-e85c15c35b6a",<br/>
                        "panNumber": "AOWPC4453K",<br/>
                        "maskedAadhar": "XXXXXXXX0473",<br/>
                        "lastFourDigitAadhar": "0473",<br/>
                        "typeOfHolder": "Individual or Person",<br/>
                        "name": "LOKESH  CHAUDHARY",<br/>
                        "firstName": "LOKESH",<br/>
                        "middleName": "",<br/>
                        "lastName": "CHAUDHARY",<br/>
                        "gender": "M",<br/>
                        "dob": "28/08/1989",<br/>
                        "address": "Villa - 03 Bestech Park View Ananda, Sector - 81 Sikanderpur B.O Badha(113) GURGAON 122004 Haryana",<br/>
                        "city": "GURGAON",<br/>
                        "state": "Haryana",<br/>
                        "country": "INDIA",<br/>
                        "pincode": "122004",<br/>
                        "mobile_no": "9930906840",<br/>
                        "email": "chaudhary.lokesh@gmail.com",<br/>
                        "isValid": true,<br/>
                        "aadhaarSeedingStatus": true,<br/>
                        "serviceCode": null<br/>
                    }<br/>
                },<br/>
                "status_code": 200,<br/>
                "success": true,<br/>
                "message_code": "success"<br/>
            }
            ]<br>
        </p>
        <span class = "badge badge-warning"><h4><u>By PAN Card</u></h4></span><br>
        <p><b> Hitting URL : </b> http://regtechapi.in/api/seachv4</p>
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
            
     </div>
    </div>
    <div class="row mt-2">
    <div class="col-md-4">
        <span class = "badge badge-dark"><h3>GSTIN APIs</h3></span>
    </div>
    <div class="col-md-6">
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
      <span class = "badge badge-warning"><h4><u>GSTIN Details</u></h4></span><br>
      <p><b> Hitting URL : </b> http://regtechapi.in/api/seachv4</p>
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
             
     </div>
     </div>
    <div class="row mt-2">
        <div class="col-md-4">
            <span class = "badge badge-dark"><h3>Passport APIs</h3></span>
        </div>
        <div class="col-md-6">
            <span class = "badge badge-warning"><h4><u>Passport OCR</u></h4></span><br>
            <p><b> Hitting URL : </b>http://regtechapi.in/api/seachv4</p>
            <b>Header : </b><br>
            {<br>   
            "AccessToken":"xxxxxxxxxxxxx"<br>
            }<br>
            <b>Request Body : </b><br>
            {<br>   
            "file":passport_image_file<br>
            "file_type":passport<br>
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


               <span class = "badge badge-warning"><h4><u>Passport Verification</u></h4></span><br>
               <p><b> Hitting URL : </b>http://regtechapi.in/api/seachv4</p>
               <b>Header : </b><br>
               {<br>   
               "AccessToken":"xxxxxxxxxxxxx"<br>
               }<br>
               <b>Request Body : </b><br>
               {<br>   
                "id_number":BO3068432472415,<br/>
                 "Date_Of_Birth":08/06/1983,<br/>     
               }<br>
               <b>Success Response : </b><br>
                   {<br/>
                       "status_code": 200,<br/>
                       "response": {<br/>
                        "code": 200,<br/>
                        "fileNumber": "BO3068432472415",<br/>
                        "givenName": "LATISH BHAILAL",<br/>
                        "surname": "SOLANKI",<br/>
                        "typeOfApplication": "NORMAL",<br/>
                        "applicationReceivedOnDate": "28/01/2015",<br/>
                        "name": "LATISH BHAILAL SOLANKI",<br/>
                        "dob": "08/06/1983"<br/>
                    }<br/>
                     }<br/>
                    <span class = "badge badge-warning"><h4><u>Passport Create Client</u></h4></span><br>
                    <p><b> Hitting URL : </b> http://regtechapi.in/api/seachv4</p>
                    <b>Request Method : POST </b><br>
                    {<br>   
                        "idNumber":BO3068432472415,<br/>     
                       }<br>
                    <p><b>Success Response : </b><br>
                    &nbsp;&nbsp;{<br>
                    &nbsp;&nbsp;"data": {<br>
                    &nbsp;&nbsp;"client_id": "takdTqhCxo"<br>
                    &nbsp;&nbsp;},<br>
                    &nbsp;&nbsp;"status_code": 201,<br>
                    &nbsp;&nbsp;"message": "",<br>
                    &nbsp;&nbsp;"success": true<br>
                    &nbsp;&nbsp;}    <br>
                            
                    </p>
                    <span class = "badge badge-warning"><h4><u>Passport Upload</u></h4></span><br>
                    <p><b> Hitting URL : </b>http://regtechapi.in/api/seachv4</p>
                    <b>Request Method : POST </b><br>
                    <b>Request Body : </b><br>
                    {<br>   
                        passport_file – passport image file,<br>
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
            <span class = "badge badge-warning"><h4><u>Verify Passport</u></h4></span><br>
            <p><b> Hitting URL : </b>http://regtechapi.in/api/seachv4</p>
            <b>Request Method : POST </b><br>
            {<br>   
            "clientId": "@{{client_id}}",<br>
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
            </p>
             
           </div>

    </div>
    <!---bhunaksha api document-->
    <div class="row mt-2">
        <div class="col-md-4">
            <span class = "badge badge-dark"><h3>Bhunaksha APIs</h3></span>
        </div>
        <div class = "col-md-6">
            <span class = "badge badge-warning"><h4><u>GOA API</u></h4></span><br>
            <p><b> Hitting URL : </b>http://regtechapi.in/api/seachv4</p>
            <b>Request Method : POST </b><br>
            <b>Request Body : </b><br>
            {<br>   
              "bhumi_type":"bhunaksha",<br>
              "State":"goa",<br>
              "District":" ",<br>
              "Taluka":" ",<br>
              "Sheetno":" ",<br>
              "Village":" ",<br>
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
            <p><b> Hitting URL : </b>http://regtechapi.in/api/seachv4</p>
            <b>Request Method : POST </b><br>
            <b>Request Body :</b><br>
            {<br>  
              "bhumi_type":"bhunaksha",<br>
              "State":"odisha",<br>
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
            <p><b> Hitting URL : </b>http://regtechapi.in/api/seachv4</p>
            <b>Request Method : POST </b><br>
            <b>Request Body : </b><br>
            {<br>
              "bhumi_type":"bhunaksha",<br>     
              "State":"rajasthan"<br>
              "District":" ",<br>
              "Tehsil":" ",<br>
              "Ri":" ",<br>
              "Halka":" ",<br>
              "Plotno":" ",<br>
              "Village":" ",<br>
              "Sheetno":" ",<br>
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
             <p><b> Hitting URL : </b>http://regtechapi.in/api/seachv4</p>
             <b>Request Method : POST </b><br>
             <b>Request Body : </b><br>
             {<br> 
               "bhumi_type":"bhunaksha",<br>       
               "State":"jharkhand"<br>
               "District":" ",<br>
               "Halka":" ",<br>
               "Circle":" ",<br>
               "Mauza":" ",<br>
               "Sheetno":" ",<br>
               "Plotno":" "<br>
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
             <p><b> Hitting URL : </b>http://regtechapi.in/api/seachv4</p>
             <b>Request Method : POST </b><br>
             <b>Request Body : </b><br>
             {<br>
               "bhumi_type":"bhunaksha",<br>   
               "State":"kerala",<br>
               "District":" ",<br>
               "Taluka":" ",<br>
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
             <p><b> Hitting URL : </b>http://regtechapi.in/api/seachv4</p>
             <b>Request Method : POST </b><br>
             <b>Request Body : </b><br>
             {<br> 
               "bhumi_type":"bhunaksha",<br>     
               "State":"lakshadweep"<br>
               "District":" ",<br>
               "Taluka":" ",<br>
               "Surveyno":" ",<br>
               "Village":" ",<br>
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
             <p><b> Hitting URL : </b>http://regtechapi.in/api/seachv4</p>
             <b>Request Method : POST </b><br>
             <b>Request Body : </b><br>
             {<br> 
               "bhumi_type":"bhunaksha",<br>   
               "State":"up"<br>
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
             <p><b> Hitting URL : </b>http://regtechapi.in/api/seachv4</p>
             <b>Request Method : POST </b><br>
             <b>Request Body : </b><br>
             {<br>  
               "bhumi_type":"bhunaksha",<br>    
               "State":"chhattisgarh"<br>
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
             <p><b> Hitting URL : </b>http://regtechapi.in/api/seachv4</p>
             <b>Request Method : POST </b><br>
             <b>Request Body : </b><br>
             {<br>
               "bhumi_type":"bhunaksha",<br>   
               "State":"bihar"<br>
               "District":"",<br>
               "Subdiv":"",<br>
               "Circle":"",<br>
               "Mauza":" ",<br>
               "Surveytype":" ",<br>
               "Mapinstance":" ",<br>
               "Sheetno":"",<br>
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
        </div>
    </div>
    <!--bhunaksha api document end-->
    <!---Start Address Api--->
    <div class="row mt-2">
        <div class="col-md-4">
            <span class="badge badge-dark"><h3>Address APIs</h3></span>
        </div>
        <div class="col-md-6">
            <span class = "badge badge-warning"><h4><u>Verify Address API</u></h4></span><br>
            <p><b> Hitting URL:</b> http://regtechapi.in/api/seachv4</p>
            <b>Request Method : POST </b><br>
            <b>Header :</b><br>
            {<br>
            "AccessToken":"xxxxxxxxxxxxx"<br>
            }<br>
            <b>Request Body : </b><br>
            {<br>
                "address_type":"verify_address",<br/>
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
            <p><b> Hitting URL </b>:http://regtechapi.in/api/seachv4</p>
            <b>Request Method : POST </b><br>
            <b>Header : </b><br>
            {<br>
            "AccessToken":"xxxxxxxxxxxxx"<br>
            }<br>
            <b>Request Body : </b><br>
            {<br>
                "address_type":"get_place",<br/>
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
            <p><b> Hitting URL </b>:http://regtechapi.in/api/seachv4</p>
            <b>Request Method : POST </b><br>
            <b>Header : </b><br>
            {<br>
            "AccessToken":"xxxxxxxxxxxxx"<br>
            }<br>
            <b>Request Body : </b><br>
            {<br>
                "address_type":"create_geofence",<br/>
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
            <span class = "badge badge-warning"><h4><u>Get Coordinate API</u></h4></span><br>
            <p><b> Hitting URL </b>:http://regtechapi.in/api/seachv4</p>
            <b>Request Method : POST </b><br>
            <b>Header : </b><br>
            {<br>
            "AccessToken":"xxxxxxxxxxxxx"<br>
            }<br>
            <b>Request Body : </b><br>
            {<br>
                "address_type":get_coordinate",<br/>
                "address":"Pune Municipal Corporation Building, Shivaji Nagar Road, Shivaji Nagar, Pune - 411005",<br/>
            }<br>
            <p><b>Success Response : </b><br>
                {<br>
                &nbsp;&nbsp;"status_code":200,<br/>
                &nbsp;&nbsp;"data":[<br>
                &nbsp;&nbsp;&nbsp;&nbsp;{<br/>
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
            <br/>
            <span class = "badge badge-warning"><h4><u>Auto Complete API</u></h4></span><br>
            <p><b> Hitting URL </b>:http://regtechapi.in/api/seachv4</p>
            <b>Request Method : POST </b><br>
            <b>Header : </b><br>
            {<br>
            "AccessToken":"xxxxxxxxxxxxx"<br>
            }<br>
            <b>Request Body : </b><br>
            {<br>
                "address_type":"auto_complate",<br/>
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
        </div>
    </div>      
    <!---End Address Api--->
    <!--Bank Statement Api-->
    <div class="row mt-2">
        <div class="col-md-4">
            <span class="badge badge-dark"><h3>Bank Statement APIs</h3></span>
        </div>
        <div class="col-md-6">
            <span class = "badge badge-warning"><h4><u>Bank Statement</u></h4></span><br>
                    <p><b> Hitting URL : </b> http://regtechapi.in/api/seachv4</p>
                    <b>Request Method : POST </b><br>
                    <b>Header : </b><br>
                        {<br>   
                        "AccessToken":"xxxxxxxxxxxxx"<br>
                        }<br>
                    <b>Request Body : </b><br>
                    {<br>
                     "bank_stmt": "bank_statement-hdfc.pdf",<br>
                     "bank_name": "HDFC"<br>
                    "account_type": "SAVING",<br>
                    }<br>
                    <p><b>Success Response : </b><br>
                     &nbsp;&nbsp;{<br>
                     &nbsp;&nbsp;"bank_statement": {<br>
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
    <!--Bank Statement Api End-->
    <!---CIN API-->
      <div class="row mt-2">
        <div class="col-md-4">
            <span class="badge badge-dark"><h3>Corporate CIN APIs</h3></span>
        </div>
        <div class="col-md-6">
            <span class = "badge badge-warning"><h4><u>CIN</u></h4></span><br>
            <p><b> Hitting URL : </b> http://regtechapi.in/api/seachv4</p>
            <b>Request Body : </b><br>
            {<br>   
            "corporate_cin_number":"U72900PN2018PTC180125"<br>
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
            <span class = "badge badge-warning"><h4><u>CIN Advance</u></h4></span><br>
            <p><b> Hitting URL : </b> http://regtechapi.in/api/seachv4</p>
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
           <span class = "badge badge-warning"><h4><u>CIN Basic</u></h4></span><br>
           <p><b> Hitting URL : </b> http://regtechapi.in/api/seachv4</p>
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
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"addressOtherThanRegisteredOffice": "ICICI BANK TOWER,AD NEAR CHAKLI CIRCLE, OLD PADRA RO, VADODARA, VADODARA, GUJARAT, INDIA, 390007",<br/>
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
   
        </div>

     </div>
    <!--CIN end API-->
    <!--DIN API-->
    <div class="row mt-2">
        <div class="col-md-4">
            <span class="badge badge-dark"><h3>Corporate Din APIs</h3></span>
        </div>
        <div class="col-md-6">
            <span class = "badge badge-warning"><h4><u>DIN</u></h4></span><br>
            <p><b> Hitting URL : </b> http://regtechapi.in/api/seachv4</p>
            <b>Request Body : </b><br>
            {<br>   
            "corporate_din_number":"U72900PN2018PTC180125"<br>
            }<br>
            <p><b>Success Response : </b><br>
                {
                    "status": "success",
                    "data": {
                      "present_address":"{@present_address}"",
                      "nationality": "{@nationality}",
                      "client_id": "{@client_id}",
                      "father_name": "{@father_name}",
                      "email": "{@email}",
                      "permanent_address": "{@permanent_address}",
                      "full_name": "{@full_name}",
                      "dob": "{@dob}",
                      "din_number": "{@din_number}"
                    }
                  }
                  
            </p>
      
          
   
        </div>

     </div>
    <!--Din Api End -->
    <!--Dedupe-->
    <div class="row mt-2">
        <div class="col-md-4">
            <span class="badge badge-dark"><h3>Dedupe APIs</h3></span>
        </div>
        <div class="col-md-6">

           <span class = "badge badge-warning"><h4><u>Dedupe</u></h4></span><br>
           <p><b> Hitting URL : </b>http://regtechapi.in/api/seachv4</p>
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
     </div>
    <!--Dedupe End Api-->
    <!--Equifax Score-->
    <div class="row mt-2">
        <div class="col-md-4">
            <span class="badge badge-dark"><h3>CreditScoreOnly API</h3></span>
        </div>
        <div class="col-md-6">

           <span class = "badge badge-warning"><h4><u>CreditScoreOnly</u></h4></span><br>
           <p><b> Hitting URL : </b> http://regtechapi.in/api/seachv4</p>
           <b>Request Body : </b><br>
           {<br>   
                first_name:"",<br/>
                last_name:"",<br/>
                dob:"",<br/>
                phone_number:"",<br/>
                pano:"",<br/>
           }<br>
            <p><b>Success Response : </b><br>
             [<br>
                   "statusCode": 200,<br/>
                   "full_name": "LOKESH CHAUDHARY",<br/>
                   "pan_no": "AOWPC4453K",<br/>
                   "success": true,<br/>
                   "ScoreValue ": "844"<br/>

                   <br/>
                   ]
          </p>
   
        </div>
    </div>

     <!--Ecredit APi -->
     <div class="row mt-2">
        <div class="col-md-4">
            <span class="badge badge-dark"><h3>Ecredit Report API</h3></span>
        </div>
        <div class="col-md-6">
           <span class = "badge badge-warning"><h4><u>Ecredit Report</u></h4></span><br>
           <p><b> Hitting URL : </b> http://regtechapi.in/api/seachv4</p>
           <b>Request Body : </b><br>
           {<br>   
                credit:"Ecredit",<br/>
                fname:"",<br/>
                lname:"",<br/>
                mobileNumber:"",<br/>
                pan_num:"",<br/>
           }<br>
            <p><b>Success Response : </b><br>
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
          </p>
   
        </div>
     </div>

     <!--End Ecredit API-->
    <!--Email Verify-->
    <div class="row mt-2">
        <div class="col-md-4">
            <span class="badge badge-dark"><h3>Email Verification API</h3></span>
        </div>
        <div class = "col-md-6">
            <span class = "badge badge-warning"><h4><u>Email Verification</u></h4></span><br>
            <p><b> Hitting URL : </b> http://regtechapi.in/api/seachv4</p>
            <b>Request Body : </b><br>
            {<br>   
             "email_to_verify":"abhi@gmail.com"<br>
            }<br>
             <p><b>Success Response : </b><br>
              [<br>
                    "statusCode": 200,<br/>
                    "data": {<br/>
                            "email": "abhi@gmail.com",<br/>
                            "HTTPStatusCode": 200,<br/>
                            "RequestId": "eddd8f17-0e04-447c-b139-fa75a5cdce90",<br/>
                            "RetryAttempts": 0,<br/>
                            "verification_initiated": true,<br/>
                            "verification_status": "Pending"<br/>
                          }
                        <br>
                    ]
           </p>
           <span class = "badge badge-warning"><h4><u>Check Email Verify</u></h4></span><br>
        <p><b> Hitting URL : </b> http://regtechapi.in/api/seachv4</p>
        <b>Request Body : </b><br>
        {<br>   
         "identity":"abhi@gmail.com"<br>
        }<br>
         <p><b>Success Response : </b><br>
          [<br>
                "statusCode": 200,<br/>
                "data": {<br/>
                    "identity": "abhi@gmail.com",<br/>
                    "verification_status": "Pending"<br/>
                }
            <br>
        ]
       </p>
    </div>
    </div>
    <!--CkycSearch-->
    <div class="row mt-2">
        <div class = "col-md-4">
            <span class = "badge badge-dark">
                <h3>Ckyc Search Advance APIs</h3>
            </span>
        </div>
        <div class = "col-md-6">
            <span class = "badge badge-warning">
                <h4><u>ckycSearch Advance</u></h4>
            </span><br>
            <p><b> Hitting URL : </b> http://regtechapi.in/api/seachv4</p>
            <b>Header : </b><br>
            {<br>
            "AccessToken":"xxxxxxxxxxxxx"<br>
            }<br>
            <b>Request Body : </b><br>
            {<br>
                "panNumber":HUHPS7607K,<br/>
                "date_of_birth":12-02-1999,<br/>
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
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"image_data":"JVBERi0xLjQNJeLjz9MNCjEgMCBvYmoNPDwvTWV0YWRhdGEgMTEgMCBSL1BhZ2VzIDMgMCBSL1R5cGIzMEJBNTVGOTQ2QkYyMDI1RUExRDM1NzAyNz5dPj4NCnN0YXJ0eHJlZg0KNDk0MDUNCiUlRU9GDQo=",<br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"image_url":"https:/ap-south-1amazonaws.com/digitap-ckyc"<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;},<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{<br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"sequence_no": "2",<br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"image_type": "JPG",<br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "image_code": "Photograph",<br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"global_flag": "Global",<br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"branch_code": "02",<br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"image_data":"/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEABALDA4MChAODQ4SERATGCgaGBYWGDEjJR0oOjM9PDkzODdASFxOQERXRTc4UG1RV19iZ2hnPk1xeXBkeFxlZ2MBERISGBUYLxoaL2NCOEJjY2NjY2NjY2NjY2NjY2NjY2NjY2NjY2NjY2NjY2NjY2NjY2NjY2NjY2,
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"image_url":"https://s3.ap-south-1.amazonaws.com/digitap-ckyc"
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;},
                   <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{<br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"sequence_no": "3",<br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"image_type": "pdf",<br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "image_code": "Proof of Possession of Aadhaar",<br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"global_flag": "Global",<br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"branch_code": "02",<br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"image_data":"/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEABALDA4MChAODQ4SERATGCgaGBYWGDEjJR0oOjM9PDkzODdASFxOQERXRTc4UG1RV19iZ2hnPk1xeXBkeFxlZ2MBERISGBUYLxoaL2NCOEJjY2NjY2NjY2NjY2NjY2NjY2NjY2NjY2NjY2NjY2NjY2NjY2NjY2NjY2,
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

        <!-- <div class = "row">
            <div class = "col-md-4">
                
            </div>
        </div> -->
    </div>
    <!--Telcom API-->
    <div class="row mt-2">
        <div class = "col-md-4">
          <span class = "badge badge-dark"><h3>Telecom API</h3></span>
        </div>
        <div class = "col-md-6">
         <span class="badge badge-warning"><h4><u>Telecom</u></h4></span><br>
         <p><b> Hitting URL : </b>http://regtechapi.in/api/seachv4</p>
         <b>Request Method : POST </b><br>
         <b>Request Body : </b><br>
         {<br>   
         "client_ref_num": "sas40",<br>
         "mobile_number": "9975621654"<br>
         }<br>
         <b>Success Response : </b>
         <p class = "px-2">{<br>
             "telecom_details": {<br>
             "http_response_code": 200,<br> 
             "client_ref_num": "sas40",<br>
             "request_id": "bf01238b-f05b-4308-9630-96c92211139f",<br>
             "result_code": 101,<br>
             "message": "Report Generated Successful",<br>
             "result":{<br>&nbsp;&nbsp;
              "customer_details": {<br>&nbsp;&nbsp;&nbsp;&nbsp;
                "name": "",<br>&nbsp;&nbsp;&nbsp;&nbsp;
                "alternate_number": null,<br>&nbsp;&nbsp;&nbsp;&nbsp;
               },
               <br>&nbsp;&nbsp;
               "is_valid": true,<br>&nbsp;&nbsp;
               "subscriber_status": "CONNECTED",<br>&nbsp;&nbsp;
               "connection_status": {<br>&nbsp;&nbsp;&nbsp;&nbsp;
                "status_code": "DELIVERED",<br>&nbsp;&nbsp;&nbsp;&nbsp;
                "error_code_id": ""<br>&nbsp;&nbsp;&nbsp;&nbsp;
                 },<br>&nbsp;&nbsp;
                "connection_type":"prepaid",<br>&nbsp;&nbsp; 
                "msisdn": {<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  "msisdn_country_code": "IN",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  "msisdn": "+919975621654",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  "type": "MOBILE",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  "mnc": "90",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  "imsi": "404223085662992",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  "mcc": "404",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  "mcc_mnc": "40422"<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                },<br>&nbsp;&nbsp;
                "current_service_provider": {<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  "network_prefix": "83780",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  "network_name": "IDEA",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  "network_region": "Maharashtra",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  "mcc": "404",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  "mnc": "22",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  "country_prefix": "+91",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  "country_code": "IN",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  "country_name": "India"<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                },<br>&nbsp;&nbsp;
                "original_service_provider": {<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  "network_prefix": "99756",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  "network_name": "Airtel",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  "network_region": "Maharashtra",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  "mcc": "404",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  "mnc": "90",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  "country_prefix": "+91",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  "country_code": "IN",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  "country_name": "India"<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                },<br>&nbsp;&nbsp;
                "romaning_service_provider": {<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  "network_prefix": "96651",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  "network_name": "Airtel",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  "network_region": "Maharashtra",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  "mcc": "404",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  "mnc": "90",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  "country_prefix": "+91",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  "country_code": "IN",<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  "country_name": "India"<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                },<br>&nbsp;&nbsp;
                "is_ported":true,<br>&nbsp;&nbsp;
                "last_ported_date": "",<br>&nbsp;&nbsp;
                "porting_history": []<br>&nbsp;&nbsp;&nbsp;&nbsp;
             }
             <br>
          },
         <br>
         "status_code": 200,<br>
         }<p>
         </div>
    </div>
    <div class="row mt-2">
        <div class = "col-md-4">
          <span class = "badge badge-dark"><h3>GSTIN API</h3></span>
        </div>
        <div class = "col-md-6">
          <span class = "badge badge-warning"><h4><u>GSTIN</u></h4></span><br>
          <p><b> Hitting URL : </b> http://regtechapi.in/api/seachv4</p>
          <!-- <b>Request Method : POST</b><br> -->
          <b>Request Body : </b><br>
          {<br>   
          "gstin":"27AABCZ2858B1ZC"<br>
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
                  "jurisdiction": "{@jurisdiction}",
                  "reg_date": "{@reg_date}
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
  
   </div>
    </div>
  <!--Ifsc API-->
  <div class="row mt-2">
    <div class = "col-md-4">
      <span class = "badge badge-dark"><h3>Verify Ifsc API</h3></span>
    </div>
    <div class = "col-md-6">
      <span class = "badge badge-warning"><h4><u>Verify Ifsc</u></h4></span><br>
      <p><b> Hitting URL : </b> http://regtechapi.in/api/seachv4</p>
      <!-- <b>Request Method : POST</b><br> -->
      <b>Request Body : </b><br>
      {<br>   
      "ifsc":"BKID0009200"<br>
      }<br>

      <b>Success Response : </b><br>
      [<br/>
            {<br/>
            "bank_verification_api": {<br/>
                        "code": 200,<br/>
                        "status": "success",<br/>
                        "request_id": "d750536c-5a38-43e0-867b-8c765f81561e",<br/>
                        "response": {<br/>
                            "request_id": "d750536c-5a38-43e0-867b-8c765f81561e",<br/>
                            "ifsc": "BKID0009200",<br/>
                            "name": "Bank of India",<br/>
                            "code": "BKID",<br/>
                            "branch": "AMGAON",<br/>
                            "micr": "441013513",<br/>
                            "address": "STATION ROADAMGAON DIST GONDIA",<br/>
                            "city": "AMGAON DIST GONDIA",<br/>
                            "state": "MAHARASHTRA",<br/>
                            "district": "AMGAON DIST GONDIA",<br/>
                            "contact": "+917189225368",<br/>
                            "upi": true,<br/>
                            "imps": true,<br/>
                            "neft": true,<br/>
                            "rtgs": true,<br/>
                            "logo": "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"
                            <br/>
                        }
                    },<br/>
                    "statusCode": "200"
                    <br/>
              }
              <br/>
         ]

   </div>
  </div>
  <!--Ifsc Api-->
  <!--Face Match-->
  <div class="row mt-2">
    <div class = "col-md-4">
      <span class = "badge badge-dark"><h3>Face Match API</h3></span>
    </div>
    <div class = "col-md-6">
      <span class = "badge badge-warning"><h4><u>Fatch Match</u></h4></span><br>
      <p><b> Hitting URL : </b> http://regtechapi.in/api/seachv4</p>
    
      <b>Request Body : </b><br>
      {<br>   
        "doc_img":"{@doc_img}"<br>
        "selfie":"{@selfie}"<br>
       <br/>
      }<br>
      <b>Success Response : </b><br>
        [
          {
            "face_match": {<br/> 
              "code": "200",<br/>
              "status": "success",<br/>  
              "response": {<br/>
                "confidence": "100%",<br/>
              },,<br/>
            
            }<br/>
            "statusCode": "200"<br/>
          }<br/>
        ]

   </div>
  </div>
  <!--Face match end-->
  <!--Bank Statement analyser-->
  <div class="row mt-2">
    <div class = "col-md-4">
        <span class = "badge badge-dark"><h3>Bank Analyser APIs</h3></span>
    </div>
    <div class = "col-md-6">
    <span class = "badge badge-warning"><h4><u>Bank Analyser For India</u></h4></span><br>
    <p><b> Hitting URL : </b> http://regtechapi.in/api/seachv4</p>
    <b>Request Method : POST </b><br>
    <b>Header : </b><br>
        {<br>   
        "AccessToken":"xxxxxxxxxxxxx"<br>
        }<br>
    <b>Request Body : </b><br>
    {<br>
    "bank_sta": "bank_statement-hdfc.pdf",<br>
    "country": "INDIA"<br>
    "password":********<br>
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
    "bank_sta_psd": "bank_statement.pdf",<br>
    "country": "Philippines"<br>
    "password":********<br>
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
 <!--Bank Statement -->
 <div class="row">
    <div class = "col-md-4">
        <span class = "badge badge-dark"><h3>Bank Statement API</h3></span>
    </div>
  <div class = "col-md-6">
    <span class = "badge badge-warning"><h4><u>Bank Statement</u></h4></span><br>
    <p><b> Hitting URL : </b> http://regtechapi.in/api/seachv4</p>
    <b>Request Method : POST </b><br>
    <b>Header : </b><br>
        {<br>   
        "AccessToken":"xxxxxxxxxxxxx"<br>
        }<br>
    <b>Request Body : </b><br>
    {<br>
    "bank_Statement": "bank_statement-hdfc.pdf",<br>
    "bank_Name": "HDFC"<br>
    "accountype": "SAVING",<br>
    
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
<div class="row">
    <div class = "col-md-4">
        <span class = "badge badge-dark"><h3>Bank Verification APIs</h3></span>
    </div>
    <div class = "col-md-6">
    <span class = "badge badge-warning"><h4><u>Bank Verification</u></h4></span><br>
    <p><b> Hitting URL : </b> http://regtechapi.in/api/seachv4</p>
    <b>Request Method : POST </b><br>
    <b>Header : </b><br>
        {<br>   
        "AccessToken":"xxxxxxxxxxxxx"<br>
        }<br>
    <b>Request Body : </b><br>
    {<br>
        "accno":8684000010000287573,<br/>
        "Ifsc":PUNB0878480,<br/>
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
<div class="row">
    <div class = "col-md-4">
        <span class = "badge badge-dark"><h3>Company Product APIs</h3></span>
    </div>
    <div class = "col-md-6">
        <span class = "badge badge-warning"><h4><u>Company Product</u></h4></span><br>
        <p><b> Hitting URL : </b> http://regtechapi.in/api/seachv4</p>
        <b>Request Method : POST </b><br>
        <b>Request Body : </b><br>
        {<br>   
            "companyName":"",<br>
            "flrsLicenseNo":"21523032001008",<br>
        }<br>
        <p><b>Success Response : </b><br>
            [<br>
                &nbsp;&nbsp;"companyDetails":  {<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;"Information": {<br/>
                        "apptypedesc": "New Registration",<br/>
                        "companyname": "VAISHNAVI MEDICAL STORES/GHODE",<br/>
                        "displayrefid": "30230721113957150",<br/>
                        "districtname": "Ahmadnagar",<br/>
                        "fboid": 182393994316199886,<br/>
                        "licenseactiveflag": true,<br/>
                        "licensecategoryid": 3,<br/>
                        "licensecategoryname": "Registration",<br/>
                        "licenseno": "21523032001008",<br/>
                        "premiseaddress": "SH.NO.1,GRD FL,PR.NO.Z166000099,GT NO.75/3/4A/4B,PLT.NO.41, BOLHEGAON <br/>GAWTHAN,CHATRAPATI SHIVAJI MAHARAJ MARG,BOLHEGAON,AHMEDNAGAR",<br/>
                        "premisepincode": 414111,<br/>
                        "refid": 113957150,<br/>
                        "statename": "Maharashtra",<br/>
                        "statusdesc": "Registration Certificate issued",<br/>
                        "talukname": "Ahmednagar (Mun Corp) Zone 1",<br/>
                        "villagename": "Adhodi"<br/>
                    },<br/>
                    "products": [<br/>
                      {<br/>
                        "activeFlag": true,<br/>
                        "categoryName": null,<br/>
                        "fpvsProductId": null,<br/>
                        "indexVal": null,<br/>
                        "kindOfBusinessType": null,<br/>
                        "manufacturFlag": false,<br/>
                        "productId": 5,<br/>
                        "productName": "05 - Confectionery",<br/>
                        "productNamef": "05 - Confectionery",<br/>
                        "rcProductId": 101141843,<br/>
                        "refId": 113957150,<br/>
                        "subCategoryId": null,<br/>
                        "subCategoryName": null<br/>
                   }<br/>
                ]<br/>,
                }<br>,
                "status_code":200<br>
            ]<br>
        </p>
     </div>
</div>
<!--Telecom-->
<div class="row">
    <div class = "col-md-4">
        <span class = "badge badge-dark"><h3>Telecom APIs</h3></span>
    </div>
    <div class = "col-md-6">
        <span class = "badge badge-warning"><h4><u>Telecom Generate OTP</u></h4></span><br>
        <p><b> Hitting URL : </b> http://regtechapi.in/api/seachv4</p>
        <b>Request Method : POST </b><br>
        <b>Request Body : </b><br>
        {<br>   
        "IDNumber": "9840115789"<br>
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
        <p><b> Hitting URL : </b> http://regtechapi.in/api/seachv4</p>
        <b>Request Method : POST </b><br>
        <b>Request Body : </b><br>
        {<br>   
        "Client_id": "@{{client_id}}",<br>
        "Otp": "@{{otp}}"<br>
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
        }<p>
     </div>
</div>
<!--Telecom End-->
<!--Land Record Api-->
<div class="row">
    <div class = "col-md-4">
        <span class = "badge badge-dark"><h3>Land Record API</h3></span>
    </div>
    <div class = "col-md-6">
        <span class = "badge badge-warning"><h4><u>Land Record</u></h4></span><br>
        <p><b> Hitting URL : </b> http://regtechapi.in/api/seachv4</p>
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
<!--Land Record Api End-->
<!--Community area-->
<div class="row">
    <div class = "col-md-4">
        <span class = "badge badge-dark"><h3>Community Area API</h3></span>
    </div>
    <div class = "col-md-6">
        <span class = "badge badge-warning"><h4><u>Community Area</u></h4></span><br>
        <p><b> Hitting URL : </b> http://regtechapi.in/api/seachv4</p>
        <b>Header : </b><br>
        {<br>   
        "AccessToken":"xxxxxxxxxxxxx"<br>
        }<br>
        <b>Request Body : </b><br>
        {<br>   
        "lat":"18.5538",<br>
        "long":"73.9477",<br>
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
<!--Community area end-->
<!--Pincode -->
<div class="row">
    <div class = "col-md-4">
        <span class = "badge badge-dark"><h3>Pincode API</h3></span>
    </div>
    <div class = "col-md-6">
        <span class = "badge badge-warning"><h4><u>Pincode</u></h4></span><br>
        <p><b> Hitting URL : </b> http://regtechapi.in/api/seachv4</p>
        <b>Request Body : </b><br>
        {<br>   
        "from_pin":"411006",<br>
        "to_pin":"411057"<br>
        }<br>
        <b>Success Response : </b><br>
       "data": {<br>
         "fromPin": "411006",<br>
         "toPin": "411057",<br>
         "distance":22,<br/>
      },<br>
    "statusCode": 200,<br>
    </div>
 </div>
<!--Pincode end-->
<!--Image Scanner-->
<div class="row">
    <div class = "col-md-4">
        <span class = "badge badge-dark"><h3>Image Scanner API</h3></span>
    </div>
    <div class = "col-md-6">
        <span class = "badge badge-warning"><h4><u>Image Scanner</u></h4></span><br>
        <p><b> Hitting URL : </b> http://regtechapi.in/api/seachv4</p>
        <b>Request Body : </b><br>
        {<br>   
        "img_file":"happy.jpg",<br>
        }<br>
        <b>Success Response : </b><br>
        "data":{<br>
            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<br/>
          },<br>
        "statusCode": 200,</br></br>
    </div>
 </div>
<!--Image Scanner End-->
<!--face decation-->
<div class="row">
    <div class = "col-md-4">
        <span class = "badge badge-dark"><h3>Face Detection API</h3></span>
    </div>
    <div class = "col-md-6">
        <span class = "badge badge-warning"><h4><u>Face Detection</u></h4></span><br>
        <p><b> Hitting URL : </b> http://regtechapi.in/api/seachv4</p>
        <b>Request Body : </b><br>
        {<br>   
        "face_image":"happy.jpg",<br>
        }<br>
        <b>Success Response : </b><br>
        "data": {<br>
            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<br/>
          },<br>
        "statusCode": 200,<br>
        <br/>
    </div>
 </div>
<!--Face Decation End-->
<!--detecation emotaion-->
<div class="row">
    <div class = "col-md-4">
        <span class = "badge badge-dark"><h3>Decated Emotion API</h3></span>
    </div>
    <div class = "col-md-6">
        <span class = "badge badge-warning"><h4><u>Decated Emotion</u></h4></span><br>
        <p><b> Hitting URL : </b> http://regtechapi.in/api/seachv4</p>
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
<!--detecation emotation end-->
<!--Predict PPL-->
<div class="row">
    <div class = "col-md-4">
        <span class = "badge badge-dark"><h3>Decated Emotion API</h3></span>
    </div>
    <div class = "col-md-6">
        <span class = "badge badge-warning"><h4><u>Decated Emotion</u></h4></span><br>
        <p><b> Hitting URL : </b> http://regtechapi.in/api/seachv4</p>
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
<!--Predict PPL END-->
<!--End Container-->

    
</div>
@stop


@section('custom_js')
@stop