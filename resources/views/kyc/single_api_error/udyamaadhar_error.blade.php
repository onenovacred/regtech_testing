 <!----Udoyg aadhar Api error-->
 @if (isset($udyamaadhar['statusCode']) && $udyamaadhar['statusCode'] == 102)
 <div class="alert alert-danger" role="alert">
     Udyam Number is Invalid
 </div>
@endif
@if (isset($udyamaadhar['statusCode']) && $udyamaadhar['statusCode'] == 404)
 <div class="alert alert-danger" role="alert">
     Server Error. Please try again later.
 </div>
@endif
@if (isset($udyamaadhar['statusCode']) && $udyamaadhar['statusCode'] == 401)
 <div class="alert alert-danger" role="alert">
    Error. Please contact techsupport@docboyz.in. for more details.
 </div>
@endif
@if (isset($udyamaadhar['statusCode']) && $udyamaadhar['statusCode'] == 500)

 <div class="alert alert-danger" role="alert">
     Internal Server Error. Please contact techsupport@docboyz.in. for more details.
 </div>
@endif
@if (isset($udyamaadhar['statusCode']) && $udyamaadhar['statusCode'] == 103)

 <div class="alert alert-danger" role="alert">
     You are not registered to use this service. Please update your plan.
 </div>
@endif
