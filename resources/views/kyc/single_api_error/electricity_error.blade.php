@if(isset($electricity['electricity']['code']) && $electricity['electricity']['code'] == '200' && $electricity['electricity']['response']['isValid'] == 'No')
<div class="alert alert-danger" role="alert">
    {{$electricity['electricity']['response']['reason']}}
</div>
@endif
@if(isset($electricity['electricity']['code']) && $electricity['electricity']['code'] == '404')
<div class="alert alert-danger" role="alert">
{{$electricity['electricity']['response']}}
</div>
@endif
@if(isset($electricity['electricity']['code']) && $electricity['electricity']['code'] == '500')
<div class="alert alert-danger" role="alert">
Internal Server Error. Please contact techsupport@docboyz.in. for more details.
</div>
@endif
@if(isset($electricity['statusCode']) && $electricity['statusCode'] == '103')
<div class="alert alert-danger" role="alert">
    You are not registered to use this service. Please update your plan.
</div>
@endif

