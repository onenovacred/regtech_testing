@if(!empty($pancardInfoDetails["pancard"]["data"]) &&  isset($pancardInfoDetails['statusCode']) && $pancardInfoDetails['statusCode'] == 200)
<div class="row">
<div class="col-md-6 offset-md-3">
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">PAN CARD Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
              <div>
                <p><strong>Full Name:</strong> {{ isset($pancardInfoDetails['pancard']['data']['fullName'])?$pancardInfoDetails['pancard']['data']['fullName']:'null'}}</p>
                <p><strong>PAN no: </strong>{{ isset($pancardInfoDetails['pancard']['data']['panNumber'])?$pancardInfoDetails['pancard']['data']['panNumber']:'null' }}</p>
                <p><strong>Is Valid: </strong>{{ isset($pancardInfoDetails['pancard']['data']['isValid'])?$pancardInfoDetails['pancard']['data']['isValid']:'null'}}</p>
                <p><strong>FirstName: </strong>{{ isset($pancardInfoDetails['pancard']['data']['firstName'])?$pancardInfoDetails['pancard']['data']['firstName']:'null' }}</p>
                <p><strong>MiddleName: </strong>{{isset($pancardInfoDetails['pancard']['data']['middleName'])?$pancardInfoDetails['pancard']['data']['middleName']:'null'}}</p>
                <p><strong>LastName: </strong>{{ isset($pancardInfoDetails['pancard']['data']['lastName'])?$pancardInfoDetails['pancard']['data']['lastName']:'null' }}</p>
                <p><strong>Pan Status Code: </strong>{{ isset($pancardInfoDetails['pancard']['data']['panStatusCode'])?$pancardInfoDetails['pancard']['data']['panStatusCode']:'null'}}</p>
                <p><strong>Pan Status: </strong>{{ isset($pancardInfoDetails['pancard']['data']['panStatus'])?$pancardInfoDetails['pancard']['data']['panStatus']:'null' }}</p>
                <p><strong>Aadhaar Seeding Status: </strong>{{ isset($pancardInfoDetails['pancard']['data']['aadhaarSeedingStatus'])?$pancardInfoDetails['pancard']['data']['aadhaarSeedingStatus']:'null' }}</p>
                <p><strong>Aadhaar Seeding Status Code: </strong>{{ isset($pancardInfoDetails['pancard']['data']['aadhaarSeedingStatusCode'])?$pancardInfoDetails['pancard']['data']['aadhaarSeedingStatusCode']:'null' }}</p>
                <p><strong>last UpdatedOn: </strong>{{isset($pancardInfoDetails['pancard']['data']['lastUpdatedOn'])?$pancardInfoDetails['pancard']['data']['lastUpdatedOn']:'null' }}</p>
              </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endif
<!--Pancard info End-->