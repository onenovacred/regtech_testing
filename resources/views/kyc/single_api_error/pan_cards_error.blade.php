 <!--pan card error start-->
 @if(isset($pan_cards['statusCode']) && $pan_cards['statusCode']==102)
 <div class="alert alert-danger" role="alert">
     {{$error_message}}
 </div>  
 @endif
@if (isset($pan_cards['statusCode']) &&  $pan_cards['statusCode']==103)
  <div class="alert alert-danger" role="alert">
   {{$error_message}}
  </div>  
@endif
@if (isset($pancardStatusCode['statusCode']) &&  $pancardStatusCode['statusCode']==103)
<div class="alert alert-danger" role="alert">
 Internal Server Error.
</div>  
@endif
<!--pan card error end-->