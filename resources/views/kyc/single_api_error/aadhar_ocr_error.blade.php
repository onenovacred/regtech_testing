 <!---Aadhar Card OCR Error Message-->
 @if (isset($aadharcardocr['status_code']) && $aadharcardocr['status_code'] == 102)
 <div class="alert alert-danger" role="alert">
     Invalid file type, must be an aadhar card image.
 </div>
@endif
@if (isset($aadharcardocr['statusCode']) && $aadharcardocr['statusCode'] == 103)
<div class="alert alert-danger" role="alert">
      {{$aadharcardocr['message']}}
</div>
@endif
@if (isset($aadharcardocr['status_code']) && $aadharcardocr['status_code'] == 404)
<div class="alert alert-danger" role="alert">
      No file provided.
</div>
@endif
@if (isset($astatusCode) &&$astatusCode == 500)
 <div class="alert alert-danger" role="alert">
     Internal Server Error. Please contact techsupport@docboyz.in. for more details.
 </div>
@endif