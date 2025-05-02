  <!--Pancard Ocr Error message-->
  @if (isset($pancard['status_code']) && $pancard['status_code']==102)
  <div class="alert alert-danger" role="alert">
      Invalid file only upload Pancard image.
  </div>
@endif
@if (isset($pancard['status_code']) && $pancard['status_code']==404)
  <div class="alert alert-danger" role="alert">
      No Image file provided.
  </div>
@endif
@if (isset($pancard['statusCode']) && $pancard['statusCode']==103)
<div class="alert alert-danger" role="alert">
     {{$pancard['message']}}
</div>
@endif
@if (isset($pastatusCode) && $pastatusCode==500)
  <div class="alert alert-danger" role="alert">
      Internal server error Please contact techsupport@docboyz.in for more details.
  </div>
@endif