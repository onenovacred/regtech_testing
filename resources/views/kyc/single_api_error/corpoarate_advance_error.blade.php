  <!--Corporate advance error-->
  @if (isset($corporate_advance['statusCode']) && $corporate_advance['statusCode']==102)
  <div class="alert alert-danger" role="alert">
       {{$corporate_advance['message']}}
  </div>
@endif
@if (isset($corporate_advance['statusCode']) && $corporate_advance['statusCode']==201)
<div class="alert alert-danger" role="alert">
   {{$corporate_advance['message']}}
</div>
@endif
@if (isset($corporate_advance['statusCode']) && $corporate_advance['statusCode']==103)
<div class="alert alert-danger" role="alert">
   {{$corporate_advance['message']}}
</div>
@endif
@if (isset($corporate_advance['statusCode']) && $corporate_advance['statusCode']==500)
<div class="alert alert-danger" role="alert">
  {{$corporate_advance['message']}}
</div>
@endif
  <!--Corporate advance error-->