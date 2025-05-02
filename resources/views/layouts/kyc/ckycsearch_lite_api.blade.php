@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
    @if (!empty(session('ckyc_api_search_exception_message')))
        @php
            $messageData = json_decode(session('ckyc_api_search_exception_message'), true);
        @endphp
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>StatusCode : {{ $messageData['statusCode'] }}</strong> &nbsp;&nbsp;<strong>Message :
                {{ $messageData['error'] }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Ckyc Search Lite</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <form role="form" method="post" action="{{ route('ckyc.searchlite.submit') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="name">PAN Number</label>
                                    <input type="text" class="form-control" maxlength="10" minlength="10" id="pan_number"
                                        name="pan_number" value="{{ old('pan_number') }}" placeholder="Ex: ABCDE1234N"
                                        required>
                                    @error('pan_number')
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

            @if (session('ckyc_api_search_success_message'))
                @php
                    $messageData = json_decode(session('ckyc_api_search_success_message'), true);
                @endphp
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Search Lite Data Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    <p><strong>Status Code:</strong>
                                        {{ $messageData['statusCode']}}
                                    </p>
                                    <p><strong>Full Name:</strong>
                                        {{ $messageData['name']}}
                                    </p>
                                    <p><strong>Mobile Number:
                                        </strong>{{$messageData['mobile_no']}}
                                    </p>
                                    <p><strong>Email:
                                        </strong>{{ $messageData['email'] }}
                                    </p>
                                    <p><strong>Address:
                                        </strong>{{$messageData['address']}}
                                    </p>
                                    <p><strong>City:
                                        </strong>{{  $messageData['city'] }}
                                    </p>
                                    <p><strong>Country:
                                        </strong>{{$messageData['country']}}
                                    </p>
                                    <p><strong>Pincode:
                                        </strong>{{$messageData['pincode']}}
                                    </p>
                                    <p><strong>State:
                                        </strong>{{$messageData['state']}}
                                    </p>
                                    <p><strong>Email:
                                        </strong>{{ $messageData['email']}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        @endif
    </div>
    </div>
@stop
