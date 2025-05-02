<div class="col-md-12">
@if (isset($predictppl_details['statusCode']) && $predictppl_details['statusCode'] == 200)

<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">PredictPPL Details</h3>
    </div>
    <div class="mt-3">
             <table class="table table-responsive table-bordered" style="margin-left:100px;">
                    <thead>
                        <tr>
                            <th>LoanIntent</th>
                            <th>LoanAmount</th>
                            <th>LoanInterestRate</th>
                            <th>LoanPercentIncome</th>
                            <th>PersonAge</th>
                            <th>PersonHomeOwnership</th>
                            <th>PersonIncome</th>
                            <th>Prediction</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($predictppl_details['data']))
                            @foreach ($predictppl_details['data'] as $data)
                                <tr>
                                    <td> {{ isset($data['LoanIntent']) ? $data['LoanIntent'] : 'null' }}
                                    </td>
                                    <td>{{ isset($data['LoanAmount']) ? $data['LoanAmount'] : 'null' }}</td>
                                    <td>{{ isset($data['LoanInterestRate']) ? $data['LoanInterestRate'] : 'null' }}
                                    </td>
                                    <td>{{ isset($data['LoanPercentIncome']) ? $data['LoanPercentIncome'] : 'null' }}
                                    </td>
                                    <td> {{ isset($data['PersonAge']) ? $data['PersonAge'] : 'null' }}</td>
                                    <td>{{ isset($data['PersonHomeOwnership']) ? $data['PersonHomeOwnership'] : 'null' }}
                                    </td>
                                    <td>{{ isset($data['PersonIncome']) ? $data['PersonIncome'] : 'null' }}
                                    </td>
                                    <td>{{ isset($data['Prediction']) ? $data['Prediction'] : 'null' }}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
    document.getElementById('predict_report_downloadExcel').addEventListener('click', function() {
     let predictpplDetails = @json($predictppl_details['data']);
     let wb = XLSX.utils.book_new();
     let ws = XLSX.utils.json_to_sheet(predictpplDetails);
        XLSX.utils.book_append_sheet(wb, ws, "Sheet1");
        XLSX.writeFile(wb, 'predict_report.xlsx');
    });
</script>
@endif
</div>