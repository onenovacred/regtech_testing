@if (!empty($udyamcardv2) && $udyamcardv2['status_code'] == 200)
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Udyam details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <p><strong>UdyamNumber:
                        </strong>{{ isset($udyamcardv2['response']['essentials']['udyamNumber']) ? $udyamcardv2['response']['essentials']['udyamNumber'] : 'null' }}</p>
                    <p><strong>Id: </strong>{{ isset($udyamcardv2['response']['id']) ? $udyamcardv2['response']['id'] : 'null'}}</p>
                    <p><strong>PatronId: </strong>{{ isset($udyamcardv2['response']['patronId']) ? $udyamcardv2['response']['patronId']:'null' }}</p>
                    <p><strong>udyamRegistrationNumber:
                        </strong>{{ isset($udyamcardv2['response']['result']['generalInfo']['udyamRegistrationNumber']) ? $udyamcardv2['response']['result']['generalInfo']['udyamRegistrationNumber'] : 'null'}}
                    </p>
                    <p><strong>nameOfEnterprise:
                        </strong>{{ isset($udyamcardv2['response']['result']['generalInfo']['nameOfEnterprise']) ? $udyamcardv2['response']['result']['generalInfo']['nameOfEnterprise'] : 'null'  }}
                    </p>
                    <p><strong>majorActivity:
                        </strong>{{ isset($udyamcardv2['response']['result']['generalInfo']['majorActivity']) ?  $udyamcardv2['response']['result']['generalInfo']['majorActivity'] : 'null'}}</p>
                    <p><strong>organisationType:
                        </strong>{{ isset($udyamcardv2['response']['result']['generalInfo']['organisationType']) ? $udyamcardv2['response']['result']['generalInfo']['organisationType'] : 'null'  }}
                    </p>
                    <p><strong>nameOfEnterprise:
                    </strong>{{ isset($udyamcardv2['response']['result']['generalInfo']['nameOfEnterprise']) ? $udyamcardv2['response']['result']['generalInfo']['nameOfEnterprise'] : 'null'  }}
                    </p>
                    <p><strong>socialCategory:
                        </strong>{{ isset($udyamcardv2['response']['result']['generalInfo']['socialCategory']) ? $udyamcardv2['response']['result']['generalInfo']['socialCategory'] :'null' }}
                    </p>
                    <p><strong>dateOfIncorporation:
                        </strong>{{ isset($udyamcardv2['response']['result']['generalInfo']['dateOfIncorporation'])?$udyamcardv2['response']['result']['generalInfo']['dateOfIncorporation']:'null' }}
                    </p>
                    <p><strong>dateOfCommencementOfProductionBusiness:
                        </strong>{{ isset($udyamcardv2['response']['result']['generalInfo']['dateOfCommencementOfProductionBusiness']) ?$udyamcardv2['response']['result']['generalInfo']['dateOfCommencementOfProductionBusiness']:'null' }}
                    </p>
                    <p><strong>dic: </strong>{{ isset($udyamcardv2['response']['result']['generalInfo']['dic']) ?$udyamcardv2['response']['result']['generalInfo']['dic']:'null'}}
                    </p>
                    <p><strong>msmedi:
                        </strong>{{ isset($udyamcardv2['response']['result']['generalInfo']['msmedi']) ? $udyamcardv2['response']['result']['generalInfo']['msmedi'] :'null' }}</p>
                    <p><strong>dateOfUdyamRegistration:
                        </strong>{{ isset($udyamcardv2['response']['result']['generalInfo']['dateOfUdyamRegistration']) ? $udyamcardv2['response']['result']['generalInfo']['dateOfUdyamRegistration'] : 'null'}}
                    </p>
                    <p><strong>typeOfEnterprise:
                        </strong>{{ isset($udyamcardv2['response']['result']['generalInfo']['typeOfEnterprise']) ? $udyamcardv2['response']['result']['generalInfo']['typeOfEnterprise']: 'null' }}
                    </p>
                    <h4 class="text-center text-muted">Units Details</h4>
                    <p><strong>state:</strong>{{ isset($udyamcardv2['response']['result']['unitsDetails'][0]['state'])? $udyamcardv2['response']['result']['unitsDetails'][0]['state']:'null' }}
                    </p>
                    <p><strong>district:</strong>{{ isset($udyamcardv2['response']['result']['unitsDetails'][0]['district'])?$udyamcardv2['response']['result']['unitsDetails'][0]['district']: 'null'}}
                    </p>
                    <p><strong>city:</strong>{{ isset($udyamcardv2['response']['result']['unitsDetails'][0]['city'])?$udyamcardv2['response']['result']['unitsDetails'][0]['city']: 'null'}}
                    </p>
                    <p><strong>pincode:</strong>{{ isset($udyamcardv2['response']['result']['unitsDetails'][0]['pin']) ?$udyamcardv2['response']['result']['unitsDetails'][0]['pin']: 'null'}}
                    </p>
                   
                    <p><strong>unitName:</strong>{{ isset($udyamcardv2['response']['result']['unitsDetails'][0]['unitName'])?$udyamcardv2['response']['result']['unitsDetails'][0]['unitName']: 'null'}}
                    </p>
                    <p><strong>flat:</strong>{{ isset($udyamcardv2['response']['result']['unitsDetails'][0]['flat'])?$udyamcardv2['response']['result']['unitsDetails'][0]['flat']: 'null'}}
                    </p>
                    <p><strong>building:</strong>{{ isset($udyamcardv2['response']['result']['unitsDetails'][0]['building']) ?$udyamcardv2['response']['result']['unitsDetails'][0]['building']: 'null'}}
                    </p>
                    <p><strong>villageTown:</strong>{{ isset($udyamcardv2['response']['result']['unitsDetails'][0]['villageTown'])?$udyamcardv2['response']['result']['unitsDetails'][0]['villageTown']:'null' }}
                    </p>
                    <p><strong>block:</strong>{{ isset($udyamcardv2['response']['result']['unitsDetails'][0]['block']) ?$udyamcardv2['response']['result']['unitsDetails'][0]['block']: 'null'}}
                    </p>
                    <p><strong>road:</strong>{{ isset($udyamcardv2['response']['result']['unitsDetails'][0]['road']) ?$udyamcardv2['response']['result']['unitsDetails'][0]['road']: 'null'}}
                    </p>
                      <h4 class="text-center text-muted">EnterpriseType</h4>
                       <p><strong>dataYear:</strong>{{ isset($udyamcardv2['response']['result']['enterpriseType'][0]['dataYear']) ? $udyamcardv2['response']['result']['enterpriseType'][0]['dataYear'] :'null'}}
                       </p>
                       <p><strong>classificationYear:</strong>{{ isset($udyamcardv2['response']['result']['enterpriseType'][0]['classificationYear']) ? $udyamcardv2['response']['result']['enterpriseType'][0]['classificationYear'] :'null'}}
                       </p>
                       <p><strong>enterpriseType:</strong>{{ isset($udyamcardv2['response']['result']['enterpriseType'][0]['enterpriseType']) ? $udyamcardv2['response']['result']['enterpriseType'][0]['enterpriseType'] :'null'}}
                       </p>
                       <p><strong>classificationDate:</strong>{{ isset($udyamcardv2['response']['result']['enterpriseType'][0]['classificationDate']) ? $udyamcardv2['response']['result']['enterpriseType'][0]['classificationDate'] :'null'}}
                       </p>
                       <h4 class="text-center text-muted">officialAddressOfEnterprise</h4>
                       <p><strong>flatDoorBlockNo:</strong>{{ isset($udyamcardv2['response']['result']['officialAddressOfEnterprise']['flatDoorBlockNo']) ? $udyamcardv2['response']['result']['officialAddressOfEnterprise']['flatDoorBlockNo']:'null'  }}
                       </p>
                       <p><strong>nameOfPremisesBuilding:</strong>{{ isset($udyamcardv2['response']['result']['officialAddressOfEnterprise']['nameOfPremisesBuilding']) ? $udyamcardv2['response']['result']['officialAddressOfEnterprise']['nameOfPremisesBuilding'] : 'null' }}
                       </p>
                       <p><strong>villageTown:</strong>{{ isset($udyamcardv2['response']['result']['officialAddressOfEnterprise']['villageTown']) ? $udyamcardv2['response']['result']['officialAddressOfEnterprise']['villageTown'] : 'null' }}
                       </p>
                       <p><strong>block:</strong>{{ isset($udyamcardv2['response']['result']['officialAddressOfEnterprise']['block']) ? $udyamcardv2['response']['result']['officialAddressOfEnterprise']['block'] : 'null' }}
                       </p>
                       <p><strong>roadStreetLane:</strong>{{ isset($udyamcardv2['response']['result']['officialAddressOfEnterprise']['roadStreetLane']) ? $udyamcardv2['response']['result']['officialAddressOfEnterprise']['roadStreetLane'] : 'null' }}
                       </p>
                       <p><strong>city:</strong>{{ isset($udyamcardv2['response']['result']['officialAddressOfEnterprise']['city']) ? $udyamcardv2['response']['result']['officialAddressOfEnterprise']['city'] : 'null' }}
                       </p>
                       <p><strong>state:</strong>{{ isset($udyamcardv2['response']['result']['officialAddressOfEnterprise']['state']) ? $udyamcardv2['response']['result']['officialAddressOfEnterprise']['state'] : 'null' }}
                       </p>
                       <p><strong>pin:</strong>{{ isset($udyamcardv2['response']['result']['officialAddressOfEnterprise']['pin']) ? $udyamcardv2['response']['result']['officialAddressOfEnterprise']['pin'] : 'null' }}
                       </p>
                       <p><strong>district:</strong>{{ isset($udyamcardv2['response']['result']['officialAddressOfEnterprise']['district']) ? $udyamcardv2['response']['result']['officialAddressOfEnterprise']['district'] : 'null' }}
                       </p>
                       <p><strong>mobile:</strong>{{ isset($udyamcardv2['response']['result']['officialAddressOfEnterprise']['mobile']) ? $udyamcardv2['response']['result']['officialAddressOfEnterprise']['mobile'] : 'null' }}
                       </p>
                       <p><strong>email:</strong>{{ isset($udyamcardv2['response']['result']['officialAddressOfEnterprise']['email'])?$udyamcardv2['response']['result']['officialAddressOfEnterprise']['email']: 'null'}}
                       </p>
                       <h4 class="text-center text-muted">nationalIndustryClassificationCodes</h4>
                       <p><strong>nic2Digit:</strong>{{ isset($udyamcardv2['response']['result']['nationalIndustryClassificationCodes']['nic2Digit']) ? $udyamcardv2['response']['result']['nationalIndustryClassificationCodes']['nic2Digit'] : 'null' }}
                       </p>
                       <p><strong>nic4Digit:</strong>{{ isset($udyamcardv2['response']['result']['nationalIndustryClassificationCodes']['nic4Digit']) ? $udyamcardv2['response']['result']['nationalIndustryClassificationCodes']['nic4Digit'] : 'null' }}
                       </p>
                       <p><strong>nic5Digit:</strong>{{ isset($udyamcardv2['response']['result']['nationalIndustryClassificationCodes']['nic5Digit'])?$udyamcardv2['response']['result']['nationalIndustryClassificationCodes']['nic5Digit']: 'null'}}
                       </p>
                       <p><strong>activity:</strong>{{ isset($udyamcardv2['response']['result']['nationalIndustryClassificationCodes']['activity'])?$udyamcardv2['response']['result']['nationalIndustryClassificationCodes']['activity']: 'null'}}
                       </p>
                       <p><strong>date:</strong>{{ isset($udyamcardv2['response']['result']['nationalIndustryClassificationCodes']['date'])?$udyamcardv2['response']['result']['nationalIndustryClassificationCodes']['date']: 'null'}}
                       </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endif