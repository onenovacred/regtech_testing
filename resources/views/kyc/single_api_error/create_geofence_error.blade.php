   <!--Error of create geofence api -->
   @if (isset($create_geofence['status_code']) && $create_geofence['status_code'] == 102)
   <div class="alert alert-danger" role="alert">
       {{$error_message}}
   </div>
  
@endif
@if (isset($create_geofence['statusCode']) &&  $create_geofence['statusCode']==103)
   <div class="alert alert-danger" role="alert">
       {{$error_message}}
   </div> 
@endif
@if (isset($create_geofence[0]['statusCode']) && $create_geofence[0]['statusCode']==403)
<div class="alert alert-danger" role="alert">
   {{$error_message}}
</div> 
@endif
@if (isset($geostatusCode) && $geostatusCode== 500)
<div class="alert alert-danger" role="alert">
      Internal server error Please contact techsupport@docboyz.in for more details.
</div>
@endif