@if(isset($company_search['statusCode']) && $company_search['statusCode'] == '102')
<div class="alert alert-danger" role="alert">
    Please enter valid details
</div>
@endif
@if(isset($company_search['statusCode']) && $company_search['statusCode']  == '404' ||isset($company_search['statusCode']) && $company_search['statusCode'] == '400')
<div class="alert alert-danger" role="alert">
Server Error, Please try later
</div>
@endif
@if(isset($company_search['statusCode']) && $company_search['statusCode'] == '500')
<div class="alert alert-danger" role="alert">
Internal Server Error. Please contact techsupport@docboyz.in. for more details.
</div>
@endif
@if(isset($company_search['statusCode']) && $company_search['statusCode'] == '103')
<div class="alert alert-danger" role="alert">
    You are not registered to use this service. Please update your plan.
</div>
@endif