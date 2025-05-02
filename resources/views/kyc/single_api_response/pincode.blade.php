@if(isset($pincode_details['statusCode']) && $pincode_details['statusCode'] == 200)
<div class="row">
    <div class="col-md-6 offset-md-3">
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Pincode Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
              <div>
                <p><strong>fromPinCode:</strong> {{ isset($pincode_details['data']['fromPin'])?$pincode_details['data']['fromPin']:'null' }}</p>
                <p><strong>toPinCode: </strong>{{ isset($pincode_details['data']['toPin'])?$pincode_details['data']['toPin']:'null'}}</p>
                <p><strong>Distance: </strong>{{ isset($pincode_details['data']['distance'])?$pincode_details['data']['distance']:'null' }}</p>
              </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endif