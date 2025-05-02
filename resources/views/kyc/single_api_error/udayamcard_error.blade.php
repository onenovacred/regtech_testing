@if (isset($udyamcard['statusCode']) && $udyamcard['statusCode'] == '102')
<div class="alert alert-danger" role="alert">
    Udyam Number is Invalid
</div>
@endif
@if (isset($udyamcard['statusCode']) && $udyamcard['statusCode'] == '103')
<div class="alert alert-danger" role="alert">
    {{ $udyamcard['message'] }}
</div>
@endif
@if (isset($udyamcard['statusCode']) && $udyamcard['statusCode'] == '404')
<div class="alert alert-danger" role="alert">
    Server Error. Please try again later.
</div>
@endif
@if (isset($udyamcard['statusCode']) && $udyamcard['statusCode'] == '500')

<div class="alert alert-danger" role="alert">
    Internal Server Error. Please contact techsupport@docboyz.in. for more details.
</div>
@endif
@if (isset($udyamcard['statusCode']) && $udyamcard['statusCode'] == '401')

<div class="alert alert-danger" role="alert">
    Error. Please contact techsupport@docboyz.in. for more details.
</div>
@endif
