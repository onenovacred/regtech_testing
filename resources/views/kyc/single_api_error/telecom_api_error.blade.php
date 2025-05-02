@if(isset($telecom['statusCode']) && $telecom['statusCode'] == '102')
<div class="alert alert-danger" role="alert">
    Wrong Phone Number. 
</div>
@endif

@if(isset($telecom['statusCode']) && $telecom['statusCode'] == '404')
<div class="alert alert-danger" role="alert">
Server Error, Please try later
</div>
@endif
@if(isset($telecom['statusCode']) && $telecom['statusCode'] == '401')
<div class="alert alert-danger" role="alert">
    Error. Please contact techsupport@docboyz.in. for more details
</div>
@endif
@if(isset($telecom['statusCode']) && $telecom['statusCode'] == '400')
<div class="alert alert-danger" role="alert">
Wrong Phone Number.
</div>
@endif
@if(isset($telecom['statusCode']) && $telecom['statusCode'] == '500')
<div class="alert alert-danger" role="alert">
Internal Server Error. Please contact techsupport@docboyz.in. for more details.
</div>
@endif
@if(isset($telecom['statusCode']) && $telecom['statusCode'] == '103')
<div class="alert alert-danger" role="alert">
    You are not registered to use this service. Please update your plan.
</div>
@endif
