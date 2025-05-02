@if(!empty($passportverify) && $passportverify['statusCode'] == '200')
<div class="row">
 <div class="col-md-6 offset-md-3">
<div class = "card card-success">
    <div class = "card-header">
        <h3 class = "card-title">Passport Verification Details</h3>
    </div>
    <div class = "card-body">
        <div class="row">
        <div class="col-md-12">
          <div>
          <p><b>Passport Verification {{ $passportverify['statusCode'] }} </b></p>
        
            <p>FileNumber: {{ isset($passportverify['Verification_Details']['response']['fileNumber'])?$passportverify['Verification_Details']['response']['fileNumber']:'null' }}</p>
            <p>full_name: {{ isset($passportverify['Verification_Details']['response']['name'])?$passportverify['Verification_Details']['response']['name']:'null' }}</p>
            <p>dob: {{ isset($passportverify['Verification_Details']['response']['dob'])?$passportverify['Verification_Details']['response']['dob']:'null' }}</p>
            <p>date_of_application: {{ isset($passportverify['Verification_Details']['response']['applicationReceivedOnDate'])?$passportverify['Verification_Details']['response']['applicationReceivedOnDate']:'null' }}</p>
            <p>TypeOfApplication: {{ isset($passportverify['Verification_Details']['response']['typeOfApplication'])?$passportverify['Verification_Details']['response']['typeOfApplication']:'null' }}</p>
          </div>
        </div>
    </div>
    </div>
</div>
 </div>
</div>
@endif

@if(!empty($passportverify) && $passportverify['statusCode'] == '422')
<div class="row">
    <div class="col-md-6 offset-md-3">
<div class = "card card-danger">
    <div class = "card-header">
        <h3 class = "card-title">Passport Verification Details</h3>
    </div>
    <div class = "card-body">
        <div class="row">
        <div class="col-md-12">
          <div>
            <p><b>Message : {{ isset($passportverify['Verification_Details']['message'])?$passportverify['Verification_Details']['message']:'null' }} </b></p>
            <p><b>Message Code : {{ isset($passportverify['Verification_Details']['message_code'])?$passportverify['Verification_Details']['message_code']:'null' }} </b></p>
            <p>client_id: {{ isset($passportverify['Verification_Details']['data']['client_id'])?$passportverify['Verification_Details']['data']['client_id']:'null' }}</p>
            <p>otp_sent: {{ isset($passportverify['Verification_Details']['data']['passport_number'])?$passportverify['Verification_Details']['data']['passport_number']:'null' }}</p>
            <p>if_number: {{ isset($passportverify['Verification_Details']['data']['full_name'])? $passportverify['Verification_Details']['data']['full_name']:'null'}}</p>
            <p>valid_aadhaar: {{ isset($passportverify['Verification_Details']['data']['dob'])?$passportverify['Verification_Details']['data']['dob']:'null' }}</p>
            <p>valid_aadhaar: {{ isset($passportverify['Verification_Details']['data']['date_of_application'])?$passportverify['Verification_Details']['data']['date_of_application']:'null' }}</p>
            <p>valid_aadhaar: {{ isset($passportverify['Verification_Details']['data']['file_number']) ?$passportverify['Verification_Details']['data']['file_number'] : 'null'}}</p>
          </div>
        </div>
    </div>
    </div>
</div>
    </div>
</div>
@endif