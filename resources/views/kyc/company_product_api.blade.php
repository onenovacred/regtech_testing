@extends('adminlte::page')

@section('title', 'Company Product APIs')

@section('content_header')
@stop

@section('content')
<div class = "container">
    <div class="row">
      <div class = "col-md-4">
        <span class = "badge badge-dark"><h3>Company Product APIs</h3></span>
      </div>
      <div class = "col-md-6">
        <span class = "badge badge-warning"><h4><u>Company Product</u></h4></span><br>
        <p><b> Hitting URL : </b> http://regtechapi.in/api/company-products</p>
        <b>Header : </b><br>
        {<br>   
        "AccessToken":"xxxxxxxxxxxxx"<br>
        }<br>
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
           <div class = "col-md">
            <a style = "color: white;"class = "btn btn-primary" onclick="history.back()" role = "button">Back</a>
        </div>

     </div>
</div> 
@stop


@section('custom_js')
@stop