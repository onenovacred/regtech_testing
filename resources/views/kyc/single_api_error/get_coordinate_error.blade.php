 <!--GET coordinate Api-->
 @if (isset($get_coordinate['status_code']) && $get_coordinate['status_code'] == 102)
 <div class="alert alert-danger" role="alert">
     {{$error_message}}
 </div>
@endif
@if (isset($get_coordinate['statusCode']) &&  $get_coordinate['statusCode']==103)
    <div class="alert alert-danger" role="alert">
       {{$error_message}}
    </div> 
 @endif
@if (isset($get_coordinate[0]['statusCode']) && $get_coordinate[0]['statusCode']==403)
 <div class="alert alert-danger" role="alert">
  {{$error_message}}
 </div> 
 @endif
 @if (isset($getcostatusCode) && $getcostatusCode== 500)
   <div class="alert alert-danger" role="alert">
    Internal server error Please contact techsupport@docboyz.in for more details.
  </div>
  @endif