@extends('adminlte::page')

@section('title', 'Aadhar OCR')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Aadhar OCR Masking</h3>
            </div>
            <div class="card-body">
                @if(isset($aadhaar_masking['status_code']) &&  $aadhaar_masking['status_code']== 102)
                    <div class="alert alert-danger" role="alert">
                        Invalid file type, must be an image.
                  </div>
                @endif
                @if(isset($aadhaar_masking['status_code']) && $aadhaar_masking['status_code']== 404)
                <div class="alert alert-danger" role="alert">
                    No image file provided.
              </div>
              @endif
                @if(isset($amstatusCode) && $amstatusCode == 500)
                <div class="alert alert-danger" role="alert">
                    Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{route('kyc.aadhar_ocr_masking')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">Aadhaar card</label>
                                    <input type="file" class="form-control" name="file" required />
                                </div>
                                <button type="submit" class="btn btn-success">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($aadhaar_masking['status_code']) && $aadhaar_masking['status_code'] == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Aadhar Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="text-center" style="font-weight:700;">Masked Aadhar</h5>
                          <div class="text-center">
                             <img src="data:image/png;base64,{{isset($aadhaar_masking["aadharcard"]["data"])?$aadhaar_masking["aadharcard"]["data"] : ''}}" alt="image not found" width="350" height="300"/>
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