@extends('adminlte::page')

@section('title', 'Bank')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Bank Statement</h3>
                <a class="float-right btn btn-secondary" href="">
                    API Doc
                </a>
            </div>
            <div class="card-body">
                {{-- @if(isset($bank_verification['statusCode']) && $bank_verification['statusCode'] == '102')
                    <div class="alert alert-danger" role="alert">
                        Please enter valid details. 
                  </div>
                @endif
                @if(isset($bank_verification['statusCode']) && ($bank_verification['statusCode'] == '404' || null))
                <div class="alert alert-danger" role="alert">
                    Error: {{ $statusCode }} Server Error, Please try later
                </div>
                @endif
                @if(isset($bank_verification['statusCode']) && $bank_verification['statusCode'] == '500')
                <div class="alert alert-danger" role="alert">
                    Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                </div>
                @endif --}}
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{route('kyc.bankstatement')}}" enctype="multipart/form-data">
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
                                </div>
                                <button type="submit" class="btn btn-success">Verify</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- @if(!empty($bank_verification) && isset($bank_verification[0]['status_code']))
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Bank Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                      <p>Account Status: {{ $bank_verification[0]['bank_verification']['account_status'] }}</p>
                        <!-- <p>Full Name: {{ $bank_verification[0]['bank_verification']['data']['full_name'] }}</p>
                        <p>Account Exists: {{ $bank_verification[0]['bank_verification']['data']['account_exists'] }}</p> -->
                      </div>
                    </div>
                </div>
            </div>
        </div>
        @endif --}}
    </div>
</div>
@stop


@section('custom_js')

@stop