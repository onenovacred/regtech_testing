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
                <h3 class="card-title">ITR Client ID Verify</h3>
            </div>
           
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{route('itr.itr_enter_clientid')}}">
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

        @if(!empty($itr_enter_clientid) && $itr_enter_clientid['status_code'] == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">ITR Client Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                        <p>Full Name: {{ $ITR['data']['given_name'] }}</p>
                        <p>ITR no: {{ $itr_enter_clientid['data']['J0933836'] }}</p>
                        <p>ITR Message: {{ $itr_enter_clientid['message'] }}</p>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if($itr_enter_clientid['data']['status_code'] == 422)
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">ITR Client Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                        <p>Success: {{ $itr_enter_clientid['data']['success'] }}</p>
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