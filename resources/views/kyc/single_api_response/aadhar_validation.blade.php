@if (isset($aadhaar_validation[0]['statusCode']) && $aadhaar_validation[0]['statusCode'] == 200)
<div class="row">
    <div class="col-md-6 offset-md-3">
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Aadhaar Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <p>Age Range:
                        {{ $aadhaar_validation[0]['aadhaar_validation']['data']['age_range'] }}
                    </p>
                    <p>Gender: {{ $aadhaar_validation[0]['aadhaar_validation']['data']['gender'] }}</p>
                    <p>Mobile:
                        {{ $aadhaar_validation[0]['aadhaar_validation']['data']['last_digits'] }}</p>
                    <p>State: {{ $aadhaar_validation[0]['aadhaar_validation']['data']['state'] }}</p>
                    <p>Aadhaar Verification:
                        {{ $aadhaar_validation[0]['aadhaar_validation']['data']['is_mobile'] }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endif