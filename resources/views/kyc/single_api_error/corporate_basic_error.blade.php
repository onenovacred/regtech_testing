   <!--Corporate Basic Error --->
   @if (isset($corporate_basic['statusCode']) && $corporate_basic['statusCode']==102)
   <div class="alert alert-danger" role="alert">
        {{$corporate_basic['message']}}
   </div>
   @endif
@if (isset($corporate_basic['statusCode']) && $corporate_basic['statusCode']==201)
 <div class="alert alert-danger" role="alert">
    {{$corporate_basic['message']}}
 </div>
 @endif
@if (isset($corporate_basic['statusCode']) && $corporate_basic['statusCode']==103)
 <div class="alert alert-danger" role="alert">
    {{$corporate_basic['message']}}
  </div>
 @endif
 @if (isset($corporate_basic['statusCode']) && $corporate_basic['statusCode']==500)
  <div class="alert alert-danger" role="alert">
   {{$corporate_basic['message']}}
  </div>
  @endif
 @if(isset($cinadbasicStatusCode) && $cinadbasicStatusCode==500)
    <div class="alert alert-danger" role="alert">
     Internal Server Error.
   </div>
   @endif
    <!--Corporate Basic Error--->