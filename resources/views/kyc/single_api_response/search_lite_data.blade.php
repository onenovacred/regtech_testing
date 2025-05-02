@if(isset($pancard_search_lite) && isset($pancard_search_lite['response']['kycStatus']) && $pancard_search_lite['response']['kycStatus']== 'SUCCESS')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Search Lite Data</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                <p><strong>Full Name:</strong> {{ $pancard_search_lite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['fullName'] }}</p>
                <p><strong>Mobile Number: </strong>{{ $pancard_search_lite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['mobNum'] }}</p>
                <p><strong>Email:</strong> {{ $pancard_search_lite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['email'] }}</p>
                <p><strong>Dob: </strong>{{ $pancard_search_lite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['dob'] }}</p>
                <p><strong>Masked Aadhaar:</strong> {{ $pancard_search_lite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['maskedAadhaar'] }}</p>
                <p><strong>lastFourDigit: </strong>{{ $pancard_search_lite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['lastFourDigit'] }}</p>
                <p><strong>Type Of Holder:</strong> {{ $pancard_search_lite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['typeOfHolder'] }}</p>
                <p><strong>Gender: </strong>{{ $pancard_search_lite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['gender'] }}</p>
                <p><strong>Address: </strong>{{ $pancard_search_lite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['address'] }}</p>
                <p><strong>City: </strong>{{ $pancard_search_lite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['city'] }}</p>
                <p><strong>Country: </strong>{{ $pancard_search_lite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['country'] }}</p>
                <p><strong>Pincode: </strong>{{ $pancard_search_lite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['pincode'] }}</p>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
@endif