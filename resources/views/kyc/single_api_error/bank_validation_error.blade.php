@if(isset($bank_verification['statusCode']) && $bank_verification['statusCode'] == '102')
<div class="alert alert-danger" role="alert">
    Please enter valid details. 
</div>
@endif
@if(isset($bank_verification['status_code']) && ($bank_verification['status_code'] == '404' || isset($bank_verification['status_code']) && $bank_verification['status_code'] == '401'))
<div class="alert alert-danger" role="alert">
    Error. Please contact techsupport@docboyz.in. for more details.
</div>
@endif
@if(isset($bank_verification['statusCode']) && $bank_verification['statusCode'] == '500')
<div class="alert alert-danger" role="alert">
Internal Server Error. Please contact techsupport@docboyz.in. for more details.
</div>
@endif
@if(isset($bank_verification['statusCode']) && $bank_verification['statusCode'] == '103')
<div class="alert alert-danger" role="alert">
    You are not registered to use this service. Please update your plan.
</div>
@endif
