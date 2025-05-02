@if (isset($upidetails['statusCode']) && $upidetails['statusCode'] == 102)
<div class="alert alert-danger" role="alert">
    Please enter valid details
</div>
@endif
@if (isset($upidetails['statusCode']) && $upidetails['statusCode'] ==400 || isset($upidetails['statusCode']) && $upidetails['statusCode'] ==404)
<div class="alert alert-danger" role="alert">
    Server Error, Please try later
</div>
@endif
@if (isset($upistatusCode) && $upistatusCode == '500')
<div class="alert alert-danger" role="alert">
    Internal Server Error. Please contact techsupport@docboyz.in. for more details.
</div>
@endif
@if (isset($upidetails['statusCode']) && $upidetails['statusCode'] =='103')
<div class="alert alert-danger" role="alert">
  {{$upidetails['message']}}
</div>
@endif