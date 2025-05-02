@if(!empty($epfo_details['Telecom EPFO Without OTP Details']) && $epfo_details['statusCode'] == 200)
<div class="row">
    <div class="col-md-6 offset-md-3">
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">EPFO Details</h3>
    </div>
    <div class="card-body">
        <div class = "row">
            @foreach($epfo_details['Telecom EPFO Without OTP Details']['data']['search_data'] as $epfo_data)
                <table class = "table" cellspacing="0">
                    <tbody>
                        <tr class = "data-title">
                            <td scope = "col">Name: {{$epfo_data['name']}}</td>
                            <td scope = "col">Confidence: {{$epfo_data['confidence']}}</td>
                            <td scope = "col">Company: {{$epfo_data['company']}}</td>
                            <td scope = "col">Company Code: {{$epfo_data['company_code']}}</td>
                        </tr>
                    </tbody>
                </table>    
                @foreach($epfo_data['filing_data'] as $filing_data)	
                <div class="col-md-12">
                    <div class="card card-success">
                        <table class = "table text-center" cellspacing="0">
                            <tbody>
                                <tr class = "epfo-data card-header">
                                    <td scope = "col" style="border-radius: 0.25rem 0 0 0 !important;">Month</td>
                                    <td scope = "col">TRRN</td>
                                    <td scope = "col" style="border-radius: 0 0.25rem 0 0 !important;">Date</td>
                                </tr>
                                <tr class="td-elements">
                                    <td> {{ isset($filing_data['trrn']) ? $filing_data['trrn'] : "" }}</td>
                                    <td>{{ isset($filing_data['trrn']) ? $filing_data['trrn'] : "" }}</td>
                                    <td>{{ isset($filing_data['date']) ? $filing_data['date'] : "" }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>  
                </div>              
                @endforeach 
            @endforeach    
        </div>
    </div>
</div>
</div>
</div>
@endif 