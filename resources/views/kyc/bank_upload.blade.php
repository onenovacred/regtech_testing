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
                <h3 class="card-title">Bank Statement</h3>
            </div>
            <div class="card-body">
                @if(isset($bankstatement['statusCode']) && $bankstatement['statusCode'] == 500)
                    <div class="alert alert-danger" role="alert">
                        Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                  </div>
                @endif
               
                @if(isset($bankstatement['statusCode']) && $bankstatement['statusCode'] == 102)
                <div class="alert alert-danger" role="alert">
                  Invalid Bank Details. Please enter correct Bank Details
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{route('kyc.bank_statement')}}" enctype="multipart/form-data">
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
     </div>
</div>
@stop


@section('custom_js')
@stop