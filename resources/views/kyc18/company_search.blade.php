@extends('adminlte::page')

@section('title', 'Regtechapi - Company Search')

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
                <h3 class="card-title">Company Search</h3>
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
                        <form role="form" method="post" action="{{route('kyc.company_search')}}">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="name">Company Name</label>
                                <input type="text" class="form-control" 
                                id="company" name="company" value="" 
                                placeholder="Enter Company Name" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Data Count</label>
                                <input type="number" class="form-control" 
                                id="search_size" name="search_size" value="" 
                                placeholder="e.g 10" required>
                            </div>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
    <div class="col-md-12">
        @if(!empty($company_search['Company Search']) && $company_search['statusCode'] == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Company Search Result</h3>
            </div>
            <div class="card-body">
                <div class = "row">
                    <table class = "table text-center" cellspacing="0">
                        <tbody>
                            <tr class = "data-title">
                                <td scope = "col">Company Name</td>
                                <td scope = "col">Company Code</td>
                                <td scope = "col">Confidence</td>
                                <td scope = "col">Address</td>
                                <td scope = "col">City</td>
                            </tr>
                            @foreach($company_search['Company Search']['data']['search_data'] as $company_data)
                                <tr class="td-elements">
                                    <td> {{ isset($company_data['company']) ? $company_data['company'] : "" }}</td>
                                    <td>{{ isset($company_data['company_code']) ? $company_data['company_code'] : "" }}</td>
                                    <td>{{ isset($company_data['confidence']) ? $company_data['confidence'] : "" }}</td>
                                    <td>{{ isset($company_data['addres']) ? $company_data['addres'] : "" }}</td>
                                    <td>{{ isset($company_data['office']) ? $company_data['office'] : "" }}</td>
                                </tr>
                            @endforeach    
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