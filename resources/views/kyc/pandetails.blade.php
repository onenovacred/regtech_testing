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
                <!-- <h3 class="card-title">PAN CARD INFO.</h3> -->
                 <h3 class="card-title">Pan Details</h3>
                <!-- <a role = "button" class = "btn btn-light float-right" 
                href = "{{ route('kyc.pancard_api') }}">Pan Card APIs</a> -->
            </div>
            <div class="card-body">
                @if(isset($pancard['statusCode']) && $pancard['statusCode'] == 102)
                    <div class="alert alert-danger" role="alert">
                        {{$pancard['message']}}
                  </div>
                @endif
                @if(isset($pancard['statusCode']) && ($pancard['statusCode'] == 404))
                <div class="alert alert-danger" role="alert">
                    Server Error. Please try again later.
                </div>
                @endif
                @if(isset($pancard['statusCode']) && ($pancard['statusCode'] == 403))
                <div class="alert alert-danger" role="alert">
                       {{$pancard['message']}}
                </div>
                @endif
                @if(isset($pancard['statusCode']) && ($pancard['statusCode'] == 103))
                <div class="alert alert-danger" role="alert">
                       {{$pancard['message']}}
                </div>
                @endif
                @if(isset($pancard['statusCode']) && $pancard['statusCode'] == 500)
                    <div class="alert alert-danger" role="alert">
                        {{$pancard['message']}}
                  </div>
                @endif
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{route('kyc.pancard.details')}}">
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

        @if(!empty($pancard["pancard"]["data"]) &&  isset($pancard['statusCode']) && $pancard['statusCode'] == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">PAN CARD Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                        <p><strong>Full Name:</strong> {{ isset($pancard['pancard']['data']['fullName'])?$pancard['pancard']['data']['fullName']:'null'}}</p>
                        <p><strong>PAN no: </strong>{{ isset($pancard['pancard']['data']['panNumber'])?$pancard['pancard']['data']['panNumber']:'null' }}</p>
                        <p><strong>Is Valid: </strong>{{ isset($pancard['pancard']['data']['isValid'])?$pancard['pancard']['data']['isValid']:'null'}}</p>
                        <p><strong>FirstName: </strong>{{ isset($pancard['pancard']['data']['firstName'])?$pancard['pancard']['data']['firstName']:'null' }}</p>
                        <p><strong>MiddleName: </strong>{{isset($pancard['pancard']['data']['middleName'])?$pancard['pancard']['data']['middleName']:'null'}}</p>
                        <p><strong>LastName: </strong>{{ isset($pancard['pancard']['data']['lastName'])?$pancard['pancard']['data']['lastName']:'null' }}</p>
                        <p><strong>Pan Status Code: </strong>{{ isset($pancard['pancard']['data']['panStatusCode'])?$pancard['pancard']['data']['panStatusCode']:'null'}}</p>
                        <p><strong>Pan Status: </strong>{{ isset($pancard['pancard']['data']['panStatus'])?$pancard['pancard']['data']['panStatus']:'null' }}</p>
                        <p><strong>Aadhaar Seeding Status: </strong>{{ isset($pancard['pancard']['data']['aadhaarSeedingStatus'])?$pancard['pancard']['data']['aadhaarSeedingStatus']:'null' }}</p>
                        <p><strong>Aadhaar Seeding Status Code: </strong>{{ isset($pancard['pancard']['data']['aadhaarSeedingStatusCode'])?$pancard['pancard']['data']['aadhaarSeedingStatusCode']:'null' }}</p>
                        <p><strong>last UpdatedOn: </strong>{{isset($pancard['pancard']['data']['lastUpdatedOn'])?$pancard['pancard']['data']['lastUpdatedOn']:'null' }}</p>
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