@extends('adminlte::page')

@section('title', 'Create Order')
<style>
    .flex-fill-center {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .details_header {
        font-family: 'system-ui';
        font-size: 15px;
        font-weight: 600;
    }
    .form-content {
            width: 100%;
        }
    .form-group{
            margin-left: 10;
     }
     .landmark_form{
            width:94% !important;
     }
     @media only screen and (max-width: 600px) {
       body {
        background-color: lightblue;
      }
   }
</style>
@section('content_header')
@stop

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="flex-fill-center">
                        <h5 class="card-title mb-2 text-muted text-uppercase border-bottom border-dark">Create Order</h5>
                    </div>
                    <hr />
             
                    <form role="form" method="post" action="{{url('create_task_submit')}}">
                        {{ csrf_field() }}
                        <p class="details_header">Pickup Details</p>
                        <hr/>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-lg-6 ml-3">
                                <div class="form-group  ml-3">
                                    <label for="name">Name</span></label>
                                    <input type="text" class="form-control"  id="pickup_name"
                                        name="pickup_name" value="{{ old('pickup_name') }}" placeholder="Enter a name">
                                        @if ($errors->has('pickup_name'))
                                        <span style="color:red;">{{ $errors->first('pickup_name') }}</span>
                                        @endif
                                </div>
                              </div>     
                             <div class="col-md-6 col-sm-6 col-lg-5 ml-4">
                                <div class="form-group ml-3">
                                    <label for="name">Mobile Number<span style="color:red;">*</span></label>
                                    <input type="text" class="form-control"
                                        id="mobile_number" name="mobile_number" value="{{ old('mobile_number') }}" 
                                       placeholder="Enter a mobile number" />
                                       @if ($errors->has('mobile_number'))
                                       <span style="color:red;">{{ $errors->first('mobile_number') }}</span>
                                       @endif
                                </div>
                              </div>
                        </div>  
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-lg-6 ml-3">
                                <div class="form-group  ml-3">
                                    <label for="pickup_address1">Address 1<span style="color:red;">*</span></label>
                                    <input type="text" class="form-control"  id="pickup_address1"
                                        name="pickup_address1" value="{{ old('pickup_address1') }}" placeholder="Enter a address">
                                        @if ($errors->has('pickup_address1'))
                                        <span style="color:red;">{{ $errors->first('pickup_address1') }}</span>
                                        @endif
                                </div>
                              </div>     
                             <div class="col-md-6 col-sm-6 col-lg-5 ml-4">
                                <div class="form-group ml-3">
                                    <label for="name">Address 2</span></label>
                                    <input type="text" class="form-control"
                                        id="pickup_address2" name="pickup_address2" value="{{ old('pickup_address2') }}" 
                                       placeholder="Enter a address" />
                                </div>
                              </div>
                        </div> 
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-lg-6 ml-3">
                                <div class="form-group  ml-3">
                                    <label for="name">Latitude <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control"  id="pickup_latitude"
                                        name="pickup_latitude" value="{{ old('pickup_latitude') }}" placeholder="Enter a latitude">
                                        @if ($errors->has('pickup_latitude'))
                                        <span style="color:red;">{{ $errors->first('pickup_latitude') }}</span>
                                        @endif
                                </div>
                              </div>     
                             <div class="col-md-6 col-sm-6 col-lg-5 ml-4">
                                <div class="form-group ml-3">
                                    <label for="name">Longitude  <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control"
                                        id="pickup_longitude" name="pickup_longitude" value="{{ old('pickup_longitude') }}" 
                                       placeholder="Enter a longitude" />
                                       @if ($errors->has('pickup_longitude'))
                                          <span style="color:red;">{{ $errors->first('pickup_longitude') }}</span>
                                       @endif
                                </div>
                              </div>
                        </div> 
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-lg-6 ml-3">
                                <div class="form-group  ml-3">
                                    <label for="name">City</label>
                                    <input type="text" class="form-control"  id="pickup_city"
                                        name="pickup_city" value="{{ old('pickup_city') }}" placeholder="Enter a city">
                                </div>
                              </div>     
                             <div class="col-md-6 col-sm-6 col-lg-5 ml-4">
                                <div class="form-group ml-3">
                                    <label for="name">State</label>
                                    <input type="text" class="form-control"
                                        id="pickup_state" name="pickup_state" value="{{ old('pickup_state') }}" 
                                       placeholder="Enter a state" />
                                </div>
                              </div>
                        </div>  
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-lg-6 ml-3">
                                <div class="form-group  ml-3">
                                    <label for="name">Pincode</label>
                                    <input type="text" class="form-control"  id="pickup_pincode"
                                        name="pickup_pincode" value="{{ old('pickup_pincode') }}" placeholder="Enter a pincode">
                                </div>
                              </div>     
                             <div class="col-md-6 col-sm-6 col-lg-5 ml-4">
                                <div class="form-group ml-3">
                                    <label for="name">Country</label>
                                    <input type="text" class="form-control"
                                        id="pickup_country" name="pickup_country" value="{{ old('pickup_country') }}" 
                                       placeholder="Enter a country" />
                                </div>
                              </div>
                        </div>  
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-lg-12 ml-3">
                                <div class="form-group ml-3">
                                    <label for="name">LandMark</label>
                                    <input type="text" class="form-control landmark_form"
                                        id="pickup_landmark" name="pickup_landmark" value="{{ old('pickup_landmark') }}" 
                                       placeholder="Enter a landmark" />
                                </div>
                            </div>
                        </div> 
                        <p class="details_header">Drop Details</p>
                        <hr/>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-lg-6 ml-3">
                                <div class="form-group  ml-3">
                                    <label for="name">Name</span></label>
                                    <input type="text" class="form-control"  id="drop_name"
                                        name="drop_name" value="{{ old('drop_name') }}" placeholder="Enter a name">
                                        @if ($errors->has('drop_name'))
                                        <span style="color:red;">{{ $errors->first('drop_name') }}</span>
                                        @endif
                                </div>
                              </div>     
                             <div class="col-md-6 col-sm-6 col-lg-5 ml-4">
                                <div class="form-group ml-3">
                                    <label for="name">Mobile Number<span style="color:red;">*</span></label>
                                    <input type="text" class="form-control"
                                        id="drop_mobile_number" name="drop_mobile_number" value="{{ old('drop_mobile_number') }}" 
                                       placeholder="Enter a mobile number" />
                                       @if ($errors->has('drop_mobile_number'))
                                       <span style="color:red;">{{ $errors->first('drop_mobile_number') }}</span>
                                       @endif
                                </div>
                              </div>
                        </div> 
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-lg-6 ml-3">
                                <div class="form-group  ml-3">
                                    <label for="drop_address1">Address 1<span style="color:red;">*</span></label>
                                    <input type="text" class="form-control"  id="pickup_address1"
                                        name="drop_address1" value="{{ old('drop_address1') }}" placeholder="Enter a address">
                                      @if ($errors->has('drop_address1'))
                                      <span style="color:red;">{{ $errors->first('drop_address1') }}</span>
                                      @endif
                                </div>
                              </div>     
                             <div class="col-md-6 col-sm-6 col-lg-5 ml-4">
                                <div class="form-group ml-3">
                                    <label for="name">Address 2</span></label>
                                    <input type="text" class="form-control"
                                        id="drop_address2" name="drop_address2" value="{{ old('drop_address2') }}" 
                                       placeholder="Enter a address" />
                                </div>
                              </div>
                        </div> 
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-lg-6 ml-3">
                                <div class="form-group  ml-3">
                                    <label for="name">Latitude <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control"  id="drop_latitude"
                                        name="drop_latitude" value="{{ old('drop_latitude') }}" placeholder="Enter a latitude">
                                        @if ($errors->has('drop_latitude'))
                                        <span style="color:red;">{{ $errors->first('drop_latitude') }}</span>
                                        @endif
                                </div>  
                               
                             </div>     
                             <div class="col-md-6 col-sm-6 col-lg-5 ml-4">
                                <div class="form-group ml-3">
                                    <label for="name">Longitude <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control"
                                        id="drop_longitude" name="drop_longitude" value="{{ old('drop_longitude') }}" 
                                       placeholder="Enter a longitude" />
                                       @if ($errors->has('drop_longitude'))
                                       <span style="color:red;">{{ $errors->first('drop_longitude') }}</span>
                                       @endif
                                </div>
                             </div>
                        </div>  
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-lg-6 ml-3">
                                <div class="form-group  ml-3">
                                    <label for="name">City</label>
                                    <input type="text" class="form-control"  id="drop_city"
                                        name="drop_city" value="{{ old('drop_city') }}" placeholder="Enter a city">
                                </div>
                              </div>     
                             <div class="col-md-6 col-sm-6 col-lg-5 ml-4">
                                <div class="form-group ml-3">
                                    <label for="name">State</label>
                                    <input type="text" class="form-control"
                                        id="drop_state" name="drop_state" value="{{ old('drop_state') }}" 
                                       placeholder="Enter a state" />
                                </div>
                              </div>
                        </div>  
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-lg-6 ml-3">
                                <div class="form-group  ml-3">
                                    <label for="name">Pincode</label>
                                    <input type="text" class="form-control"  id="pickup_pincode"
                                        name="drop_pincode" value="{{ old('drop_pincode') }}" placeholder="Enter a pincode">
                                </div>
                              </div>     
                             <div class="col-md-6 col-sm-6 col-lg-5 ml-4">
                                <div class="form-group ml-3">
                                    <label for="name">Country</label>
                                    <input type="text" class="form-control"
                                        id="drop_country" name="drop_country" value="{{ old('drop_country') }}" 
                                       placeholder="Enter a country" />
                                </div>
                              </div>
                        </div>  
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-lg-12 ml-3">
                                <div class="form-group ml-3">
                                    <label for="name">LandMark</label>
                                    <input type="text" class="form-control landmark_form"
                                        id="drop_landmark" name="drop_landmark" value="{{ old('drop_landmark') }}" 
                                       placeholder="Enter a landmark" />
                                </div>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-lg-6 ml-3">
                                <div class="form-group  ml-3">
                                    <label for="name">Amount<span style="color:red;">*</span></label>
                                    <input type="text" class="form-control"  id="drop_amount"
                                        name="drop_amount" value="{{ old('drop_amount') }}" placeholder="Enter a amount">
                                        @if ($errors->has('drop_amount'))
                                              <span style="color:red;">{{ $errors->first('drop_amount') }}</span>
                                         @endif
                                     </div>
                                </div>     
                             <div class="col-md-6 col-sm-6 col-lg-5 ml-4">
                                <div class="form-group ml-3">
                                    <label for="name">Payment Mode<span style="color:red;">*</span></label>
                                    <select class="form-control"  name="payment_method" id="payment_method"
                                    class="form-control selectpicker multiselect" data-live-search="true"
                                    data-actions-box="true">
                                     <option value="">Select Payment Option</option>
                                     <option value="COD">Cash-On-Delivery</option>
                                     <option value="DUNZO_CREDIT">Dunzo Credit</option>
                                  </select>
                                  @if ($errors->has('payment_method'))
                                    <span style="color:red;">{{ $errors->first('payment_method') }}</span>
                                  @endif
                                </div>
                             </div>
                             <div class="form-group ml-5">
                             <input type="submit" class="btn btn-success btn sm" value="Submit"/>
                             </div>
                        </div>  
                    </form>
                    </div>
            </div>
    <div>
@stop
@section('custom_js')
     <script type="text/javascript">
      $(document).ready(function() {
      $('#mobile_number').on('keypress', function(e) {
        let inputLength = $(this).val().length;
        if (inputLength >= 10) {
            e.preventDefault();
        }
      });
      $('#drop_mobile_number').on('keypress', function(e) {
        let inputLength = $(this).val().length;
        if (inputLength >= 10) {
            e.preventDefault();
        }
      });
});

 </script>

@stop
