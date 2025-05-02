@extends('adminlte::page')

@section('title', 'Scanner')

@section('content_header')

@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Image Scanner</h3>
                <a class="btn btn-light float-right" href="{{route('kyc.image_scanner_api')}}">Image API</a>
            </div>
            <div class="card-body">
             @if(isset($image_scanner_details['statusCode']) &&  $image_scanner_details['statusCode']== 102)
                    <div class="alert alert-danger" role="alert">
                           Image does not support.
                    </div>
             @endif
             @if(isset($image_scanner_details['statusCode']) && $image_scanner_details['statusCode']== 500)
                <div class="alert alert-danger" role="alert">
                    Internal Server Error. Please contact techsupport@docboyz.in. for more details.
              </div>
             @endif
            @if(isset($image_scanner_details['statusCode']) && $image_scanner_details['statusCode']== 103)
                <div class="alert alert-danger" role="alert">
                    You are not registered to use this service. Please update your plan.
                </div>
            @endif
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{route('kyc.img_scanner')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">Upload Image</label>
                                    <input type="file" class="form-control" name="image_file" required />
                                </div>
                                <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @if(!empty($image_scanner_details['statusCode']) && $image_scanner_details['statusCode'] == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Image Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="text-center" style="font-weight:700;">Scanned Image</h5>
                          <div class="text-center">
                             <img src="data:image/png;base64,{{isset($image_scanner_details["data"])?$image_scanner_details["data"] : ''}}" alt="image not found" width="350" height="300"/>
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