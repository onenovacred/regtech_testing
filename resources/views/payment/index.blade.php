@extends('adminlte::page')

@section('title', 'Splash Screen Images')

@section('content_header')
@stop

@section('custom_css')

@stop

@section('content')
<div class="row text-right container">
    <a class="btn btn-sm btn-primary" href="{{ url('/admin/payment/process') }}">Proceed Payment</a>
    <button class="btn btn-sm btn-primary" id="ebz-checkout-btn">Proceed to Pay</button>
<script
src="https://ebz-static.s3.ap-south-1.amazonaws.com/easecheckout/easebuzz-checkout.js"></script>
<script>
var easebuzzCheckout = new EasebuzzCheckout('2PBP7IABZ2', 'test')
document.getElementById('ebz-checkout-btn').onclick = function(e){
var options = {
access_key: '2PBP7IABZ2', // access key received via Initiate Payment
onResponse: (response) => {
console.log(response);
},
theme: "#123456" // color hex
}
easebuzzCheckout.initiatePayment(options);
}
</script>
</div>
@stop

@section('custom_js')

@stop