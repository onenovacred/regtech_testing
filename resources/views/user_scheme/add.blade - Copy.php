@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Add</h1> -->
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add User Scheme</h3>
                    </div>
                    <form role="form" method="post" action="{{route('user.scheme.create')}}">
                        {{csrf_field()}}
                        <div class="card-body">
                            <div class="form-group">
                                <label for="api_id">User</label>
                                <select id="user_id" name="user_id" class="form-control">
                                    @foreach($users as $key=>$value)
                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="api_id">API</label>
                                <select id="api_id" name="api_id" class="form-control">
                                    @foreach($api_group as $key=>$value)
                                        <option value="{{$value->id}}" disabled><b>{{$value->group_name}}</b></option>
                                        <?php
                                            $sub_menus=DB::table('api_master')->select('id','api_name')->where('api_group_id',$value->id)->get();
                                            if(count($sub_menus)>0){
                                                foreach ($sub_menus as $sub_menu){
                                                    echo '<option value="'.$sub_menu->id.'">&nbsp;&nbsp;&nbsp;&nbsp;'.$sub_menu->api_name.'</option>';
                                                }
                                            }
                                        ?>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="scheme_price">Scheme Price</label>
                                <input type="text" class="form-control" id="scheme_price" name="scheme_price" placeholder="Scheme Price">
                            </div>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
