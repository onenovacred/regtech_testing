@extends('adminlte::page')

@section('title', 'Credit Report')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Set Branding</h3>
            </div>
            <div class="card-body">
                @if($statusCode ?? '' == '422')
                    <div class="alert alert-danger" role="alert">
                      It is not working
                  </div>
                @endif
                @if($statusCode ?? '' == '404' || null)
                <div class="alert alert-danger" role="alert">
                    Server Error, Please try later
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{route('branding.post')}}" id="formSubmitted" enctype="multipart/form-data">
                            {{csrf_field()}}       
                                <div class="form-group">
                                    <label for="brand_image_url">Image Url</label>
                                    <input type="file" class="form-control-file" name="brand_image_url" id="brand_image_url">
                               </div>

                                <div class="form-group">
                                <label for="pan">Brand Name</label>
                                <input type="text" class="form-control" 
                                    id="brand_name" name="brand_name" />
                                </div>          
                                <button id="submitForm" type="submit" class="btn btn-success">Verify</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
 
    </div>
</div>
@stop

@section('custom_js')

@stop