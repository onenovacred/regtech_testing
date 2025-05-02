@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<form role="form" method="post" action="{{route('billing.add_wallet')}}">
{{csrf_field()}}
<div class="row">
@if(Auth::user()->id== 1)
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">Select User</label>
            <select class="form-control" id="user" name="user" required>
                <option disabled selected>Select Prepaid User</option>
                @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}} : {{$user->email}} : Rs {{$user->wallet_amount}}</option>
                @endforeach
            </select>
        </div>
    </div>
@endif  
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">Credit / Debit</label>
            <select class="form-control" id="transaction_type" name="transaction_type" required>
                <option disabled selected>credit / debit</option>
                <option value="credit">credit</option>
                <option value="debit">debit</option>
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="credit/debit">Wallet Balance to Credit / Debit. For Ex : [ 15000 ]</label>
            <input type="text" class="form-control" id="amount" name="amount" placeholder="Wallet Balance to Credit / Debit">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="reason">Reason & Transaction for Credit / Debit <br>  [ why credited ? , Who Credited ? , Bank Transaction/UTR Number? ] </label>
            <input type="text" class="form-control" id="reason" name="reason" placeholder="Reason For Credit / Debit and Transaction Details" required>
        </div>
    </div>

    <div class="col-md-6">
        <button type="submit" class="btn btn-primary">Add</button>
    </div>
</div>
</form>
@stop


@section('custom_js')
@stop