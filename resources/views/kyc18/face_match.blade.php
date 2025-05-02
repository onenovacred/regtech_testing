@extends('adminlte::page')

@section('title', 'Face Match')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Face Match</h3>
                <a href = "{{ route('kyc.face_match_api') }}" role = "button" 
                class = "btn btn-light float-right">Face Match API</a> 
            </div>
            <div class="card-body">
                @if(isset($face_match['statusCode']) && $face_match['statusCode'] == '102')
                    <div class="alert alert-danger" role="alert">
                        Image should be in JPEG or PNG format only
                  </div>
                @endif
                @if(isset($face_match['statusCode']) && ($face_match['statusCode'] == '404' || $face_match['statusCode'] == '400'))
                <div class="alert alert-danger" role="alert">
                    {{$face_match['message']}}
                </div>
                @endif
                @if(isset($face_match['statusCode']) && $face_match['statusCode'] == '500')
                <div class="alert alert-danger" role="alert">
                    Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{route('kyc.face_match')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">Document Image</label>
                                    <input type="file" class="form-control" id="doc_img" name="doc_img" value="" 
                                    required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Selfie Image</label>
                                    <input type="file" class="form-control" id="selfie" name="selfie" value="" 
                                    required>
                                </div>
                                <button type="submit" class="btn btn-success">Verify</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        @if(!empty($face_match) && isset($face_match[0]['statusCode']) && $face_match[0]['statusCode'] == 200)

        @php
            $cardClasses = ['card'];

            if ((float)$face_match[0]['face_match']['response']['confidence'] <= 60) {
                $cardClasses[] = ' card-danger';
            }else if ((float)$face_match[0]['face_match']['response']['confidence'] > 60 && (float)$face_match[0]['face_match']['response']['confidence'] <= 80){
                $cardClasses[] = ' card-warning';
            }else{
                $cardClasses[] = ' card-success';
            }
        @endphp

        <div class="{{ implode(' ', $cardClasses) }}">
            <div class="card-header">
                <h3 class="card-title">Face Match Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                        <p><strong>Confidence: </strong>{{ $face_match[0]['face_match']['response']['confidence'] }}%</p>
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