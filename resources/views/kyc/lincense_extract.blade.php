@extends('adminlte::page')

@section('title', 'Lincense Extract')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Lincense Extract</h3>
                </div>
                <div class="card-body">
                    @if (isset($lincense_extract['status_code']) && $lincense_extract['status_code'] == 102)
                        <div class="alert alert-danger" role="alert">
                            Invalid file type, must be an driving license image.
                        </div>
                    @endif
                    @if (isset($lincense_extract['status_code']) && $lincense_extract['status_code'] == 404)
                     <div class="alert alert-danger" role="alert">
                             No file provided.
                     </div>
                    @endif
                    @if (isset($lincense_extract['statusCode']) && $lincense_extract['statusCode'] == 103)
                    <div class="alert alert-danger" role="alert">
                        You are not registered to use this service. Please update your plan.
                    </div>
                   @endif
                    @if (isset($lincense_extract['status_code']) && $lincense_extract['status_code']== 500)
                        <div class="alert alert-danger" role="alert">
                            Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <form role="form" method="post" action="{{route('kyc.extract_drivinglicense_text')}}"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="img">Lincense Upload</label>
                                    <input type="file" name="file" class="form-control" id="file" required/> <br>
                                </div>
                                <button type="submit" class="btn btn-success">Uplode</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            @if (!empty($lincense_extract['status_code']) && $lincense_extract['status_code'] == 200)
                {{-- {{dd($lincense_extract)}} --}}
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
                                        @if(isset($lincense_extract['driving_license']['detected_text']))
                                         {{$lincense_extract['driving_license']['detected_text']}} 
                                        
                                        @endif          
                                    </p>
                                    <p><strong>Valid Till:
                                        </strong>{{ isset($lincense_extract['driving_license']['extracted_info']['Valid Till']) ? $lincense_extract['driving_license']['extracted_info']['Valid Till'] : 'null' }}
                                    </p>
                                    <p><strong>birth date:
                                        </strong>{{ isset($lincense_extract['driving_license']['extracted_info']['birth_date']) ? $lincense_extract['driving_license']['extracted_info']['birth_date'] : 'null' }}
                                    </p>
                                    <p><strong>dl_no:
                                    </strong>{{ isset($lincense_extract['driving_license']['extracted_info']['dl_no']) ? $lincense_extract['driving_license']['extracted_info']['dl_no'] : 'null' }}
                                     </p>
                                     <p><strong>name:
                                    </strong>{{ isset($lincense_extract['driving_license']['extracted_info']['name']) ? $lincense_extract['driving_license']['extracted_info']['name'] : 'null' }}
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
