<!--FaceMatch Error-->
@if(isset($face_match['statusCode']) && $face_match['statusCode'] == '102')
<div class="alert alert-danger" role="alert">
    Image should be in JPEG or PNG format only
</div>
@endif
@if(isset($face_match['statusCode']) && ($face_match['statusCode'] == '404' || $face_match['statusCode'] == '400'))
<div class="alert alert-danger" role="alert">
{{$face_match['message']}}
</div>
@endif
@if(isset($face_match['statusCode']) && $face_match['statusCode'] == '500')
<div class="alert alert-danger" role="alert">
Internal Server Error. Please contact techsupport@docboyz.in. for more details.
</div>
@endif
<!--FaceMatch Error End-->