@if(isset($passport_create_client['statusCode']) &&  $passport_create_client['statusCode']== '102')
<div class="alert alert-danger" role="alert">
    Passport Create Client failed 
</div>
@endif
@if(isset($passport_create_client['statusCode']) &&  $passport_create_client['statusCode'] == '404' || isset($passport_create_client['statusCode']) &&  $passport_create_client['statusCode'] == '400'))
<div class="alert alert-danger" role="alert">
Server Error, Please try later
</div>
@endif
@if(isset($passport_create_client['statusCode']) &&  $passport_create_client['statusCode'] == '500')
<div class="alert alert-danger" role="alert">
Internal Server Error. Please contact techsupport@docboyz.in. for more details.
</div>
@endif
@if(isset($passport_create_client['statusCode']) &&  $passport_create_client['statusCode'] == '401')
<div class="alert alert-danger" role="alert">
Error. Please contact techsupport@docboyz.in. for more details.
</div>
@endif