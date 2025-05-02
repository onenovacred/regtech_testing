@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')

@stop
@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Extract PAN CARD</h3>
                    
                </div>
                <div class="card-body">
                    @if (isset($extract_pancard_text['status_code']) && $extract_pancard_text['status_code']==102)
                        <div class="alert alert-danger" role="alert">
                            Invalid file only upload Pancard image.
                        </div>
                    @endif
                    @if (isset($extract_pancard_text['status_code']) && $extract_pancard_text['status_code']==404)
                        <div class="alert alert-danger" role="alert">
                            No Image file provided.
                        </div>
                    @endif
                    @if (isset($extract_pancard_text['statusCode']) && $extract_pancard_text['statusCode']==103)
                      <div class="alert alert-danger" role="alert">
                          You are not registered to use this service. Please update your plan.
                       </div>
                   @endif
                   @if (isset($extract_pancard_text['status_code']) && $extract_pancard_text['status_code']==103)
                    <div class="alert alert-danger" role="alert">
                        Internal server error Please contact techsupport@docboyz.in for more details.
                      </div>
                  @endif
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <form role="form" method="post" action="{{ route('kyc.extract_pancard_text') }}"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="name">Pan Card Image</label>
                                    <input type="file" class="form-control" id="file" name="file"
                                        value="{{ old('file') }}" />
                                    @error('file')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-success">Verify</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @if (isset($extract_pancard_text['status_code']) && $extract_pancard_text['status_code']==200)
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">PAN CARD Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    <p><strong>Pan Description:&nbsp;&nbsp;</strong>
                                        @if(isset($extract_pancard_text['pancard']['detected_text']))
                                            {{$extract_pancard_text['pancard']['detected_text']}}
                                       @endif         
                                    </p>
                                    <p><strong>Date Of Birth:&nbsp;&nbsp;</strong>
                                        @if (!empty($extract_pancard_text["pancard"]['extracted_info']['date_of_birth']))
                                            {{ $extract_pancard_text["pancard"]['extracted_info']['date_of_birth'] }}
                                        @else
                                        null
                                        @endif
                                    </p>
                                    <p><strong>Pan number :&nbsp;&nbsp;</strong>
                                        @if (!empty($extract_pancard_text["pancard"]['extracted_info']['pan_number']))
                                            {{$extract_pancard_text["pancard"]['extracted_info']['pan_number'] }}
                                        @else
                                        null
                                        @endif
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
