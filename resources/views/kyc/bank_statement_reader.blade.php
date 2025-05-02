@extends('adminlte::page')

@section('title', 'Bank Reader')

@section('content_header')
@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Bank Reader</h3>
                {{-- <a class="float-right btn btn-light" href="">
                    APIs
                </a> --}}
            </div>
            <div class="card-body">
                @if(isset($bank_statement_reader['statusCode']) && $bank_statement_reader['statusCode'] == 102)
                    <div class="alert alert-danger" role="alert">
                        Please enter bank name. 
                    </div>
                @endif
                @if(isset($bank_statement_reader['statusCode']) && $bank_statement_reader['statusCode'] == 500)
                <div class="alert alert-danger" role="alert">
                    Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                </div>
                @endif
                @if(isset($bank_statement_reader['statusCode']) && $bank_statement_reader['statusCode'] == 103)
                  <div class="alert alert-danger" role="alert">
                      You are not registered to use this service. Please update your plan.
                  </div>
                @endif
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{route('kyc.bankstatement.reader')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">Uplode file</label>
                                    <input type="file" class="form-control" 
                                     name="file"
                                    />
                                    <label for="name">Bank Name</label>
                                    <input type="text" class="form-control" 
                                     name="bank_name" placeholder="Bank Name"
                                    />
                                    <label for="name">AccountType</label>
                                    <input type="text" class="form-control" 
                                     name="account_type" placeholder="Account Type"
                                    />
                                    <label for="name">Password</label>
                                    <input type="text" class="form-control" 
                                     name="password" placeholder="Enter a password"
                                    />
                                </div>
                                <button type="submit" class="btn btn-success">Verify</button>
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