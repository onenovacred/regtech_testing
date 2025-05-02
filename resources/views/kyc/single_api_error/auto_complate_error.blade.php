  <!--Auto Complate Api Error Code-->
  @if (isset($auto_complate['status_code']) && $auto_complate['status_code'] == 102)
  <div class="alert alert-danger" role="alert">
      {{$error_message}}
  </div>
  @endif
@if (isset($auto_complate['statusCode']) &&  $auto_complate['statusCode']==103)
  <div class="alert alert-danger" role="alert">
      {{$error_message}}
  </div> 
@endif
@if (isset($auto_complate[0]['statusCode']) && $auto_complate[0]['statusCode']==403)
 <div class="alert alert-danger" role="alert">
     {{$error_message}}
  </div> 
@endif
@if (isset($auto_complate[0]['statusCode']) && $auto_complate[0]['statusCode']==404)
 <div class="alert alert-danger" role="alert">
    {{$error_message}}
  </div> 
@endif
 @if (isset($autostatusCode) && $autostatusCode== 500)
  <div class="alert alert-danger" role="alert">
     Internal server error Please contact techsupport@docboyz.in for more details.
   </div>
@endif