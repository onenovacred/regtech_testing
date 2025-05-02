@if(!empty($aadhaar_masking1) && isset($aadhaar_masking1[0]['aadhaar_masked_details']['status_code']) && $aadhaar_masking1[0]['aadhaar_masked_details']['status_code'] == 200)
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Aadhar Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
              <div>
                <p><strong>Aadhar Number: </strong>{{ $aadhaar_masking1[0]['aadhaar_masked_details']['data']['ocr_fields'][0]['aadhaar_number']['value'] }}</p>
                <p><strong>Full Name: </strong>{{ $aadhaar_masking1[0]['aadhaar_masked_details']['data']['ocr_fields'][0]['full_name']['value'] }}</p>
                <p><strong>Gender: </strong>{{ $aadhaar_masking1[0]['aadhaar_masked_details']['data']['ocr_fields'][0]['gender']['value'] }}</p>
                <p><strong>DOB: </strong>{{ $aadhaar_masking1[0]['aadhaar_masked_details']['data']['ocr_fields'][0]['dob']['value'] }}</p>
                @if(isset($aadhaar_masking1[0]['aadhaar_masked_details']['data']['ocr_fields'][1]))
                    <p><strong>Address: </strong>{{ $aadhaar_masking1[0]['aadhaar_masked_details']['data']['ocr_fields'][1]['address']['value'] }}</p>
                    <p><strong>City: </strong>{{ $aadhaar_masking1[0]['aadhaar_masked_details']['data']['ocr_fields'][1]['address']['city'] }}</p>
                    <p><strong>State: </strong>{{ $aadhaar_masking1[0]['aadhaar_masked_details']['data']['ocr_fields'][1]['address']['state'] }}</p>
                    <p><strong>Pincode: </strong>{{ $aadhaar_masking1[0]['aadhaar_masked_details']['data']['ocr_fields'][1]['address']['zip'] }}</p>
                @endif
                @if(isset($aadhaar_masking1[0]['aadhaar_masked_details']['data']['ocr_fields'][1]['masked_image']))
                    <p><strong>Masked Aadhar Front -</strong></p>
                @else
                    <p><strong>Masked Aadhar -</strong></p>
                @endif
                <img src="{{$aadhaar_masking1[0]['aadhaar_masked_details']['data']['ocr_fields'][0]['masked_image']}}" style="width: 100%">
                @if(isset($aadhaar_masking1[0]['aadhaar_masked_details']['data']['ocr_fields'][1]['masked_image']))
                <p style="margin-top:10px;"><strong>Masked Aadhar Back -</strong></p>
                <img src="{{$aadhaar_masking1[0]['aadhaar_masked_details']['data']['ocr_fields'][1]['masked_image']}}" style="width: 100%">
                @endif
              </div>
            </div>
        </div>
    </div>
</div>
@endif