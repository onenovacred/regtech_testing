@if(isset($epfo_details['statusCode']) && $epfo_details['statusCode'] == '102')
<div class="alert alert-danger" role="alert">
    Company Name is Invalid. Please enter correct. 
</div>
@endif
@if(isset($epfo_details['statusCode']) && ($epfo_details['statusCode'] == '404' || $epfo_details['statusCode'] == '400'))
<div class="alert alert-danger" role="alert">
    Server Error, Please try later
</div>
@endif
@if(isset($epfo_details['statusCode']) &&  $epfo_details['statusCode'] == '500')
<div class="alert alert-danger" role="alert">
    Internal Server Error. Please contact techsupport@docboyz.in. for more details.
</div>
@endif
@if(isset($epfo_details['statusCode']) &&  $epfo_details['statusCode'] == '401')
<div class="alert alert-danger" role="alert">
 Error. Please contact techsupport@docboyz.in. for more details.
</div>
@endif
@if(isset($epfo_details['statusCode']) &&  $epfo_details['statusCode'] == '103')
<div class="alert alert-danger" role="alert">
You are not registered to use this service. Please update your plan.
</div>
@endif