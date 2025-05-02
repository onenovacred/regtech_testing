@extends('adminlte::page')

@section('title', 'ITR')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">ITR Forget Password</h3>
            </div>
            <div class="card-body">
                <form role="form" method="post" action="{{route('itr.itr_submit_otp')}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="name">Client ID</label>
                        <input type="text" class="form-control" 
                        id="client_id" name="client_id" value="{{old('client_id')}}" 
                        placeholder="Ex: itr_glvFpjIAxwsdscTEHYy" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Enter OTP</label>
                        <input type="text" class="form-control" 
                        id="otp" name="otp" value="{{old('otp')}}" 
                        placeholder="" required>
                    </div>
                    <button type="submit" class="btn btn-success">Send OTP</button>
                </form>
            </div>
            </div>
        </div>

        @if(!empty($itr_submit_otp) && $itr_submit_otp['status_code'] == 200)
        <div class="col-md-6 offset-md-3">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Response</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                <p><strong>Data:</strong> {{ json_encode($itr_submit_otp) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @elseif(!empty($itr_submit_otp) && $itr_submit_otp['status_code'] == 422)
        <div class="col-md-6 offset-md-3">
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">Response</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                <p><strong>Data:</strong> {{ json_encode($itr_submit_otp) }}</p>
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