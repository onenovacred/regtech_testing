@extends('adminlte::page')

@section('title', 'Electricity')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Electricity</h3>
            </div>
            <div class="card-body">
                @if(isset($electricity['electricity']['code']) && $electricity['electricity']['code'] == '200' && $electricity['electricity']['response']['isValid'] == 'No')
                    <div class="alert alert-danger" role="alert">
                        {{$electricity['electricity']['response']['reason']}}
                    </div>
                @endif
                @if(isset($electricity['electricity']['code']) && $electricity['electricity']['code'] == '404')
                <div class="alert alert-danger" role="alert">
                    {{$electricity['electricity']['response']}}
                </div>
                @endif
                @if(isset($electricity['electricity']['code']) && $electricity['electricity']['code'] == '500')
                <div class="alert alert-danger" role="alert">
                    Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                </div>
                @endif
                <div class="row">
                    <div class="col-md-7 offset-md-2">
                        <form role="form" method="post" action="{{route('kyc.electricity')}}">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="name">Consumer Number with Billing Unit</label>
                                <input type="text" class="form-control" id="id_number" name="id_number" value="{{old('id_number')}}" 
                                placeholder="Billing unit/Consumer Number" required>
                            </div>
                            <!-- <div class="form-group">
                                <label for="name">Operator Code</label>
                                <input type="text" class="form-control" id="code" name="code" value="{{old('code')}}" 
                                placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Billing Unit</label>
                                <input type="text" class="form-control" id="billing_unit" name="billing_unit" value="{{old('billing_unit')}}" 
                                placeholder="" required>
                            </div> -->
                            <!-- @if(!empty($states) && isset($states['status_code']) && $states['status_code'] == 200)
                            <div class="form-group">
                                <label>State</label>
                                <select class="form-control select2" name="code" style="width: 100%;" required>
                                    <option selected="selected" disabled>Select State</option>
                                    @foreach($states['data'] as $state)
                                <option value="{{$state['operator_code']}}">{{$state['state']}}</option>
                                    @endforeach
                                </select>
                                </div>
                                @endif -->
                            <button type="submit" class="btn btn-success">Verify</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($electricity))
            @if(isset($electricity['electricity']['code']) && $electricity['electricity']['code'] == 200 && $electricity['electricity']['response']['isValid'] == 'Yes')
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Electricity Bill Details</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                        <div>
                            <p><strong>Customer ID:</strong> {{ $electricity['electricity']['response']['customer_id'] }}</p>
                            <p><strong>Customer Name:</strong> {{ $electricity['electricity']['response']['customer_name'] }}</p>
                            <p><strong>Operator:</strong> {{ $electricity['electricity']['response']['operator_name'] }} - {{ $electricity['electricity']['response']['operator_code'] }}</p>
                            <p><strong>Due Amount:</strong> {{ $electricity['electricity']['response']['due_amount'] }}</p>
                            <p><strong>Due Date:</strong> {{ $electricity['electricity']['response']['due_date'] }}</p>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="alert alert-danger" role="alert">
                Internal Server Error. Please contact techsupport@docboyz.in. for more details.
            </div>
            @endif
        @endif
    </div>
</div>
@stop


@section('custom_js')
<script>
    //   $(function () {
    //   //Initialize Select2 Elements
    //      $('.select2').select2()

    //   });
</script>
@stop