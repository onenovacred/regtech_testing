@extends('adminlte::page')

@section('title', 'RegtechAPI')

@section('content_header')
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">
                    Wallet Transaction - {{ Auth::user()->name }}
                </h3>
                <div>
                    <a href="{{ route('billing.add_wallet') }}" class="btn btn-warning">
                        Add Wallet Balance <i class="fa fa-inr"></i>
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-12"><br>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Trns Id</th>
                                    <th>Service</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Remark</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <td>{{ $transaction->transaction_id }}</td>
                                        <td>{{ $transaction->api_master->api_name ?? 'No API Found' }}</td>
                                        <td>{{ $transaction->type_creditdebit }}</td>
                                        <td>
                                            <i class="{{ $transaction->type_creditdebit === 'Credit' ? 'fa fa-arrow-up' : 'fa fa-arrow-down' }}"></i>
                                            {{ $transaction->amount }}
                                        </td>
                                        <td class="text-success">{{ $transaction->status }}</td>
                                        <td><i class="fa fa-inr"></i>{{ $transaction->remark }}</td>
                                        <td>{{ $transaction->created_at }}</td>
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
@stop

@section('css')
    <!-- DataTables + Buttons Bundle CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/v/bs5/dt-1.13.6/b-2.4.2/datatables.min.css"/>
@stop

@section('custom_js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>

<script>
$(document).ready(function () {
    $('#example1').DataTable({
        dom: 'Bfrtip',
        buttons: [{
            extend: 'excelHtml5',
            title: 'Wallet_Transactions',
            text: '<i class="fa fa-download"></i> Download Excel',
            className: 'btn btn-success'
        }]
    });
});
</script>
@stop
