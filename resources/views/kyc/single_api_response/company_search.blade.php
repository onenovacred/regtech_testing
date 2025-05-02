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