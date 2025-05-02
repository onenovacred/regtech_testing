@if(!empty($aadhaar1) && $statusCodeAadhaarUpload == 200)
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Aadhaar CARD OCR</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
              <div>
                <p>Aadhaar Number: {{ $aadhaar[0]['aadhaar_validation']['data']['aadhaar_number'] }}</p>
                <p>Full Name: {{$aadhaarOCR1['data']['ocr_fields'][0]['full_name']['value']}}</p>
                <p>DOB: {{$aadhaarOCR1['data']['ocr_fields'][0]['dob']['value']}}</p>
                
              </div>
            </div>
        </div>
    </div>
</div>
@endif
@if(isset($aadhaar1) && $aadhaar1 !=null)
<div class = "card card-success">
    <div class = "card-header">
        <h3 class = "card-title">Aadhaar Verification</h3>
    </div>
    <div class = "card-body">
        <div class="row">
            <div class="col-md-12">
              <div>
                <p>Aadhaar Number: {{ $aadhaar1[0]['aadhaar_validation']['data']['aadhaar_number'] }}</p>
                <p>Age Range: {{ $aadhaar1[0]['aadhaar_validation']['data']['age_range'] }}</p>
                <p>Gender: @if($aadhaar1[0]['aadhaar_validation']['data']['gender'] == 'M') Male @elseif($aadhaar1[0]['aadhaar_validation']['data']['gender'] == 'F') Female @else {{$aadhaar1['data']['gender']}} @endif</p>
                <p>Mobile: {{ '*******'.$aadhaar1[0]['aadhaar_validation']['data']['last_digits'] }}</p>
                <p>State: {{ $aadhaar1[0]['aadhaar_validation']['data']['state'] }}</p>
                <p>Aadhaar Verification: {{ $aadhaar1[0]['aadhaar_validation']['message_code'] }}</p>
              </div>
            </div>
        </div>
    </div>
    @endif