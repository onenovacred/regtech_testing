@if(isset($facematch_details['statusCode']) && $facematch_details['statusCode']== 102)
<div class="alert alert-danger" role="alert">
    Face detection failed.
</div>
@endif
@if(isset($facematch_details['statusCode']) && $facematch_details['statusCode']== 103)
<div class="alert alert-danger" role="alert">
   You are not registered to use this service. Please update your plan.
</div>
@endif
@if(isset($facematch_details['status_code']) && $facematch_details['status_code']== 500)
<div class="alert alert-danger" role="alert">
Internal Server Error. Please contact techsupport@docboyz.in. for more details.
</div>
@endif