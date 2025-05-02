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
                    <h3 class="card-title">Wallet Transaction ({{Auth::user()->name}})</h3>
                    <div class="card-tools">
                        <a href="#" class="btn btn-warning"> Wallet Balance : 49873 <i class="fa fa-inr"></i></a>
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
                                    <tr>
                                        <td>DB000010</td>
                                        <td>Video KYC</td>
                                        <td>Debit</td>
                                        <td><i class="fa fa-arrow-down"></i> 750</td>
                                        <td class="text-success">Success</td>
                                        <td><i class="fa fa-inr"></i>.750 debited from your wallet</td>
                                        <td>30-10-2020 10:00:00</td>
                                    </tr>
                                    <tr>
                                        <td>DB000009</td>
                                        <td>PAN CARD</td>
                                        <td>Debit</td>
                                        <td><i class="fa fa-arrow-down"></i> 250</td>
                                        <td class="text-success">Success</td>
                                        <td><i class="fa fa-inr"></i>.250 debited from your wallet</td>
                                        <td>28-10-2020 09:00:00</td>
                                    </tr>
                                    <tr>
                                        <td>DB000008</td>
                                        <td>AADHAR CARD</td>
                                        <td>Debit</td>
                                        <td><i class="fa fa-arrow-down"></i> 0</td>
                                        <td class="text-danger">Failed</td>
                                        <td>AADHAR CARD sevice failed</td>
                                        <td>27-10-2020 08:00:00</td>
                                    </tr>
                                    <tr>
                                        <td>DB000007</td>
                                        <td>Wallet</td>
                                        <td>Credit</td>
                                        <td><i class="fa fa-arrow-up"></i> 8000</td>
                                        <td class="text-success">Success</td>
                                        <td><i class="fa fa-inr"></i>.8000 credited to your wallet</td>
                                        <td>25-10-2020 04:10:00</td>
                                    </tr>
                                    <tr>
                                        <td>DB000006</td>
                                        <td>Bank Verification</td>
                                        <td>Debit</td>
                                        <td><i class="fa fa-arrow-down"></i> 250</td>
                                        <td class="text-success">Success</td>
                                        <td><i class="fa fa-inr"></i>.250 debited from your wallet</td>
                                        <td>24-10-2020 01:35:00</td>
                                    </tr>
                                    <tr>
                                        <td>DB000005</td>
                                        <td>Shop Establishment</td>
                                        <td>Debit</td>
                                        <td><i class="fa fa-arrow-down"></i> 250</td>
                                        <td class="text-success">Success</td>
                                        <td><i class="fa fa-inr"></i>.250 debited from your wallet</td>
                                        <td>24-10-2020 06:08:00</td>
                                    </tr>
                                    <tr>
                                        <td>DB000004</td>
                                        <td>Electricity</td>
                                        <td>Debit</td>
                                        <td><i class="fa fa-arrow-down"></i> 250</td>
                                        <td class="text-success">Success</td>
                                        <td><i class="fa fa-inr"></i>.250 debited from your wallet</td>
                                        <td>20-10-2020 11:20:00</td>
                                    </tr>
                                    <tr>
                                        <td>DB000003</td>
                                        <td>GSTIN</td>
                                        <td>Debit</td>
                                        <td><i class="fa fa-arrow-down"></i> 0</td>
                                        <td class="text-danger">Failed</td>
                                        <td>GSTIN service failed</td>
                                        <td>18-10-2020 12:40:00</td>
                                    </tr>
                                    <tr>
                                        <td>DB000002</td>
                                        <td>LICENCE</td>
                                        <td>Debit</td>
                                        <td><i class="fa fa-arrow-down"></i> 250</td>
                                        <td class="text-success">Success</td>
                                        <td><i class="fa fa-inr"></i>.250 debited from your wallet</td>
                                        <td>15-10-2020 03:21:00</td>
                                    </tr>
                                    <tr>
                                        <td>DB000001</td>
                                        <td>Wallet</td>
                                        <td>Credit</td>
                                        <td><i class="fa fa-arrow-up"></i> 4500</td>
                                        <td class="text-success">Success</td>
                                        <td><i class="fa fa-inr"></i>.4500 credited to your wallet</td>
                                        <td>12-10-2020 06:35:00</td>
                                    </tr>
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
                { "width": "8%" },
                null,
                { "width": "10%" },
                { "width": "10%" },
                { "width": "10%" },
                { "width": "25%" },
                { "width": "20%" }
            ]
        });
    });
</script>
@stop