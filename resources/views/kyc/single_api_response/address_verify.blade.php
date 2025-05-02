
@if (isset($verify_address['status_code']) && $verify_address['status_code'] ==200)
     <div class="row">
        <div class="col-md-6 offset-md-3">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Verified Address Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    <p><strong>Input Address:&nbsp;&nbsp;</strong>
                                        @if (!empty($verify_address['data']['input_address']))
                                            {{ $verify_address['data']['input_address'] }}
                                        @else
                                            null
                                        @endif
                                    </p>
                                    <p><strong>Match:&nbsp;&nbsp;</strong>
                                        @if (!empty($verify_address['data']['match']))
                                            {{ $verify_address['data']['match'] }}
                                        @else
                                        null
                                        @endif
                                    </p>
                                    <p><strong>Verified Address:&nbsp;&nbsp;</strong>
                                        @if (!empty($verify_address['data']['verified_address']))
                                            {{ $verify_address['data']['verified_address']}}
                                        @else
                                        null
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
     </div>     
 @endif
 <!--GET Place -->
 @if (isset($get_place['status_code']) && $get_place['status_code']==200)
 <div class="row">
    <div class="col-md-6 offset-md-3">
 <div class="card card-success">
     <div class="card-header">
         <h3 class="card-title">Get Place Address Details</h3>
     </div>
     <div class="card-body">
         <div class="row">
             <div class="col-md-12">
                 <div>
                     <p><strong>Label:&nbsp;&nbsp;</strong>
                         @if (!empty($get_place['data'][0]['label']))
                             {{ $get_place['data'][0]['label'] }}
                         @else
                             null
                         @endif
                     </p>
                     <p><strong>longitude:&nbsp;&nbsp;</strong>
                         @if (!empty($get_place['data'][0]['point'][0]))
                             {{$get_place['data'][0]['point'][0]}}
                         @else
                         null
                         @endif
                     </p>
                     <p><strong>latitude:&nbsp;&nbsp;</strong>
                         @if (!empty($get_place['data'][0]['point'][1]))
                             {{$get_place['data'][0]['point'][1]}}
                         @else
                         null
                         @endif
                     </p>
                 </div>
             </div>
         </div>
     </div>
 </div>
 </div>
 </div>
@endif