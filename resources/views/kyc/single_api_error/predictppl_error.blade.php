@if (isset($predictppl_details['statusCode']) && $predictppl_details['statusCode'] == 102)
<div class="alert alert-danger" role="alert">
    Invalid file.Please upload csv file.
</div>
@endif
@if (isset($predictppl_details['statusCode']) && $predictppl_details['statusCode'] == 404)
<div class="alert alert-danger" role="alert">
    Server Error, Please try later
</div>
@endif
@if (isset($predictppl_details['statusCode']) && $predictppl_details['statusCode'] == 500)
<div class="alert alert-danger" role="alert">
    Internal server error. Please contact techsupport@docboyz.in. for more details
</div>
@endif
@if (isset($predictppl_details['statusCode']) && $predictppl_details['statusCode'] == 103)
<div class="alert alert-danger" role="alert">
    You are not registered to use this service. Please update your plan.
</div>
@endif