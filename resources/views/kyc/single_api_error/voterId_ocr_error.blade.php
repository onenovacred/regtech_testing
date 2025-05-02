   <!--voterId Ocr Error message-->
   @if (isset($voterid['status_code']) && $voterid['status_code'] == 102)
   <div class="alert alert-danger" role="alert">
       Invalid file only upload VoterId image.
   </div>
@endif
@if (isset($voterid['status_code']) && $voterid['status_code'] ==404)
   <div class="alert alert-danger" role="alert">
       No Image file provided.
   </div> 
@endif
@if (isset($voterid['statusCode']) && $voterid['statusCode'] ==103)
<div class="alert alert-danger" role="alert">
      {{$voterid['message']}}
</div> 
@endif
@if (isset($vostatusCode) && $vostatusCode== 500)
<div class="alert alert-danger" role="alert">
      Internal server error Please contact techsupport@docboyz.in for more details.
</div>
@endif