@if (!empty($upidetails['upidetails']) && $upidetails['statusCode'] == 200)
     <div class="card card-success">
         <div class="card-header">
             <h3 class="card-title">UPI Details</h3>
         </div>
         <div class="card-body">
             <div class="row">
                 <div class="col-md-12">
                     <div>
                         <p><b>Order ID:</b> {{ $upidetails['upidetails']['response']['orderId'] }}</p>
                         <p><b>Name:</b>
                             {{ $upidetails['upidetails']['response']['account_details']['beneficiary_name'] }}
                         </p>
                         <p><b>UPI Id:</b>
                             {{ $upidetails['upidetails']['response']['account_details']['beneficiary_vpa'] }}
                         </p>
                         <p><b>Account Status:</b>
                             {{ $upidetails['upidetails']['response']['account_details']['account_status'] }}</p>
 
                     </div>
                 </div>
             </div>
         </div>
     </div>
     @endif
     @if(isset($upidetails_response) && $upidetails_response != null)
     <div class="card card-success">
         <div class="card-header">
             <h3 class="card-title">UPI Details</h3>
         </div>
         <div class="card-body">
             <div class="row">
                 <div class="col-md-12">
                     <div>
                         @if(!empty($upidetails_response['upidetails']['response']['orderId']))
                            <p><b>Order ID:</b> {{$upidetails_response['upidetails']['response']['orderId'] }}</p>
                         @else
                         @endif
                         @if(!empty($upidetails_response['upidetails']['response']['account_details']['account_status']))
                         <p><b>Account Status:</b>
                             {{ $upidetails_response['upidetails']['response']['account_details']['account_status'] }}
                         </p>
                         @else
                         @endif
                         @if(!empty($upidetails_response['upidetails']['response']['account_details']['beneficiary_name']))
                         <p><b>Name:</b>
                             {{ $upidetails_response['upidetails']['response']['account_details']['beneficiary_name'] }}
                         </p>
                         @else
                         @endif
                         @if(!empty($upidetails_response['upidetails']['response']['account_details']['beneficiary_vpa']))
                          <p><b>UPI Id:</b>
                             {{$upidetails_response['upidetails']['response']['account_details']['beneficiary_vpa'] }}
                           </p>
                         @else
                         @endif
                         @if(!empty($upidetails_response['upidetails']['response']['mode']))
                           <p><b>Mode:</b>
                             {{$upidetails_response['upidetails']['response']['mode'] }}
                           </p>
                          @else
                         @endif
                         @if(!empty($upidetails_response['upidetails']['response']['utr']))
                         <p><b>UTR:</b>
                             {{$upidetails_response['upidetails']['response']['utr'] }}
                           </p>
                         @else
                         @endif
                         @if(!empty($upidetails_response['upidetails']['response']['commission']))
                         <p><b>Commission:</b>
                             {{$upidetails_response['upidetails']['response']['commission'] }}
                           </p>
                         @else
                         @endif
                         @if(!empty($upidetails_response['upidetails']['response']['charge']))
                         <p><b>Charge:</b>
                             {{$upidetails_response['upidetails']['response']['charge'] }}
                           </p>
                         @else
                         @endif
                         @if(!empty($upidetails_response['upidetails']['response']['tax']))
                         <p><b>Tax:</b>
                             {{$upidetails_response['upidetails']['response']['tax'] }}
                           </p>
                         @else
                         @endif
                         @if(!empty($upidetails_response['upidetails']['response']['created_at']))
                         <p><b>Created At:</b>
                             {{$upidetails_response['upidetails']['response']['created_at'] }}
                           </p>
                         @else
                         @endif
                      </div>
                 </div>
             </div>
         </div>
      </div>
     @endif