@if (isset($aadhaar_otp_genrate['statusCode']) && $aadhaar_otp_genrate['statusCode'] == '102')
<div class="alert alert-danger" role="alert">
    Aadhaar is Invalid
</div>
@endif
@if (isset($aadhaar_otp_genrate[0]['aadhaar_validation']['statusCode']) &&
    $aadhaar_otp_genrate[0]['aadhaar_validation']['statusCode'] == '422')
<div class="alert alert-danger" role="alert">
    Verification Failed Invalid Aadhar Number.
</div>
@endif
@if (isset($aadhaar_otp_genrate['statusCode']) && $aadhaar_otp_genrate['statusCode'] == '404')
<div class="alert alert-danger" role="alert">
    Server Error, Please try later
</div>
@endif
@if (isset($aadhaar_otp_genrate['statusCode']) && $aadhaar_otp_genrate['statusCode'] == '500')
<div class="alert alert-danger" role="alert">
    Internal Server Error. Please contact techsupport@docboyz.in. for more details.
</div>
@endif
@if (isset($aadhaar_otp_genrate['statusCode']) && $aadhaar_otp_genrate['statusCode'] == '409')
<div class="alert alert-danger" role="alert">
    Error. Please contact techsupport@docboyz.in. for more details
</div>
@endif
@if (isset($aadhaar_otp_genrate['statusCode']) && $aadhaar_otp_genrate['statusCode'] == '103')
<div class="alert alert-danger" role="alert">
     {{$aadhaar_otp_genrate['message']}} 
</div>
@endif