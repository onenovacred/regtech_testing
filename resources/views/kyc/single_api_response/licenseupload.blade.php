@if(!empty($licenseUpload['status_code']) &&  $licenseUpload['status_code'] == 200)
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">License Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
              <div>
                <p>License Number: {{  $licenseUpload['data']['license_number']['value'] }}</p>
                <p>DOB: {{  $licenseUpload['data']['dob']['value'] }}</p>
              </div>
            </div>
        </div>
        
    </div>
</div>
@endif
@if(isset($license_upload_validation) && $license_upload_validation != null)
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">License Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
              <div>
                <p>License Number: {{  $license_upload_validation['data']['license_number'] }}</p>
                <p>Name: {{  $license_upload_validation['data']['name'] }}</p>
                <p>Father / Husband Name: {{  $license_upload_validation['data']['father_or_husband_name'] }}</p>
                <p>Gender: {{ $license_upload_validation['data']['gender']}}</p>
                <p>DOB: {{ $license_upload_validation['data']['dob']}}</p>
                <p>Permanent Address: {{  $license_upload_validation['data']['permanent_address'] }}</p>
                <p>Permanent ZIP: {{  $license_upload_validation['data']['permanent_zip'] }}</p>
                <p>Temporary Address: {{  $license_upload_validation['data']['temporary_address'] }}</p>
                <p>Temporary ZIP: {{  $license_upload_validation['data']['temporary_zip'] }}</p>
                <p>Citizenship: {{  $license_upload_validation['data']['citizenship'] }}</p>
                <p>State: {{  $license_upload_validation['data']['state'] }}</p>
                <p>DOI: {{ $license_upload_validation['data']['doi']}}</p>
                <p>DOE: {{ $license_upload_validation['data']['doe']}}</p>
                <p>RTO Code: {{  $license_upload_validation['data']['ola_code'] }}</p>
                <p>RTO Name: {{  $license_upload_validation['data']['ola_name'] }}</p>
                <p>License Verification: {{  $license_upload_validation['message_code'] }}</p>
              </div>
            </div>
        </div>
    </div>
</div>
@endif