    <!--Ifsc Api Error Start-->
@if(isset($bank_verification_ifsc[0]['bank_verification_api']['code']) && $bank_verification_ifsc[0]['bank_verification_api']['code'] == '102')
    <div class="alert alert-danger" role="alert">
        IFSC CODE is invalid
  </div>
@endif
@if(isset($bank_verification_ifsc[0]['bank_verification_api']['code']) && ($bank_verification_ifsc[0]['bank_verification_api']['code'] == '404'))
<div class="alert alert-danger" role="alert">
    {{$bank_verification_ifsc[0]['bank_verification_api']['response']}}
</div>
@endif
@if(isset($bank_verification_ifsc[0]['bank_verification_api']['code']) && $bank_verification_ifsc[0]['bank_verification_api']['code'] == '500')
<div class="alert alert-danger" role="alert">
    Internal Server Error. Please contact techsupport@docboyz.in. for more details.
</div>
@endif
@if(isset($bank_verification_ifsc['statusCode']) && $bank_verification_ifsc['statusCode'] == 102)
<div class="alert alert-danger" role="alert">
     {{$bank_verification_ifsc['message']}}
</div>
@endif
@if(isset($bank_verification_ifsc['statusCode']) && $bank_verification_ifsc['statusCode'] == 500)
<div class="alert alert-danger" role="alert">
     {{$bank_verification_ifsc['message']}}
</div>
@endif
@if(isset($bank_verification_ifsc['statusCode']) && $bank_verification_ifsc['statusCode'] ==103)
<div class="alert alert-danger" role="alert">
     {{$bank_verification_ifsc['message']}}
</div>
@endif
@if(isset($bank_verification_ifsc[0]['bank_verification_api']['code']) && $bank_verification_ifsc[0]['bank_verification_api']['code'] == '500')
<div class="alert alert-danger" role="alert">
    Internal Server Error. Please contact techsupport@docboyz.in. for more details.
</div>
@endif
<!--Ifsc Api Error End-->