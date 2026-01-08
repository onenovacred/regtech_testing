@extends('adminlte::page')

@section('title', 'RegtechAPI')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Aadhar masking</h3>
            </div>
            <div class="card-body">
                @if(isset($aadhaar_masking[0]['aadhaar_masked_details']['status_code']) && $aadhaar_masking[0]['aadhaar_masked_details']['status_code'] == '102')
                    <div class="alert alert-danger" role="alert">
                        Please upload valid aadhar photo. Error code - 102 
                  </div>
                @endif
                @if(isset($aadhaar_masking[0]['aadhaar_masked_details']['status_code']) && ($aadhaar_masking[0]['aadhaar_masked_details']['status_code'] == '404' || $aadhaar_masking[0]['aadhaar_masked_details']['status_code'] == '400'))
                <div class="alert alert-danger" role="alert">
                    Server Error, Please try later
                </div>
                @endif
                @if(isset($aadhaar_masking[0]['aadhaar_masked_details']['status_code']) && $aadhaar_masking[0]['aadhaar_masked_details']['status_code'] == '500')
                <div class="alert alert-danger" role="alert">
                    Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{route('kyc.aadhaar_masking')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">Aadhaar Front</label>
                                <input type="file" class="form-control" name="file" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Aadhaar Back</label>
                                <input type="file" class="form-control" name="file_back">
                                </div>
                                <button type="submit" class="btn btn-success">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($aadhaar_masking))
        <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Aadhar Details</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div>
                        <p><strong>Masked Aadhar -</strong></p>
                        
                        @php
                            $base64 = $aadhaar_masking[0]['aadhaar_masked_details']['files'][0]['masked_image_base64']; 
                            
                            // Check for image type based on the starting characters of the Base64 string
                            if (strpos($base64, 'iVBORw0KGgo') === 0) {
                                // PNG (Base64 PNG strings usually start with 'iVBORw0KGgo')
                                $imageType = 'image/png';
                            } elseif (strpos($base64, '/9j/') === 0) {
                                // JPEG (Base64 JPEG strings usually start with '/9j/')
                                $imageType = 'image/jpeg';
                            } elseif (strpos($base64, 'R0lGODlh') === 0) {
                                // GIF (Base64 GIF strings usually start with 'R0lGODlh')
                                $imageType = 'image/gif';
                            } elseif (strpos($base64, 'UklGR') === 0) {
                                // WebP (Base64 WebP strings usually start with 'UklGR')
                                $imageType = 'image/webp';
                            } elseif (strpos($base64, '<?xml') === 0) {
                                // SVG (Base64 SVG strings usually start with '<?xml')
                                $imageType = 'image/svg+xml';
                            } else {
                                // Default to JPEG if the type is unknown
                                $imageType = 'image/jpeg'; 
                            }
                        @endphp

                        <img src="data:{{ $imageType }};base64,{{$base64}}" style="width: 100%">
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