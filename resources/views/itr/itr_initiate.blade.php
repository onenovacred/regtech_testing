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
                <h3 class="card-title">ITR Create Client</h3>
            </div>
                <div class="card-body">
                    @if($statusCode == '404')
                        <div class = "alert alert-danger" role = "alert">
                                <p>Internal Server Error. Please try again.</p>
                        </div>
                    @endif
                    <form role="form" method="post" action="{{route('itr.itr_initiate')}}">
                        {{csrf_field()}}
                            <div class="form-group">
                                <label for="name">Create ITR Client</label>
                            </div>
                            <div class="form-group">
                                <label for="name">username</label>
                            <input type="text" class="form-control" 
                                id="username" name="username" value="{{old('username')}}" 
                                placeholder="Ex: ABCDE1234N" required>
                            </div>
                            <div class="form-group">
                                <label for="name">password</label>
                            <input type="text" class="form-control" 
                                id="password" name="password" value="{{old('password')}}" 
                                placeholder="Ex: ABCDE1234N" required>
                            </div>
                            <button type="submit" class="btn btn-success">Create</button>
                    </form>
                </div>
            </div>
        </div>

        @if(!empty($itr_initiate) && $itr_initiate['status_code'] == 200)
        <div class="col-md-6 offset-md-3">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">ITR Client Create Details</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                <div class="form-group">
                                    <label for="name">ITR Client ID</label>
                                <input type="text" class="form-control" id="client_id"value="{{ $itr_initiate['data']['client_id'] }}" readonly>
                                    <br>
                                <p><strong>Message: </strong> {{
                                $itr_initiate['message']}}</p>

                                <p><strong>Status: </strong> {{
                                $itr_initiate['success']}}</p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
@stop


@section('custom_js')
@stop