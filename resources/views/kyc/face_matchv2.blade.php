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
                {{-- <a href = "{{ route('kyc.face_match_api') }}" role = "button" 
                class = "btn btn-light float-right">Face Match API</a>  --}}
            </div>
            <div class="card-body">
                @if(isset($facematch_details['statusCode']) && $facematch_details['statusCode'] == 102)
                    <div class="alert alert-danger" role="alert">
                        face recognition is not defined.
                    </div>
                @endif
                @if(isset($facematch_details['statusCode']) && $facematch_details['statusCode'] == 103)
                   <div class="alert alert-danger" role="alert">
                         You are not registered to use this service. Please update your plan.
                  </div>
                @endif
                @if(isset($facematch_details['statusCode']) && $facematch_details['statusCode'] == 500)
                <div class="alert alert-danger" role="alert">
                    Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{route('kyc.facematch')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">Face Image</label>
                                    <input type="file" class="form-control" id="known_face_image" name="known_face_image" value="" 
                                    required />
                                </div>
                                <div class="form-group">
                                    <label for="name">Image</label>
                                    <input type="file" class="form-control" id="image" name="image" value="" 
                                    required />
                                </div>
                                <button type="submit" class="btn btn-success">Verify</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        @if(isset($facematch_details['status_code']) && $facematch_details['status_code'] == 200)

        @php
            $cardClasses = ['card'];
            if ((float)$facematch_details['rec_face']['match'] <= 60) {
                $cardClasses[] = ' card-danger';
            }else if ((float)$facematch_details['rec_face']['match'] > 60 && (float)$$facematch_details['rec_face']['match'] <= 80){
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
                        <p><strong>Confidence: </strong>{{ $facematch_details['rec_face']['match'] }}%</p>
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