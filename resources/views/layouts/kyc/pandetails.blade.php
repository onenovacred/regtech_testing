@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">
        Scheme Details</h1> -->
@stop

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">PAN CARD INFO.</h3>
                    <a role = "button" class = "btn btn-light float-right" href = "{{ route('kyc.pancard_api') }}">Pan Card
                        APIs</a>
                </div>
                <div class="card-body">
                    @if (isset($pancard['statusCode']) && $pancard['statusCode'] == '102')
                        <div class="alert alert-danger" role="alert">
                            PAN Number is Invalid
                        </div>
                    @endif
                    @if (isset($pancard['statusCode']) && $pancard['statusCode'] == '404')
                        <div class="alert alert-danger" role="alert">
                            Server Error. Please try again later.
                        </div>
                    @endif
                    @if (isset($pancard['statusCode']) && $pancard['statusCode'] == '500')
                        <!--$pancard[0]['pancard']['code']-->
                        <div class="alert alert-danger" role="alert">
                            Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                        </div>
                    @endif
                    @if (isset($pancard['statusCode']) && $pancard['statusCode'] == '400')
                        <div class="alert alert-danger" role="alert">
                            Error. Please contact techsupport@docboyz.in. for more details.
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <form role="form" method="post" action="{{ route('kyc.pancard.details') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="name">PAN Number</label>
                                    <input type="text" class="form-control" maxlength="10" minlength="10" id="pan_number"
                                        name="pan_number" value="{{ old('pan_number') }}" placeholder="Ex: ABCDE1234N"
                                        required>
                                </div>
                                <button type="submit" class="btn btn-success">Verify</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @if (!empty($pancard) && isset($pancard[0]['statusCode']) && $pancard[0]['statusCode'] == 200)
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
                                    <p><strong>MiddleName: </strong>{{ $pancard[0]['pancard']['middleName'] }}</p>
                                    <p><strong>LastName: </strong>{{ $pancard[0]['pancard']['lastName'] }}</p>
                                    <p><strong>Pan Status Code: </strong>{{ $pancard[0]['pancard']['panStatusCode'] }}</p>
                                    <p><strong>Pan Status: </strong>{{ $pancard[0]['pancard']['panStatus'] }}</p>
                                    <p><strong>Aadhaar Seeding Status:
                                        </strong>{{ $pancard[0]['pancard']['aadhaarSeedingStatus'] }}</p>
                                    <p><strong>Aadhaar Seeding Status Code:
                                        </strong>{{ $pancard[0]['pancard']['aadhaarSeedingStatusCode'] }}</p>
                                    <p><strong>last UpdatedOn: </strong>{{ $pancard[0]['pancard']['lastUpdatedOn'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if (!empty($pancard_response) && isset($statusCode) && $statusCode == 200)
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">PAN CARD Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    @if (!empty($pancard_response[0]['pancard']['fullName']))
                                        <p><strong>Full Name:</strong> {{ $pancard_response[0]['pancard']['fullName'] }}
                                        </p>
                                    @else
                                    @endif

                                    @if (!empty($pancard_response[0]['pancard']['panNumber']))
                                        <p><strong>PAN no: </strong>{{ $pancard_response[0]['pancard']['panNumber'] }}</p>
                                    @else
                                    @endif

                                    @if (!empty($pancard_response[0]['pancard']['isValid']))
                                        <p><strong>Is Valid: </strong>{{ $pancard_response[0]['pancard']['isValid'] }}</p>
                                    @else
                                    @endif

                                    @if (!empty($pancard_response[0]['pancard']['firstName']))
                                        <p><strong>FirstName: </strong>{{ $pancard_response[0]['pancard']['firstName'] }}
                                        </p>
                                    @else
                                    @endif

                                    @if (!empty($pancard_response[0]['pancard']['middleName']))
                                        <p><strong>MiddleName: </strong>{{ $pancard_response[0]['pancard']['middleName'] }}
                                        </p>
                                    @else
                                    @endif

                                    @if (!empty($pancard_response[0]['pancard']['lastName']))
                                        <p><strong>LastName: </strong>{{ $pancard_response[0]['pancard']['lastName'] }}</p>
                                    @else
                                    @endif

                                    @if (!empty($pancard_response[0]['pancard']['title']))
                                        <p><strong>Title: </strong>{{ $pancard_response[0]['pancard']['title'] }}</p>
                                    @else
                                    @endif

                                    @if (!empty($pancard_response[0]['pancard']['panStatusCode']))
                                        <p><strong>Pan Status Code:
                                            </strong>{{ $pancard_response[0]['pancard']['panStatusCode'] }}</p>
                                    @else
                                    @endif

                                    @if (!empty($pancard_response[0]['pancard']['panStatus']))
                                        <p><strong>Pan Status: </strong>{{ $pancard_response[0]['pancard']['panStatus'] }}
                                        </p>
                                    @else
                                    @endif

                                    @if (!empty($pancard_response[0]['pancard']['aadhaarSeedingStatus']))
                                        <p><strong>Aadhaar Seeding Status:
                                            </strong>{{ $pancard_response[0]['pancard']['aadhaarSeedingStatus'] }}</p>
                                    @else
                                    @endif

                                    @if (!empty($pancard_response[0]['pancard']['aadhaarSeedingStatusCode']))
                                        <p><strong>Aadhaar Seeding Status Code:
                                            </strong>{{ $pancard_response[0]['pancard']['aadhaarSeedingStatusCode'] }}</p>
                                    @else
                                    @endif

                                    @if (!empty($pancard_response[0]['pancard']['lastUpdatedOn']))
                                        <p><strong>last UpdatedOn:
                                            </strong>{{ $pancard_response[0]['pancard']['lastUpdatedOn'] }}</p>
                                    @else
                                    @endif
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
