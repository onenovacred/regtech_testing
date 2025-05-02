@if(isset($corporate_cin1) && isset($corporate_cin1[0]['corporate_cin']['status_code']) && $corporate_cin1[0]['corporate_cin']['status_code'] == 200)
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">CORPORATE CIN Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
              <div>
                <p>company_class: {{ $corporate_cin1[0]['corporate_cin']['data']['company_class'] }}</p>
                <p>client_id: {{ $corporate_cin1[0]['corporate_cin']['data']['client_id'] }}</p>
                <p>cin_number: {{ $corporate_cin1[0]['corporate_cin']['data']['cin_number'] }}</p>
                <p>zip: {{ $corporate_cin1[0]['corporate_cin']['data']['zip'] }}</p>
                <p>company_address: {{ $corporate_cin1[0]['corporate_cin']['data']['company_address'] }}</p>
                <p>email: {{ $corporate_cin1[0]['corporate_cin']['data']['email'] }}</p>
                <p>incorporation_date: {{ $corporate_cin1[0]['corporate_cin']['data']['incorporation_date'] }}</p>
                <p>director_name: {{ $corporate_cin1[0]['corporate_cin']['data']['directors'][0]['director_name'] }}</p>
                <p>din_number: {{ $corporate_cin1[0]['corporate_cin']['data']['directors'][1]['din_number'] }}</p>
              </div>
            </div>
        </div>
    </div>
</div>
@endif