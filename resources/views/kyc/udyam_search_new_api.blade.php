@extends('adminlte::page')

@section('title', 'Udyam APIs')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class = "container">
    <div class="row">
      <div class = "col-md-4">
        <span class = "badge badge-dark"><h3>Udyam  API</h3></span>
      </div>
      <div class = "col-md-6">
        <span class = "badge badge-warning"><h4><u>Udyam Search v2</u></h4></span><br>
        <p><b> Hitting URL : </b>http://regtechapi.in/api/seachv4</p>
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
@stop


@section('custom_js')
@stop