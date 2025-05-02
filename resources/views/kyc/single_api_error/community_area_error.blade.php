@if(isset($community_details['statusCode']) && $community_details['statusCode'] == 102)
<div class="alert alert-danger" role="alert">
    Please enter valid details
</div>
@endif
@if(isset($community_details['statusCode']) && $community_details['statusCode']==202)
<div class="alert alert-danger" role="alert">
Server Error, Please try later
</div>
@endif
@if(isset($community_details['statusCode']) && $community_details['statusCode'] == 500)
<div class="alert alert-danger" role="alert">
Internal Server Error. Please contact techsupport@docboyz.in. for more details.
</div>
@endif
@if(isset($community_details['statusCode']) && $community_details['statusCode'] == 103)
<div class="alert alert-danger" role="alert">
You are not registered to use this service. Please update your plan.
</div>
@endif