   <!--Passport  Ocr Error message-->
   @if (isset($passport['status_code']) && $passport['status_code'] == 102)
   <div class="alert alert-danger" role="alert">
       Failed to extract MRZ information.
   </div>
@endif
@if (isset($passport['statusCode']) && $passport['statusCode'] == 103)
<div class="alert alert-danger" role="alert">
    {{$passport['message']}}
</div>
@endif
@if (isset($passport['status_code']) && $passport['status_code'] == 404)
<div class="alert alert-danger" role="alert">
       No file provided.
</div>
@endif
@if (isset($pstatusCode) && $pstatusCode == 500)
   <div class="alert alert-danger" role="alert">
       Internal Server Error. Please contact techsupport@docboyz.in. for more details.
   </div>
@endif