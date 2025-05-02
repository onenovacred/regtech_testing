@extends('adminlte::page')

@section('title', 'Bhunaksha APIs')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class = "container">
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
      <div class = "col-md">
            <a style = "color: white;"class = "btn btn-primary" onclick="history.back()" role = "button">Back</a>
        </div>

    </div>
</div> 
        
@stop


@section('custom_js')
@stop