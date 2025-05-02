@if(!empty($bank_verification) && isset($bank_verification[0]['status_code']))
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Bank Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
              <div>
              <p>Account Status: {{ $bank_verification[0]['bank_verification']['account_status'] }}</p>
                <!-- <p>Full Name: {{ $bank_verification[0]['bank_verification']['data']['full_name'] }}</p>
                <p>Account Exists: {{ $bank_verification[0]['bank_verification']['data']['account_exists'] }}</p> -->
              </div>
            </div>
        </div>
    </div>
</div>
@endif