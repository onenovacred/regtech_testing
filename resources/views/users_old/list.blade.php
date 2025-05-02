@extends('adminlte::page')

@section('title', 'RegtechAPI')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme</h1> -->
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Users</h3>
                        <div class="card-tools">
                            <a href="{{ route('user.add') }}" class="btn btn-warning"><i class="fa fa-plus-square"></i>
                                Add</a>
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
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Verified</th>
                                            <th>Status</th>
                                            <th>Scheme</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (Auth::user()->id == 1 && Auth::user()->role_id == 0)
                                            @foreach ($users as $key => $value)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $value->name }}</td>
                                                    <td>{{ $value->email }}</td>
                                                    <td class="text-center">
                                                        @if ($value->verified == 1)
                                                            <span class="badge badge-success">Verified</span>
                                                        @else
                                                            <span class="badge badge-danger">Not Verified</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        @if ($value->status == 1)
                                                            <span class="badge badge-success">Active</span>
                                                        @else
                                                            <span class="badge badge-danger">Inactive</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $value->scheme_type }}

                                                    <td class="text-center">
                                                        <a href="{{ url('/userEdit') }}/{{ $value->id }}" class="btnEdit"
                                                            title="Edit"><i class="fa fa-pencil"></i></a>
                                                        <a href="{{ url('/userDelete') }}/{{ $value->id }}"
                                                            onclick="return confirm('Are you sure?')" class="btnDelete"
                                                            title="Delete"><i class="fa fa-trash"></i></a>
                                                        <a href="{{ url('/userSetNewPassword') }}/{{ $value->id }}"
                                                            class="btnSetNewPassword" title="Set New Password"
                                                            style="margin-left: 10px; font-size: 18px;"><i
                                                                class="fa fa-key"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @elseif(Auth::user()->id != 1 && Auth::user()->role_id == 1)
                                            @foreach ($users as $key => $value)
                                              
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ $value->name }}</td>
                                                            <td>{{ $value->email }}</td>
                                                            <td class="text-center">
                                                                @if ($value->verified == 1)
                                                                    <span class="badge badge-success">Verified</span>
                                                                @else
                                                                    <span class="badge badge-danger">Not Verified</span>
                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                                @if ($value->status == 1)
                                                                    <span class="badge badge-success">Active</span>
                                                                @else
                                                                    <span class="badge badge-danger">Inactive</span>
                                                                @endif
                                                            </td>
                                                            <td>{{ $value->scheme_type }}
                                                            <td class="text-center">
                                                                <a href="{{ url('/userEdit') }}/{{ $value->id }}"
                                                                    class="btnEdit" title="Edit"><i
                                                                        class="fa fa-pencil"></i></a>
                                                                <a href="{{ url('/userDelete') }}/{{ $value->id }}"
                                                                    onclick="return confirm('Are you sure?')"
                                                                    class="btnDelete" title="Delete"><i
                                                                        class="fa fa-trash"></i></a>
                                                                <a href="{{ url('/userSetNewPassword') }}/{{ $value->id }}"
                                                                    class="btnSetNewPassword" title="Set New Password"
                                                                    style="margin-left: 10px; font-size: 18px;"><i
                                                                        class="fa fa-key"></i></a>
                                                            </td>
                                                        </tr>
                                                @endforeach
                                        @endif
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
        $(function() {
            $('#example1').DataTable({
                "responsive": true,
                "columns": [{
                        "width": "5%"
                    },
                    {
                        "width": "20%"
                    },
                    null,
                    {
                        "width": "10%"
                    },
                    {
                        "width": "10%"
                    },
                    {
                        "width": "5%"
                    },
                    {
                        "width": "10%",
                        "orderable": false
                    }
                ]
            });
        });
    </script>
@stop
