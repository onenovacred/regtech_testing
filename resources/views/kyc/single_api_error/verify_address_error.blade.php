  <!--Address Verify Error -->
  @if (isset($verify_address['status_code']) && $verify_address['status_code'] == 102)
  <div class="alert alert-danger" role="alert">
      {{$error_message}}
  </div>
 
   @endif
 @if (isset($verify_address['statusCode']) &&  $verify_address['statusCode']==103)
  <div class="alert alert-danger" role="alert">
      {{$error_message}}
   </div> 
  @endif
 @if (isset($verify_address[0]['statusCode']) && $verify_address[0]['statusCode']==403)
 <div class="alert alert-danger" role="alert">
     {{$error_message}}
  </div> 
   @endif
 @if (isset($verify_address['status_code']) &&  $verify_address['status_code']==202)
 <div class="alert alert-danger" role="alert">
     {{$error_message}}
  </div> 
  @endif
   @if (isset($verifyaddstatusCode) && $verifyaddstatusCode== 500)
   <div class="alert alert-danger" role="alert">
        Internal server error Please contact techsupport@docboyz.in for more details.
    </div>
@endif