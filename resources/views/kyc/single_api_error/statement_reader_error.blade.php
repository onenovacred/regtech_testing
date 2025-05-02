@if(isset($bank_statement_reader['statusCode']) && $bank_statement_reader['statusCode'] == 102)
<div class="alert alert-danger" role="alert">
    Please enter bank name. 
</div>
@endif
@if(isset($bank_statement_reader['statusCode']) && $bank_statement_reader['statusCode'] == 500)
<div class="alert alert-danger" role="alert">
Internal Server Error. Please contact techsupport@docboyz.in. for more details.
</div>
@endif
@if(isset($bank_statement_reader['statusCode']) && $bank_statement_reader['statusCode'] == 103)
<div class="alert alert-danger" role="alert">
  You are not registered to use this service. Please update your plan.
</div>
@endif