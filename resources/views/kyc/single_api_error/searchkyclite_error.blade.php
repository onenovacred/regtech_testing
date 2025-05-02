  <!--Search Kyc Lite Error Message-->
  @if (isset($searchkyclite['statusCode']) &&  $searchkyclite['statusCode']==103)
  <div class="alert alert-danger" role="alert">
     You are not registered to use this service. Please update your plan.
  </div> 
@endif
@if (isset($searchkyclite['statusCode']) && $searchkyclite['statusCode']==102)
 <div class="alert alert-danger" role="alert">
     {{$searchkyclite['response']}}
  </div> 
@endif
@if (isset($searchkyclite['statusCode']) && $searchkyclite['statusCode']==202)
 <div class="alert alert-danger" role="alert">
     {{$searchkyclite['response']}}
  </div> 
@endif
@if (isset($searchkyclite['statusCode']) && $searchkyclite['statusCode']==201)
  <div class="alert alert-danger" role="alert">
    {{$searchkyclite['response']}}
 </div> 
 @endif
 @if (isset($searchkyclite['statusCode']) && $searchkyclite['statusCode']==500)
  <div class="alert alert-danger" role="alert">
     Internal server error Please contact techsupport@docboyz.in for more details.
   </div>
@endif
<!-- Search Kyc Lite End-->