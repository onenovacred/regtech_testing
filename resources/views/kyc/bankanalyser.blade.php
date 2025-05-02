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
                <h3 class="card-title">Bank Analyser</h3>
                <!-- <a role = "button" class = "btn btn-light float-right" 
                href = "{{ route('kyc.pancard_api') }}">Bank Statement APIs</a> -->
            </div>
            <div class="card-body">
                @if(isset($statusCode) && $statusCode == '422')
                    <div class="alert alert-danger" role="alert">
                        PAN is Invalid 
                  </div>
                @endif
                @if(isset($statusCode) && ($statusCode == '404' || $statusCode == '400'))
                <div class="alert alert-danger" role="alert">
                    Server Error, Please try later
                </div>
                @endif
                @if(isset($statusCode) && $statusCode == '500')
                <div class="alert alert-danger" role="alert">
                    Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{route('kyc.bank_analyser')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">Bank Statement</label>
                                <input type="file" class="form-control" name="file"  required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Bank</label>
                                    <input type="text" class="form-control" name="bank" id = "bank" placeholder = "Enter Bank Name" 
                                    value="SBI" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Password</label>
                                    <input type="text" class="form-control" name="password" id = "password" placeholder = "Enter Password" 
                                    value="Password">
                                </div>
                                <div class="form-group">
                                    <label for="name">Account Type</label>
                                    <input type="text" class="form-control" name="accounttype" id = "accounttype" placeholder = "Enter Account Type" 
                                    value="SAVING" required>
                                </div>
                                <button type="submit" class="btn btn-success">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($statmendata))
            @if(isset($statusCode) && $statusCode == 200)
            <div class="card card-success" style="max-height: 300px; overflow-y: auto;">
                <div class="card-header">
                    <h3 class="card-title">Bank Analyser</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                        <div>
                        @foreach($statmendata as $statmendatas)
                            <p>Amount: {{ $statmendatas['amount'] }}</p>
                            <p>BalanceAfterTransaction: {{ $statmendatas['balanceAfterTransaction'] }}</p>
                            <p>Bank: {{ $statmendatas['bank'] }}</p>
                            <p>BatchID: {{ $statmendatas['batchID'] }}</p>
                            <p>Category: {{ $statmendatas['category'] }}</p>
                            <p>DateTime: {{ $statmendatas['dateTime'] }}</p>
                            <p>Description: {{ $statmendatas['description'] }}</p>
                            <p>Remark: {{ $statmendatas['remark'] }}</p>
                            <p>TransactionId: {{ $statmendatas['transactionId'] }}</p>
                            <p>TransactionNumber: {{ $statmendatas['transactionNumber'] }}</p>
                            <p>Type: {{ $statmendatas['type'] }}</p>
                            <p>ValueDate: {{ $statmendatas['valueDate'] }}</p>
                            <hr style="border: 1px solid #000;width: 100%;">
                            </br>
                        @endforeach
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="alert alert-danger" role="alert">
                Internal Server Error. Please contact techsupport@docboyz.in. for more details.
            </div>
            @endif
        @endif
       
    </div>
</div>
@stop


@section('custom_js')
@stop