 <!--Gstin Api Error-->
 @if(isset($corporate_gstin['statusCode']) && $corporate_gstin['statusCode'] == '102' || isset($corporate_gstin[0]['corporate_gstin']['code']) && $corporate_gstin[0]['corporate_gstin']['code']=='404')
 <div class="alert alert-danger" role="alert">
     CORPORATE GSTIN is Invalid
 </div>
@endif
@if(isset($corporate_gstin[0]['corporate_gstin']['code']) && ($corporate_gstin[0]['corporate_gstin']['code'] == '400'))
 <div class="alert alert-danger" role="alert">
     Server Error, Please try later
 </div>
@endif
@if(isset($corporate_gstin[0]['corporate_gstin']['code']) && $corporate_gstin[0]['corporate_gstin']['code'] == '500')
 <div class="alert alert-danger" role="alert">
     Internal Server Error. Please contact techsupport@docboyz.in. for more details.
 </div>
@endif
 <!--Gstin Api Error End-->