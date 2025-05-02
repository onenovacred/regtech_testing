@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')

@stop
@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Create Geofence API</h3>
                </div>
                <div class="card-body">
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
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <form role="form" method="post" action="{{ route('kyc.create_geofence') }}" >
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="name">Longitude</label>
                                    <input type="text" class="form-control" id="longitude" name="longitude"
                                      placeholder="Enter a Longitude" required />
                                      <label for="name">Latitude</label>
                                     <input type="text" class="form-control" id="latitude" name="latitude"
                                      placeholder="Enter a Latitude" required />
                                      <label for="name">Radius</label>
                                     <input type="number" class="form-control" id="radius" name="radius"
                                      placeholder="Enter a radius" required  min="1"/>
                                </div>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @if (isset($create_geofence['status_code']) && $create_geofence['status_code']==200)
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
            @endif
        </div>
    </div>
@stop
@section('custom_js')
@stop
