@if(isset($shopestablishment['statusCode']) && $shopestablishment['statusCode'] == '102')
<div class="alert alert-danger" role="alert">
    Shop establishment is Invalid 
</div>
@endif
@if(isset($shopestablishment['statusCode']) && ($shopestablishment['statusCode'] == '404' || $shopestablishment['statusCode'] == '400'))
<div class="alert alert-danger" role="alert">
Server Error, Please try later
</div>
@endif
@if(isset($shopestablishment['statusCode']) && $shopestablishment['statusCode'] == '500')
<div class="alert alert-danger" role="alert">
Internal Server Error. Please contact techsupport@docboyz.in. for more details.
</div>
@endif
@if(isset($shopestablishment['statusCode']) && $shopestablishment['statusCode'] == '103')
<div class="alert alert-danger" role="alert">
    You are not registered to use this service. Please update your plan.
</div>
@endif