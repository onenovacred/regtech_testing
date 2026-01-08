@extends('adminlte::page')

@section('title', 'Voter ID Verification')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Voter ID Verification</h3>
                <a href = "{{ route('kyc.voter_api') }}" role = "button"
                class = "btn btn-light float-right">Voter ID APIs</a>
            </div>
            <div class="card-body">
                @if(isset($voter_validation[0]['statusCode']) && $voter_validation[0]['statusCode'] == '10')
                    <div class="alert alert-danger" role="alert">
                        Voter ID is Invalid
                  </div>
                @endif
                @if(isset($voter_validation[0]['statusCode']) && ($voter_validation[0]['statusCode'] == '404' || $voter_validation[0]['statusCode'] == '400'))
                <div class="alert alert-danger" role="alert">
                    Server Error, Please try later
                </div>
                @endif
                @if(isset($voter_validation[0]['statusCode']) && $voter_validation[0]['statusCode'] == '500')
                <div class="alert alert-danger" role="alert">
                    Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{route('kyc.voter_validation')}}">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">Voter ID Number</label>
                                <input type="text" class="form-control"
                                    id="voter_number" name="voter_number" value="{{old('voter_number')}}"
                                    placeholder="Ex: NLN1234567" required>
                                </div>
                                <button type="submit" class="btn btn-success">Verify</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($voter_validation) && isset($voter_validation[0]['statusCode']))
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Voter Details</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div>
                        <p>Voter ID / Epic Number: {{ $voter_validation[0]['voter_validation']['result']['epic_no'] ?? '' }}</p>
                        <p>Name: {{ $voter_validation[0]['voter_validation']['result']['name'] ?? '' }}</p>
                        <p>Name (Local Lang): {{ $voter_validation[0]['voter_validation']['result']['name_v1'] ?? '' }}</p>
                        <p>First Name: {{ $voter_validation[0]['voter_validation']['result']['name_fn'] ?? '' }}</p>
                        <p>First Name (Local Lang 1): {{ $voter_validation[0]['voter_validation']['result']['name_fn_v1'] ?? '' }}</p>
                        <p>First Name (Local Lang 2): {{ $voter_validation[0]['voter_validation']['result']['name_fn_v2'] ?? '' }}</p>
                        <p>First Name (Local Lang 3): {{ $voter_validation[0]['voter_validation']['result']['name_fn_v3'] ?? '' }}</p>
                        <p>Last Name: {{ $voter_validation[0]['voter_validation']['result']['name_ln'] ?? '' }}</p>
                        <p>Last Name (Local Lang 1): {{ $voter_validation[0]['voter_validation']['result']['name_ln_v1'] ?? '' }}</p>
                        <p>Last Name (Local Lang 2): {{ $voter_validation[0]['voter_validation']['result']['name_ln_v2'] ?? '' }}</p>

                        <p>Relation Type: {{ $voter_validation[0]['voter_validation']['result']['rln_type'] ?? '' }}</p>
                        <p>Relation Name: {{ $voter_validation[0]['voter_validation']['result']['rln_name'] ?? '' }}</p>
                        <p>Relation Name (Local 1): {{ $voter_validation[0]['voter_validation']['result']['rln_name_v1'] ?? '' }}</p>
                        <p>Relation Name (Local 2): {{ $voter_validation[0]['voter_validation']['result']['rln_name_v2'] ?? '' }}</p>
                        <p>Relation Name (Local 3): {{ $voter_validation[0]['voter_validation']['result']['rln_name_v3'] ?? '' }}</p>

                        <p>Age: {{ $voter_validation[0]['voter_validation']['result']['age'] ?? '' }}</p>
                        <p>Gender:
                            @if(($voter_validation[0]['voter_validation']['result']['gender'] ?? '') == 'M')
                                Male
                            @elseif(($voter_validation[0]['voter_validation']['result']['gender'] ?? '') == 'F')
                                Female
                            @else
                                {{ $voter_validation[0]['voter_validation']['result']['gender'] ?? '' }}
                            @endif
                        </p>

                        <p>State: {{ $voter_validation[0]['voter_validation']['result']['st_name'] ?? '' }}</p>
                        <p>State Code: {{ $voter_validation[0]['voter_validation']['result']['st_code'] ?? '' }}</p>
                        <p>District: {{ $voter_validation[0]['voter_validation']['result']['dist_name'] ?? '' }}</p>
                        <p>District (Local Lang): {{ $voter_validation[0]['voter_validation']['result']['dist_name_v1'] ?? '' }}</p>

                        <p>Assembly Constituency: {{ $voter_validation[0]['voter_validation']['result']['ac_name'] ?? '' }}</p>
                        <p>Assembly Constituency (Local Lang): {{ $voter_validation[0]['voter_validation']['result']['ac_name_v1'] ?? '' }}</p>
                        <p>Assembly Constituency Number: {{ $voter_validation[0]['voter_validation']['result']['ac_no'] ?? '' }}</p>

                        <p>Parliamentary Constituency: {{ $voter_validation[0]['voter_validation']['result']['pc_name'] ?? '' }}</p>
                        <p>Parliamentary Constituency (Local Lang): {{ $voter_validation[0]['voter_validation']['result']['pc_name_v1'] ?? '' }}</p>
                        <p>Parliamentary Constituency Number: {{ $voter_validation[0]['voter_validation']['result']['pc_no'] ?? '' }}</p>

                        <p>Polling Station: {{ $voter_validation[0]['voter_validation']['result']['ps_name'] ?? '' }}</p>
                        <p>Polling Station (Local Lang): {{ $voter_validation[0]['voter_validation']['result']['ps_name_v1'] ?? '' }}</p>
                        <p>Polling Station Number: {{ $voter_validation[0]['voter_validation']['result']['ps_no'] ?? '' }}</p>
                        <p>Polling Lat/Long: {{ $voter_validation[0]['voter_validation']['result']['ps_lat_long'] ?? '' }}</p>
                        <p>Polling Building Name: {{ $voter_validation[0]['voter_validation']['result']['psbuildingName'] ?? '' }}</p>
                        <p>Polling Building Name (Local Lang): {{ $voter_validation[0]['voter_validation']['result']['psBuildingNameL1'] ?? '' }}</p>
                        <p>Polling Room Details: {{ $voter_validation[0]['voter_validation']['result']['psRoomDetails'] ?? '' }}</p>
                        <p>Polling Room Details (Local Lang): {{ $voter_validation[0]['voter_validation']['result']['psRoomDetailsL1'] ?? '' }}</p>
                        <p>Building Address: {{ $voter_validation[0]['voter_validation']['result']['buildingAddress'] ?? '' }}</p>

                        <p>Part Number: {{ $voter_validation[0]['voter_validation']['result']['part_no'] ?? '' }}</p>
                        <p>Part Name: {{ $voter_validation[0]['voter_validation']['result']['part_name'] ?? '' }}</p>
                        <p>Part Name (Local Lang): {{ $voter_validation[0]['voter_validation']['result']['part_name_v1'] ?? '' }}</p>
                        <p>Section Number: {{ $voter_validation[0]['voter_validation']['result']['section_no'] ?? '' }}</p>

                        <p>Last Update: {{ $voter_validation[0]['voter_validation']['result']['last_update'] ?? '' }}</p>
                        <p>SL No. in Part: {{ $voter_validation[0]['voter_validation']['result']['slno_inpart'] ?? '' }}</p>
                        <p>ID: {{ $voter_validation[0]['voter_validation']['result']['id'] ?? '' }}</p>

                        <p>Created Date/Time: {{ $voter_validation[0]['voter_validation']['result']['createdDttm'] ?? '' }}</p>
                        <p>Is Active: {{ $voter_validation[0]['voter_validation']['result']['isActive'] ? 'Yes' : 'No' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

    </div>
</div>
@stop


@section('custom_js')
@stop
