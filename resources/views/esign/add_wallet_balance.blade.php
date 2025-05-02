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
                <h3 class="card-title">eSign Docboyz</h3>
            </div>
            <div class="card-body">
                @if($statusCode == '422')
                    <div class="alert alert-danger" role="alert">
                        eSign Initialize is Invalid 
                  </div>
                @endif
                @if($statusCode == '404' || null)
                <div class="alert alert-danger" role="alert">
                    Server Error, Please try later
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{route('esign.esign_docboyz')}}">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">eSign Docboyz</label>
                                </div>
                                <div class="form-group">
                                    <label for="name">Full Name</label>
                                    <input type="text" class="form-control" 
                                        id="full_name" name="full_name" value="{{old('full_name')}}" 
                                        placeholder="Full Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Mobile Number</label>
                                    <input type="text" class="form-control" 
                                        maxlength="10" minlength="10" 
                                        id="mobile_number" name="mobile_number" value="{{old('mobile_number')}}" 
                                        placeholder="Mobile Number" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">User Email</label>
                                    <input type="text" class="form-control" 
                                        id="user_email" name="user_email" value="{{old('user_email')}}" 
                                        placeholder="User Email" required>
                                </div>
                                <button type="submit" class="btn btn-success">eSign Verify</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($esign) && $esign['status_code'] == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">eSign Initialize</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                        <p>client_id: {{ $esign['data']['client_id'] }}</p>
                        <p>group_id: {{ $esign['data']['group_id'] }}</p>
                        <!-- <p>token: {{ $esign['data']['token'] }}</p> -->
                        <p>url: <a href="{{ $esign['data']['url'] }}" target="_blank">{{ $esign['data']['url'] }}</a></p>
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