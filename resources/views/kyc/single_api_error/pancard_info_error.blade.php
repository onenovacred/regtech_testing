  <!--pancard Info Start-->
  @if(isset($pancardInfoDetails['statusCode']) && $pancardInfoDetails['statusCode'] == 102)
  <div class="alert alert-danger" role="alert">
      {{$pancardInfoDetails['message']}}
</div>
@endif
@if(isset($pancardInfoDetails['statusCode']) && ($pancardInfoDetails['statusCode'] == 404))
<div class="alert alert-danger" role="alert">
  Server Error. Please try again later.
</div>
@endif
@if(isset($pancardInfoDetails['statusCode']) && ($pancardInfoDetails['statusCode'] == 403))
<div class="alert alert-danger" role="alert">
     {{$pancardInfoDetails['message']}}
</div>
@endif
@if(isset($pancardInfoDetails['statusCode']) && ($pancardInfoDetails['statusCode'] == 103))
<div class="alert alert-danger" role="alert">
     {{$pancardInfoDetails['message']}}
</div>
@endif
@if(isset($pancardInfoDetails['statusCode']) && $pancardInfoDetails['statusCode'] == 500)
  <div class="alert alert-danger" role="alert">
      {{$pancardInfoDetails['message']}}
</div>
@endif
  <!--Pancard info End-->