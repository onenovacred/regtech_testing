@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')

@stop
@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Extract Voter Id</h3>
                </div>
                <div class="card-body">
                    @if (isset($extract_voterid['status_code']) && $extract_voterid['status_code'] == 102)
                        <div class="alert alert-danger" role="alert">
                            Invalid file only upload VoterId image.
                        </div>
                       
                        
                    @endif
                    @if (isset($extract_voterid['status_code']) && $extract_voterid['status_code'] ==404)
                        <div class="alert alert-danger" role="alert">
                            No Image file provided.
                        </div> 
                    @endif
                    @if (isset($extract_voterid['status_code']) && $extract_voterid['status_code']== 500)
                    <div class="alert alert-danger" role="alert">
                           Internal server error Please contact techsupport@docboyz.in for more details.
                    </div>
                    @endif
                    @if (isset($extract_voterid['statusCode']) && $extract_voterid['statusCode']== 103)
                    <div class="alert alert-danger" role="alert">
                           You are not registered to use this service. Please update your plan.
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <form role="form" method="post" action="{{ route('kyc.extract_voterId_text') }}"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="name">Voter Id Image</label>
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
           
            @if (isset($extract_voterid['status_code']) && $extract_voterid['status_code']==200)
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Voter Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    <p><strong>Voter Description:&nbsp;&nbsp;</strong>
                                        @if (!empty($extract_voterid['voterid']['detected_text']))
                                            {{ $extract_voterid['voterid']['detected_text'] }}
                                        @else
                                            null
                                        @endif
                                    </p>
                                    <p><strong>Name:&nbsp;&nbsp;</strong>
                                        @if (!empty($extract_voterid['voterid']['extracted_info']['name']))
                                            {{ $extract_voterid['voterid']['extracted_info']['name'] }}
                                        @else
                                        null
                                        @endif
                                    </p>
                                    <p><strong>Voter Id:&nbsp;&nbsp;</strong>
                                        @if (!empty($extract_voterid['voterid']['extracted_info']['voter_id']))
                                            {{ $extract_voterid['voterid']['extracted_info']['voter_id'] }}
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
