@if (isset($license_validation['statusCode']) && $license_validation['statusCode'] == '102')
<div class="alert alert-danger" role="alert">
    License Number is Invalid
</div>
@endif
@if (isset($license_validation['statusCode']) && ($license_validation['statusCode'] == '404' || null))
<div class="alert alert-danger" role="alert">
    Server Error, Please try later
</div>
@endif
@if (isset($license_validation['statusCode']) && $license_validation['statusCode'] == '500')
<div class="alert alert-danger" role="alert">
    Internal Server Error. Please contact techsupport@docboyz.in. for more details.
</div>
@endif
@if (isset($license_validation['statusCode']) && $license_validation['statusCode'] == '103')
<div class="alert alert-danger" role="alert">
     {{$license_validation['message']}}
</div>
@endif
@if (isset($license_validation['statusCode']) && $license_validation['statusCode'] == 400)
<div class="alert alert-danger" role="alert">
    Error. Please contact techsupport@docboyz.in. for more details
</div>
@endif