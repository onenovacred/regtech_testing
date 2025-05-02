@if(isset($statusCodeUploadPassport) && $statusCodeUploadPassport == '422')
<div class="alert alert-danger" role="alert">
    Passport is Invalid 
</div>
@endif
@if(isset($statusCodeUploadPassport) && ($statusCodeUploadPassport == '404' || $statusCodeUploadPassport == '400'))
<div class="alert alert-danger" role="alert">
Server Error, Please try later
</div>
@endif
@if(isset($statusCodeUploadPassport) && $statusCodeUploadPassport == '500')
<div class="alert alert-danger" role="alert">
Internal Server Error. Please contact techsupport@docboyz.in. for more details.
</div>
@endif