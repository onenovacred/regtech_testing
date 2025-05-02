@if (!empty($bhunakshstatusCode) && $bhunakshstatusCode == 202)
<div class="alert alert-danger" role="alert">
    {{$error_message}}
 </div>
@endif
@if (!empty($bhunakshstatusCode) && $bhunakshstatusCode == 103)
<div class="alert alert-danger" role="alert">
  {{$error_message}}
</div>
@endif
@if (!empty($bhunakshstatusCode) && $bhunakshstatusCode == 500)
  <div class="alert alert-danger" role="alert">
    {{$error_message}}
  </div>
@endif