<!--Email verify check Api Error--->
@if (isset($check_verify_email_status['statusCode']) && $check_verify_email_status['statusCode'] == 102)
<div class="alert alert-danger" role="alert">
    {{ $error_message }}
</div>
@endif
@if (isset($check_verify_email_status['statusCode']) && $check_verify_email_status['statusCode'] == 103)
<div class="alert alert-danger" role="alert">
    {{ $error_message }}
</div>
@endif
@if (isset($check_verify_email_status['statusCode']) && $check_verify_email_status['statusCode'] == 500)
<div class="alert alert-danger" role="alert">
    {{ $error_message }}
</div>
@endif
<!--Email verify check end-->