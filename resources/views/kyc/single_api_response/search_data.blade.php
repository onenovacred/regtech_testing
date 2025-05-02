@if(isset($pancard_search) && isset($pancard_search['response']['kycStatus']) && $pancard_search['response']['kycStatus'] == 'SUCCESS')
<div class="row">
<div class="col-md-6 offset-md-3">
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Search Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
              <div>
                <p><strong>Full Name:</strong> {{ $pancard_search['response']['kycDetails']['personalIdentifiableData']['personalDetails']['fullName'] }}</p>
                <p><strong>Mobile Number: </strong>{{ $pancard_search['response']['kycDetails']['personalIdentifiableData']['personalDetails']['mobNum'] }}</p>
                <p><strong>Email: </strong>{{ $pancard_search['response']['kycDetails']['personalIdentifiableData']['personalDetails']['email'] }}</p>
                <p><strong>Current Address: </strong>{{ $pancard_search['response']['kycDetails']['personalIdentifiableData']['personalDetails']['corresLine1'] }}</br>{{ $pancard_search['response']['kycDetails']['personalIdentifiableData']['personalDetails']['corresLine2'] }}</p>
                <p><strong>Current City: </strong>{{ $pancard_search['response']['kycDetails']['personalIdentifiableData']['personalDetails']['corresCity'] }}</p>
                <p><strong>Current Dist: </strong>{{ $pancard_search['response']['kycDetails']['personalIdentifiableData']['personalDetails']['corresDist'] }}</p>
                <p><strong>Current Pincode: </strong>{{ $pancard_search['response']['kycDetails']['personalIdentifiableData']['personalDetails']['corresPin'] }}</p>
                <p><strong>Permanent Address: </strong>{{ $pancard_search['response']['kycDetails']['personalIdentifiableData']['personalDetails']['permLine1'] }}</br>{{ $pancard_search['response']['kycDetails']['personalIdentifiableData']['personalDetails']['permLine2'] }}</p>
                <p><strong>Permanent Dist: </strong>{{ $pancard_search['response']['kycDetails']['personalIdentifiableData']['personalDetails']['permDist'] }}</p>
                <p><strong>Permanent City: </strong>{{ $pancard_search['response']['kycDetails']['personalIdentifiableData']['personalDetails']['permCity'] }}</p>
                <p><strong>Permanent Pincode: </strong>{{ $pancard_search['response']['kycDetails']['personalIdentifiableData']['personalDetails']['permPin'] }}</p>
                <p><strong>Number Of Identity: </strong>{{ $pancard_search['response']['kycDetails']['personalIdentifiableData']['personalDetails']['numIdentity'] }}</p>
                <p><strong>Number Of Related: </strong>{{ $pancard_search['response']['kycDetails']['personalIdentifiableData']['personalDetails']['numRelated'] }}</p>
                <p><strong>Number Of Images: </strong>{{ $pancard_search['response']['kycDetails']['personalIdentifiableData']['personalDetails']['numImages'] }}</p>
              </div>
              </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endif