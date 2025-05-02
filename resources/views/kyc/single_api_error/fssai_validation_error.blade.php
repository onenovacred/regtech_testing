@if(isset($fssi_validation['statusCode']) && $fssi_validation['statusCode'] == '102')
<div class="alert alert-danger" role="alert">
    FSSAI is Invalid 
</div>
@endif
@if(isset($fssi_validation['statusCode']) && $fssi_validation['statusCode'] == '404' || isset($fssi_validation['statusCode']) && $fssi_validation['statusCode'] == '400')
<div class="alert alert-danger" role="alert">
Server Error, Please try later
</div>
@endif
@if(isset($fssi_validation['statusCode']) && $fssi_validation['statusCode'] == '500')
<div class="alert alert-danger" role="alert">
Internal Server Error. Please contact techsupport@docboyz.in. for more details.
</div>
@endif
@if(isset($fssi_validation['statusCode']) && $fssi_validation['statusCode'] == '401')
<div class="alert alert-danger" role="alert">
      Error. Please contact techsupport@docboyz.in. for more details.
</div>
@endif
@if(isset($fssi_validation['statusCode']) && $fssi_validation['statusCode'] == '103')
<div class="alert alert-danger" role="alert">
    You are not register.Please update your plan.
</div>
@endif