@extends('adminlte::page')

@section('title', 'Regtechapi - Company Details')

@section('content_header')
<style>
		
    table{
        width:100%;
    }

    .data-title{
        background-color:#8B0000;
        color:#FFFFFF;
        height:20px;
        table-layout: fixed;
        -webkit-font-smoothing: antialiased;	
    }

    .company-data{
        background-color:grey;
        color:black;
        height:10px;
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
                <h3 class="card-title">Company Details</h3>
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
                        <form role="form" method="post" action="{{route('kyc.company_details')}}">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="name">Company Code</label>
                                <input type="text" class="form-control" 
                                id="company_code" name="company_code" value="" 
                                placeholder="Enter Company Code" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Data Count</label>
                                <input type="number" class="form-control" 
                                id="filling_data_size" name="filling_data_size" value="" 
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
        @if(!empty($company_details['Company Details']) && $company_details['statusCode'] == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Company Details</h3>
            </div>
            <div class="card-body">
                <div class = "row">
                    <table class = "table" cellspacing="0">
                        <tr class = "data-title">
                            <td scope = "col">Company Name: {{$company_details['Company Details']['data']['search_data']['company']}}</td>
                            <td scope = "col">Company Code: {{$company_details['Company Details']['data']['search_data']['company_code']}}</td>
                            <td scope = "col">Client ID: {{$company_details['Company Details']['data']['client_id']}}</td>
                        </tr>
                    </table>    
                    <table class = "table" cellspacing="0">
                        <tr>
                            <td scope = "col"><b>Address:</b> {{$company_details['Company Details']['data']['search_data']['addres']}}</td>
                            <td scope = "col"><b>Office:</b> {{$company_details['Company Details']['data']['search_data']['office']}}</td>
                            <td scope = "col"><b>Name As Per PAN:</b> {{$company_details['Company Details']['data']['search_data']['name_as_per_pan']}}</td>
                            <td scope = "col"><b>PAN Status:</b> {{$company_details['Company Details']['data']['search_data']['pan_status']}}</td>
                        </tr>
                        <tr>
                            <td scope = "col"><b>Section Applicable:</b> {{$company_details['Company Details']['data']['search_data']['section_applicable']}}</td>
                            <td scope = "col"><b>Primary Business Activity:</b> {{$company_details['Company Details']['data']['search_data']['primary_business_activity']}}</td>
                            <td scope = "col"><b>ESIC Code:</b> {{$company_details['Company Details']['data']['search_data']['esic_code']}}</td>
                            <td scope = "col"><b>CIN:</b> {{$company_details['Company Details']['data']['search_data']['cin']}}</td>
                        </tr>
                        <tr>
                            <td scope = "col"><b>LIN:</b> {{$company_details['Company Details']['data']['search_data']['lin']}}</td>
                            <td scope = "col"><b>Ownership Type:</b> {{$company_details['Company Details']['data']['search_data']['ownership_type']}}</td>
                            <td scope = "col"><b>Date of Establishment:</b> {{$company_details['Company Details']['data']['search_data']['date_of_setup_of_establishment']}}</td>
                            <td scope = "col"><b>Pin Code:</b> {{$company_details['Company Details']['data']['search_data']['pin_code']}}</td>
                        </tr>
                        <tr>
                            <td scope = "col"><b>City:</b> {{$company_details['Company Details']['data']['search_data']['city']}}</td>
                            <td scope = "col"><b>District:</b> {{$company_details['Company Details']['data']['search_data']['district']}}</td>
                            <td scope = "col"><b>State:</b> {{$company_details['Company Details']['data']['search_data']['state']}}</td>
                            <td scope = "col"><b>Country:</b> {{$company_details['Company Details']['data']['search_data']['country']}}</td>
                        </tr>
                        <tr>
                            <td scope = "col"><b>EPFO Office Name:</b> {{$company_details['Company Details']['data']['search_data']['epfo_office_name']}}</td>
                            <td scope = "col"><b>EPFO Office Address:</b> {{$company_details['Company Details']['data']['search_data']['epfo_office_address']}}</td>
                            <td scope = "col"><b>Zone:</b> {{$company_details['Company Details']['data']['search_data']['zone']}}</td>
                            <td scope = "col"><b>Region:</b> {{$company_details['Company Details']['data']['search_data']['region']}}</td>
                        </tr>
                    </table>    
                    @foreach($company_details['Company Details']['data']['search_data']['filing_data'] as $filing_data)	
                        <div class="col-md-12">
                            <div class="card card-success">
                                <table class = "table text-center" cellspacing="0">
                                    <tbody>
                                        <tr class = "company-data card-header">
                                            <td scope = "col" style="border-radius: 0.25rem 0 0 0 !important;">Date</td>
                                            <td scope = "col">Amount</td>
                                            <td scope = "col">Month</td>
                                            <td scope = "col">Wage Month</td>
                                            <td scope = "col">Number Of Employees</td>
                                            <td scope = "col" style="border-radius: 0 0.25rem 0 0 !important;">ECR</td>
                                        </tr>
                                        <tr class="td-elements">
                                            <td> {{ isset($filing_data['date']) ? $filing_data['date'] : "" }}</td>
                                            <td>{{ isset($filing_data['amount']) ? $filing_data['amount'] : "" }}</td>
                                            <td>{{ isset($filing_data['month']) ? $filing_data['month'] : "" }}</td>
                                            <td> {{ isset($filing_data['wage_month']) ? $filing_data['wage_month'] : "" }}</td>
                                            <td>{{ isset($filing_data['no_of_employees']) ? $filing_data['no_of_employees'] : "" }}</td>
                                            <td>{{ isset($filing_data['ecr']) ? $filing_data['ecr'] : "" }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>  
                        </div>              
                    @endforeach 
                </div>
            </div>
        </div>
        @endif 
    </div>       
</div>
@stop


@section('custom_js')
@stop