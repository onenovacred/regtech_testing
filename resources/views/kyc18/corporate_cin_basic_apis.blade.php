@extends('adminlte::page')

@section('title', 'CIN APIs')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class = "container">
    <div class="row">
      <div class = "col-md-4">
        <span class = "badge badge-dark"><h3>Corporate CIN Basic APIs</h3></span>
      </div>
      <div class = "col-md-6">
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