 <!--CkycSearch Api Error-->
 @if (isset($statusCodeCkyc) && $statusCodeCkyc == 102)
 <div class="alert alert-danger" role="alert">
   Please enter vaild information.
 </div>
 @endif
@if (isset($statusCodeCkyc) && $statusCodeCkyc == 103)
 <div class="alert alert-danger" role="alert">
    You are not registered to use this service.
 </div>
@endif
@if (isset($statusCodeCkyc) && $statusCodeCkyc == 500)
<div class="alert alert-danger" role="alert">
    Internal Server Error. Please contact techsupport@docboyz.in. for more details.
</div>
@endif
<!--CkycSearch Api--> 