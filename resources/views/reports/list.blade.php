@extends('adminlte::page')

@section('title', 'RegtechAPI')

@section('content_header')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['line', 'corechart']});
        google.charts.setOnLoadCallback(drawChart);
        
        // function drawChart() {
        //     var chartDiv = document.getElementById('chart_div');
            
        //     var data = new google.visualization.DataTable();
        //     <?php
        //     if($userService!=0){
        //     ?>
        //         data.addColumn('string', 'Date');
        //     <?php
        //     }else{
        //     ?>
        //         data.addColumn('string', 'API Name');
        //     <?php 
        //     }
        //     ?>
        //     data.addColumn('number', "Hit Count");

        //     // data.addRows([
        //     //     // <?php 
        //     //     //     // if(isset($hits_date[0])){
        //     //     //         for($i=0;$i<$total_hits;$i++){
        //     //     //             if($userService!=0){
        //     //     //                 echo "['".$hits_date[$i]."',".$hits_per_day[$i]."],\n";
        //     //     //             }else{
        //     //     //                 echo "['".$api_name[$i]."',".$hit_count[$i]."],\n";
        //     //     //             }
        //     //     //         }
        //     //     //     // }
        //     //     // ?>
                
        //     // ]);
        //     // <?php
        //     // if(Auth::user()->id == 1){
        //     // ?>
        //     // data.addRows([
        //     //     <?php 
        //     //         // if(isset($hits_date[0])){
        //     //             for($i=0;$i<$total_hits;$i++){
        //     //                 if($userService!=0){
        //     //                     echo "['".$hits_date[$i]."',".$hits_per_day[$i]."],\n";
        //     //                 }else{
        //     //                     echo "['".$api_name[$i]."',".$hit_count[$i]."],\n";
        //     //                 }
        //     //             }
        //     //         // }
        //     //     ?>
        //     // ]);
        //     // <?php 
        //     // }
        //     // ?>

        //     var materialOptions = {
        //       chart: {
        //         title: 'API Hit Count'
        //       },
        //       width: 1000,
        //       height: 400,
        //       series: {
        //         0: {axis: 'hit_count'},
        //         1: {axis: 'api_name'}
        //       },
        //       axes: {
        //         y: {
        //           hit_count: {label: 'hit_count'},
        //           api_name: {label: 'api_name'}
        //         }
        //       }
        //     };

        //     function drawMaterialChart() {
        //       var materialChart = new google.charts.Line(chartDiv);
        //       materialChart.draw(data, materialOptions);
        //     }
        //     drawMaterialChart();
        // }

    </script>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-primary">
                <div class="card-header">
                    <form id="generate_bill" role="form" method="post" action="{{route('reports.generate_bill')}}">
                        @csrf
                        <h3 class="card-title">Report ({{Auth::user()->name}})</h3>
                        <div class="card-tools" style="float: right;">
                        @if($userService!=0)
                            <input name="userDetails" id="userDetails" type="hidden" value={{$userService}}>
                            <button id="generateBill" class="btn btn-warning"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;Generate Bill</button>
                        @else    
                            <input name="userDetails" id="userDetails" type="hidden" value="">
                            <button id="generateBill" class="btn btn-warning" disabled><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;Generate Bill</button>
                        @endif
                        @if($year_month!=0)    
                            <input name="yearMonth" id="yearMonth" type="hidden" value="{{$year_month}}">
                        @else
                            <input name="yearMonth" id="yearMonth" type="hidden" value="">
                        @endif
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <form role="form" method="post" action="{{route('reports.list')}}">
                    @csrf
                        <div class="row">
                            @if($isAdmin == true)
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="endDate">Select User</label>
                                        <select id="user" name="user" class="form-control">
                                            <option value="0" @if($userService==0) selected @endif>All</option>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}" @if($userService==$user->id) selected @endif>{{$user->name}} : {{$user->email}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif    
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="endDate">Select Year Month</label>
                                    <select id="year_month" name="year_month" class="form-control">
                                        <option value="0">All</option>
                                        @foreach($ddl_year_month as $key=>$value)
                                        <option value="{{$value->hit_year_month}}" @if($year_month==$value->hit_year_month) selected @endif>{{$value->hit_year_month}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <label for="exampleInputEmail1" style="visibility: hidden;">To Date</label>
                                <button id="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>    
                    </div>
                    <!-- <h3>Hit Counts -</h3> -->
                    <div class="row" style="margin-top: 30px">
                        <div class="col-md-3" style="padding:0px 20px 0px 20px">
                            <div class="card card-outline card-primary" style="background-color: #08a908; color: white; box-shadow: rgb(0 0 0 / 24%) 6px 8px 7px;">
                                <div class="text-center card-tools" style="margin: 10px">
                                    <h3>Status Code: 200</h3>
                                    <h5>{{$count200}}</h5>
                                </div>
                            </div>    
                        </div>
                        <div class="col-md-3" style="padding:0px 20px 0px 20px">
                            <div class="card card-outline card-primary" style="background-color: orange; color: white; box-shadow: rgb(0 0 0 / 24%) 6px 8px 7px;">
                                <div class="text-center card-tools" style="margin: 10px">
                                    <h3>Status Code: 101</h3>
                                    <h5>{{$count101}}</h5>
                                </div>
                            </div>    
                        </div>
                        <div class="col-md-3" style="padding:0px 20px 0px 20px">
                            <div class="card card-outline card-primary" style="background-color: #e1e110; color: white; box-shadow: rgb(0 0 0 / 24%) 6px 8px 7px;">
                                <div class="text-center card-tools" style="margin: 10px">
                                    <h3>Status Code: 102</h3>
                                    <h5>{{$count400}}</h5>
                                </div>
                            </div> 
                        </div>
                        <div class="col-md-3" style="padding:0px 20px 0px 20px">
                            <div class="card card-outline card-primary" style="background-color: #f72828; color: white; box-shadow: rgb(0 0 0 / 24%) 6px 8px 7px;">
                                <div class="text-center card-tools" style="margin: 10px">
                                    <h3>Status Code: 500</h3>
                                    <h5>{{$count500}}</h5>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="chart_div"></div>
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