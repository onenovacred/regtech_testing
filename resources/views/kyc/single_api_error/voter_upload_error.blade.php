@if(isset($statusCodevoterUpload) && $statusCodevoterUpload == '102')
<div class="alert alert-danger" role="alert">
    Please enter valid details
</div>
@endif
@if(isset($statusCodevoterUpload) && ($statusCodevoterUpload == '404' || $statusCodevoterUpload == '400'))
<div class="alert alert-danger" role="alert">
Server Error, Please try later
</div>
@endif
@if(isset($statusCodevoterUpload) && $statusCodevoterUpload == '500')
<div class="alert alert-danger" role="alert">
    Internal Server Error. Please contact techsupport@docboyz.in. for more details.
</div>
@endif

@if(isset($statusCodevoterUpload) && $statusCodevoterUpload == '500')
<div class="alert alert-danger" role="alert">
    Internal Server Error. Please contact techsupport@docboyz.in. for more details.
</div>
@endif

@if(isset($statusCodevoterUpload) && $statusCodevoterUpload == '500')
<div class="alert alert-danger" role="alert">
    Internal Server Error. Please contact techsupport@docboyz.in. for more details.
</div>
@endif