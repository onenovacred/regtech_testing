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
                <h3 class="card-title">PAN CARD INFO.</h3>
                <a role = "button" class = "btn btn-light float-right" 
                href = "{{ route('kyc.pancard_api') }}">Pan Card APIs</a>
            </div>
            <div class="card-body">
                @if(isset($pancard['statusCode']) && $pancard['statusCode'] == '102')
                    <div class="alert alert-danger" role="alert">
                        PAN Number is Invalid 
                  </div>
                @endif
                @if(isset($pancard['statusCode']) && ($pancard['statusCode'] == '404'))
                <div class="alert alert-danger" role="alert">
                    Server Error. Please try again later.
                </div>
                @endif
                @if(isset($pancard['statusCode']) && $pancard['statusCode'] == '500') <!--$pancard[0]['pancard']['code']-->
                    <div class="alert alert-danger" role="alert">
                        Internal Server Error. Please contact techsupport@docboyz.in. for more details.
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

        @if(!empty($pancard) &&  isset($pancard[0]['statusCode']) && $pancard[0]['statusCode'] == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">PAN CARD Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                        <p><strong>Full Name:</strong> {{ $pancard[0]['pancard']['fullName'] }}</p>
                        <p><strong>PAN no: </strong>{{ $pancard[0]['pancard']['panNumber'] }}</p>
                        <p><strong>Is Valid: </strong>{{ $pancard[0]['pancard']['isValid'] }}</p>
                        <p><strong>FirstName: </strong>{{ $pancard[0]['pancard']['firstName'] }}</p>
                        <p><strong>MiddleName: </strong>{{ $pancard[0]['pancard']['lastName'] }}</p>
                        <p><strong>Pan Status Code: </strong>{{ $pancard[0]['pancard']['panStatusCode'] }}</p>
                        <p><strong>Pan Status: </strong>{{ $pancard[0]['pancard']['panStatus'] }}</p>
                        <p><strong>Aadhaar Seeding Status: </strong>{{ $pancard[0]['pancard']['aadhaarSeedingStatus'] }}</p>
                        <p><strong>Aadhaar Seeding Status Code: </strong>{{ $pancard[0]['pancard']['aadhaarSeedingStatusCode'] }}</p>
                        <p><strong>last UpdatedOn: </strong>{{ $pancard[0]['pancard']['lastUpdatedOn'] }}</p>
                        <!-- <p>PAN Verification: @if(isset($pancard[0]['pancard']['message'][0])) $pancard[0]['pancard']['message'][0] @endif</p> -->
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