@if (isset($pantogstDetails['statusCode']) && $pantogstDetails['statusCode'] == 102)
<div class="alert alert-danger" role="alert">
      {{$error_message}}
</div>  
@endif
@if (isset($pantogstDetails['statusCode']) && $pantogstDetails['statusCode'] ==103)
  <div class="alert alert-danger" role="alert">
       {{$error_message}}
   </div>  
 @endif

@if(isset($pantogstDetails[0]['statusCode']) && $pantogstDetails[0]['statusCode']==403)
<div class="alert alert-danger" role="alert">
     {{$error_message}}
</div>  
@endif
@if(isset($pantogstDetails[0]['statusCode']) && $pantogstDetails[0]['statusCode']==404)
<div class="alert alert-danger" role="alert">
     {{$error_message}}
</div>  
@endif
@if(isset($pangststatusCode) && $pangststatusCode==500)
<div class="alert alert-danger" role="alert">
     Internal Server Error.
</div>  
@endif