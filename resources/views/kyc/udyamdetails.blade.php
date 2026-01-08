@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">Scheme Details</h1> -->
@stop

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Udyam Registration Search.</h3>
                <a role = "button" class = "btn btn-light float-right"
                href = "{{ route('kyc.udyam_api') }}">Udyam Card APIs</a>
            </div>
            <div class="card-body">
                @if(isset($udyamcard['statusCode']) && $udyamcard['statusCode'] == '102')
                    <div class="alert alert-danger" role="alert">
                        Udyam Number is Invalid
                  </div>
                @endif
                @if(isset($udyamcard['statusCode']) && ($udyamcard['statusCode'] == '404'))
                <div class="alert alert-danger" role="alert">
                    Server Error. Please try again later.
                </div>
                @endif
                @if(isset($udyamcard['statusCode']) && $udyamcard['statusCode'] == '500')
                    <div class="alert alert-danger" role="alert">
                        Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                  </div>
                @endif
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form role="form" method="post" action="{{route('kyc.udyam.details')}}">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">Udyam Number</label>
                                <input type="text" class="form-control"
                                    maxlength="20" minlength="10"
                                    id="udyam_number" name="udyam_number" value="{{old('udyam_number')}}"
                                    placeholder="Ex: ABCDE1234N" required>
                                </div>
                                <button type="submit" class="btn btn-success">Verify</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        @if(!empty($udyamcard) &&  isset($udyamcard['status_code']) && $udyamcard['status_code'] == 200)
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Udyam details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div>
<p><strong>UdyamNumber: </strong>{{ $udyamcard['response']['udyam_reg_no'] }}</p>
<p><strong>Date Of Registration: </strong>{{ $udyamcard['response']['date_of_reg'] }}</p>
<p><strong>DIC: </strong>{{ $udyamcard['response']['district_industries_center'] }}</p>
<p><strong>MSME DFO: </strong>{{ $udyamcard['response']['msme_dfo'] }}</p>

{{-- Profile --}}
<p><strong>Enterprise Name: </strong>{{ $udyamcard['response']['profile']['enterprise_name'] }}</p>
<p><strong>Enterprise Type: </strong>{{ $udyamcard['response']['profile']['enterprise_type'] }}</p>
<p><strong>Major Activity: </strong>{{ $udyamcard['response']['profile']['major_activity'] }}</p>
<p><strong>Organisation Type: </strong>{{ $udyamcard['response']['profile']['organization_type'] }}</p>
<p><strong>Social Category: </strong>{{ $udyamcard['response']['profile']['social_category'] }}</p>
<p><strong>Date Of Incorporation: </strong>{{ $udyamcard['response']['profile']['date_of_incorporation'] }}</p>
<p><strong>Date Of Commencement: </strong>{{ $udyamcard['response']['profile']['date_of_commencement'] ?? 'N/A' }}</p>

{{-- Official Address --}}
<p><strong>Official Address:</strong><br>
    {{ $udyamcard['response']['official_address']['flat'] }},
    {{ $udyamcard['response']['official_address']['premises'] }},
    {{ $udyamcard['response']['official_address']['village'] }},
    {{ $udyamcard['response']['official_address']['block'] }},
    {{ $udyamcard['response']['official_address']['road'] }},
    {{ $udyamcard['response']['official_address']['city'] }},
    {{ $udyamcard['response']['official_address']['district'] }},
    {{ $udyamcard['response']['official_address']['state'] }} -
    {{ $udyamcard['response']['official_address']['pincode'] }}
</p>
<p><strong>Email: </strong>{{ $udyamcard['response']['official_address']['email'] }}</p>
<p><strong>Mobile: </strong>{{ $udyamcard['response']['official_address']['mobile'] }}</p>

{{-- Branch Details --}}
@if(!empty($udyamcard['response']['branch_details']))
    <p><strong>Branch Details:</strong></p>
    <ul>
        @foreach($udyamcard['response']['branch_details'] as $branch)
            <li>
                {{ $branch['name'] }} -
                {{ $branch['flat'] }}, {{ $branch['premises'] }}, {{ $branch['village'] }},
                {{ $branch['block'] }}, {{ $branch['road'] }},
                {{ $branch['city'] }}, {{ $branch['district'] }},
                {{ $branch['state'] }} - {{ $branch['pincode'] }}
            </li>
        @endforeach
    </ul>
@endif

{{-- Industry --}}
@if(!empty($udyamcard['response']['industry']))
    <p><strong>Industry Details:</strong></p>
    <ul>
        @foreach($udyamcard['response']['industry'] as $ind)
            <li>
                <strong>{{ $ind['industry'] }}</strong><br>
                Sub Sector: {{ $ind['sub_sector'] }}<br>
                Activity: {{ $ind['activity'] }}<br>
                Description: {{ $ind['activity_description'] }}<br>
                Industry Code: {{ $ind['industry_code'] }}<br>
                Sub Sector Code: {{ $ind['sub_sector_code'] }}<br>
                NIC Code: {{ $ind['nic_code'] }}<br>
                Date: {{ $ind['date'] }}
            </li>
        @endforeach
    </ul>
@endif

{{-- Enterprise Type History --}}
@if(!empty($udyamcard['response']['enterprise_type_history']))
    <p><strong>Enterprise Type History:</strong></p>
    <ul>
        @foreach($udyamcard['response']['enterprise_type_history'] as $history)
            <li>{{ $history['classification_year'] }} - {{ $history['enterprise_type'] }} ({{ $history['classification_date'] }})</li>
        @endforeach
    </ul>
@endif


                        {{-- <p><strong>UdyamNumber: </strong>{{$udyamcard['response']['udyam_reg_no'] }}</p>
                        <p><strong>Id: </strong>{{$udyamcard['response']['id']}}</p>
                        <p><strong>PatronId: </strong>{{$udyamcard['response']['patronId']}}</p>
                        <p><strong>udyamRegistrationNumber: </strong>{{$udyamcard['response']['result']['generalInfo']['udyamRegistrationNumber']}}</p>
                        <p><strong>nameOfEnterprise: </strong>{{$udyamcard['response']['result']['generalInfo']['nameOfEnterprise']}}</p>
                        <p><strong>majorActivity: </strong>{{$udyamcard['response']['result']['generalInfo']['majorActivity']}}</p>
                        <p><strong>organisationType: </strong>{{$udyamcard['response']['result']['generalInfo']['organisationType']}}</p>
                        <p><strong>socialCategory: </strong>{{$udyamcard['response']['result']['generalInfo']['socialCategory']}}</p>
                        <p><strong>dateOfIncorporation: </strong>{{$udyamcard['response']['result']['generalInfo']['dateOfIncorporation']}}</p>
                        <p><strong>dateOfCommencementOfProductionBusiness: </strong>{{$udyamcard['response']['result']['generalInfo']['dateOfCommencementOfProductionBusiness']}}</p>
                        <p><strong>dic: </strong>{{$udyamcard['response']['result']['generalInfo']['dic']}}</p>
                        <p><strong>msmedi: </strong>{{$udyamcard['response']['result']['generalInfo']['msmedi']}}</p>
                        <p><strong>dateOfUdyamRegistration: </strong>{{$udyamcard['response']['result']['generalInfo']['dateOfUdyamRegistration']}}</p>
                        <p><strong>typeOfEnterprise: </strong>{{$udyamcard['response']['result']['generalInfo']['typeOfEnterprise']}}</p>
                        <p><strong>officialAddressOfEnterprise: </strong>{{$udyamcard['response']['result']['officialAddressOfEnterprise']['flatDoorBlockNo']}}</br></strong>{{$udyamcard['response']['result']['officialAddressOfEnterprise']['nameOfPremisesBuilding']}}</br></strong>{{$udyamcard['response']['result']['officialAddressOfEnterprise']['villageTown']}}</br></strong>{{$udyamcard['response']['result']['officialAddressOfEnterprise']['block']}}</p>
                        <p><strong>state:</strong>{{$udyamcard['response']['result']['officialAddressOfEnterprise']['state']}}</p>
                        <p><strong>district:</strong>{{$udyamcard['response']['result']['officialAddressOfEnterprise']['district']}}</p>
                        <p><strong>city:</strong>{{$udyamcard['response']['result']['officialAddressOfEnterprise']['city']}}</p>
                        <p><strong>pincode:</strong>{{$udyamcard['response']['result']['officialAddressOfEnterprise']['pin']}}</p>
                        <p><strong>email:</strong>{{$udyamcard['response']['result']['officialAddressOfEnterprise']['email']}}</p> --}}
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
