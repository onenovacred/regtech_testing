 <!--Email verify error start-->
 @if (isset($verify_email['statusCode']) && $verify_email['statusCode'] == 102)
 <div class="alert alert-danger" role="alert">
     {{$error_message}}
 </div>
 @endif
 @if (isset($verify_email['statusCode']) &&  $verify_email['statusCode']==103)
   <div class="alert alert-danger" role="alert">
     {{$error_message}}
    </div> 
 @endif
 @if (isset($verify_email['statusCode']) && $verify_email['statusCode']==500)
        <div class="alert alert-danger" role="alert">
         {{$error_message}}
          </div> 
 @endif
 <!--Email Verify End-->