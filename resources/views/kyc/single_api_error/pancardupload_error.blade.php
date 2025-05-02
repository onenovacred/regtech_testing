@if(isset($statusCodepanUpload) && $statusCodepanUpload == '422')
<div class="alert alert-danger" role="alert">
    PAN is Invalid 
</div>
@endif
@if(isset($statusCodepanUpload) && $statusCodepanUpload == '404' || null)
<div class="alert alert-danger" role="alert">
Server Error, Please try later
</div>
@endif
@if(isset($pancarduploade[0]['statusCode']) && $pancarduploade[0]['statusCode']=='102' || null)
<div class="alert alert-danger" role="alert">
Server Error, Please try later
</div>
@endif
