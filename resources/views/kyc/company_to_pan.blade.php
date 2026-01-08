@extends('adminlte::page')

@section('title', 'Company → PAN Search')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">

        {{-- FORM CARD --}}
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Company → PAN Verification</h3>
            </div>

            <div class="card-body">

                {{-- ERROR --}}
                @if(isset($errorMessage))
                    <div class="alert alert-danger">
                        {{ $errorMessage }}
                    </div>
                @endif

                {{-- HIT LIMIT --}}
                @if(isset($hit_limits_exceeded) && $hit_limits_exceeded == 1)
                    <div class="alert alert-danger">
                        Hit limit exceeded. Please upgrade your plan.
                    </div>
                @endif

                {{-- FORM --}}
                <form method="POST" action="{{ route('kyc.company_to_pan') }}">
                    @csrf

                    <div class="form-group">
                        <label>Company Name</label>
                        <input type="text"
                               name="company_name"
                               class="form-control"
                               placeholder="Enter company name"
                               value="{{ old('company_name') }}"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Result Count</label>
                        <input type="number"
                               name="output_count"
                               class="form-control"
                               value="10">
                    </div>

                    {{-- <div class="form-check mb-3">
                        <input type="checkbox"
                               name="search_by_trade_name"
                               class="form-check-input"
                               value="1">
                        <label class="form-check-label">
                            Search by Trade Name
                        </label>
                    </div> --}}

                    <button type="submit" class="btn btn-success">
                        Search PAN
                    </button>
                </form>
            </div>
        </div>

        {{-- RESULT --}}
        @if(isset($companyData['result']['pan_list']))
        <div class="card card-success mt-3">
            <div class="card-header">
                <h3 class="card-title">PAN Results</h3>
            </div>

            <div class="card-body table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>PAN</th>
                            <th>Legal Name</th>
                            <th>Trade Name</th>
                            <th>Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($companyData['result']['pan_list'] as $row)
                        <tr>
                            <td>{{ $row['pan'] }}</td>
                            <td>{{ $row['legal_name'] }}</td>
                            <td>{{ $row['trade_name'] }}</td>
                            <td>{{ $row['score'] }}</td>
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
