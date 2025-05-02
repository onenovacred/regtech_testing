@extends('adminlte::page')

@section('title', 'Emoation API')

@section('content_header')

@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Detection Emotion</h3>
                <a class="btn btn-light float-right" href="{{route('kyc.detection_emotion_api')}}">Detection API</a>
            </div>
            <div class="card-body">
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
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{route('kyc.detection_emotion')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">Image File</label>
                                    <input type="file" class="form-control" name="image_file" required />
                                </div>
                                <button type="submit" class="btn btn-success">submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($detection_emotion_details['statusCode']) && $detection_emotion_details['statusCode'] == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Emotion Details.</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <p>
                             <strong>Emoation Description:</strong>
                             @if(isset($detection_emotion_details['response']['emotions'][0]))
                                   {{$detection_emotion_details['response']['emotions'][0]}}
                                @else
                                  ""
                             @endif
                        </p>
                       
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