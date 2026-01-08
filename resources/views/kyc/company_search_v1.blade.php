@extends('adminlte::page')

@section('title', 'Company Search')

@section('content')
<div class="row">
    <div class="col-md-10 offset-md-1">

        
        @if($low_wallet_balance ?? false)
            <div class="alert alert-danger">
                Please recharge your wallet.
            </div>
        @endif

        @if($hit_limits_exceeded ?? false)
            <div class="alert alert-warning">
                You are not registered for this service. Please upgrade your plan.
            </div>
        @endif

        @if(isset($errorMessage))
            <div class="alert alert-danger">
                {{ $errorMessage }}
            </div>
        @endif

        {{-- FORM --}}
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Company Search</h3>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('kyc.company_search_vone') }}">
                    @csrf

                    <div class="form-group">
                        <label>Company / Employer Name</label>
                        <input type="text"
                               name="employer_name"
                               class="form-control"
                               value="{{ old('employer_name') }}"
                               placeholder="Enter company name"
                               required>
                    </div>

                    <button class="btn btn-success btn-block">
                        Search Company
                    </button>
                </form>
            </div>
        </div>

        {{-- RESULT --}}
        @if(!empty($companyData) && isset($companyData['result']['companies']))

            <div class="card card-success mt-4">
                <div class="card-header">
                    <h3 class="card-title">Company Search Results</h3>
                </div>

                <div class="card-body">

                    <p>
                        <strong>Total Matches:</strong>
                        {{ $companyData['result']['count'] ?? 0 }}
                    </p>

                    <table class="table table-bordered table-striped table-sm">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Company Name</th>
                                <th>DC ID</th>
                                <th>Confidence Score</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($companyData['result']['companies'] as $index => $company)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $company['name'] ?? '-' }}</td>
                                    <td>{{ $company['dc_id'] ?? '-' }}</td>
                                    <td>
                                        @php $score = $company['score'] ?? 0; @endphp
                                        @if($score >= 80)
                                            <span class="badge badge-success">{{ $score }}</span>
                                        @elseif($score >= 65)
                                            <span class="badge badge-warning">{{ $score }}</span>
                                        @else
                                            <span class="badge badge-secondary">{{ $score }}</span>
                                        @endif
                                    </td>
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
