<!--passport api error start-->
@if(isset($passportverify['statusCode']) && $passportverify['statusCode'] == '102')
<div class="alert alert-danger" role="alert">
   File Number is Invalid 
</div>
@endif
@if(isset($passportverify['statusCode']) && $passportverify['statusCode'] == '404')
 <div class="alert alert-danger" role="alert">
   Server Error, Please try later
 </div>
@endif
@if(isset($passportverify['statusCode']) && $passportverify['statusCode'] == '500')
 <div class="alert alert-danger" role="alert">
  Internal server error. Please contact techsupport@docboyz.in. for more details
</div>
@endif
<!--passport api error end-->