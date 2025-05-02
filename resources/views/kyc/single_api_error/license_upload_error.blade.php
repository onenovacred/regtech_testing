@if(isset($licenseUpload['statusCode']) && $licenseUpload['statusCode'] == '102')
<div class="alert alert-danger" role="alert">
    License is Invalid 
</div>
@endif
@if(isset($licenseUpload['statusCode']) && $licenseUpload['statusCode'] == '404' || isset($licenseUpload['statusCode']) && $licenseUpload['statusCode'] == '400')
<div class="alert alert-danger" role="alert">
Server Error, Please try later
</div>
@endif
@if(isset($licenseUpload['statusCode']) && $licenseUpload['statusCode'] == '500')
<div class="alert alert-danger" role="alert">
Internal Server Error. Please contact techsupport@docboyz.in. for more details.
</div>
@endif