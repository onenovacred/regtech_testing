  <!--pancard varification Api Error-->
  @if(isset($pancardVerification['statusCode']) && $pancardVerification['statusCode'] == 102)
  <div class="alert alert-danger" role="alert">
      {{$pancardVerification['message']}}
  </div>
 @endif
@if(isset($pancardVerification['statusCode'])&& $pancardVerification['statusCode'] ==404)
  <div class="alert alert-danger" role="alert">
    {{$pancardVerification['message']}}
 </div>
 @endif
 @if(isset($pancardVerification['statusCode']) && $pancardVerification['statusCode'] == 403)
  <div class="alert alert-danger" role="alert">
     {{$pancardVerification['message']}}
    </div>
  @endif
 @if(isset($pancardVerification['statusCode']) && ($pancardVerification['statusCode'] ==103))
      <div class="alert alert-danger" role="alert">
     {{$pancardVerification['message']}}
   </div>
 @endif
 @if(isset($pancardVerification['statusCode']) && $pancardVerification['statusCode'] ==500)
  <div class="alert alert-danger" role="alert">
      {{$pancardVerification['message']}}
   </div>
  @endif
  <!--Pancard  varification Api Error End-->