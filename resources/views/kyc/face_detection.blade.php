@extends('adminlte::page')

@section('title', 'Face Detection')

@section('content_header')

@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Face Detection</h3>
                <a class="btn btn-light float-right" href="{{route('kyc.detection_face_api')}}">Face Detection API</a>
            </div>
            <div class="card-body">
                @if(isset($facematch_details['statusCode']) && $facematch_details['statusCode']== 102)
                    <div class="alert alert-danger" role="alert">
                        Face detection failed.
                  </div>
                @endif
              @if(isset($facematch_details['statusCode']) && $facematch_details['statusCode']== 103)
                <div class="alert alert-danger" role="alert">
                       You are not registered to use this service. Please update your plan.
                </div>
                @endif
                @if(isset($facematch_details['status_code']) && $facematch_details['status_code']== 500)
                <div class="alert alert-danger" role="alert">
                    Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{route('kyc.detection_face')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">Image File</label>
                                    <input type="file" class="form-control" name="image_file" required />
                                </div>
                                <button type="submit" class="btn btn-success">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($facematch_details['statusCode']) && $facematch_details['statusCode'] == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Image Details.</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="text-center" style="font-weight:700;">Decated Image</h5>
                          <div class="text-center">
                             <img src="data:image/png;base64,{{isset($facematch_details["data"])?$facematch_details["data"] : ''}}" alt="image not found" width="350" height="300"/>
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