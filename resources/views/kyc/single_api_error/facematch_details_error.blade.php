@if(isset($facematch_details1['statusCode']) && $facematch_details1['statusCode'] == 102)
<div class="alert alert-danger" role="alert">
    face recognition is not defined.
</div>
@endif
@if(isset($facematch_details1['statusCode']) && $facematch_details1['statusCode'] == 103)
<div class="alert alert-danger" role="alert">
     You are not registered to use this service. Please update your plan.
</div>
@endif
@if(isset($facematch_details1['statusCode']) && $facematch_details1['statusCode'] == 500)
<div class="alert alert-danger" role="alert">
Internal Server Error. Please contact techsupport@docboyz.in. for more details.
</div>
@endif