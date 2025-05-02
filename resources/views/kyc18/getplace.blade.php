@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')

@stop
@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Get Place Address</h3>
                </div>
                <div class="card-body">
                    @if (isset($get_place['status_code']) && $get_place['status_code'] == 102)
                        <div class="alert alert-danger" role="alert">
                            {{$error_message}}
                        </div>
                       
                  @endif
                    @if (isset($get_place['statusCode']) &&  $get_place['statusCode']==103)
                        <div class="alert alert-danger" role="alert">
                            {{$error_message}}
                        </div> 
                    @endif
                    @if (isset($get_place[0]['statusCode']) && $get_place[0]['statusCode']==403)
                    <div class="alert alert-danger" role="alert">
                        {{$error_message}}
                    </div> 
                    @endif
                    @if (isset($getplace_statusCode) && $getplace_statusCode== 500)
                    <div class="alert alert-danger" role="alert">
                           Internal server error Please contact techsupport@docboyz.in for more details.
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <form role="form" method="post" action="{{ route('kyc.get_place') }}" >
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="name">Longitude</label>
                                    <input type="text" class="form-control" id="longitude" name="longitude"
                                      placeholder="Enter a Longitude" required />
                                      <label for="name">Latitude</label>
                                     <input type="text" class="form-control" id="latitude" name="latitude"
                                      placeholder="Enter a Latitude" required />
                                </div>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @if (isset($get_place['status_code']) && $get_place['status_code']==200)
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Get Place Address Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    <p><strong>Label:&nbsp;&nbsp;</strong>
                                        @if (!empty($get_place['data'][0]['label']))
                                            {{ $get_place['data'][0]['label'] }}
                                        @else
                                            null
                                        @endif
                                    </p>
                                    <p><strong>longitude:&nbsp;&nbsp;</strong>
                                        @if (!empty($get_place['data'][0]['point'][0]))
                                            {{$get_place['data'][0]['point'][0]}}
                                        @else
                                        null
                                        @endif
                                    </p>
                                    <p><strong>latitude:&nbsp;&nbsp;</strong>
                                        @if (!empty($get_place['data'][0]['point'][1]))
                                            {{$get_place['data'][0]['point'][1]}}
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
