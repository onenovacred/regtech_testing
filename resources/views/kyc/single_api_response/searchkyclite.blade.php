@if (!empty($searchkyclite) && $searchkyclite['statusCode'] == 200)
<div class="row">
   <div class="col-md-6 offset-md-3">
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Search Kyc Details</h3>
    </div>
    <div class="card-body">
       <div class="col-md-12">
                <div>
                    @if (!empty($searchkyclite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['fullName']))
                        <p><strong>Full Name:</strong>
                            {{ $searchkyclite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['fullName'] }}
                        </p>
                    @endif
                    @if (!empty($searchkyclite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['mobNum']))
                        <p><strong>Mobile Number:
                            </strong>{{ $searchkyclite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['mobNum'] }}
                        </p>
                    @endif
                    @if (!empty($searchkyclite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['email']))
                        <p><strong>Email:
                            </strong>{{ $searchkyclite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['email'] }}
                        </p>
                    @endif
                    @if (!empty($searchkyclite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['dob']))
                        <p><strong>DOB:
                            </strong>{{$searchkyclite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['dob'] }}
                        </p>
                    @endif
                    @if (!empty($searchkyclite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['pan']))
                        <p><strong>Pan Number:
                            </strong>{{$searchkyclite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['pan'] }}
                        </p>
                    @endif
                    @if (
                        !empty(
                            $searchkyclite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['maskedAadhaar']
                        ))
                        <p><strong>MaskedAadhaar:
                            </strong>{{ $searchkyclite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['maskedAadhaar'] }}
                        </p>
                    @endif
                    @if (
                        !empty(
                            $searchkyclite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['lastFourDigit']
                        ))
                        <p><strong>LastFourDigit:
                            </strong>{{ $searchkyclite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['lastFourDigit'] }}
                        </p>
                    @endif
                    @if (
                        !empty(
                            $searchkyclite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['typeOfHolder']
                        ))
                        <p><strong>TypeOfHolder:
                            </strong>{{ $searchkyclite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['typeOfHolder'] }}
                        </p>
                    @endif
                    @if (!empty($searchkyclite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['firstName']))
                        <p><strong>FirstName:
                            </strong>{{ $searchkyclite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['firstName'] }}
                        </p>
                    @endif
                    @if (
                        !empty(
                            $searchkyclite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['middleName']
                        ))
                        <p><strong>MiddleName:
                            </strong>{{ $searchkyclite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['middleName'] }}
                        </p>
                    @endif
                    @if (!empty($searchkyclite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['lastName']))
                        <p><strong>LastName:
                            </strong>{{$searchkyclite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['lastName'] }}
                        </p>
                    @endif
                    @if (!empty($searchkyclite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['address']))
                        <p><strong>Address:
                            </strong>{{ $searchkyclite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['address'] }}
                        </p>
                    @endif
                    @if (!empty($searchkyclite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['city']))
                        <p><strong>City:
                            </strong>{{$searchkyclite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['city'] }}
                        </p>
                    @endif
                    @if (!empty($searchkyclite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['state']))
                        <p><strong>State:
                            </strong>{{ $searchkyclite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['state'] }}
                        </p>
                    @endif
                    @if (!empty($searchkyclite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['country']))
                        <p><strong>Country:
                            </strong>{{ $searchkyclite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['country'] }}
                        </p>
                    @endif
                    @if (!empty($searchkyclite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['pincode']))
                        <p><strong>Pincode:
                            </strong>{{ $searchkyclite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['pincode'] }}
                        </p>
                    @endif
                    @if (!empty($searchkyclite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['gender']))
                        <p><strong>Gender:
                            </strong>{{ $searchkyclite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['gender'] }}
                        </p>
                    @endif
                    @if (!empty($searchkyclite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['isValid']))
                        <p><strong>IsValid:
                            </strong>{{ $searchkyclite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['isValid'] }}
                        </p>
                    @endif
                    @if (
                        !empty(
                            $searchkyclite['response']['kycDetails']['personalIdentifiableData']['personalDetails'][
                                'aadhaarSeedingStatus'
                            ]
                        ))
                        <p><strong>AadhaarSeedingStatus:
                            </strong>{{ $searchkyclite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['aadhaarSeedingStatus'] }}
                        </p>
                    @endif
                    @if (
                        !empty(
                            $searchkyclite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['serviceCode']
                        ))
                        <p><strong>ServiceCode:
                            </strong>{{ $searchkyclite['response']['kycDetails']['personalIdentifiableData']['personalDetails']['serviceCode'] }}
                        </p>
                    @endif
                </div>
       </div>
    </div>
</div>
   </div>
</div>
@endif