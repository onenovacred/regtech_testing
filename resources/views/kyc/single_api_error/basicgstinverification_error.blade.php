 <!--Error Basic Gstin Start-->
 @if(isset($BasicGstinVerification['statusCode']) && $BasicGstinVerification['statusCode']==102 || isset($BasicGstinVerification['status_code']) && $BasicGstinVerification['status_code']==102)
 <div class="alert alert-danger" role="alert">
  Gstin Number InValid Please Enter Valid Gstin Number
 </div>  
 @endif
@if (isset($BasicGstinVerification['statusCode']) &&  $BasicGstinVerification['statusCode']==103)
 <div class="alert alert-danger" role="alert">
   {{$error_message}}
 </div>  
@endif

@if(isset($BasicGstinVerification[0]['statusCode']) && $BasicGstinVerification[0]['statusCode']==403)
<div class="alert alert-danger" role="alert">
   {{$error_message}}
</div>  
@endif
@if(isset($BasicGstinVerification[0]['statusCode']) && $BasicGstinVerification[0]['statusCode']==404)
<div class="alert alert-danger" role="alert">
   {{$error_message}}
</div>  
@endif
@if(isset($BasicGstinVerification['statusCode']) && $BasicGstinVerification['statusCode']==500)
 <div class="alert alert-danger" role="alert">
     {{$error_message}}
 </div> 
@endif
<!--Error Basic End-->