  <!---Bank statement api Error-->
  @if (isset($bankstatment['statusCode']) && $bankstatment['statusCode'] == 102)
  <div class="alert alert-danger" role="alert">
      {{$error_message}}
  </div> 
  @endif
  @if (isset($bankstatment['statusCode']) && $bankstatment['statusCode'] == 103)
   <div class="alert alert-danger" role="alert">
       {{$error_message}}
   </div> 
  @endif
 @if (isset($bankStatementStatusCode) && $bankStatementStatusCode==500)
  <div class="alert alert-danger" role="alert">
     Internal server error.
   </div>
  @endif