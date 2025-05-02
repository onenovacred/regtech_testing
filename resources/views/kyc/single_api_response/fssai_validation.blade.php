@if(!empty($fssi_validation) && $fssi_validation['statusCode'] == '200')
<div class="row">
    <div class="col-md-6 offset-md-3">
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">FSSAI Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
              <div>
                <p>FSSAI Number: {{ $fssi_validation['Verification Details']['data']['fssai_number'] }}</p>
                <p>Client_ID: {{ $fssi_validation['Verification Details']['data']['client_id'] }}</p>
                <p>FSSAI Verification: {{ $fssi_validation['Verification Details']['message_code'] }}</p>
                <p>Address: {{ $fssi_validation['Verification Details']['data']['details'][0]['address'] }}</p>
                <p>fbo_id: {{ $fssi_validation['Verification Details']['data']['details'][0]['fbo_id'] }}</p>
                <p>display_ref_id: {{ $fssi_validation['Verification Details']['data']['details'][0]['display_ref_id'] }}</p>
                <p>License_category_name: {{ $fssi_validation['Verification Details']['data']['details'][0]['license_category_name'] }}</p>
                <p>State_name: {{ $fssi_validation['Verification Details']['data']['details'][0]['state_name'] }}</p>
                <p>Status_desc: {{ $fssi_validation['Verification Details']['data']['details'][0]['status_desc'] }}</p>
                <p>License_category_id: {{ $fssi_validation['Verification Details']['data']['details'][0]['license_category_id'] }}</p>
                <p>Company_name: {{ $fssi_validation['Verification Details']['data']['details'][0]['company_name'] }}</p>
                <p>License_active_flag: {{ $fssi_validation['Verification Details']['data']['details'][0]['license_active_flag'] }}</p>
                <p>App_type_desc: {{ $fssi_validation['Verification Details']['data']['details'][0]['app_type_desc'] }}</p>
                <p>Premise_pincode: {{ $fssi_validation['Verification Details']['data']['details'][0]['premise_pincode'] }}</p>
              </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endif