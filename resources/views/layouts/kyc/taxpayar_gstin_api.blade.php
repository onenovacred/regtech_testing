@extends('adminlte::page')

@section('title', 'GSTIN APIs')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class = "container">
    <div class="row">
      <div class = "col-md-4">
        <span class = "badge badge-dark"><h3>TAXPAYAR GSTIN APIs</h3></span>
      </div>
      <div class = "col-md-6">
        <br/>
        <span class = "badge badge-warning"><h4><u>TAXPAYAR GSTIN</u></h4></span><br>
        <p><b> Hitting URL : </b>http://regtechapi.in/api/seachv4</p>
        <!-- <b>Request Method : POST</b><br> -->
        <b>Request Body : </b><br>
        {<br>   
        "tax_payer_gstin_number":"27AABCZ2858B1ZC"<br>
        }<br>

        <b>Success Response : </b><br>
        [
          <p class = "px-2">
              "statusCode": 200,<br>
              "taxpayer_gstin": {<br>&nbsp;
                  "stateJurisdictionCode": "UP333",<br>
                  "legalNameOfBusiness": "ONE97 COMMUNICATIONS LIMITED",<br>
                  "stateJurisdiction": "Corporate Circle, Noida",<br>
                  "taxpayerType": "Regular",<br>
                  "additionalPlaceOfBusinessFields": [

                        {
                          <br>
                          "additionalPlaceOfBusinessAddress": {<br>&nbsp;
                              "buildingName": "",<br>
                              "streetName": "Sector -3",<br>
                              "location": "Noida",<br>
                              "buildingNumber": "D-7",<br>
                              "districtName": "Gautambuddha Nagar",<br>
                              "lattitude": "",<br>
                              "locality": "",<br>
                              "pincode": "201301",<br>
                              "landMark": "",<br>
                              "stateName": "Uttar Pradesh",<br>
                              "geocodelvl": "NA",<br>
                              "floorNumber": "Ground Floor",<br>
                              "longitude": ""<br>
                           },<br>
                          "natureOfAdditionalPlaceOfBusiness": "Office / Sale Office"
                          <br>
                      },<br>
                      <br>
                      {  <br>
                          "additionalPlaceOfBusinessAddress": {  <br>
                              "buildingName": "Behind SBI Bank",  <br>
                              "streetName": "Vibhuti Khand",  <br>
                              "location": "Gomti Nagar",  <br>
                              "buildingNumber": "B2/64 Basement SSC",  <br>
                              "districtName": "Lucknow",  <br>
                              "lattitude": "",  <br>
                              "locality": "",  <br>
                              "pincode": "226010",<br>
                              "landMark": "",<br>
                              "stateName": "Uttar Pradesh",<br>
                              "geocodelvl": "NA", <br>
                              "floorNumber": "Trade Tower",  <br>
                              "longitude": ""  <br>
                          },  <br>
                          "natureOfAdditionalPlaceOfBusiness": "Supplier of Services"
                          <br>
                      },<br>
                      { <br>
                          "additionalPlaceOfBusinessAddress": { <br>
                              "buildingName": "", <br>
                              "streetName": "Plot No. H 10-B", <br>
                              "location": "Sector -98", <br>
                              "buildingNumber": "One Skymark", <br>
                              "districtName": "Gautambuddha Nagar", <br>
                              "lattitude": "", <br>
                              "locality": "", <br>
                              "pincode": "201303", <br>
                              "landMark": "", <br>
                              "stateName": "Uttar Pradesh", <br>
                              "geocodelvl": "NA", <br>
                              "floorNumber": "Floor No 6 to 22 IN Tower -D", <br>
                              "longitude": "" <br>
                          },
                          "natureOfAdditionalPlaceOfBusiness": "Office / Sale Office" <br>
                      },<br>
                      { <br>
                          "additionalPlaceOfBusinessAddress": {
                              "buildingName": "", <br>
                              "streetName": "Chapraula", <br>
                              "location": "Ghaziabad", <br>
                              "buildingNumber": "417", <br>
                              "districtName": "Ghaziabad", <br>
                              "lattitude": "", <br>
                              "locality": "", <br>
                              "pincode": "201009", <br>
                              "landMark": "", <br>
                              "stateName": "Uttar Pradesh", <br>
                              "geocodelvl": "NA", <br>
                              "floorNumber": "Plot No. 230-231, G.T. Road", <br>
                              "longitude": "" <br>
                          },
                          "natureOfAdditionalPlaceOfBusiness": "Warehouse / Depot" <br>
                      },<br>
                      { <br>
                          "additionalPlaceOfBusinessAddress": {
                              "buildingName": "",<br>
                              "streetName": "Block A Road",<br>
                              "location": "Noida Phase-2",<br>
                              "buildingNumber": "Address - A-21,",<br>
                              "districtName": "Gautambuddha Nagar",<br>
                              "lattitude": "",<br>
                              "locality": "",<br>
                              "pincode": "201305",<br>
                              "landMark": "",<br>
                              "stateName": "Uttar Pradesh",<br>
                              "geocodelvl": "NA",<br>
                              "floorNumber": "Hosiery Complex",<br>
                              "longitude": ""<br>
                          },
                          "natureOfAdditionalPlaceOfBusiness": "Warehouse / Depot"<br>
                      },<br>
                      {<br>
                          "additionalPlaceOfBusinessAddress": {
                              "buildingName": "Ecotech-3",<br>
                              "streetName": "Village  Habibpur",<br>
                              "location": "Noida",<br>
                              "buildingNumber": "Greater Noida, Gautam Budh Nagar",<br>
                              "districtName": "Gautambuddha Nagar",<br>
                              "lattitude": "28.5002",<br>
                              "locality": "",<br>
                              "pincode": "201306",<br>
                              "landMark": "",<br>
                              "stateName": "Uttar Pradesh",<br>
                              "geocodelvl": "pincode",<br>
                              "floorNumber": "Khasra No. 18  19",<br>
                              "longitude": "77.474474"<br>
                          },<br>
                          "natureOfAdditionalPlaceOfBusiness": "Office / Sale Office, Warehouse / Depot"<br>
                      },<br>
                      {<br>
                          "additionalPlaceOfBusinessAddress": {
                              "buildingName": "Lallapura",<br>
                              "streetName": "Ward Chetganj",<br>
                              "location": "Varanasi",<br>
                              "buildingNumber": "Plot no 13",<br>
                              "districtName": "Varanasi",<br>
                              "lattitude": "25.3178080000001",<br>
                              "locality": "Gulab Bagh",<br>
                              "pincode": "221010",<br>
                              "landMark": "",<br>
                              "stateName": "Uttar Pradesh",<br>
                              "geocodelvl": "Building",<br>
                              "floorNumber": "House no C 19/187-13-K",<br>
                              "longitude": "82.9940460000001"<br>
                          },<br>
                          "natureOfAdditionalPlaceOfBusiness": "Office / Sale Office, Warehouse / Depot"<br>
                      },<br>
                      {<br>
                          "additionalPlaceOfBusinessAddress": {
                              "buildingName": "",<br>
                              "streetName": "Village Bhovapur, Reliance Road",<br>
                              "location": "Hapur",<br>
                              "buildingNumber": "Jindal Nagar",<br>
                              "districtName": "Hapur",<br>
                              "lattitude": "28.686226",<br>
                              "locality": "",<br>
                              "pincode": "245101",<br>
                              "landMark": "",<br>
                              "stateName": "Uttar Pradesh",<br>
                              "geocodelvl": "pincode",<br>
                              "floorNumber": "Khasra No 347",<br>
                              "longitude": "77.800683"<br>
                          },<br>
                          "natureOfAdditionalPlaceOfBusiness": "Office / Sale Office, Warehouse / Depot"<br>
                      },<br>
                      {<br>
                          "additionalPlaceOfBusinessAddress": {
                              "buildingName": "Tower-D",<br>
                              "streetName": "Plot No. H-10B",<br>
                              "location": "Noida",<br>
                              "buildingNumber": "One Skymark",<br>
                              "districtName": "Gautambuddha Nagar",<br>
                              "lattitude": "28.537022",<br>
                              "locality": "Sector 98",<br>
                              "pincode": "201304",<br>
                              "landMark": "",<br>
                              "stateName": "Uttar Pradesh",<br>
                              "geocodelvl": "locality",<br>
                              "floorNumber": "Floor No 6 to 22",<br>
                              "longitude": "77.358504"<br>
                          },<br>
                          "natureOfAdditionalPlaceOfBusiness": "Warehouse / Depot, Office / Sale Office"<br>
                      },<br>
                      {<br>
                          "additionalPlaceOfBusinessAddress": {
                              "buildingName": "",<br>
                              "streetName": "Mangal Panday Nagar",<br>
                              "location": "Meerut",<br>
                              "buildingNumber": "Sunrise Tower",<br>
                              "districtName": "Meerut",<br>
                              "lattitude": "28.966983",<br>
                              "locality": "",<br>
                              "pincode": "250001",<br>
                              "landMark": "",<br>
                              "stateName": "Uttar Pradesh",<br>
                              "geocodelvl": "Building",<br>
                              "floorNumber": "3rd Floor",<br>
                              "longitude": "77.73618"<br>
                          },<br>
                          "natureOfAdditionalPlaceOfBusiness": "Office / Sale Office, Warehouse / Depot"<br>
                      },
                      {<br>
                          "additionalPlaceOfBusinessAddress": {<br>
                              "buildingName": "",<br>
                              "streetName": "Gautam Budh marg",<br>
                              "location": "Lucknow",<br>
                              "buildingNumber": "92-D",<br>
                              "districtName": "Lucknow",<br>
                              "lattitude": "26.856159",<br>
                              "locality": "",<br>
                              "pincode": "226010",<br>
                              "landMark": "",<br>
                              "stateName": "Uttar Pradesh",<br>
                              "geocodelvl": "pincode",<br>
                              "floorNumber": "First Floor",<br>
                              "longitude": "81.004399"<br>
                          },<br>
                          "natureOfAdditionalPlaceOfBusiness": "Office / Sale Office, Supplier of Services, Warehouse / Depot"<br>
                      },<br>
                      {<br>
                          "additionalPlaceOfBusinessAddress": {
                              "buildingName": "Trade Tower",<br>
                              "streetName": "Behind SBI bank",<br>
                              "location": "Lucknow",<br>
                              "buildingNumber": "B2/64",<br>
                              "districtName": "Lucknow",<br>
                              "lattitude": "26.9277310000001",<br>
                              "locality": "Vibhuti Khand",<br>
                              "pincode": "226010",<br>
                              "landMark": "",<br>
                              "stateName": "Uttar Pradesh",<br>
                              "geocodelvl": "Building",<br>
                              "floorNumber": "Second Floor",<br>
                              "longitude": "80.9442280000001"<br>
                          },<br>
                          "natureOfAdditionalPlaceOfBusiness": "Office / Sale Office, Warehouse / Depot"<br>
                      },<br>
                      {<br>
                          "additionalPlaceOfBusinessAddress": {
                              "buildingName": "",<br>
                              "streetName": "Block - B-1-A",<br>
                              "location": "Noida",<br>
                              "buildingNumber": "Plot No - 4 & 5",<br>
                              "districtName": "Gautambuddha Nagar",<br>
                              "lattitude": "28.5778780000001",<br>
                              "locality": "Sector 51",<br>
                              "pincode": "201301",<br>
                              "landMark": "",<br>
                              "stateName": "Uttar Pradesh",<br>
                              "geocodelvl": "locality",<br>
                              "floorNumber": "",<br>
                              "longitude": "77.3646160000001"<br>
                          },<br>
                          "natureOfAdditionalPlaceOfBusiness": "Office / Sale Office, Warehouse / Depot, Supplier of Services"<br>
                      }<br>
                  ],<br>
                  "dateOfCancellation": "",<br>
                  "gstIdentificationNumber": "09AAACO4007A1Z3",<br>
                  "natureOfBusinessActivity": [
                      "Office / Sale Office",
                      "Supplier of Services",
                      "Warehouse / Depot"
                  ],<br>
                  "lastUpdatedDate": "15/11/2023",<br>
                  "dateOfRegistration": "01/07/2017",<br>
                  "constitutionOfBusiness": "Public Limited Company",<br>
                  "principalPlaceOfBusinessFields": {<br>
                      "principalPlaceOfBusinessAddress": {
                          "buildingName": "",<br>
                          "streetName": "SECTOR-5",<br>
                          "location": "NOIDA",<br>
                          "buildingNumber": "B-121",<br>
                          "districtName": "Gautambuddha Nagar",<br>
                          "lattitude": "",<br>
                          "locality": "",<br>
                          "pincode": "201301",<br>
                          "landMark": "",<br>
                          "stateName": "Uttar Pradesh",<br>
                          "geocodelvl": "NA",<br>
                          "floorNumber": "",<br>
                          "longitude": ""<br>
                      },<br>
                      "natureOfPrincipalPlaceOfBusiness": "Office / Sale Office"<br>
                  },<br>
                  "tradeName": "M/S ONE 97 COMMUNICATION LTD",<br>
                  "gstnStatus": "Active",<br>
                  "centerJurisdictionCode": "YC0401",<br>
                  "centerJurisdiction": "RANGE - 16",<br>
                  "eInvoiceStatus": "Yes"<br>
                  ,<br>&nbsp;&nbsp;
              }
              
          
            <br>
         
         </p>
         <br/>
      ]

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