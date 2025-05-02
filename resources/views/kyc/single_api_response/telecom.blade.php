    @if(isset($telecom) && isset($telecom['statusCode']) && $telecom['statusCode'] == 200)
    <div class="row">
        <div class="col-md-6 offset-md-3">
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Telecom Details</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                  <div>
                    <p>Client ID: {{ $telecom['Telecom Generate OTP Details']['data']['client_id'] }}</p>
                    <p>Operator: {{ $telecom['Telecom Generate OTP Details']['data']['operator'] }}</p>

                  </div>
                </div>
            </div>
        </div>
    </div>
     </div>
    </div>
    @endif
