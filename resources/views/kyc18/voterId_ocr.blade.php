@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')

@stop
@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Voter OCR</h3>
                </div>
                <div class="card-body">
                    @if (isset($voterid['status_code']) && $voterid['status_code'] == 102)
                        <div class="alert alert-danger" role="alert">
                            Invalid file only upload VoterId image.
                        </div>
                        @else
                        
                    @endif
                    @if (isset($voterid['status_code']) && $voterid['status_code'] ==404)
                        <div class="alert alert-danger" role="alert">
                            No Image file provided.
                        </div> 
                    @endif
                    @if (isset($vostatusCode) && $vostatusCode== 500)
                    <div class="alert alert-danger" role="alert">
                           Internal server error Please contact techsupport@docboyz.in for more details.
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <form role="form" method="post" action="{{ route('kyc.voterid.ocr') }}"
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
           
            @if (isset($voterid['status_code']) && $voterid['status_code']==200)
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Voter Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    <p><strong>Voter Description:&nbsp;&nbsp;</strong>
                                        @if(isset($voterid['voterid']['raw_ocr_texts']))
                                        @foreach($voterid['voterid']['raw_ocr_texts'] as $row_text) {{$row_text }} @endforeach
                                       @else 
                                        "null"
                                        @endif       

                                    </p>
                                    <p><strong>Name:&nbsp;&nbsp;</strong>
                                        @if (!empty($voterid['voterid']['name']))
                                            {{ $voterid['voterid']['name'] }}
                                        @else
                                        null
                                        @endif
                                    </p>
                                    <p><strong>Voter Id:&nbsp;&nbsp;</strong>
                                        @if (!empty($voterid['voterid']['voter_id_number']))
                                            {{ $voterid['voterid']['voter_id_number'] }}
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
