   <!--pancard details api error start-->
   @if (isset($pancardnew_details['statusCode']) && $pancardnew_details['statusCode']==102 && $pancardnew_details['message'] == 'No Records found!.')
   <div class="alert alert-danger" role="alert">
       Record Not Found !
   </div>
@endif
@if (isset($pancardnew_details['statusCode']) && $pancardnew_details['statusCode']==102 && $pancardnew_details['message'] =='PAN Number InValid Please Enter Correct PanNumber.')
   <div class="alert alert-danger" role="alert">
       PAN Number InValid Please Enter Correct PanNumber.
   </div>
@endif
@if (isset($pancardnew_details['statusCode']) && $pancardnew_details['statusCode']==500)
   <div class="alert alert-danger" role="alert">
       Internal Server Error. Please contact techsupport@docboyz.in. for more details.
   </div>
@endif
@if (isset($pancardnew_details['statusCode']) && $pancardnew_details['statusCode']==103)
<div class="alert alert-danger" role="alert">
  You are not registered to use this service. Please update your plan.
</div>
@endif
<!--Pancard details api error end--->