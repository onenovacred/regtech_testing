@if(!empty($bank_verification_ifsc) && isset($bank_verification_ifsc[0]['bank_verification_api']['code']) && $bank_verification_ifsc[0]['bank_verification_api']['code'] == 200)
<div class="row">
<div class="col-md-6 offset-md-3">
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Bank Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
              <div>
                <p>ifsc: {{ $bank_verification_ifsc[0]['bank_verification_api']['response']['ifsc'] }}</p>
                <p>Bank Name: {{ $bank_verification_ifsc[0]['bank_verification_api']['response']['name'] }}</p>
                <p>code: {{ $bank_verification_ifsc[0]['bank_verification_api']['response']['code'] }}</p>
                <p>Branch: {{ $bank_verification_ifsc[0]['bank_verification_api']['response']['branch'] }}</p>
                <p>Address: {{ $bank_verification_ifsc[0]['bank_verification_api']['response']['address'] }}</p>
                <p>City: {{ $bank_verification_ifsc[0]['bank_verification_api']['response']['city'] }}</p>
                <p>State: {{ $bank_verification_ifsc[0]['bank_verification_api']['response']['state'] }}</p>
                <p>District: {{ $bank_verification_ifsc[0]['bank_verification_api']['response']['district'] }}</p>
                <p>contact: {{ $bank_verification_ifsc[0]['bank_verification_api']['response']['contact'] }}</p>
                <p>UPI: {{ $bank_verification_ifsc[0]['bank_verification_api']['response']['upi'] }}</p>
                <p>Rtgs: {{ $bank_verification_ifsc[0]['bank_verification_api']['response']['rtgs'] }}</p>
                <p>neft: {{ $bank_verification_ifsc[0]['bank_verification_api']['response']['neft'] }}</p>
                <p>imps: {{ $bank_verification_ifsc[0]['bank_verification_api']['response']['imps'] }}</p>
              </div>
            </div>
        </div>
    </div>
</div>
 </div>
</div>
@endif