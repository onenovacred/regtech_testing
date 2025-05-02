@if(isset($rc_validationLite['statusCode']) && $rc_validationLite['statusCode'] == '102')
<div class="alert alert-danger" role="alert">
    Invalid RC Number / RC Number in Multiple RTOs. Error Code - 102 
</div>
@endif
@if(isset($rc_validationLite['statusCode']) && $rc_validationLite['statusCode'] == '101')
<div class="alert alert-danger" role="alert">
    RC Number in Multiple RTOs. Error Code - 101
</div>
@endif
@if(isset($rc_validationLite['statusCode']) && ($rc_validationLite['statusCode'] == '404' || $rc_validationLite['statusCode'] == '400' || $rc_validationLite['statusCode'] == '401'))
<div class="alert alert-danger" role="alert">
Server Error, Please try later
</div>
@endif
@if(isset($rc_validationLite['statusCode']) && $rc_validationLite['statusCode'] == '500')
<div class="alert alert-danger" role="alert">
  Internal Server Error. Please contact techsupport@docboyz.in. for more details.
</div>
@endif