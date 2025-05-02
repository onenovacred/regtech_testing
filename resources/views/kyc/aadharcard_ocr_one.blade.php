@extends('adminlte::page')

@section('title', 'Aadhar OCR')

@section('content_header')
@stop

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Aadharcard OCR</h3>
                </div>
                <div class="card-body">
                    @if (isset($aadharcardocr['status_code']) && $aadharcardocr['status_code'] == 102)
                        <div class="alert alert-danger" role="alert">
                            Invalid file type, must be an aadhar card image.
                        </div>
                    @endif
                    @if (isset($aadharcardocr['status_code']) && $aadharcardocr['status_code'] == 404)
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
                            <form role="form" method="post" action="{{ route('kyc.aadharcard_ocr')}}"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="img">Aadharcard Upload</label>
                                    <input type="file" name="file" class="form-control" id="file" /> <br>
                                </div>
                                <button type="submit" class="btn btn-success">Uplode</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @if (!empty($aadharcardocr['status_code']) && $aadharcardocr['status_code'] == 200)
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Aadhar Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    <p><strong>Aadhar Description:
                                        </strong>
                                         @if(isset($aadharcardocr['aadharcard']['raw_ocr_texts']))
                                         @foreach($aadharcardocr['aadharcard']['raw_ocr_texts'] as $row_text) {{$row_text }} @endforeach
                                                            
                                         @else 
                                         "null"
                                    @endif          
                                   </p>
                                    <p><strong>Date of Bith:
                                        </strong>{{ isset($aadharcardocr['aadharcard']['date_of_birth']) ? $aadharcardocr['aadharcard']['date_of_birth'] : 'null' }}
                                    </p>
                                    <p><strong>Aadhar Number:
                                        </strong>{{ isset($aadharcardocr['aadharcard']['aadhar_number']) ? $aadharcardocr['aadharcard']['aadhar_number'] : 'null' }}
                                    </p>
                                    <p><strong>Name:
                                    </strong>{{ isset($aadharcardocr['aadharcard']['name']) ? $aadharcardocr['aadharcard']['name'] : 'null' }}
                                     </p>
                                     <p><strong>Gender:
                                    </strong>{{ isset($aadharcardocr['aadharcard']['gender']) ? $aadharcardocr['aadharcard']['gender'] : 'null' }}
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
