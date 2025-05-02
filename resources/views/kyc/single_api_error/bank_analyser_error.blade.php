  <!--Bank Analyser Error-->
  @if(isset($bankstatement_analyser['statusCode']) && $bankstatement_analyser['statusCode'] == 102)
  <div class="alert alert-danger" role="alert">
      Invalid Bank name 
</div>
@endif
@if(isset($bankstatement_analyser['statusCode']) && $bankstatement_analyser['statusCode'] == 103)
   <div class="alert alert-danger" role="alert">
      You are not registered to use this service. Please update your plan.
  </div>
@endif
@if(isset($bankstatement_analyser['statusCode']) && $bankstatement_analyser['statusCode'] == 500)
   <div class="alert alert-danger" role="alert">
  Internal Server Error. Please contact techsupport@docboyz.in. for more details.
  </div>
@endif
  <!--Bank Analyser Error End-->
  