@if(isset($pancard_search['statusCode']) && $pancard_search['statusCode'] == '102')
<div class="alert alert-danger" role="alert">
    PAN Number is Invalid 
</div>
@endif
@if(isset($pancard_search['statusCode']) && ($pancard_search['statusCode'] == '404'))
<div class="alert alert-danger" role="alert">
Server Error. Please try again later.
</div>
@endif
@if(isset($pancard_search['statusCode']) && $pancard_search['statusCode'] == '500') 
<div class="alert alert-danger" role="alert">
    Internal Server Error. Please contact techsupport@docboyz.in. for more details.
</div>
@endif
@if(isset($pancard_search['statusCode']) && $pancard_search['statusCode'] == '103') 
<div class="alert alert-danger" role="alert">
    You are not registered to use this service. Please update your plan.
</div>
@endif