@extends('adminlte::page')

@section('title', 'Regtechapi - UAN Details')

@section('content_header')
<style>
		
    table{
        width:100%;
    }

    .data-title{
        background-color:grey;
        color:black;
        height:20px;
        table-layout: fixed;
        -webkit-font-smoothing: antialiased;	
    }

</style>
@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">UAN Details</h3>
            </div>
            <div class="card-body">
                @if(isset($statusCode) && $statusCode == '102')
                    <div class="alert alert-danger" role="alert">
                        Please enter valid details
                    </div>
                @endif
                @if(isset($statusCode) && ($statusCode == '404' || $statusCode == '400'))
                <div class="alert alert-danger" role="alert">
                    Server Error, Please try later
                </div>
                @endif
                @if(isset($statusCode) && $statusCode == '500')
                <div class="alert alert-danger" role="alert">
                    Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{route('kyc.uan_details')}}">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="name">Mobile Number</label>
                                <input type="number" class="form-control" 
                                id="mobile_number" name="mobile_number" value="" 
                                placeholder="Enter Mobile Number" required>
                            </div>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
    <div class="col-md-12">
        @if(!empty($uan_details['UAN Details']) && $uan_details['statusCode'] == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">UAN Details</h3>
            </div>
            <div class="card-body">
                <div class = "row">
                    <table class = "table text-center" cellspacing="0">
                        <tbody>
                            <tr class = "data-title">
                                <td scope = "col"><b>UAN:</b> {{$uan_details['UAN Details']['data']['pf_uan']}}</td>
                                <td scope = "col"><b>Client ID:</b> {{$uan_details['UAN Details']['data']['client_id']}}</td>
                            </tr>
                        </tbody>
                    </table>    
                </div>
            </div>
        </div>
        @endif 
    </div>       
</div>
@stop


@section('custom_js')
@stop