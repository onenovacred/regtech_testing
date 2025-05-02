@if (isset($voter_validation[0]['statusCode']) && $voter_validation[0]['statusCode'] == '400')
<div class="alert alert-danger" role="alert">
    Voter ID is Invalid
</div>
@endif
@if (isset($voter_validation[0]['statusCode']) && $voter_validation[0]['statusCode'] == '404')
<div class="alert alert-danger" role="alert">
    Server Error, Please try later
</div>
@endif
@if (isset($voter_validation[0]['statusCode']) && $voter_validation[0]['statusCode'] == '500')
<div class="alert alert-danger" role="alert">
    Internal Server Error. Please contact techsupport@docboyz.in. for more details.
</div>
@endif
@if (isset($voter_validation['statusCode']) && $voter_validation['statusCode'] == '103')
<div class="alert alert-danger" role="alert">
  {{$voter_validation['message']}}
</div>
@endif