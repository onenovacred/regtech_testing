
@if(!empty($shopestablishment))
@if(isset($shopestablishment['status_code']) && $shopestablishment['status_code'] == 200)
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">shop establishment Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
            <div>
                <p>Client Id: {{ $shopestablishment['data']['client_id'] }}</p>
                <p>SE Number: {{ $shopestablishment['data']['se_number'] }}</p>
                <p>State Code: {{ $shopestablishment['data']['state_code'] }}</p>
                <p>state_name: {{ $shopestablishment['data']['state_name'] }}</p>
                <p>business_name: {{ $shopestablishment['data']['business_name'] }}</p>
                <p>address: {{ $shopestablishment['data']['address'] }}</p>
                <p>user_mobile_number: {{ $shopestablishment['data']['user_mobile_number'] }}</p>
                <p>registration_number: {{ $shopestablishment['data']['registration_number'] }}</p>
                <p>registration_date: {{ $shopestablishment['data']['registration_date'] }}</p>
                <p>category: {{ $shopestablishment['data']['category'] }}</p>
                <p>certificate_number: {{ $shopestablishment['data']['certificate_number'] }}</p>
                <p>document_link: {{ $shopestablishment['data']['document_link'] }}</p>
            </div>
            </div>
        </div>
    </div>
</div>
@endif
@endif