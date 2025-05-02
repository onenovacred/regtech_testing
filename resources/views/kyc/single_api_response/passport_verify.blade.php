@if(!empty($passport_verify1) && $passport_verify1['statusCode'] == '200')
<div class = "card card-success">
    <div class = "card-header">
        <h3 class = "card-title">Passport Verification Details</h3>
    </div>
    <div class = "card-body">
        <div class="row">
        <div class="col-md-12">
          <div>
          <p><b>Passport Verification {{ $passport_verify1['statusCode'] }} </b></p>
        
            <p>FileNumber: {{ $passport_verify1['Verification_Details']['response']['fileNumber'] }}</p>
            <p>full_name: {{ $passport_verify1['Verification_Details']['response']['name'] }}</p>
            <p>dob: {{ $passport_verify1['Verification_Details']['response']['dob'] }}</p>
            <p>date_of_application: {{ $passport_verify1['Verification_Details']['response']['applicationReceivedOnDate'] }}</p>
            <p>TypeOfApplication: {{ $passport_verify1['Verification_Details']['response']['typeOfApplication'] }}</p>
          </div>
        </div>
    </div>
    </div>
</div>
@endif

@if(!empty($passport_verify1) && $passport_verify1['statusCode'] == '422')
<div class = "card card-danger">
    <div class = "card-header">
        <h3 class = "card-title">Passport Verification Details</h3>
    </div>
    <div class = "card-body">
        <div class="row">
        <div class="col-md-12">
          <div>
            <p><b>Message : {{ $passport_verify1['Verification_Details']['message'] }} </b></p>
            <p><b>Message Code : {{ $passport_verify1['Verification_Details']['message_code'] }} </b></p>
            <p>client_id: {{ $passport_verify1['Verification_Details']['data']['client_id'] }}</p>
            <p>otp_sent: {{ $passport_verify1['Verification_Details']['data']['passport_number'] }}</p>
            <p>if_number: {{ $passport_verify1['Verification_Details']['data']['full_name'] }}</p>
            <p>valid_aadhaar: {{ $passport_verify1['Verification_Details']['data']['dob'] }}</p>
            <p>valid_aadhaar: {{ $passport_verify1['Verification_Details']['data']['date_of_application'] }}</p>
            <p>valid_aadhaar: {{ $passport_verify1['Verification_Details']['data']['file_number'] }}</p>
          </div>
        </div>
    </div>
    </div>
</div>
@endif