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
                <h3 class="card-title">ITR Forget Password</h3>
            </div>
            <div class="card-body">
                <form role="form" method="post" action="{{route('itr.itr_forget_password')}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="name">Client ID</label>
                        <input type="text" class="form-control" 
                        id="client_id" name="client_id" value="{{old('client_id')}}" 
                        placeholder="Ex: itr_glvFpjIAxwsdscTEHYy" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Password</label>
                        <input type="text" class="form-control" 
                        id="password" name="password" value="{{old('password')}}" 
                        placeholder="" required>
                    </div>
                    <button type="submit" class="btn btn-success">Send OTP</button>
                </form>
            </div>
            </div>
        </div>

        @if(!empty($itr_forget_password) && $itr_forget_password['status_code'] == 200)
        <div class="col-md-6 offset-md-3">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Response</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                <p><strong>Data:</strong> {{ json_encode($itr_forget_password) }}</p>
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


@section('custom_js')
@stop