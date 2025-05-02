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
                    <a role = "button" class = "btn btn-light float-right" href = "{{ route('kyc.udyam_api') }}">Udyam Card
                        APIs</a>
                </div>
                <div class="card-body">
                    @if (isset($udyamcard['statusCode']) && $udyamcard['statusCode'] == '102')
                        <div class="alert alert-danger" role="alert">
                            Udyam Number is Invalid
                        </div>
                    @endif
                    @if (isset($udyamcard['statusCode']) && $udyamcard['statusCode'] == '404')
                        <div class="alert alert-danger" role="alert">
                            Server Error. Please try again later.
                        </div>
                    @endif
                    @if (isset($udyamcard['statusCode']) && $udyamcard['statusCode'] == '500')
                        <!--$pancard[0]['pancard']['code']-->
                        <div class="alert alert-danger" role="alert">
                            Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                        </div>
                    @endif
                    @if (isset($udyamcard['statusCode']) && $udyamcard['statusCode'] == '400')
                        <!--$pancard[0]['pancard']['code']-->
                        <div class="alert alert-danger" role="alert">
                            Error. Please contact techsupport@docboyz.in. for more details.
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <form role="form" method="post" action="{{ route('kyc.udyam.details') }}">
                                {{ csrf_field() }}
                                @if (isset($udyamRequest[1]) && $udyamRequest[1] == 'udyamNumber')
                                    <div class="form-group">
                                        <label for="name">Udyam Number</label>
                                        <input type="text" class="form-control" maxlength="20" minlength="10"
                                            id="udyam_number" name="udyam_number" value="{{ old('udyam_number') }}"
                                            placeholder="Ex: ABCDE1234N" required>
                                    </div>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                @else
                                    <div class="form-group">
                                        <label for="name">Udyam Number</label>
                                        <input type="text" class="form-control" maxlength="20" minlength="10"
                                            id="udyam_number" name="udyam_number" value="{{ old('udyam_number') }}"
                                            placeholder="Ex: ABCDE1234N" required>
                                    </div>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @if (!empty($udyamcard) && isset($udyamcard['statusCode']) && $udyamcard['statusCode'] == 200)
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Udyam details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    <p><strong>UdyamNumber:
                                        </strong>{{ $udyamcard['response']['essentials']['udyamNumber'] }}</p>
                                    <p><strong>Id: </strong>{{ $udyamcard['response']['id'] }}</p>
                                    <p><strong>PatronId: </strong>{{ $udyamcard['response']['patronId'] }}</p>
                                    <p><strong>udyamRegistrationNumber:
                                        </strong>{{ $udyamcard['response']['result']['generalInfo']['udyamRegistrationNumber'] }}
                                    </p>
                                    <p><strong>nameOfEnterprise:
                                        </strong>{{ $udyamcard['response']['result']['generalInfo']['nameOfEnterprise'] }}
                                    </p>
                                    <p><strong>majorActivity:
                                        </strong>{{ $udyamcard['response']['result']['generalInfo']['majorActivity'] }}</p>
                                    <p><strong>organisationType:
                                        </strong>{{ $udyamcard['response']['result']['generalInfo']['organisationType'] }}
                                    </p>
                                    <p><strong>socialCategory:
                                        </strong>{{ $udyamcard['response']['result']['generalInfo']['socialCategory'] }}
                                    </p>
                                    <p><strong>dateOfIncorporation:
                                        </strong>{{ $udyamcard['response']['result']['generalInfo']['dateOfIncorporation'] }}
                                    </p>
                                    <p><strong>dateOfCommencementOfProductionBusiness:
                                        </strong>{{ $udyamcard['response']['result']['generalInfo']['dateOfCommencementOfProductionBusiness'] }}
                                    </p>
                                    <p><strong>dic: </strong>{{ $udyamcard['response']['result']['generalInfo']['dic'] }}
                                    </p>
                                    <p><strong>msmedi:
                                        </strong>{{ $udyamcard['response']['result']['generalInfo']['msmedi'] }}</p>
                                    <p><strong>dateOfUdyamRegistration:
                                        </strong>{{ $udyamcard['response']['result']['generalInfo']['dateOfUdyamRegistration'] }}
                                    </p>
                                    <p><strong>typeOfEnterprise:
                                        </strong>{{ $udyamcard['response']['result']['generalInfo']['typeOfEnterprise'] }}
                                    </p>
                                    <p><strong>officialAddressOfEnterprise:
                                        </strong>{{ $udyamcard['response']['result']['officialAddressOfEnterprise']['flatDoorBlockNo'] }}</br></strong>{{ $udyamcard['response']['result']['officialAddressOfEnterprise']['nameOfPremisesBuilding'] }}</br></strong>{{ $udyamcard['response']['result']['officialAddressOfEnterprise']['villageTown'] }}</br></strong>{{ $udyamcard['response']['result']['officialAddressOfEnterprise']['block'] }}
                                    </p>
                                    <p><strong>state:</strong>{{ $udyamcard['response']['result']['officialAddressOfEnterprise']['state'] }}
                                    </p>
                                    <p><strong>district:</strong>{{ $udyamcard['response']['result']['officialAddressOfEnterprise']['district'] }}
                                    </p>
                                    <p><strong>city:</strong>{{ $udyamcard['response']['result']['officialAddressOfEnterprise']['city'] }}
                                    </p>
                                    <p><strong>pincode:</strong>{{ $udyamcard['response']['result']['officialAddressOfEnterprise']['pin'] }}
                                    </p>
                                    <p><strong>email:</strong>{{ $udyamcard['response']['result']['officialAddressOfEnterprise']['email'] }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if (!empty($udyamcard_response) && isset($statusCode) && $statusCode == 200)
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Udyam details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    @if (!empty($udyamcard_response['data']['udyamNumber']))
                                        <p><strong>UdyamNumber:</strong>{{ $udyamcard_response['data']['udyamNumber'] }}
                                        </p>
                                    @else
                                    @endif
                                    @if (!empty($udyamcard_response['data']['id']))
                                        <p><strong>Id: </strong>{{ $udyamcard_response['data']['id'] }}</p>
                                    @else
                                    @endif
                                    @if (!empty($udyamcard_response['data']['patronId']))
                                        <p><strong>PatronId: </strong>{{ $udyamcard_response['data']['patronId'] }}
                                        </p>
                                    @else
                                    @endif
                                    @if (!empty($udyamcard_response['data']['udyamRegistrationNumber']))
                                        <p><strong>udyamRegistrationNumber:
                                            </strong>{{ $udyamcard_response['data']['udyamRegistrationNumber'] }}
                                        </p>
                                    @else
                                    @endif
                                    @if (!empty($udyamcard_response['data']['nameOfEnterprise']))
                                        <p><strong>nameOfEnterprise:
                                            </strong>{{ $udyamcard_response['data']['nameOfEnterprise'] }}
                                        </p>
                                    @else
                                    @endif
                                    @if (!empty($udyamcard_response['data']['majorActivity']))
                                        <p><strong>majorActivity:
                                            </strong>{{ $udyamcard_response['data']['majorActivity'] }}
                                        </p>
                                    @else
                                    @endif
                                    @if (!empty($udyamcard_response['data']['organisationType']))
                                        <p><strong>organisationType:
                                            </strong>{{ $udyamcard_response['data']['organisationType'] }}
                                        </p>
                                    @else
                                    @endif
                                    @if (!empty($udyamcard_response['data']['socialCategory']))
                                    <p><strong>socialCategory:
                                    </strong>{{ $udyamcard_response['data']['socialCategory'] }}
                                    </p>
                                    @else
                                    @endif
                                    @if (!empty($udyamcard_response['data']['dateOfIncorporation']))
                                    <p><strong>dateOfIncorporation:
                                    </strong>{{ $udyamcard_response['data']['dateOfIncorporation'] }}
                                    </p>
                                    @else
                                    @endif
                                    @if (!empty($udyamcard_response['data']['dateOfCommencementOfProductionBusiness']))
                                    <p><strong>dateOfCommencementOfProductionBusiness:
                                    </strong>{{ $udyamcard_response['data']['dateOfCommencementOfProductionBusiness'] }}
                                    </p>
                                    @else
                                    @endif
                                    @if (!empty($udyamcard_response['data']['dic']))
                                    <p><strong>dic:
                                    </strong>{{ $udyamcard_response['data']['dic'] }}
                                    </p>
                                    @else
                                    @endif
                                    @if (!empty($udyamcard_response['data']['msmedi']))
                                    <p><strong>msmedi:
                                    </strong>{{ $udyamcard_response['data']['msmedi'] }}
                                    </p>
                                    @else
                                    @endif
                                    @if (!empty($udyamcard_response['data']['dateOfUdyamRegistration']))
                                    <p><strong>dateOfUdyamRegistration:
                                    </strong>{{ $udyamcard_response['data']['dateOfUdyamRegistration'] }}
                                    </p>
                                    @else
                                    @endif
                                    @if (!empty($udyamcard_response['data']['dic']))
                                    <p><strong>dic:
                                    </strong>{{ $udyamcard_response['data']['dic'] }}
                                    </p>
                                    @else
                                    @endif
                                    @if (!empty($udyamcard_response['data']['typeOfEnterprise']))
                                    <p><strong>typeOfEnterprise:
                                    </strong>{{ $udyamcard_response['data']['typeOfEnterprise'] }}
                                    </p>
                                    @else
                                    @endif
                                    @if (!empty($udyamcard_response['data']['sn']))
                                    <p><strong>SN:
                                    </strong>{{ $udyamcard_response['data']['sn'] }}
                                     </p>
                                    @else
                                    @endif
                                    @if (!empty($udyamcard_response['data']['unitName']))
                                    <p><strong>unitName:
                                    </strong>{{ $udyamcard_response['data']['unitName'] }}
                                     </p>
                                    @else
                                    @endif
                                    @if (!empty($udyamcard_response['data']['flat']))
                                    <p><strong>Flat:
                                    </strong>{{ $udyamcard_response['data']['flat'] }}
                                    </p>
                                    @else
                                    @endif
                                    @if (!empty($udyamcard_response['data']['building']))
                                    <p><strong>building:
                                    </strong>{{ $udyamcard_response['data']['building'] }}
                                    </p>
                                    @else
                                    @endif
                                    @if (!empty($udyamcard_response['data']['villageTown']))
                                    <p><strong>villageTown:
                                    </strong>{{ $udyamcard_response['data']['villageTown'] }}
                                    </p>
                                    @else
                                    @endif
                                    @if (!empty($udyamcard_response['data']['roadStreetLane']))
                                    <p><strong>roadStreetLane:
                                    </strong>{{ $udyamcard_response['data']['roadStreetLane'] }}
                                    </p>
                                     @else
                                    @endif
                                    @if (!empty($udyamcard_response['data']['block']))
                                    <p><strong>block:
                                    </strong>{{ $udyamcard_response['data']['block'] }}
                                    </p>
                                    @else
                                    @endif
                                    @if (!empty($udyamcard_response['data']['city']))
                                    <p><strong>city:
                                    </strong>{{ $udyamcard_response['data']['city'] }}
                                   </p>
                                    @else
                                    @endif
                                    @if (!empty($udyamcard_response['data']['state']))
                                    <p><strong>state:
                                    </strong>{{ $udyamcard_response['data']['state'] }}
                                    </p>
                                    @else
                                    @endif
                                    @if (!empty($udyamcard_response['data']['pin']))
                                    <p><strong>pin:
                                    </strong>{{ $udyamcard_response['data']['pin'] }}
                                     </p>
                                    @else
                                    @endif
                                    @if (!empty($udyamcard_response['data']['district']))
                                    <p><strong>district:
                                    </strong>{{ $udyamcard_response['data']['district'] }}
                                    </p>
                                    @else
                                    @endif
                                    @if (!empty($udyamcard_response['data']['mobile']))
                                    <p><strong>mobile:
                                    </strong>{{ $udyamcard_response['data']['mobile'] }}
                                    </p>
                                    @else
                                    @endif
                                    @if (!empty($udyamcard_response['data']['email']))
                                    <p><strong>email:
                                    </strong>{{ $udyamcard_response['data']['email'] }}
                                    </p>
                                    @else
                                    @endif
                                    @if (!empty($udyamcard_response['data']['nic2Digit']))
                                    <p><strong>nic2Digit:
                                    </strong>{{ $udyamcard_response['data']['nic2Digit'] }}
                                    </p>
                                    @else
                                    @endif
                                    
                                    @if (!empty($udyamcard_response['data']['nic4Digit']))
                                    <p><strong>nic4Digit:
                                    </strong>{{ $udyamcard_response['data']['nic4Digit'] }}
                                    </p>
                                    @else
                                    @endif
                                    @if (!empty($udyamcard_response['data']['nic5Digit']))
                                    <p><strong>nic5Digit:
                                    </strong>{{ $udyamcard_response['data']['nic5Digit'] }}
                                    </p>
                                    @else
                                    @endif
                                    @if (!empty($udyamcard_response['data']['activity']))
                                    <p><strong>activity:
                                    </strong>{{ $udyamcard_response['data']['activity'] }}
                                    </p>
                                    @else
                                    @endif
                                    @if (!empty($udyamcard_response['data']['date']))
                                    <p><strong>date:
                                    </strong>{{ $udyamcard_response['data']['date'] }}
                                    </p>
                                    @else
                                    @endif
                                     @if (!empty($udyamcard_response['data']['enterpriseType']))
                                        <p><strong>enterpriseType:
                                            </strong>
                                            @php
                                                $enterpriseType = $udyamcard_response['data']['enterpriseType'];
                                                $enterpriseTypes = json_encode($enterpriseType);
                                                $enterpriseTypeIitem = json_decode($enterpriseTypes, true);
                                            @endphp
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>DateYear</th>
                                                    <th>ClassificationYear</th>
                                                    <th>EnterpriseType</th>
                                                    <th>ClassificationDate</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($enterpriseTypeIitem as $item)
                                                    <tr>
                                                        <td>{{ $item['dataYear'] }}</td>
                                                        <td>{{ $item['classificationYear'] }}</td>
                                                        <td>{{ $item['enterpriseType'] }}</td>
                                                        <td>{{ $item['classificationDate'] }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        </p>
                                    @else
                                    @endif
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
