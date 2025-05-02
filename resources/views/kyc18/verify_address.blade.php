@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')

@stop
@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Verify Address</h3>
                </div>
                <div class="card-body">
                    @if (isset($verify_address['status_code']) && $verify_address['status_code'] == 102)
                        <div class="alert alert-danger" role="alert">
                            {{$error_message}}
                        </div>
                       
                  @endif
                    @if (isset($verify_address['statusCode']) &&  $verify_address['statusCode']==103)
                        <div class="alert alert-danger" role="alert">
                            {{$error_message}}
                        </div> 
                    @endif
                    @if (isset($verify_address[0]['statusCode']) && $verify_address[0]['statusCode']==403)
                    <div class="alert alert-danger" role="alert">
                        {{$error_message}}
                    </div> 
                    @endif
                    @if (isset($verify_address['status_code']) &&  $verify_address['status_code']==202)
                    <div class="alert alert-danger" role="alert">
                        {{$error_message}}
                    </div> 
                    @endif
                    @if (isset($statusCode) && $statusCode== 500)
                    <div class="alert alert-danger" role="alert">
                           Internal server error Please contact techsupport@docboyz.in for more details.
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <form role="form" method="post" action="{{ route('kyc.verify_address') }}" >
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="name">Address</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                      placeholder="Enter a address" required />
                                </div>
                                <button type="submit" class="btn btn-success">Verify</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @if (isset($verify_address['status_code']) && $verify_address['status_code'] ==200)
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Verified Address Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    <p><strong>Input Address:&nbsp;&nbsp;</strong>
                                        @if (!empty($verify_address['data']['input_address']))
                                            {{ $verify_address['data']['input_address'] }}
                                        @else
                                            null
                                        @endif
                                    </p>
                                    <p><strong>Match:&nbsp;&nbsp;</strong>
                                        @if (!empty($verify_address['data']['match']))
                                            {{ $verify_address['data']['match'] }}
                                        @else
                                        null
                                        @endif
                                    </p>
                                    <p><strong>Verified Address:&nbsp;&nbsp;</strong>
                                        @if (!empty($verify_address['data']['verified_address']))
                                            {{ $verify_address['data']['verified_address']}}
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
