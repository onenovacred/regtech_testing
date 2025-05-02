 <!--Dedup Error Start-->
 @if (isset($dedupe_details['statusCode']) && $dedupe_details['statusCode'] == 102)
 <div class="alert alert-danger" role="alert">
     {{$error_message}}
 </div>
@endif
@if (isset($dedupe_details['statusCode']) &&  $dedupe_details['statusCode']==103)
 <div class="alert alert-danger" role="alert">
     {{$error_message}}
 </div> 
@endif
@if (isset($dedupe_details['statusCode']) && $dedupe_details['statusCode']==500)
<div class="alert alert-danger" role="alert">
 {{$error_message}}
</div> 
@endif
 <!--Dedupe End Error-->