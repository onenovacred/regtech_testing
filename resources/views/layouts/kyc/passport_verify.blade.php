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
                <h3 class="card-title">Passport Verify</h3>
                <a href = "{{ route('kyc.passport_api') }}" class="btn btn-light float-right">Passport APIs</a>
            </div>
            <div class="card-body">
                @if(isset($statusCode) && $statusCode == '102')
                    <div class="alert alert-danger" role="alert">
                        Client Id is Invalid 
                    </div>
                @endif
                @if(isset($statusCode) && ($statusCode == '404' || $statusCode == '400'))
                <div class="alert alert-danger" role="alert">
                    Server Error, Please try later
                </div>
                @endif
                @if(isset($statusCode) && $statusCode == '500')
                <div class="alert alert-danger" role="alert">
                    Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{route('kyc.passport_verify')}}">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">Client ID</label>
                                <input type="text" class="form-control" 
                                    id="client_id" name="client_id" value="{{old('client_id')}}" 
                                    placeholder="Ex: ABCDE1234N" required>
                                </div>
                                <button type="submit" class="btn btn-success">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($passport))
            @if(isset($passport['status_code']) && $passport['status_code'] == 200)
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Passport Client Details</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                        <div>
                            <p>Full Name: {{ $passport['data']['given_name'] }}</p>
                            <p>Passport no: {{ $passport['data']['passport_num'] }}</p>
                            <p>Passport Message: {{ $passport['message'] }}</p>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="alert alert-danger" role="alert">
                Internal Server Error. Please contact techsupport@docboyz.in. for more details.
            </div>
            @endif
        @endif
    </div>
</div>
@stop


@section('custom_js')
@stop