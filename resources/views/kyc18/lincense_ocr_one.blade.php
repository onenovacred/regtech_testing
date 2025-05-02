@extends('adminlte::page')

@section('title', 'Lincense OCR')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Lincense OCR</h3>
                </div>
                <div class="card-body">
                    @if (isset($lincensedocr['status_code']) && $lincensedocr['status_code'] == 102)
                        <div class="alert alert-danger" role="alert">
                            Invalid file type, must be an driving license image.
                        </div>
                    @endif
                    @if (isset($lincensedocr['status_code']) && $lincensedocr['status_code'] == 404)
                     <div class="alert alert-danger" role="alert">
                             No file provided.
                     </div>
                    @endif
                    @if (isset($astatusCode) &&$astatusCode == 500)
                        <div class="alert alert-danger" role="alert">
                            Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <form role="form" method="post" action="{{route('kyc.license_ocr')}}"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="img">Lincense Upload</label>
                                    <input type="file" name="file" class="form-control" id="file" /> <br>
                                </div>
                                <button type="submit" class="btn btn-success">Uplode</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @if (!empty($lincensedocr['status_code']) && $lincensedocr['status_code'] == 200)
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Lincense Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div>
    
                                    <p><strong>Lincese Description:
                                        </strong>
                                        @if(isset($lincensedocr['driving_license']['raw_ocr_texts']))
                                        @foreach($lincensedocr['driving_license']['raw_ocr_texts'] as $row_text) {{$row_text }} @endforeach
                                       @else 
                                        "null"
                                        @endif          
                                    </p>
                                    <p><strong>Valid Till:
                                        </strong>{{ isset($lincensedocr['driving_license']['expiry_date']) ? $lincensedocr['driving_license']['expiry_date'] : 'null' }}
                                    </p>
                                    <p><strong>birth date:
                                        </strong>{{ isset($lincensedocr['driving_license']['birth_date']) ? $lincensedocr['driving_license']['birth_date'] : 'null' }}
                                    </p>
                                    <p><strong>dl_no:
                                    </strong>{{ isset($lincensedocr['driving_license']['dl_no']) ? $lincensedocr['driving_license']['dl_no'] : 'null' }}
                                     </p>
                                     <p><strong>name:
                                    </strong>{{ isset($lincensedocr['driving_license']['name']) ? $lincensedocr['driving_license']['name'] : 'null' }}
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
