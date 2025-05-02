@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">PAN CARD Verification</h3>
                <a role = "button" class = "btn btn-light float-right" 
                href = "{{ route('kyc.pancard_api') }}">Pan Card APIs</a>
            </div>
            <div class="card-body">
                @if(isset($pancard['statusCode']) && $pancard['statusCode'] == 102)
                    <div class="alert alert-danger" role="alert">
                        {{$pancard['message']}}
                  </div>
                @endif
                @if(isset($pancard['statusCode'])&& $pancard['statusCode'] ==404)
                <div class="alert alert-danger" role="alert">
                    {{$pancard['message']}}
                </div>
                @endif
                @if(isset($pancard['statusCode']) && $pancard['statusCode'] == 403)
                <div class="alert alert-danger" role="alert">
                       {{$pancard['message']}}
                </div>
                @endif
                @if(isset($pancard['statusCode']) && ($pancard['statusCode'] ==103))
                <div class="alert alert-danger" role="alert">
                       {{$pancard['message']}}
                </div>
                @endif
                @if(isset($pancard['statusCode']) && $pancard['statusCode'] ==500)
                    <div class="alert alert-danger" role="alert">
                        {{$pancard['message']}}
                  </div>
                @endif
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{route('kyc.pancard')}}">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">PAN Number</label>
                                <input type="text" class="form-control" 
                                    maxlength="10" minlength="10" 
                                    id="pan_number" name="pan_number" value="{{old('pan_number')}}" 
                                    placeholder="Ex: ABCDE1234N" required>
                                </div>
                                <button type="submit" class="btn btn-success">Verify</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($pancard) &&  isset($pancard['statusCode']) && $pancard['statusCode'] == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">PAN CARD Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                        {{-- <p><strong>Client Id :</strong>{{isset($pancard['pancard']['data']['client_id'])?$pancard['pancard']['data']['client_id']:'null'}}</p> --}}
                        <p><strong>Full Name:</strong> {{ isset($pancard['pancard']['data']['full_name'])?$pancard['pancard']['data']['full_name']:'null' }}</p>
                        <p><strong>PAN no: </strong>{{ isset($pancard['pancard']['data']['pan_number'])?$pancard['pancard']['data']['pan_number']:'null'}}</p>
                        <p><strong>Category: </strong>{{ isset($pancard['pancard']['data']['category'])?$pancard['pancard']['data']['category']:'null' }}</p>
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