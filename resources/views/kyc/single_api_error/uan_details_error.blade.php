@if(isset($uan_details['statusCode']) && $uan_details['statusCode'] == '102')
<div class="alert alert-danger" role="alert">
    Please enter valid details
</div>
@endif
@if(isset($uan_details['statusCode']) && $uan_details['statusCode'] == '404' || isset($uan_details['statusCode']) && $uan_details['statusCode']== '400')
<div class="alert alert-danger" role="alert">
Server Error, Please try later
</div>
@endif
@if(isset($uan_details['statusCode']) && $uan_details['statusCode'] == '500')
<div class="alert alert-danger" role="alert">
Internal Server Error. Please contact techsupport@docboyz.in. for more details.
</div>
@endif
@if(isset($uan_details['statusCode']) && $uan_details['statusCode'] == '401')
<div class="alert alert-danger" role="alert">
    Error. Please contact techsupport@docboyz.in. for more details
</div>
@endif