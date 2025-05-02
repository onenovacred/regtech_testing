@if(isset($corporate_din1) && isset($corporate_din1['status_code']) && $corporate_din1['status_code']== 200)
<div class="row">
    <div class="col-md-6 offset-md-3">
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">CORPORATE DIN Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
              <div>
                <p>present_address: {{ $corporate_din1['data']['present_address'] }}</p>
                <p>nationality: {{ $corporate_din1['data']['nationality'] }}</p>
                <p>client_id: {{ $corporate_din1['data']['client_id'] }}</p>
                <p>father_name: {{ $corporate_din1['data']['father_name'] }}</p>
                <p>email: {{ $corporate_din1['data']['email'] }}</p>
                <p>permanent_address: {{ $corporate_din1['data']['permanent_address'] }}</p>
                <p>full_name: {{ $corporate_din1['data']['full_name'] }}</p>
                <p>dob: {{ $corporate_din1['data']['dob'] }}</p>
                <p>din_number: {{ $corporate_din1['data']['din_number'] }}</p>

              </div>
            </div>
        </div>
    </div>
</div>
    </div>
</div>
@endif