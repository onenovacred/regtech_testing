@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">API Documentation</h3>
                </div>
                <div class="card-body">
                    <div class="col-4">
                        <label for="">Access Token: </label>
                        <input type="text" value="{{Auth::user()->access_token}}" class="form-control" readonly>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@stop

@section('custom_js')

@stop