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
                    <h3 class="card-title">Udyam  Registration Search v2 </h3>
                    <a role = "button" class = "btn btn-light float-right" href = "{{ route('kyc.udyam_api.v2') }}">UdyamCard 
                         APIs</a>
                </div>
                <div class="card-body">
                    @if (isset($statusCode) &&  $statusCode == 202)
                        <div class="alert alert-danger" role="alert">
                             {{$error_message}}
                        </div>
                    @endif
                    @if (isset($statusCode) &&  $statusCode == 103)
                        <div class="alert alert-danger" role="alert">
                            {{$error_message}}
                        </div>
                    @endif
                    @if (isset($statusCode) &&  $statusCode == 500)
                        <div class="alert alert-danger" role="alert">
                            {{$error_message}}
                        </div>
                    @endif
                    @if (isset($statusCode) && $statusCode == 403)
                    <div class="alert alert-danger" role="alert">
                        {{$error_message}}
                    </div>
                    @endif
                    @if (isset($statusCode) &&  $statusCode == 500)
                    <div class="alert alert-danger" role="alert">
                        {{$error_message}}
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <form role="form" method="post" action="{{ route('kyc.udyam.details.v2') }}">
                                {{ csrf_field() }}
                                   <div class="form-group">
                                        <label for="name">Udyam Number</label>
                                        <input type="text" class="form-control" maxlength="20" minlength="10"
                                            id="udyam_number" name="udyam_number" value="{{ old('udyam_number') }}"
                                            placeholder="Enter Udyam Registration Number" required>
                                    </div>
                                   <button type="submit" class="btn btn-success">Verify</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @if (!empty($udyamcard) && isset($udyamcard['status_code']) && $udyamcard['status_code'] == 200)
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Udyam details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    <p><strong>UdyamNumber:
                                        </strong>{{ isset($udyamcard['response']['essentials']['udyamNumber']) ? $udyamcard['response']['essentials']['udyamNumber'] : 'null' }}</p>
                                    <p><strong>Id: </strong>{{ isset($udyamcard['response']['id']) ? $udyamcard['response']['id'] : 'null'}}</p>
                                    <p><strong>PatronId: </strong>{{ isset($udyamcard['response']['patronId']) ? $udyamcard['response']['patronId']:'null' }}</p>
                                    <p><strong>udyamRegistrationNumber:
                                        </strong>{{ isset($udyamcard['response']['result']['generalInfo']['udyamRegistrationNumber']) ? $udyamcard['response']['result']['generalInfo']['udyamRegistrationNumber'] : 'null'}}
                                    </p>
                                    <p><strong>nameOfEnterprise:
                                        </strong>{{ isset($udyamcard['response']['result']['generalInfo']['nameOfEnterprise']) ? $udyamcard['response']['result']['generalInfo']['nameOfEnterprise'] : 'null'  }}
                                    </p>
                                    <p><strong>majorActivity:
                                        </strong>{{ isset($udyamcard['response']['result']['generalInfo']['majorActivity']) ?  $udyamcard['response']['result']['generalInfo']['majorActivity'] : 'null'}}</p>
                                    <p><strong>organisationType:
                                        </strong>{{ isset($udyamcard['response']['result']['generalInfo']['organisationType']) ? $udyamcard['response']['result']['generalInfo']['organisationType'] : 'null'  }}
                                    </p>
                                    <p><strong>nameOfEnterprise:
                                    </strong>{{ isset($udyamcard['response']['result']['generalInfo']['nameOfEnterprise']) ? $udyamcard['response']['result']['generalInfo']['nameOfEnterprise'] : 'null'  }}
                                    </p>
                                    <p><strong>socialCategory:
                                        </strong>{{ isset($udyamcard['response']['result']['generalInfo']['socialCategory']) ? $udyamcard['response']['result']['generalInfo']['socialCategory'] :'null' }}
                                    </p>
                                    <p><strong>dateOfIncorporation:
                                        </strong>{{ isset($udyamcard['response']['result']['generalInfo']['dateOfIncorporation'])?$udyamcard['response']['result']['generalInfo']['dateOfIncorporation']:'null' }}
                                    </p>
                                    <p><strong>dateOfCommencementOfProductionBusiness:
                                        </strong>{{ isset($udyamcard['response']['result']['generalInfo']['dateOfCommencementOfProductionBusiness']) ?$udyamcard['response']['result']['generalInfo']['dateOfCommencementOfProductionBusiness']:'null' }}
                                    </p>
                                    <p><strong>dic: </strong>{{ isset($udyamcard['response']['result']['generalInfo']['dic']) ?$udyamcard['response']['result']['generalInfo']['dic']:'null'}}
                                    </p>
                                    <p><strong>msmedi:
                                        </strong>{{ isset($udyamcard['response']['result']['generalInfo']['msmedi']) ? $udyamcard['response']['result']['generalInfo']['msmedi'] :'null' }}</p>
                                    <p><strong>dateOfUdyamRegistration:
                                        </strong>{{ isset($udyamcard['response']['result']['generalInfo']['dateOfUdyamRegistration']) ? $udyamcard['response']['result']['generalInfo']['dateOfUdyamRegistration'] : 'null'}}
                                    </p>
                                    <p><strong>typeOfEnterprise:
                                        </strong>{{ isset($udyamcard['response']['result']['generalInfo']['typeOfEnterprise']) ? $udyamcard['response']['result']['generalInfo']['typeOfEnterprise']: 'null' }}
                                    </p>
                                    <h4 class="text-center text-muted">Units Details</h4>
                                    <p><strong>state:</strong>{{ isset($udyamcard['response']['result']['unitsDetails'][0]['state'])? $udyamcard['response']['result']['unitsDetails'][0]['state']:'null' }}
                                    </p>
                                    <p><strong>district:</strong>{{ isset($udyamcard['response']['result']['unitsDetails'][0]['district'])?$udyamcard['response']['result']['unitsDetails'][0]['district']: 'null'}}
                                    </p>
                                    <p><strong>city:</strong>{{ isset($udyamcard['response']['result']['unitsDetails'][0]['city'])?$udyamcard['response']['result']['unitsDetails'][0]['city']: 'null'}}
                                    </p>
                                    <p><strong>pincode:</strong>{{ isset($udyamcard['response']['result']['unitsDetails'][0]['pin']) ?$udyamcard['response']['result']['unitsDetails'][0]['pin']: 'null'}}
                                    </p>
                                   
                                    <p><strong>unitName:</strong>{{ isset($udyamcard['response']['result']['unitsDetails'][0]['unitName'])?$udyamcard['response']['result']['unitsDetails'][0]['unitName']: 'null'}}
                                    </p>
                                    <p><strong>flat:</strong>{{ isset($udyamcard['response']['result']['unitsDetails'][0]['flat'])?$udyamcard['response']['result']['unitsDetails'][0]['flat']: 'null'}}
                                    </p>
                                    <p><strong>building:</strong>{{ isset($udyamcard['response']['result']['unitsDetails'][0]['building']) ?$udyamcard['response']['result']['unitsDetails'][0]['building']: 'null'}}
                                    </p>
                                    <p><strong>villageTown:</strong>{{ isset($udyamcard['response']['result']['unitsDetails'][0]['villageTown'])?$udyamcard['response']['result']['unitsDetails'][0]['villageTown']:'null' }}
                                    </p>
                                    <p><strong>block:</strong>{{ isset($udyamcard['response']['result']['unitsDetails'][0]['block']) ?$udyamcard['response']['result']['unitsDetails'][0]['block']: 'null'}}
                                    </p>
                                    <p><strong>road:</strong>{{ isset($udyamcard['response']['result']['unitsDetails'][0]['road']) ?$udyamcard['response']['result']['unitsDetails'][0]['road']: 'null'}}
                                    </p>
                                      <h4 class="text-center text-muted">EnterpriseType</h4>
                                       <p><strong>dataYear:</strong>{{ isset($udyamcard['response']['result']['enterpriseType'][0]['dataYear']) ? $udyamcard['response']['result']['enterpriseType'][0]['dataYear'] :'null'}}
                                       </p>
                                       <p><strong>classificationYear:</strong>{{ isset($udyamcard['response']['result']['enterpriseType'][0]['classificationYear']) ? $udyamcard['response']['result']['enterpriseType'][0]['classificationYear'] :'null'}}
                                       </p>
                                       <p><strong>enterpriseType:</strong>{{ isset($udyamcard['response']['result']['enterpriseType'][0]['enterpriseType']) ? $udyamcard['response']['result']['enterpriseType'][0]['enterpriseType'] :'null'}}
                                       </p>
                                       <p><strong>classificationDate:</strong>{{ isset($udyamcard['response']['result']['enterpriseType'][0]['classificationDate']) ? $udyamcard['response']['result']['enterpriseType'][0]['classificationDate'] :'null'}}
                                       </p>
                                       <h4 class="text-center text-muted">officialAddressOfEnterprise</h4>
                                       <p><strong>flatDoorBlockNo:</strong>{{ isset($udyamcard['response']['result']['officialAddressOfEnterprise']['flatDoorBlockNo']) ? $udyamcard['response']['result']['officialAddressOfEnterprise']['flatDoorBlockNo']:'null'  }}
                                       </p>
                                       <p><strong>nameOfPremisesBuilding:</strong>{{ isset($udyamcard['response']['result']['officialAddressOfEnterprise']['nameOfPremisesBuilding']) ? $udyamcard['response']['result']['officialAddressOfEnterprise']['nameOfPremisesBuilding'] : 'null' }}
                                       </p>
                                       <p><strong>villageTown:</strong>{{ isset($udyamcard['response']['result']['officialAddressOfEnterprise']['villageTown']) ? $udyamcard['response']['result']['officialAddressOfEnterprise']['villageTown'] : 'null' }}
                                       </p>
                                       <p><strong>block:</strong>{{ isset($udyamcard['response']['result']['officialAddressOfEnterprise']['block']) ? $udyamcard['response']['result']['officialAddressOfEnterprise']['block'] : 'null' }}
                                       </p>
                                       <p><strong>roadStreetLane:</strong>{{ isset($udyamcard['response']['result']['officialAddressOfEnterprise']['roadStreetLane']) ? $udyamcard['response']['result']['officialAddressOfEnterprise']['roadStreetLane'] : 'null' }}
                                       </p>
                                       <p><strong>city:</strong>{{ isset($udyamcard['response']['result']['officialAddressOfEnterprise']['city']) ? $udyamcard['response']['result']['officialAddressOfEnterprise']['city'] : 'null' }}
                                       </p>
                                       <p><strong>state:</strong>{{ isset($udyamcard['response']['result']['officialAddressOfEnterprise']['state']) ? $udyamcard['response']['result']['officialAddressOfEnterprise']['state'] : 'null' }}
                                       </p>
                                       <p><strong>pin:</strong>{{ isset($udyamcard['response']['result']['officialAddressOfEnterprise']['pin']) ? $udyamcard['response']['result']['officialAddressOfEnterprise']['pin'] : 'null' }}
                                       </p>
                                       <p><strong>district:</strong>{{ isset($udyamcard['response']['result']['officialAddressOfEnterprise']['district']) ? $udyamcard['response']['result']['officialAddressOfEnterprise']['district'] : 'null' }}
                                       </p>
                                       <p><strong>mobile:</strong>{{ isset($udyamcard['response']['result']['officialAddressOfEnterprise']['mobile']) ? $udyamcard['response']['result']['officialAddressOfEnterprise']['mobile'] : 'null' }}
                                       </p>
                                       <p><strong>email:</strong>{{ isset($udyamcard['response']['result']['officialAddressOfEnterprise']['email'])?$udyamcard['response']['result']['officialAddressOfEnterprise']['email']: 'null'}}
                                       </p>
                                       <h4 class="text-center text-muted">nationalIndustryClassificationCodes</h4>
                                       <p><strong>nic2Digit:</strong>{{ isset($udyamcard['response']['result']['nationalIndustryClassificationCodes']['nic2Digit']) ? $udyamcard['response']['result']['nationalIndustryClassificationCodes']['nic2Digit'] : 'null' }}
                                       </p>
                                       <p><strong>nic4Digit:</strong>{{ isset($udyamcard['response']['result']['nationalIndustryClassificationCodes']['nic4Digit']) ? $udyamcard['response']['result']['nationalIndustryClassificationCodes']['nic4Digit'] : 'null' }}
                                       </p>
                                       <p><strong>nic5Digit:</strong>{{ isset($udyamcard['response']['result']['nationalIndustryClassificationCodes']['nic5Digit'])?$udyamcard['response']['result']['nationalIndustryClassificationCodes']['nic5Digit']: 'null'}}
                                       </p>
                                       <p><strong>activity:</strong>{{ isset($udyamcard['response']['result']['nationalIndustryClassificationCodes']['activity'])?$udyamcard['response']['result']['nationalIndustryClassificationCodes']['activity']: 'null'}}
                                       </p>
                                       <p><strong>date:</strong>{{ isset($udyamcard['response']['result']['nationalIndustryClassificationCodes']['date'])?$udyamcard['response']['result']['nationalIndustryClassificationCodes']['date']: 'null'}}
                                       </p>
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
