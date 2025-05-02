@if (isset($fast_tag_information['statusCode']) && $fast_tag_information['statusCode'] == '102')
<div class="alert alert-danger" role="alert">
    Invalid RC Number / RC Number in Multiple RTOs. Error Code - 102
</div>
@endif
@if (isset($fast_tag_information['statusCode']) && $fast_tag_information['statusCode'] == '101')
<div class="alert alert-danger" role="alert">
    RC Number in Multiple RTOs. Error Code - 101
</div>
@endif
@if (isset($fast_tag_information['statusCode']) && $fast_tag_information['statusCode'] == '103')
<div class="alert alert-danger" role="alert">
   {{$fast_tag_information['message']}} 
</div>
@endif
@if (isset($fast_tag_information['statusCode']) &&
    ($fast_tag_information['statusCode'] == '404' ||
        $fast_tag_information['statusCode'] == '400' ||
        $fast_tag_information['statusCode'] == '401'))
<div class="alert alert-danger" role="alert">
    Server Error, Please try later
</div>
@endif
@if (isset($fast_tag_information['statusCode']) && $fast_tag_information['statusCode'] == '500')
<div class="alert alert-danger" role="alert">
    Internal Server Error. Please contact techsupport@docboyz.in. for more details.
</div>
@endif