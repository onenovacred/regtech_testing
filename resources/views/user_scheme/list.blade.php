@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme</h1> -->
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Scheme</h3>
                        <div class="card-tools">
                            <a href="{{route('user.scheme.add')}}" class="btn btn-warning"><i class="fa fa-plus-square"></i> Add</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr</th>
                                            <th>Api Name</th>
                                            <th>Scheme Name</th>
                                            <th>Scheme Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $key=>$value)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$value->name}}</td>
                                            <td>{{$value->name}}</td>
                                            <td class="text-right">{{$value->email}}</td>
                                            <td class="text-center">
                                                <a href="#" class="btnEdit" title="Edit"><i class="fa fa-pencil"></i></a>
                                                <a href="#" class="btnDelete" title="Delete"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('custom_js')
<script>
	$(function () {
		$('#example1').DataTable({
			"responsive": true,
			"columns": [
				{ "width": "5%" },
				{ "width": "20%" },
				null,
				{ "width": "20%" },
				{ "width": "10%", "orderable": false }
			]
		});
	});
</script>
@stop