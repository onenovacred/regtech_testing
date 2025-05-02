@extends('adminlte::page')

@section('title', 'RegtechAPI')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Add</h1> -->
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Set New Password for {{$user->name}}</h3>
                    </div>
                    <form role="form" id="frmAddScheme" method="post" action="{{route('user.setNewPasswordSave')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="user_id" value="{{$user->id}}">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="password">New Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="New Password" required>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" id="btnAdd" class="btn btn-primary">Set New Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('custom_js')
@stop