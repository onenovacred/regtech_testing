@if(isset($detection_emotion_details['statusCode']) && $detection_emotion_details['statusCode']== 102)
<div class="alert alert-danger" role="alert">
    Detection emotion is not defined
</div>
@endif
@if(isset($detection_emotion_details['statusCode']) && $detection_emotion_details['statusCode']== 103)
<div class="alert alert-danger" role="alert">
   You are not registered to use this service. Please update your plan.
</div>
@endif
@if(isset($detection_emotion_details['statusCode']) && $detection_emotion_details['statusCode']== 500)
<div class="alert alert-danger" role="alert">
Internal Server Error. Please contact techsupport@docboyz.in. for more details.
</div>
@endif