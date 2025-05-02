@extends('adminlte::page')

@section('title', 'RegtechAPI')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-primary">
                <div class="card-header">
                    <h3 class="card-title">Bill Report</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h5>Name: <i style="color: grey; font-size: 20px">{{$users['name']}}</i></h5>
                            <h5>Email: <i style="color: grey; font-size: 20px">{{$users['email']}}</i></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="clearfix">
                                <div class="pull-right tableTools-container"></div>
                            </div>
                            <table id="dynamic-table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">Sr</th>
                                        <th>Service</th>
                                        <th style="width: 10%;">Price</th>
                                        <th style="width: 15%;">Hit Count</th>
                                        <th style="width: 10%;">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  
                                    @foreach($reports as $value)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$value['api_name']}}</td>
                                        <td class="text-right">{{$value['scheme_price']}}</td>
                                        <td class="text-center">{{$value['hit_count']}}</td>
                                        @if(Auth::user()->scheme_type=='demo')
                                           <td class="text-right">0</td>
                                        @else
                                           <td class="text-right">{{($value['total'])}}</td>
                                        @endif
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <th colspan=4>Total Transaction</th>
                                        <?php
                                            $transactionTotal = 0;
                                            foreach($reports as $key=>$value){
                                                $transactionTotal += $value['total'];
                                            }
                                        ?>
                                        <th class="text-right"><?php echo $transactionTotal;?></th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop


@section('custom_js')
<script>
   
</script>
@stop