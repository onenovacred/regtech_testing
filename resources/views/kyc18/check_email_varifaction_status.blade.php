@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')

@stop
@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Check Email Varification Status</h3>
                    <a class="float-right btn btn-secondary" href="{{ route('kyc.check_verify_email_status_api') }}">
                        Check Email Verification Apis
                    </a>
                </div>
                <div class="card-body">
                    @if (isset($check_verify_email_status['statusCode']) && $check_verify_email_status['statusCode'] == 102)
                        <div class="alert alert-danger" role="alert">
                            {{ $error_message }}
                        </div>
                    @endif
                    @if (isset($check_verify_email_status['statusCode']) && $check_verify_email_status['statusCode'] == 103)
                        <div class="alert alert-danger" role="alert">
                            {{ $error_message }}
                        </div>
                    @endif
                    @if (isset($check_verify_email_status['statusCode']) && $check_verify_email_status['statusCode'] == 500)
                        <div class="alert alert-danger" role="alert">
                            {{ $error_message }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <form role="form" method="post" action="{{ route('kyc.check_verify_email_status') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="name">Email Id</label>
                                    <input type="text" class="form-control" id="email_id" name="email_id"
                                        placeholder="Enter a email" required />
                                </div>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @if (isset($check_verify_email_status['statusCode']) && $check_verify_email_status['statusCode'] == 200)
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Verified Address Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    <p><strong>Identity:&nbsp;&nbsp;</strong>
                                        @if (!empty($check_verify_email_status['data']['identity']))
                                            {{ $check_verify_email_status['data']['identity'] }}
                                        @else
                                            null
                                        @endif
                                    </p>
                                    <p><strong>Verification Status:&nbsp;&nbsp;</strong>
                                        @if (!empty($check_verify_email_status['data']['verification_status']))
                                            {{ $check_verify_email_status['data']['verification_status'] }}
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
