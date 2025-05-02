@if(isset($statusCodeAadhaarUpload) && $statusCodeAadhaarUpload == '102')
<div class="alert alert-danger" role="alert">
    Aadhaar is Invalid 
</div>
@endif
@if(isset($statusCodeAadhaarUpload) && $statusCodeAadhaarUpload== '404')
<div class="alert alert-danger" role="alert">
Server Error, Please try later
</div>
@endif
@if(isset($statusCodeAadhaarUpload) && $statusCodeAadhaarUpload == '500')
<div class="alert alert-danger" role="alert">
Internal Server Error. Please contact techsupport@docboyz.in. for more details.
</div>
@endif
