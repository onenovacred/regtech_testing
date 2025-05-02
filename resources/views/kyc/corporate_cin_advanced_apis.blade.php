@extends('adminlte::page')

@section('title', 'CIN APIs')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class = "container">
    <div class="row">
      <div class = "col-md-4">
        <span class = "badge badge-dark"><h3>Corporate CIN Advance APIs</h3></span>
      </div>
      <div class = "col-md-6">
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
      <div class = "col-md">
            <a style = "color: white;"class = "btn btn-primary" onclick="history.back()" role = "button">Back</a>
        </div>
      </div>
</div> 
@stop


@section('custom_js')
@stop