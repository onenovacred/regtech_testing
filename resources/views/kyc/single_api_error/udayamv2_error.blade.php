   <!--Udyam search v2 error start--->
   @if(isset($udyamcardv2['status_code']) && $udyamcardv2['status_code']==202)
   <div class="alert alert-danger" role="alert">
         {{$udyamcardv2['message']}}
   </div>
   @endif
   @if(isset($udyamcardv2['status_code']) && $udyamcardv2['status_code']==103)
   <div class="alert alert-danger" role="alert">
         {{$udyamcardv2['message']}}
   </div>
   @endif
   @if(isset($udyamcardv2[0]['statusCode']) && $udyamcardv2[0]['statusCode']==403)
   <div class="alert alert-danger" role="alert">
         {{$udyamcardv2[0]['message']}}
   </div>
   @endif
   @if(isset($udyamcardv2statusCode) && $udyamcardv2statusCode==500)
   <div class="alert alert-danger" role="alert">
          Internal Server Error. Please contact techsupport@docboyz.in. 
   </div>
   @endif