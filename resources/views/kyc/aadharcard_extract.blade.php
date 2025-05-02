@extends('adminlte::page')

@section('title', 'Aadhar Extract')

@section('content_header')
@stop

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Extract Aadhar</h3>
                </div>
                <div class="card-body">
                    @if (isset($aadharcard_extract['status_code']) && $aadharcard_extract['status_code'] == 102)
                        <div class="alert alert-danger" role="alert">
                            Invalid file type, must be an aadhar card image.
                        </div>
                    @endif
                    @if (isset($aadharcard_extract['status_code']) && $aadharcard_extract['status_code'] == 404)
                     <div class="alert alert-danger" role="alert">
                             No file provided.
                     </div>
                    @endif
                    @if (isset($aadharcard_extract['status_code']) && $aadharcard_extract['status_code'] == 500)
                        <div class="alert alert-danger" role="alert">
                            Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                        </div>
                    @endif
                    @if (isset($aadharcard_extract['statusCode']) && $aadharcard_extract['statusCode'] == 103)
                    <div class="alert alert-danger" role="alert">
                            You are not registered to use this service. Please update your plan.
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <form role="form" method="post" action="{{ route('kyc.extract_aadharcard_text')}}"
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

            @if (!empty($aadharcard_extract['status_code']) && $aadharcard_extract['status_code'] == 200)
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
                                         @if(isset($aadharcard_extract['aadharcard']['detected_text']))
                                            {{$aadharcard_extract['aadharcard']['detected_text']}}
                                          @else 
                                         "null"
                                    @endif          
                                   </p>
                                    <p><strong>Date of Bith:
                                        </strong>{{ isset($aadharcard_extract['aadharcard']['date_of_birth']) ? $aadharcard_extract['aadharcard']['date_of_birth'] : 'null' }}
                                    </p>
                                    <p><strong>Aadhar Number:
                                        </strong>{{ isset($aadharcard_extract['aadharcard']['aadhar_number']) ? $aadharcard_extract['aadharcard']['aadhar_number'] : 'null' }}
                                    </p>
                                    <p><strong>Name:
                                    </strong>{{ isset($aadharcard_extract['aadharcard']['name']) ? $aadharcard_extract['aadharcard']['name'] : 'null' }}
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
