@if (isset($lincense_extract['status_code']) && $lincense_extract['status_code'] == 102)
<div class="alert alert-danger" role="alert">
    Invalid file type, must be an driving license image.
</div>
@endif
@if (isset($lincense_extract['status_code']) && $lincense_extract['status_code'] == 404)
<div class="alert alert-danger" role="alert">
     No file provided.
</div>
@endif
@if (isset($lincense_extract['statusCode']) && $lincense_extract['statusCode'] == 103)
<div class="alert alert-danger" role="alert">
You are not registered to use this service. Please update your plan.
</div>
@endif
@if (isset($astatusCode) &&$astatusCode == 500)
<div class="alert alert-danger" role="alert">
    Internal Server Error. Please contact techsupport@docboyz.in. for more details.
</div>
@endif