@if(isset($corporate_din1['status_code']) && $corporate_din1['status_code'] == '102')
<div class="alert alert-danger" role="alert">
    CORPORATE DIN is Invalid 
</div>
@endif
@if(isset($corporate_din1['statusCode']) && ($corporate_din1['statusCode'] == '404' || $corporate_din1['statusCode']== '400'))
<div class="alert alert-danger" role="alert">
    Server Error, Please try later
</div>
@endif
@if(isset($corporate_din1['statusCode']) &&  $corporate_din1['statusCode']== '500')
<div class="alert alert-danger" role="alert">
    Internal Server Error. Please contact techsupport@docboyz.in. for more details.
</div>
@endif
@if(isset($corporate_din1['statusCode']) &&  $corporate_din1['statusCode']== '401')
<div class="alert alert-danger" role="alert">
    Error. Please contact techsupport@docboyz.in. for more details.
</div>
@endif