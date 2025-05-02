   <!--GET Place Error -->
   @if (isset($get_place['status_code']) && $get_place['status_code'] == 102)
   <div class="alert alert-danger" role="alert">
       {{$error_message}}
   </div>
  
    @endif
    @if (isset($get_place['statusCode']) &&  $get_place['statusCode']==103)
     <div class="alert alert-danger" role="alert">
       {{$error_message}}
     </div> 
    @endif
    @if (isset($get_place[0]['statusCode']) && $get_place[0]['statusCode']==403)
     <div class="alert alert-danger" role="alert">
       {{$error_message}}
     </div> 
   @endif
    @if (isset($getplace_statusCode) && $getplace_statusCode== 500)
     <div class="alert alert-danger" role="alert">
        Internal server error Please contact techsupport@docboyz.in for more details.
     </div>
    @endif