@extends('adminlte::page')

@section('title', 'RegtechAPI')

@section('content_header')
@stop

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">

        {{-- FORM CARD --}}
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">E-commerce Website List</h3>
            </div>

            <div class="card-body">

                {{-- ERROR / STATUS MESSAGES --}}
                @if($low_wallet_balance == 1)
                    <div class="alert alert-danger">
                        Please recharge your wallet.
                    </div>
                @endif

                @if($hit_limits_exceeded == 1)
                    <div class="alert alert-warning">
                        You have exceeded your hit limits.
                    </div>
                @endif

                @if(isset($statusCode) && in_array($statusCode, [400,404,500]))
                    <div class="alert alert-danger">
                        Server error. Please try again later.
                    </div>
                @endif

                {{-- FORM (POST like reference) --}}
                <form method="post" action="{{ route('kyc.ecom_websites_list') }}">
                    {{ csrf_field() }}

                    <p class="text-muted">
                        Click the button below to fetch enabled e-commerce websites.
                    </p>

                    <button type="submit" class="btn btn-success">
                        Get Website List
                    </button>
                </form>

            </div>
        </div>

        {{-- RESULT CARD --}}
        @if(!empty($websiteData) && $statusCode == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Enabled Websites</h3>
            </div>

            <div class="card-body">

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Website Name</th>
                            <th>Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($websiteData as $site)
                            <tr>
                                <td>{{ $site['id'] }}</td>
                                <td>{{ $site['name'] }}</td>
                                <td>{{ $site['type'] }}</td>
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

@section('custom_js')
@stop
