@extends('adminlte::page')

@section('title', 'TDS Quarterly')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">

        {{-- FORM --}}
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">TDS Quarterly Verification</h3>
            </div>

            <div class="card-body">

                {{-- ERROR --}}
                @if(isset($errorMessage))
                    <div class="alert alert-danger">{{ $errorMessage }}</div>
                @endif

                {{-- HIT LIMIT --}}
                @if(isset($hit_limits_exceeded) && $hit_limits_exceeded == 1)
                    <div class="alert alert-danger">
                        Hit limit exceeded. Please upgrade your plan.
                    </div>
                @endif

                <form method="POST" action="{{ route('kyc.tds_quarterly') }}">
                    @csrf

                    <div class="form-group">
                        <label>PAN</label>
                        <input type="text" name="pan" class="form-control"
                               maxlength="10" required value="{{ old('pan') }}">
                    </div>

                    <div class="form-group">
                        <label>TAN</label>
                        <input type="text" name="tan" class="form-control"
                               required value="{{ old('tan') }}">
                    </div>

                    <div class="form-group">
                        <label>Financial Year</label>
                        <input type="text" name="financial_year"
                               class="form-control"
                               placeholder="2021-22"
                               required value="{{ old('financial_year') }}">
                    </div>

                    <button class="btn btn-success">Verify</button>
                </form>
            </div>
        </div>

        {{-- RESULT --}}
        @if(isset($tdsData['result']))
        <div class="card card-success mt-3">
            <div class="card-header">
                <h3 class="card-title">TDS Result</h3>
            </div>

            <div class="card-body">
                <p><strong>Employer:</strong> {{ $tdsData['result']['employer_name'] ?? '-' }}</p>
                <p><strong>Return Type:</strong> {{ $tdsData['result']['return_type'] ?? '-' }}</p>

                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>Quarter</th>
                            <th>Count</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tdsData['result']['tds'] as $row)
                        <tr>
                            <td>{{ $row['quarter'] }}</td>
                            <td>{{ $row['count'] }}</td>
                            <td>{{ $row['remarks'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

    </div>
</div>
@stop
