@extends('adminlte::page')

@section('title', 'EPFO Employee Name Search')

@section('content')
<div class="row">
    <div class="col-md-10 offset-md-1">

        {{-- ALERTS --}}
        @if($low_wallet_balance ?? false)
            <div class="alert alert-danger">
                Please recharge your wallet.
            </div>
        @endif

        @if($hit_limits_exceeded ?? false)
            <div class="alert alert-warning">
                You have exceeded your hit limits.
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
                <h3 class="card-title">EPFO Employee Name Search</h3>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('kyc.epfo') }}">
                    @csrf

                    <div class="form-group">
                        <label>Employee Name</label>
                        <input type="text"
                               name="employee_name"
                               class="form-control"
                               value="{{ old('employee_name') }}"
                               placeholder="Enter employee name"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Employer Name</label>
                        <input type="text"
                               name="employer_name"
                               class="form-control"
                               value="{{ old('employer_name') }}"
                               placeholder="Enter employer name"
                               required>
                    </div>

                    <button class="btn btn-success btn-block">
                        Search EPFO
                    </button>
                </form>
            </div>
        </div>

      
        @if(!empty($epfoData) && (isset($epfoData['result']) || isset($epfoData['result_code'])))

            
            @if(($epfoData['result_code'] ?? null) == 202)
                <div class="alert alert-info mt-4">
                    EPFO search is in progress. Please try again after a few seconds.
                </div>
            @endif

            
            @if(($epfoData['result_code'] ?? null) == 102)
                <div class="alert alert-warning mt-4">
                    No EPFO records found for given details.
                </div>
            @endif

            @if(
                ($epfoData['result_code'] ?? 101) == 101 &&
                isset($epfoData['result'])
            )
                <div class="card card-success mt-4">
                    <div class="card-header">
                        <h3 class="card-title">EPFO Search Result</h3>
                    </div>

                    <div class="card-body">

                        <p><strong>Employee Name:</strong>
                            {{ $epfoData['result']['employee_name'] ?? '-' }}
                        </p>

                        <p><strong>Organization:</strong>
                            {{ $epfoData['result']['organization_name'] ?? '-' }}
                        </p>

                        <hr>

                        <h5>Employment Status</h5>
                        <ul>
                            <li>Is Employed:
                                {!! !empty($epfoData['result']['is_employed'])
                                    ? '<span class="badge badge-success">Yes</span>'
                                    : '<span class="badge badge-danger">No</span>' !!}
                            </li>
                            <li>Name Exact:
                                {!! !empty($epfoData['result']['is_name_exact'])
                                    ? '<span class="badge badge-success">Yes</span>'
                                    : '<span class="badge badge-danger">No</span>' !!}
                            </li>
                            <li>Name Unique:
                                {!! !empty($epfoData['result']['is_name_unique'])
                                    ? '<span class="badge badge-success">Yes</span>'
                                    : '<span class="badge badge-danger">No</span>' !!}
                            </li>
                        </ul>

                       
                        @if(!empty($epfoData['result']['matches']) && is_array($epfoData['result']['matches']))
                            <hr>
                            <h5>Matched Employees</h5>

                            <table class="table table-bordered table-sm">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Confidence</th>
                                        <th>Establishment ID</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($epfoData['result']['matches'] as $match)
                                        <tr>
                                            <td>{{ $match['name'] ?? '-' }}</td>
                                            <td>{{ $match['confidence'] ?? '-' }}</td>
                                            <td>{{ $match['est_id'] ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

                        
                        @if(
                            !empty($epfoData['result']['est_info']) &&
                            isset($epfoData['result']['est_info'][0]['establishment_details'])
                        )
                            <hr>
                            <h5>Establishment Details</h5>

                            @php
                                $est = $epfoData['result']['est_info'][0]['establishment_details'];
                            @endphp

                            <p><strong>Name:</strong> {{ $est['establishment_name'] ?? '-' }}</p>
                            <p><strong>Code:</strong> {{ $est['establishment_code'] ?? '-' }}</p>
                            <p><strong>Address:</strong> {{ $est['address'] ?? '-' }}</p>
                            <p><strong>City:</strong> {{ $est['city'] ?? '-' }}</p>
                            <p><strong>State:</strong> {{ $est['state'] ?? '-' }}</p>
                            <p><strong>PIN:</strong> {{ $est['pin_code'] ?? '-' }}</p>
                            <p><strong>Business Activity:</strong> {{ $est['primary_business_activity'] ?? '-' }}</p>
                        @endif

                    </div>
                </div>
            @endif
        @endif

    </div>
</div>
@stop
