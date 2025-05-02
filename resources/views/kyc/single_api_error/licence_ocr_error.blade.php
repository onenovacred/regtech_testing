 <!-- Linces ocr error Message-->
 @if (isset($lincensedocr['status_code']) && $lincensedocr['status_code'] == 102)
 <div class="alert alert-danger" role="alert">
     Invalid file type, must be an driving license image.
 </div>
@endif
@if (isset($lincensedocr['status_code']) && $lincensedocr['status_code'] == 404)
<div class="alert alert-danger" role="alert">
      No file provided.
</div>
@endif
@if (isset($lincensedocr['statusCode']) && $lincensedocr['statusCode'] == 103)
<div class="alert alert-danger" role="alert">
      {{$lincensedocr['message']}}
</div>
@endif
@if (isset($listatusCode) &&$listatusCode == 500)
 <div class="alert alert-danger" role="alert">
     Internal Server Error. Please contact techsupport@docboyz.in. for more details.
 </div>
@endif