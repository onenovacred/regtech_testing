@extends('adminlte::page')

@section('title', 'ITR')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">ITR Client ID Verify</h3>
            </div>
                <div class="card-body">
                    <form role="form" method="post" action="{{route('itr.itr_enter_clientid')}}">
                        {{csrf_field()}}
                            <div class="form-group">
                                <label for="name">Client ID</label>
                            <input type="text" class="form-control" 
                                id="client_id" name="client_id" value="{{old('client_id')}}" 
                                placeholder="Ex: ABCDE1234N" required>
                            </div>
                            <button type="submit" class="btn btn-success">Send</button>
                    </form>
                </div>
            </div>
        </div>
        
        @if($statusCode)
        <div class="col-md-6 offset-md-3">
        <div class="@if(!empty($itr_enter_clientid) && $itr_enter_clientid['status_code'] == 200) card card-success @else card card-danger @endif">
            <div class="card-header">
                <h3 class="card-title">ITR Client ID</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
                        @if(!empty($itr_enter_clientid) && $itr_enter_clientid['status_code'] == 200)
                        <p>Verification: Success</p>
                        @else
                        <p>Verification: Failed (Incorrect Client ID / Expired)</p>
                        @endif
                      </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        @endif
    </div>
</div>
@stop


@section('custom_js')
@stop