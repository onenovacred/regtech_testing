@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Scheme Type Master</h3>
                    <div class="card-tools">
                        <a href="{{route('scheme_type.add')}}" class="btn btn-warning"><i class="fa fa-plus-square"></i> Add</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            @if(sizeof($scheme_types)>0)
                            
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <td>Sr</td>
                                        <td>Name</td>
                                        <td>Hit Limit</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($scheme_types as $key=>$value)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$value->name}}</td>
                                        <td>{{$value->hit_limits}}</td>
                                        <td>
                                            <a href="{{url('/schemeTypeEdit')}}/{{$value->id}}" class="btnEdit"><i class="fa fa-pencil"></i></a>
                                            @if($value->users_count==0)
                                            <a href="{{url('/schemeTypeDelete')}}/{{$value->id}}" class="btnDelete" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
                                            @else
                                            <a href="#" class="btnNoDelete"><i class="fa fa-ban"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <h2 class="text-center text-red">No Data</h2>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop