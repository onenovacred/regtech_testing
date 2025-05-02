@extends('adminlte::page')

@section('title', 'Regtechapi - Predictppl')

@section('content_header')
@stop

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">PredictPPL</h3>
                    <a role = "button" class = "btn btn-light float-right" href = "{{ route('kyc.predictppl.api') }}">Predict
                        API</a>
                </div>
                <div class="card-body">
                    @if (isset($predictppl_details['statusCode']) && $predictppl_details['statusCode'] == 102)
                        <div class="alert alert-danger" role="alert">
                            Invalid file.Please upload csv file.
                        </div>
                    @endif
                    @if (isset($predictppl_details['statusCode']) && $predictppl_details['statusCode'] == 404)
                        <div class="alert alert-danger" role="alert">
                            Server Error, Please try later
                        </div>
                    @endif
                    @if (isset($predictppl_details['statusCode']) && $predictppl_details['statusCode'] == 500)
                        <div class="alert alert-danger" role="alert">
                            Internal server error. Please contact techsupport@docboyz.in. for more details
                        </div>
                    @endif
                    @if (isset($predictppl_details['statusCode']) && $predictppl_details['statusCode'] == 103)
                        <div class="alert alert-danger" role="alert">
                            You are not registered to use this service. Please update your plan.
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <form role="form" method="post" action="{{ route('kyc.predictppl') }}"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="name">Upload File</label>
                                    <input type="file" class="form-control" id="csv_file" name="csv_file"
                                        value="{{ old('csv_file') }}" required />
                                </div>
                                <button type="submit" class="btn btn-success offset-md-3"
                                    id="predict_report_downloadExcel">Verify</button>
                            </form><br>
                        </div>
                    </div>
                </div>
            </div>
            @if (isset($predictppl_details['statusCode']) && $predictppl_details['statusCode'] == 200)
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">PredictPPL Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class = "table text-center table-responsive table-bordered" cellspacing="0">
                                    <thead>
                                        <tr class = "card-header">
                                            <th scope = "col" style="border-radius: 0.25rem 0 0 0 !important;">LoanIntent
                                            </th>
                                            <th scope = "col">LoanAmount</th>
                                            <th scope = "col">LoanInterestRate</th>
                                            <th scope = "col">LoanPercentIncome</th>
                                            <th scope = "col">PersonAge</th>
                                            <th scope = "col">PersonHomeOwnership</th>
                                            <th scope = "col">PersonIncome</th>
                                            <th scope = "col">Prediction</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        @if (isset($predictppl_details['data']))
                                            @foreach ($predictppl_details['data'] as $data)
                                                <tr class="td-elements">
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
    </div>
@stop


@section('custom_js')


@stop
