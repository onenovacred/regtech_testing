@if(isset($aadhaar_masking1[0]['aadhaar_masked_details']['status_code']) && $aadhaar_masking1[0]['aadhaar_masked_details']['status_code'] == '102')
<div class="alert alert-danger" role="alert">
    Please upload valid aadhar photo. Error code - 102 
</div>
@endif
@if(isset($aadhaar_masking1[0]['aadhaar_masked_details']['status_code']) && ($aadhaar_masking1[0]['aadhaar_masked_details']['status_code'] == '404' || $aadhaar_masking1[0]['aadhaar_masked_details']['status_code'] == '400'))
<div class="alert alert-danger" role="alert">
Server Error, Please try later
</div>
@endif
@if(isset($aadhaar_masking1[0]['aadhaar_masked_details']['status_code']) && $aadhaar_masking1[0]['aadhaar_masked_details']['status_code'] == '500')
<div class="alert alert-danger" role="alert">
Internal Server Error. Please contact techsupport@docboyz.in. for more details.
</div>
@endif
@if(isset($aadhaar_masking1['status_code']) && $aadhaar_masking1['status_code'] == '401')
<div class="alert alert-danger" role="alert">
Error. Please contact techsupport@docboyz.in. for more details.
</div>
@endif