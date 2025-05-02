 <!--start Equifax score Api Error-->
 @if (isset($score_api_message))
 @php
     $messageDatasss = json_decode($score_api_message, true);
 @endphp
 <div class="alert alert-danger alert-dismissible fade show" role="alert">
     <strong>StatusCode : {{ $messageDatasss['statusCode'] }}</strong> &nbsp;&nbsp;<strong>Message :
         {{ $messageDatasss['message'] }}</strong>
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
     </button>
 </div>
@endif
 <!--End Equifax score Api Error-->