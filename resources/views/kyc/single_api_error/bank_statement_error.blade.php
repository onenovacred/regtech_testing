@if (isset($bank_statement2['statusCode']) && $bank_statement2['statusCode'] == 103)
<div class="alert alert-danger" role="alert">
    {{$bank_statement2['message']}}
</div>
@endif
@if (isset($bank_statement2['statusCode']) && $bank_statement2['statusCode'] == 102)
<div class="alert alert-danger" role="alert">
       Bank name not found.
</div>
@endif
@if (isset($bank_statement2['statusCode']) && $bank_statement2['statusCode'] == 500)
 <div class="alert alert-danger" role="alert">
     Internal Server Error. Please contact techsupport@docboyz.in. for more details.
 </div>
@endif