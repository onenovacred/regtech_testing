@if(isset($rc_challan['statusCode']) && $rc_challan['statusCode'] == '102')
<div class="alert alert-danger" role="alert">
    RC Number is Invalid. Error Code - 102 
</div>
@endif
@if(isset($rc_challan['statusCode']) && $rc_challan['statusCode'] == '101')
<div class="alert alert-danger" role="alert">
    RC Number in Multiple RTOs. Error Code - 101
</div>
@endif
@if(isset($rc_challan['statusCode']) && ($rc_challan['statusCode'] == '404' || $rc_challan['statusCode'] == '400'))
<div class="alert alert-danger" role="alert">
    Server Error, Please try later
</div>
@endif
@if(isset($rc_challan['statusCode']) && $rc_challan['statusCode'] == '500')
<div class="alert alert-danger" role="alert">
   Internal Server Error. Please contact techsupport@docboyz.in. for more details.
</div>
@endif