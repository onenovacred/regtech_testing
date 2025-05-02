@if (isset($create_geofence['status_code']) && $create_geofence['status_code']==200)
<div class="row">
    <div class="col-md-6 offset-md-3">
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Create Geofence Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <p><strong>CreateTime:&nbsp;&nbsp;</strong>
                        @if (!empty($create_geofence['data']['CreateTime']))
                            {{ $create_geofence['data']['CreateTime'] }}
                        @else
                            null
                        @endif
                    </p>
                    <p><strong>GeofenceId:&nbsp;&nbsp;</strong>
                        @if (!empty($create_geofence['data']['GeofenceId']))
                            {{$create_geofence['data']['GeofenceId']}}
                        @else
                        null
                        @endif
                    </p>
                    <p><strong>UpdateTime:&nbsp;&nbsp;</strong>
                        @if (!empty($create_geofence['data']['UpdateTime']))
                            {{$create_geofence['data']['UpdateTime']}}
                        @else
                        null
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endif