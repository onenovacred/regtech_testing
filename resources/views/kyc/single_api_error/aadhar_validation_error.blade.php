@if (isset($aadhaar_validation[0]['aadhaar_validation']['status']['statusCode']) &&
$aadhaar_validation[0]['aadhaar_validation']['status']['statusCode'] == '102')
<div class="alert alert-danger" role="alert">
Aadhaar Number is Invalid
</div>
@endif
@if (isset($aadhaar_validation[0]['aadhaar_validation']['status']['statusCode']) &&
$aadhaar_validation[0]['aadhaar_validation']['status']['statusCode'] == '404')
<div class="alert alert-danger" role="alert">
{{ $aadhaar_validation[0]['aadhaar_validation']['response'] }}
</div>
@endif
@if (isset($aadhaar_validation['statusCode']) && $aadhaar_validation['statusCode'] == 400)
<div class="alert alert-danger" role="alert">
Internal Server Error. Please contact techsupport@docboyz.in. for more details.
</div>
@endif
@if (isset($aadhaar_validation['statusCode']) && $aadhaar_validation['statusCode'] == 103)
<div class="alert alert-danger" role="alert">
{{$aadhaar_validation['message']}}
</div>
@endif