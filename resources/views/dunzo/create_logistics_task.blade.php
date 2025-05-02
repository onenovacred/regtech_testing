@extends('adminlte::page')

@section('title', 'Create Logistics')
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
</style>
@section('content_header')
@stop

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="flex-fill-center">
                        <h5 class="card-title mb-2 text-muted text-uppercase">Estimated Price Logistics Task</h5>
                    </div>
                    <hr />
             
                    <form role="form" method="post" action="{{url('create_logistics_task_submit')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <p class="details_header">Pickup Details</p>
                        <hr/>
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
                        <p class="details_header">Drop Details</p>
                        <hr/>
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
                                    <label for="name">Amount<span style="color:red;">*</span></label>
                                    <input type="text" class="form-control"  id="drop_amount"
                                        name="drop_amount" value="{{ old('drop_amount') }}" placeholder="Enter a amount.">
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
                             <div class="form-group  ml-5"> 
                             <input type="submit" class="btn btn-success btn sm" value="Submit"/>
                             </div>
                             
                        </div>  
                    </form>
                    </div>
            </div>
            <div>
            @stop
@section('custom_js')
@stop
