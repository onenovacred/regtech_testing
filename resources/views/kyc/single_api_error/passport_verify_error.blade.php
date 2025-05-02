@if(isset($passport_verify1['statusCode']) && $passport_verify1['statusCode'] == '102')
<div class="alert alert-danger" role="alert">
    File Number is Invalid 
</div>
@endif
@if(isset($passport_verify1['statusCode']) && $passport_verify1['statusCode'] == '404' || null)
<div class="alert alert-danger" role="alert">
Server Error, Please try later
</div>
@endif
@if(isset($passport_verify1['statusCode']) && $passport_verify1['statusCode'] == '500')
<div class="alert alert-danger" role="alert">
Internal server error. Please contact techsupport@docboyz.in. for more details
</div>
@endif
@if(isset($passport_verify1['statusCode']) && $passport_verify1['statusCode'] == '401')
<div class="alert alert-danger" role="alert">
   Error. Please contact techsupport@docboyz.in. for more details
</div>
@endif


