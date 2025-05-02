@extends('adminlte::page')

@section('title', 'Pancard APIs')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class = "container">
    <div class="row">
      <div class = "col-md-4">
        <span class = "badge badge-dark"><h3>Udyam Search APIs</h3></span>
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
           
        }"<br>
                &nbsp;&nbsp;&nbsp;&nbsp;}<br>
              



                &nbsp;&nbsp;}<br>
            ]<br>
        </p>


        <!-- PAN Upload -->
              

    </div>

    <!-- <div class = "row">
        <div class = "col-md-4">
            
        </div>
    </div> -->
</div> 
@stop


@section('custom_js')
@stop