@if(!empty($corporate_basic['corporate_cin']["data"]) && !empty($corporate_basic['statusCode']) && $corporate_basic['statusCode']==200)
<div class="row">
    <div class="col-md-6 offset-md-3">
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">CORPORATE CIN Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
              <div>
                 <p><strong>cinNumber:</strong>{{isset($corporate_basic['corporate_cin']["data"]['cin'])?$corporate_basic['corporate_cin']["data"]['cin']:'null'}}</p>
                 <p><strong>numberOfMembers:</strong>{{isset($corporate_basic['corporate_cin']["data"]['numberOfMembers'])?$corporate_basic['corporate_cin']["data"]['numberOfMembers']:'null'}}</p>
                 <p><strong>subCategory:</strong>{{isset($corporate_basic['corporate_cin']["data"]['subCategory'])?$corporate_basic['corporate_cin']["data"]['subCategory']:'null'}}</p>
                 <p><strong>classType:</strong>{{isset($corporate_basic['corporate_cin']["data"]['classType'])?$corporate_basic['corporate_cin']["data"]['classType']:'null'}}</p>
                 <p><strong>companyType:</strong>{{isset($corporate_basic['corporate_cin']["data"]['companyType'])?$corporate_basic['corporate_cin']["data"]['companyType']:'null'}}</p>
                 <p><strong>companyName:</strong>{{isset($corporate_basic['corporate_cin']["data"]['companyName'])?$corporate_basic['corporate_cin']["data"]['companyName']:'null'}}</p>
                 <p><strong>paidUpCapital</strong>:{{isset($corporate_basic['corporate_cin']["data"]['paidUpCapital'])?$corporate_basic['corporate_cin']["data"]['paidUpCapital']:'null'}}</p>
                 <p><strong>authorisedCapital</strong>:{{isset($corporate_basic['corporate_cin']["data"]['authorisedCapital'])?$corporate_basic['corporate_cin']["data"]['authorisedCapital']:'null'}}</p>
                 <p><strong>whetherListed</strong>:{{isset($corporate_basic['corporate_cin']["data"]['whetherListed'])?$corporate_basic['corporate_cin']["data"]['whetherListed']:'null'}}</p>
                 <p><strong>dateOfIncorporation</strong>:{{isset($corporate_basic['corporate_cin']["data"]['dateOfIncorporation'])?$corporate_basic['corporate_cin']["data"]['dateOfIncorporation']:'null'}}</p>
                 <p><strong>registrationNumber</strong>:{{isset($corporate_basic['corporate_cin']["data"]['registrationNumber'])?$corporate_basic['corporate_cin']["data"]['registrationNumber']:'null'}}</p>
                 <p><strong>registeredAddress</strong>:{{isset($corporate_basic['corporate_cin']["data"]['registeredAddress'])?$corporate_basic['corporate_cin']["data"]['registeredAddress']:'null'}}</p>
                 <p><strong>registeredDisctrict</strong>:{{isset($corporate_basic['corporate_cin']["data"]['registeredDisctrict'])?$corporate_basic['corporate_cin']["data"]['registeredDisctrict']:'null'}}</p>
                 <p><strong>registeredState</strong>:{{isset($corporate_basic['corporate_cin']["data"]['registeredState'][0])?$corporate_basic['corporate_cin']["data"]['registeredState'][0]:'null'}}</p>
                 <p><strong>registeredCity</strong>:{{isset($corporate_basic['corporate_cin']["data"]['registeredCity'])?$corporate_basic['corporate_cin']["data"]['registeredCity']:'null'}}</p>
                 <p><strong>registeredPincode</strong>:{{isset($corporate_basic['corporate_cin']["data"]['registeredPincode'])?$corporate_basic['corporate_cin']["data"]['registeredPincode']:'null'}}</p>
                 <p><strong>registeredCountry</strong>:{{isset($corporate_basic['corporate_cin']["data"]['registeredCountry'])?$corporate_basic['corporate_cin']["data"]['registeredCountry']:'null'}}</p>
                 <p><strong>activeCompliance</strong>:{{isset($corporate_basic['corporate_cin']["data"]['activeCompliance'])?$corporate_basic['corporate_cin']["data"]['activeCompliance']:'null'}}</p>
                 <p><strong>category</strong>:{{isset($corporate_basic['corporate_cin']["data"]['category'])?$corporate_basic['corporate_cin']["data"]['category']:'null'}}</p>
                 <p><strong>status</strong>:{{isset($corporate_basic['corporate_cin']["data"]['status'])?$corporate_basic['corporate_cin']["data"]['status']:'null'}}</p>
                 <p><strong>rocOffice</strong>:{{isset($corporate_basic['corporate_cin']["data"]['rocOffice'])?$corporate_basic['corporate_cin']["data"]['rocOffice']:'null'}}</p>
                 <p><strong>addressOtherThanRegisteredOffice</strong>:{{isset($corporate_basic['corporate_cin']["data"]['addressOtherThanRegisteredOffice'])?$corporate_basic['corporate_cin']["data"]['addressOtherThanRegisteredOffice']:'null'}}</p>
                 <p><strong>emailId</strong>:{{isset($corporate_basic['corporate_cin']["data"]['emailId'])?$corporate_basic['corporate_cin']["data"]['emailId']:'null'}}</p>
                 <p><strong>natureOfBusiness</strong>:{{isset($corporate_basic['corporate_cin']["data"]['natureOfBusiness'])?$corporate_basic['corporate_cin']["data"]['natureOfBusiness']:'null'}}</p>
                 <p><strong>noOfDirectors</strong>:{{isset($corporate_basic['corporate_cin']["data"]['noOfDirectors'])?$corporate_basic['corporate_cin']["data"]['noOfDirectors']:'null'}}</p>
                 <p><strong>statusForEfiling</strong>:{{isset($corporate_basic['corporate_cin']["data"]['statusForEfiling'])?$corporate_basic['corporate_cin']["data"]['statusForEfiling']:'null'}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
</div>
@endif