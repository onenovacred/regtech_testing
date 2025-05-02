                @if(isset($corporate_cin1['statusCode']) && $corporate_cin1['statusCode'] == '102')
                    <div class="alert alert-danger" role="alert">
                        CORPORATE CIN is Invalid 
                    </div>
                @endif
                @if(isset($corporate_cin1['statusCode']) && ($corporate_cin1['statusCode'] == '404' || $corporate_cin1['statusCode'] == '400'))
                    <div class="alert alert-danger" role="alert">
                        Server Error, Please try later
                    </div>
                @endif
                @if(isset($corporate_cin1['statusCode']) &&  $corporate_cin1['statusCode'] == '500')
                    <div class="alert alert-danger" role="alert">
                        Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                    </div>
                @endif
                @if(isset($corporate_cin1['statusCode']) &&  $corporate_cin1['statusCode'] == '401')
                <div class="alert alert-danger" role="alert">
                     Error. Please contact techsupport@docboyz.in. for more details.
                </div>
                @endif
                @if(isset($corporate_cin1['statusCode']) &&  $corporate_cin1['statusCode'] == '103')
                <div class="alert alert-danger" role="alert">
                    You are not registered to use this service. Please update your plan.
                </div>
                @endif