
@if(isset($passport_create_client) && $passport_create_client['statusCode'] == 200)
<div class="row">
    <div class="col-md-6 offset-md-3">
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Passport Client Create Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
            <div>
                <p>Passport Client ID: {{ $passport_create_client['passport']['data']['client_id'] }}</p>
            </div>
            </div>
        </div>
    </div>
</div>
    </div>
</div>
@endif