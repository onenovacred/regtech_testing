@extends('adminlte::page')

@section('title', 'RegtechAPI')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Wallet Transaction - {{ Auth::user()->name }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('billing.add_wallet') }}" class="btn btn-warning"> Add Wallet Balance <i
                                class="fa fa-inr"></i></a>
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
                                    <?php
                                    //foreach ($transactions as $element) {
                                        //echo $element . "<br><br><br><br><br><br><br><br>";
                                    //}
                                    //?>
                                    @foreach ($transactions as $transaction)
                                        <tr>
                                            <td>{{ $transaction->transaction_id }}</td>
                                            <td>
                                                @if ($transaction->api_name != null)
                                                    {{ $transaction->api_name }}
                                                @else
                                                    Credit/Debit
                                                @endif
                                            </td>
                                            <td>{{ $transaction->type_creditdebit }}</td>
                                            <td><i
                                                    class="{{ $transaction->type_creditdebit === 'Credit' ? 'fa fa-arrow-up' : 'fa fa-arrow-down' }}"></i>
                                                {{ $transaction->amount }}</td>
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


@section('custom_js')
    <script>
        $(document).ready(function() {
            $('#example1').DataTable();
        });
    </script>
@stop
