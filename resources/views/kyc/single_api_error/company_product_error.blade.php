@if (isset($companyProductDetails['status_code']) && $companyProductDetails['status_code'] == 102)
<div class="alert alert-danger" role="alert">
    Invalid companyName or flrsLicenseNo
</div>
@endif
@if(isset($companyProductDetails['statusCode']) && $companyProductDetails['statusCode'] == 103)
<div class="alert alert-danger" role="alert">
    You are not registered to use this service. Please update your plan.
</div>
@endif
@if(isset($companyProductDetails['status_code']) && $companyProductDetails['status_code'] == 500)
<div class="alert alert-danger" role="alert">
Internal Server Error. Please contact techsupport@docboyz.in. for more details.
</div>
@endif