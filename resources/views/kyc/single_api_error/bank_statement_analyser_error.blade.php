@if(isset($bank_statement_analyser['statusCode']) && $bank_statement_analyser['statusCode'] == 102)
<div class="alert alert-danger" role="alert">
    Please enter valid bank name. 
</div>
@endif
@if(isset($bank_statement_analyser['statusCode']) && $bank_statement_analyser['statusCode'] == 500)
<div class="alert alert-danger" role="alert">
Internal Server Error. Please contact techsupport@docboyz.in. for more details.
</div>
@endif
@if(isset($bank_statement_analyser['statusCode']) && $bank_statement_analyser['statusCode'] == 103)
<div class="alert alert-danger" role="alert">
You are not registered to use this service. Please update your plan.
</div>
@endif