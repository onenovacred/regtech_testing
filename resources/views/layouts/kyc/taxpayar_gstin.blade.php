@extends('adminlte::page')

@section('title', 'TAXPAYAR GSTIN')

@section('content_header')
    <!-- <h1 class="m-0 text-dark">
            Scheme Details</h1> -->
@stop

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">TAXPAYAR GSTIN</h3>
                    <a role = "button" class = "btn btn-light float-right"
                        href = "{{ route('kyc.taxpayar_gstin_api') }}">TAXPAYAR GSTIN
                        APIs</a>
                </div>
                <div class="card-body">
                    @if (isset($taxpayar_gstin['statusCode']) && $taxpayar_gstin['statusCode'] == 500)
                        <div class="alert alert-danger" role="alert">
                            Internal Server Error. Please contact techsupport@docboyz.in. for more details.
                        </div>
                    @endif
                    @if (isset($taxpayar_gstin['statusCode']) && $taxpayar_gstin['statusCode'] == 401)
                        <div class="alert alert-danger" role="alert">
                            Authentication failed.
                        </div>
                    @endif
                    @if (isset($taxpayar_gstin['statusCode']) && $taxpayar_gstin['statusCode'] == 102)
                        <div class="alert alert-danger" role="alert">
                            Wrong taxpayer gstin number. Please enter correct taxpayer gstin number.
                        </div>
                    @endif
                    @if (isset($taxpayar_gstin['statusCode']) && $taxpayar_gstin['statusCode'] == 403)
                        <div class="alert alert-danger" role="alert">
                            You are not authorized to use this API.
                        </div>
                    @endif
                    @if (isset($taxpayar_gstin['statusCode']) && $taxpayar_gstin['statusCode'] == 404)
                        <div class="alert alert-danger" role="alert">
                            Record Not Found.
                        </div>
                    @endif
                    @if (isset($taxpayar_gstin['statusCode']) && $taxpayar_gstin['statusCode'] == 502)
                        <div class="alert alert-danger" role="alert">
                            Publisher service returned an invalid response. Please contact with techsupport@docboyz.in
                        </div>
                    @endif
                    @if (isset($taxpayar_gstin['statusCode']) && $taxpayar_gstin['statusCode'] == 503)
                        <div class="alert alert-danger" role="alert">
                            Publisher service is temporarily unavailable. Please contact with techsupport@docboyz.in
                        </div>
                    @endif
                    @if (isset($taxpayar_gstin['statusCode']) && $taxpayar_gstin['statusCode'] == 504)
                        <div class="alert alert-danger" role="alert">
                            Publisher service is temporarily unavailable. Please contact with techsupport@docboyz.in
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <form role="form" method="post" action="{{ route('kyc.taxpayar_gstin') }}">
                                {{ csrf_field() }}
                                @if (isset($gstinRequest[1]) && $gstinRequest[1] == 'tax_payer_gstin_number')
                                    <div class="form-group">
                                        <label for="name">TAXPAYAR GSTIN NUMBER</label>
                                        <input type="text" class="form-control" id="tax_payer_gstin_number"
                                            name="tax_payer_gstin_number" value="{{ old('tax_payer_gstin_number') }}"
                                            placeholder="Ex: ABCDE1234N" required>
                                    </div>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                @elseif(isset($gstinRequest[2]) && $gstinRequest[2] == 'tax_payer_gstin_number')
                                    <div class="form-group">
                                        <label for="name">TAXPAYAR GSTIN NUMBER</label>
                                        <input type="text" class="form-control" id="tax_payer_gstin_number"
                                            name="tax_payer_gstin_number" value="{{ old('tax_payer_gstin_number') }}"
                                            placeholder="Ex: ABCDE1234N" required>
                                    </div>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                @else
                                    <div class="form-group">
                                        <label for="name">TAXPAYAR GSTIN NUMBER</label>
                                        <input type="text" class="form-control" id="tax_payer_gstin_number"
                                            name="tax_payer_gstin_number" value="{{ old('tax_payer_gstin_number') }}"
                                            placeholder="Ex: ABCDE1234N" required>
                                    </div>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                @endif

                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @if (!empty($taxpayar_gstin) && $taxpayar_gstin['statusCode'] == 200)
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">TAXPAYAR GSTIN Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    <p><strong>Business Name:</strong>
                                        @if (isset($taxpayar_gstin['taxpayer_gstin']['legalNameOfBusiness']))
                                            {{ $taxpayar_gstin['taxpayer_gstin']['legalNameOfBusiness'] }}
                                        @else
                                        @endif
                                    </p>
                                    <p><strong>GSTIN Number:</strong>
                                        @if (isset($taxpayar_gstin['taxpayer_gstin']['gstIdentificationNumber']))
                                            {{ $taxpayar_gstin['taxpayer_gstin']['gstIdentificationNumber'] }}
                                        @else
                                        @endif
                                    </p>
                                    <p><strong>Status:</strong>
                                        @if (isset($taxpayar_gstin['taxpayer_gstin']['gstnStatus']))
                                            {{ $taxpayar_gstin['taxpayer_gstin']['gstnStatus'] }}
                                        @else
                                        @endif
                                    </p>
                                    <p><strong>Trade Name:</strong>
                                        @if (isset($taxpayar_gstin['taxpayer_gstin']['tradeName']))
                                            {{ $taxpayar_gstin['taxpayer_gstin']['tradeName'] }}
                                        @else
                                        @endif
                                    </p>
                                    <p><strong>Taxpayer Type:</strong>
                                        @if (isset($taxpayar_gstin['taxpayer_gstin']['taxpayerType']))
                                            {{ $taxpayar_gstin['taxpayer_gstin']['taxpayerType'] }}
                                        @else
                                        @endif
                                    </p>
                                    <p><strong>Registration Date:</strong>
                                        @if (isset($taxpayar_gstin['taxpayer_gstin']['dateOfRegistration']))
                                            {{ $taxpayar_gstin['taxpayer_gstin']['dateOfRegistration'] }}
                                        @else
                                        @endif
                                    </p>
                                    <p><strong>Nature:</strong>
                                        @if (isset($taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['natureOfPrincipalPlaceOfBusiness']))
                                            {{ $taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['natureOfPrincipalPlaceOfBusiness'] }}
                                        @else
                                        @endif
                                    </p>

                                    <p><strong>Business Type:</strong>
                                        @if (isset($taxpayar_gstin['taxpayer_gstin']['natureOfBusinessActivity']))
                                        @else
                                        @endif
                                    </p>
                                    <p><strong>Last Update:</strong>
                                        @if (isset($taxpayar_gstin['taxpayer_gstin']['lastUpdatedDate']))
                                            {{ $taxpayar_gstin['taxpayer_gstin']['lastUpdatedDate'] }}
                                        @else
                                        @endif
                                    </p>
                                    <p><strong>constitutionOfBusiness:</strong>
                                        @if (isset($taxpayar_gstin['taxpayer_gstin']['constitutionOfBusiness']))
                                            {{ $taxpayar_gstin['taxpayer_gstin']['constitutionOfBusiness'] }}
                                        @else
                                        @endif
                                    </p>
                                    <p><strong>natureOfBusinessActivity:</strong>
                                        @if (isset($taxpayar_gstin['taxpayer_gstin']['natureOfBusinessActivity']))
                                            {{ implode(',', $taxpayar_gstin['taxpayer_gstin']['natureOfBusinessActivity']) }}
                                        @else
                                        @endif
                                    </p>
                                    <p><strong>dateOfCancellation:</strong>
                                        @if (isset($taxpayar_gstin['taxpayer_gstin']['dateOfCancellation']))
                                            @if (!empty($taxpayar_gstin['taxpayer_gstin']['dateOfCancellation']))
                                                {{ $taxpayar_gstin['taxpayer_gstin']['dateOfCancellation'] }}
                                            @else
                                                " "
                                            @endif
                                        @else
                                        @endif
                                    </p>
                                    <p><strong>gstnStatus:</strong>
                                        @if (isset($taxpayar_gstin['taxpayer_gstin']['gstnStatus']))
                                            @if (!empty($taxpayar_gstin['taxpayer_gstin']['gstnStatus']))
                                                {{ $taxpayar_gstin['taxpayer_gstin']['gstnStatus'] }}
                                            @else
                                                " "
                                            @endif
                                        @else
                                        @endif
                                    </p>
                                    <p><strong>centerJurisdictionCode:</strong>
                                        @if (isset($taxpayar_gstin['taxpayer_gstin']['centerJurisdictionCode']))
                                            @if (!empty($taxpayar_gstin['taxpayer_gstin']['centerJurisdictionCode']))
                                                {{ $taxpayar_gstin['taxpayer_gstin']['centerJurisdictionCode'] }}
                                            @else
                                                " "
                                            @endif
                                        @else
                                        @endif
                                    </p>
                                    <p><strong>centerJurisdiction:</strong>
                                        @if (isset($taxpayar_gstin['taxpayer_gstin']['centerJurisdiction']))
                                            @if (!empty($taxpayar_gstin['taxpayer_gstin']['centerJurisdiction']))
                                                {{ $taxpayar_gstin['taxpayer_gstin']['centerJurisdiction'] }}
                                            @else
                                                " "
                                            @endif
                                        @else
                                        @endif
                                    </p>

                                    <p><strong>eInvoiceStatus:</strong>
                                        @if (isset($taxpayar_gstin['taxpayer_gstin']['eInvoiceStatus']))
                                            @if (!empty($taxpayar_gstin['taxpayer_gstin']['eInvoiceStatus']))
                                                {{ $taxpayar_gstin['taxpayer_gstin']['eInvoiceStatus'] }}
                                            @else
                                                " "
                                            @endif
                                        @else
                                        @endif
                                    </p>
                                    @if (isset($taxpayar_gstin['taxpayer_gstin']['additionalPlaceOfBusinessFields']))

                                        <p class="text-center"><strong>AdditionalPlaceOfBusinessFields</strong></p>

                                        @php
                                            $additionalAddressBusinessAddress = $taxpayar_gstin['taxpayer_gstin']['additionalPlaceOfBusinessFields'];
                                            $additionalAddress = json_encode($additionalAddressBusinessAddress, true);
                                            $additionalAddressIitem = json_decode($additionalAddress, true);

                                        @endphp
                                        <table class="table table-bordered table-responsive">
                                            <thead>
                                                <tr>
                                                    <th>buildingName</th>
                                                    <th>streetName</th>
                                                    <th>location</th>
                                                    <th>buildingNumber</th>
                                                    <th>districtName</th>
                                                    <th>lattitude</th>
                                                    <th>locality</th>
                                                    <th>pincode</th>
                                                    <th>landMark</th>
                                                    <th>stateName</th>
                                                    <th>geocodelvl</th>
                                                    <th>floorNumber</th>
                                                    <th>longitude</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($additionalAddressIitem as $item)
                                                    <tr>
                                                        <td class="text-center">
                                                            @if (!empty($item['additionalPlaceOfBusinessAddress']['buildingName']))
                                                                {{ $item['additionalPlaceOfBusinessAddress']['buildingName'] }}
                                                            @else
                                                                ""
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if (!empty($item['additionalPlaceOfBusinessAddress']['streetName']))
                                                                {{ $item['additionalPlaceOfBusinessAddress']['streetName'] }}
                                                            @else
                                                                ""
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if (!empty($item['additionalPlaceOfBusinessAddress']['location']))
                                                                {{ $item['additionalPlaceOfBusinessAddress']['location'] }}
                                                            @else
                                                                ""
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if (!empty($item['additionalPlaceOfBusinessAddress']['buildingNumber']))
                                                                {{ $item['additionalPlaceOfBusinessAddress']['buildingNumber'] }}
                                                            @else
                                                                ""
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if (!empty($item['additionalPlaceOfBusinessAddress']['districtName']))
                                                                {{ $item['additionalPlaceOfBusinessAddress']['districtName'] }}
                                                            @else
                                                                ""
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if (!empty($item['additionalPlaceOfBusinessAddress']['lattitude']))
                                                                {{ $item['additionalPlaceOfBusinessAddress']['lattitude'] }}
                                                            @else
                                                                ""
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if (!empty($item['additionalPlaceOfBusinessAddress']['locality']))
                                                                {{ $item['additionalPlaceOfBusinessAddress']['locality'] }}
                                                            @else
                                                                ""
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if (!empty($item['additionalPlaceOfBusinessAddress']['pincode']))
                                                                {{ $item['additionalPlaceOfBusinessAddress']['pincode'] }}
                                                            @else
                                                                ""
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if (!empty($item['additionalPlaceOfBusinessAddress']['landMark']))
                                                                {{ $item['additionalPlaceOfBusinessAddress']['landMark'] }}
                                                            @else
                                                                ""
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if (!empty($item['additionalPlaceOfBusinessAddress']['stateName']))
                                                                {{ $item['additionalPlaceOfBusinessAddress']['stateName'] }}
                                                            @else
                                                                ""
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if (!empty($item['additionalPlaceOfBusinessAddress']['geocodelvl']))
                                                                {{ $item['additionalPlaceOfBusinessAddress']['geocodelvl'] }}
                                                            @else
                                                                ""
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if (!empty($item['additionalPlaceOfBusinessAddress']['floorNumber']))
                                                                {{ $item['additionalPlaceOfBusinessAddress']['floorNumber'] }}
                                                            @else
                                                                ""
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if (!empty($item['additionalPlaceOfBusinessAddress']['longitude']))
                                                                {{ $item['additionalPlaceOfBusinessAddress']['longitude'] }}
                                                            @else
                                                                ""
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        </p>
                                        <p class="text-center"><strong>natureOfAdditionalPlaceOfBusiness</strong>
                                        <ol>
                                            @foreach ($additionalAddressIitem as $item)
                                                <li>{{ $item['natureOfAdditionalPlaceOfBusiness'] }}</li>
                                            @endforeach
                                        </ol>
                                        </p>
                                    @else
                                    @endif
                                    @if (isset($taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']))

                                        <p class="text-center"><strong>PrincipalPlaceOfBusinessAddress</strong></p>
                                        <p><strong>buildingName:</strong>
                                            @if (isset(
                                                    $taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                        'buildingName'
                                                    ]))
                                                @if (
                                                    !empty(
                                                        $taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                            'buildingName'
                                                        ]
                                                    ))
                                                    {{ $taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['buildingName'] }}
                                                @else
                                                    " "
                                                @endif
                                            @else
                                            @endif
                                        </p>
                                        <p><strong>streetName:</strong>
                                            @if (isset(
                                                    $taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                        'streetName'
                                                    ]))
                                                @if (
                                                    !empty(
                                                        $taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                            'streetName'
                                                        ]
                                                    ))
                                                    {{ $taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['streetName'] }}
                                                @else
                                                    " "
                                                @endif
                                            @else
                                            @endif
                                        </p>
                                        <p><strong>location:</strong>
                                            @if (isset(
                                                    $taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                        'location'
                                                    ]))
                                                @if (
                                                    !empty(
                                                        $taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                            'location'
                                                        ]
                                                    ))
                                                    {{ $taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['location'] }}
                                                @else
                                                    " "
                                                @endif
                                            @else
                                            @endif
                                        </p>
                                        <p><strong>buildingNumber:</strong>
                                            @if (isset(
                                                    $taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                        'buildingNumber'
                                                    ]))
                                                @if (
                                                    !empty(
                                                        $taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                            'buildingNumber'
                                                        ]
                                                    ))
                                                    {{ $taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['buildingName'] }}
                                                @else
                                                    " "
                                                @endif
                                            @else
                                            @endif
                                        </p>
                                        <p><strong>districtName:</strong>
                                            @if (isset(
                                                    $taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                        'districtName'
                                                    ]))
                                                @if (
                                                    !empty(
                                                        $taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                            'districtName'
                                                        ]
                                                    ))
                                                    {{ $taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['districtName'] }}
                                                @else
                                                    " "
                                                @endif
                                            @else
                                            @endif
                                        </p>
                                        <p><strong>lattitude:</strong>
                                            @if (isset(
                                                    $taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                        'lattitude'
                                                    ]))
                                                @if (
                                                    !empty(
                                                        $taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                            'lattitude'
                                                        ]
                                                    ))
                                                    {{ $taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['lattitude'] }}
                                                @else
                                                    " "
                                                @endif
                                            @else
                                            @endif
                                        </p>
                                        <p><strong>districtName:</strong>
                                            @if (isset(
                                                    $taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                        'districtName'
                                                    ]))
                                                @if (
                                                    !empty(
                                                        $taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                            'districtName'
                                                        ]
                                                    ))
                                                    {{ $taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['districtName'] }}
                                                @else
                                                    " "
                                                @endif
                                            @else
                                            @endif
                                        </p>
                                        <p><strong>locality:</strong>
                                            @if (isset(
                                                    $taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                        'locality'
                                                    ]))
                                                @if (
                                                    !empty(
                                                        $taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                            'locality'
                                                        ]
                                                    ))
                                                    {{ $taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['locality'] }}
                                                @else
                                                    " "
                                                @endif
                                            @else
                                            @endif
                                        </p>
                                        <p><strong>pincode:</strong>
                                            @if (isset(
                                                    $taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                        'pincode'
                                                    ]))
                                                @if (
                                                    !empty(
                                                        $taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                            'pincode'
                                                        ]
                                                    ))
                                                    {{ $taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['pincode'] }}
                                                @else
                                                    " "
                                                @endif
                                            @else
                                            @endif
                                        </p>
                                        <p><strong>landMark:</strong>
                                            @if (isset(
                                                    $taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                        'landMark'
                                                    ]))
                                                @if (
                                                    !empty(
                                                        $taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                            'landMark'
                                                        ]
                                                    ))
                                                    {{ $taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['landMark'] }}
                                                @else
                                                    " "
                                                @endif
                                            @else
                                            @endif
                                        </p>

                                        <p><strong>stateName:</strong>
                                            @if (isset(
                                                    $taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                        'stateName'
                                                    ]))
                                                @if (
                                                    !empty(
                                                        $taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                            'stateName'
                                                        ]
                                                    ))
                                                    {{ $taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['stateName'] }}
                                                @else
                                                    " "
                                                @endif
                                            @else
                                            @endif
                                        </p>
                                        <p><strong>geocodelvl:</strong>
                                            @if (isset(
                                                    $taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                        'geocodelvl'
                                                    ]))
                                                @if (
                                                    !empty(
                                                        $taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                            'geocodelvl'
                                                        ]
                                                    ))
                                                    {{ $taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['geocodelvl'] }}
                                                @else
                                                    " "
                                                @endif
                                            @else
                                            @endif
                                        </p>
                                        <p><strong>floorNumber:</strong>
                                            @if (isset(
                                                    $taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                        'floorNumber'
                                                    ]))
                                                @if (
                                                    !empty(
                                                        $taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                            'floorNumber'
                                                        ]
                                                    ))
                                                    {{ $taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['floorNumber'] }}
                                                @else
                                                    " "
                                                @endif
                                            @else
                                            @endif
                                        </p>
                                        <p><strong>longitude:</strong>
                                            @if (isset(
                                                    $taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                        'longitude'
                                                    ]))
                                                @if (
                                                    !empty(
                                                        $taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                            'longitude'
                                                        ]
                                                    ))
                                                    {{ $taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['longitude'] }}
                                                @else
                                                    " "
                                                @endif
                                            @else
                                            @endif
                                        </p>
                                        <p><strong>natureOfPrincipalPlaceOfBusiness:</strong>
                                            @if (isset($taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['natureOfPrincipalPlaceOfBusiness']))
                                                @if (!empty($taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['natureOfPrincipalPlaceOfBusiness']))
                                                    {{ $taxpayar_gstin['taxpayer_gstin']['principalPlaceOfBusinessFields']['natureOfPrincipalPlaceOfBusiness'] }}
                                                @else
                                                    " "
                                                @endif
                                            @else
                                            @endif
                                        </p>
                                    @else
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <!--Response Filed-->
            @if (!empty($taxpayar_gstin_response) && !empty($statusCode) && $statusCode == 200)
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">TAXPAYAR GSTIN Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div>

                                    @if (isset($taxpayar_gstin_response['taxpayer_gstin']['legalNameOfBusiness']))
                                        <p><strong>Business Name:</strong>
                                            {{ $taxpayar_gstin_response['taxpayer_gstin']['legalNameOfBusiness'] }}
                                        </p>
                                    @else
                                    @endif
                                    @if (isset($taxpayar_gstin_response['taxpayer_gstin']['gstIdentificationNumber']))
                                        <p><strong>GSTIN Number:</strong>
                                            {{ $taxpayar_gstin_response['taxpayer_gstin']['gstIdentificationNumber'] }}
                                        </p>
                                    @else
                                    @endif
                                    @if (isset($taxpayar_gstin_response['taxpayer_gstin']['gstnStatus']))
                                        <p><strong>Status:</strong>
                                            {{ $taxpayar_gstin_response['taxpayer_gstin']['gstnStatus'] }}
                                        </p>
                                    @else
                                    @endif
                                    @if (isset($taxpayar_gstin_response['taxpayer_gstin']['tradeName']))
                                        <p><strong>Trade Name:</strong>
                                            {{ $taxpayar_gstin_response['taxpayer_gstin']['tradeName'] }}
                                        </p>
                                    @else
                                    @endif


                                    @if (isset($taxpayar_gstin_response['taxpayer_gstin']['taxpayerType']))
                                        <p><strong>Taxpayer Type:</strong>
                                            {{ $taxpayar_gstin_response['taxpayer_gstin']['taxpayerType'] }}
                                        </p>
                                    @else
                                    @endif
                                    @if (isset($taxpayar_gstin_response['taxpayer_gstin']['dateOfRegistration']))
                                        <p><strong>Registration Date:</strong>
                                            {{ $taxpayar_gstin_response['taxpayer_gstin']['dateOfRegistration'] }}
                                        </p>
                                    @else
                                    @endif
                                    @if (isset(
                                            $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields'][
                                                'natureOfPrincipalPlaceOfBusiness'
                                            ]))
                                        <p><strong>Nature:</strong>
                                            {{ $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields']['natureOfPrincipalPlaceOfBusiness'] }}
                                        </p>
                                    @else
                                    @endif
                                    @if (isset($taxpayar_gstin_response['taxpayer_gstin']['lastUpdatedDate']))
                                        <p><strong>Last Update:</strong>
                                            {{ $taxpayar_gstin_response['taxpayer_gstin']['lastUpdatedDate'] }}
                                        </p>
                                    @else
                                    @endif
                                    @if (isset($taxpayar_gstin_response['taxpayer_gstin']['constitutionOfBusiness']))
                                        <p><strong>constitutionOfBusiness:</strong>
                                            {{ $taxpayar_gstin_response['taxpayer_gstin']['constitutionOfBusiness'] }}
                                        </p>
                                    @else
                                    @endif
                                    @if (isset($taxpayar_gstin_response['taxpayer_gstin']['natureOfBusinessActivity']))
                                        <p><strong>natureOfBusinessActivity:</strong>
                                            {{ implode(',', $taxpayar_gstin_response['taxpayer_gstin']['natureOfBusinessActivity']) }}
                                        </p>
                                    @else
                                    @endif


                                    @if (isset($taxpayar_gstin_response['taxpayer_gstin']['dateOfCancellation']))
                                        <p><strong>dateOfCancellation:</strong>
                                            @if (!empty($taxpayar_gstin_response['taxpayer_gstin']['dateOfCancellation']))
                                                {{ $taxpayar_gstin_response['taxpayer_gstin']['dateOfCancellation'] }}
                                            @else
                                                " "
                                            @endif
                                        </p>
                                    @else
                                    @endif


                                    @if (isset($taxpayar_gstin_response['taxpayer_gstin']['gstnStatus']))
                                        <p><strong>gstnStatus:</strong>
                                            @if (!empty($taxpayar_gstin_response['taxpayer_gstin']['gstnStatus']))
                                                {{ $taxpayar_gstin_response['taxpayer_gstin']['gstnStatus'] }}
                                            @else
                                                " "
                                            @endif
                                        </p>
                                    @else
                                    @endif


                                    @if (isset($taxpayar_gstin_response['taxpayer_gstin']['centerJurisdictionCode']))
                                        <p><strong>centerJurisdictionCode:</strong>
                                            @if (!empty($taxpayar_gstin_response['taxpayer_gstin']['centerJurisdictionCode']))
                                                {{ $taxpayar_gstin_response['taxpayer_gstin']['centerJurisdictionCode'] }}
                                            @else
                                                " "
                                            @endif
                                        </p>
                                    @else
                                    @endif
                                    @if (isset($taxpayar_gstin_response['taxpayer_gstin']['centerJurisdiction']))
                                        <p><strong>centerJurisdiction:</strong>
                                            @if (!empty($taxpayar_gstin_response['taxpayer_gstin']['centerJurisdiction']))
                                                {{ $taxpayar_gstin_response['taxpayer_gstin']['centerJurisdiction'] }}
                                            @else
                                                " "
                                            @endif
                                        </p>
                                    @else
                                    @endif

                                    @if (isset($taxpayar_gstin_response['taxpayer_gstin']['stateJurisdiction']))
                                        <p><strong>stateJurisdiction:</strong>
                                            @if (!empty($taxpayar_gstin_response['taxpayer_gstin']['stateJurisdiction']))
                                                {{ $taxpayar_gstin_response['taxpayer_gstin']['stateJurisdiction'] }}
                                            @else
                                                " "
                                            @endif
                                        </p>
                                    @else
                                    @endif


                                    @if (isset($taxpayar_gstin_response['taxpayer_gstin']['eInvoiceStatus']))
                                        <p><strong>eInvoiceStatus:</strong>
                                            @if (!empty($taxpayar_gstin_response['taxpayer_gstin']['eInvoiceStatus']))
                                                {{ $taxpayar_gstin_response['taxpayer_gstin']['eInvoiceStatus'] }}
                                            @else
                                                " "
                                            @endif
                                        </p>
                                    @else
                                    @endif

                                    @if (isset($taxpayar_gstin_response['taxpayer_gstin']['additionalPlaceOfBusinessFields']))

                                        <p class="text-center"><strong>AdditionalPlaceOfBusinessFields</strong></p>

                                        @php
                                            $additionalAddressBusinessAddress = $taxpayar_gstin_response['taxpayer_gstin']['additionalPlaceOfBusinessFields'];
                                            $additionalAddress = json_encode($additionalAddressBusinessAddress, true);
                                            $additionalAddressIitem = json_decode($additionalAddress, true);

                                        @endphp
                                        <table class="table table-bordered table-responsive">
                                            <thead>
                                                <tr>
                                                    <th>buildingName</th>
                                                    <th>streetName</th>
                                                    <th>location</th>
                                                    <th>buildingNumber</th>
                                                    <th>districtName</th>
                                                    <th>lattitude</th>
                                                    <th>locality</th>
                                                    <th>pincode</th>
                                                    <th>landMark</th>
                                                    <th>stateName</th>
                                                    <th>geocodelvl</th>
                                                    <th>floorNumber</th>
                                                    <th>longitude</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($additionalAddressIitem as $item)
                                                    <tr>
                                                        <td class="text-center">
                                                            @if (!empty($item['additionalPlaceOfBusinessAddress']['buildingName']))
                                                                {{ $item['additionalPlaceOfBusinessAddress']['buildingName'] }}
                                                            @else
                                                                ""
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if (!empty($item['additionalPlaceOfBusinessAddress']['streetName']))
                                                                {{ $item['additionalPlaceOfBusinessAddress']['streetName'] }}
                                                            @else
                                                                ""
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if (!empty($item['additionalPlaceOfBusinessAddress']['location']))
                                                                {{ $item['additionalPlaceOfBusinessAddress']['location'] }}
                                                            @else
                                                                ""
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if (!empty($item['additionalPlaceOfBusinessAddress']['buildingNumber']))
                                                                {{ $item['additionalPlaceOfBusinessAddress']['buildingNumber'] }}
                                                            @else
                                                                ""
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if (!empty($item['additionalPlaceOfBusinessAddress']['districtName']))
                                                                {{ $item['additionalPlaceOfBusinessAddress']['districtName'] }}
                                                            @else
                                                                ""
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if (!empty($item['additionalPlaceOfBusinessAddress']['lattitude']))
                                                                {{ $item['additionalPlaceOfBusinessAddress']['lattitude'] }}
                                                            @else
                                                                ""
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if (!empty($item['additionalPlaceOfBusinessAddress']['locality']))
                                                                {{ $item['additionalPlaceOfBusinessAddress']['locality'] }}
                                                            @else
                                                                ""
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if (!empty($item['additionalPlaceOfBusinessAddress']['pincode']))
                                                                {{ $item['additionalPlaceOfBusinessAddress']['pincode'] }}
                                                            @else
                                                                ""
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if (!empty($item['additionalPlaceOfBusinessAddress']['landMark']))
                                                                {{ $item['additionalPlaceOfBusinessAddress']['landMark'] }}
                                                            @else
                                                                ""
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if (!empty($item['additionalPlaceOfBusinessAddress']['stateName']))
                                                                {{ $item['additionalPlaceOfBusinessAddress']['stateName'] }}
                                                            @else
                                                                ""
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if (!empty($item['additionalPlaceOfBusinessAddress']['geocodelvl']))
                                                                {{ $item['additionalPlaceOfBusinessAddress']['geocodelvl'] }}
                                                            @else
                                                                ""
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if (!empty($item['additionalPlaceOfBusinessAddress']['floorNumber']))
                                                                {{ $item['additionalPlaceOfBusinessAddress']['floorNumber'] }}
                                                            @else
                                                                ""
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if (!empty($item['additionalPlaceOfBusinessAddress']['longitude']))
                                                                {{ $item['additionalPlaceOfBusinessAddress']['longitude'] }}
                                                            @else
                                                                ""
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        </p>
                                        <p class="text-center"><strong>natureOfAdditionalPlaceOfBusiness</strong>
                                        <ol>
                                            @foreach ($additionalAddressIitem as $item)
                                                <li>{{ $item['natureOfAdditionalPlaceOfBusiness'] }}</li>
                                            @endforeach
                                        </ol>
                                        </p>
                                    @else
                                    @endif
                                    @if (isset(
                                            $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']))

                                        <p class="text-center"><strong>PrincipalPlaceOfBusinessAddress</strong></p>
                                        <p><strong>buildingName:</strong>
                                            @if (isset(
                                                    $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                        'buildingName'
                                                    ]))
                                                @if (
                                                    !empty(
                                                        $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                            'buildingName'
                                                        ]
                                                    ))
                                                    {{ $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['buildingName'] }}
                                                @else
                                                    " "
                                                @endif
                                            @else
                                                ''
                                            @endif
                                        </p>
                                        <p><strong>streetName:</strong>
                                            @if (isset(
                                                    $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                        'streetName'
                                                    ]))
                                                @if (
                                                    !empty(
                                                        $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                            'streetName'
                                                        ]
                                                    ))
                                                    {{ $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['streetName'] }}
                                                @else
                                                    " "
                                                @endif
                                            @else
                                                ''
                                            @endif
                                        </p>
                                        <p><strong>location:</strong>
                                            @if (isset(
                                                    $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                        'location'
                                                    ]))
                                                @if (
                                                    !empty(
                                                        $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                            'location'
                                                        ]
                                                    ))
                                                    {{ $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['location'] }}
                                                @else
                                                    " "
                                                @endif
                                            @else
                                                ''
                                            @endif
                                        </p>
                                        <p><strong>buildingNumber:</strong>
                                            @if (isset(
                                                    $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                        'buildingNumber'
                                                    ]))
                                                @if (
                                                    !empty(
                                                        $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                            'buildingNumber'
                                                        ]
                                                    ))
                                                    {{ $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['buildingName'] }}
                                                @else
                                                    " "
                                                @endif
                                            @else
                                                ''
                                            @endif
                                        </p>
                                        <p><strong>districtName:</strong>
                                            @if (isset(
                                                    $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                        'districtName'
                                                    ]))
                                                @if (
                                                    !empty(
                                                        $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                            'districtName'
                                                        ]
                                                    ))
                                                    {{ $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['districtName'] }}
                                                @else
                                                    " "
                                                @endif
                                            @else
                                                ''
                                            @endif
                                        </p>
                                        <p><strong>lattitude:</strong>
                                            @if (isset(
                                                    $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                        'lattitude'
                                                    ]))
                                                @if (
                                                    !empty(
                                                        $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                            'lattitude'
                                                        ]
                                                    ))
                                                    {{ $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['lattitude'] }}
                                                @else
                                                    " "
                                                @endif
                                            @else
                                                ''
                                            @endif
                                        </p>
                                        <p><strong>districtName:</strong>
                                            @if (isset(
                                                    $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                        'districtName'
                                                    ]))
                                                @if (
                                                    !empty(
                                                        $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                            'districtName'
                                                        ]
                                                    ))
                                                    {{ $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['districtName'] }}
                                                @else
                                                    " "
                                                @endif
                                            @else
                                                ''
                                            @endif
                                        </p>
                                        <p><strong>locality:</strong>
                                            @if (isset(
                                                    $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                        'locality'
                                                    ]))
                                                @if (
                                                    !empty(
                                                        $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                            'locality'
                                                        ]
                                                    ))
                                                    {{ $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['locality'] }}
                                                @else
                                                    " "
                                                @endif
                                            @else
                                                ''
                                            @endif
                                        </p>
                                        <p><strong>pincode:</strong>
                                            @if (isset(
                                                    $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                        'pincode'
                                                    ]))
                                                @if (
                                                    !empty(
                                                        $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                            'pincode'
                                                        ]
                                                    ))
                                                    {{ $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['pincode'] }}
                                                @else
                                                    " "
                                                @endif
                                            @else
                                                ''
                                            @endif
                                        </p>
                                        <p><strong>landMark:</strong>
                                            @if (isset(
                                                    $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                        'landMark'
                                                    ]))
                                                @if (
                                                    !empty(
                                                        $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                            'landMark'
                                                        ]
                                                    ))
                                                    {{ $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['landMark'] }}
                                                @else
                                                    " "
                                                @endif
                                            @else
                                                ''
                                            @endif
                                        </p>

                                        <p><strong>stateName:</strong>
                                            @if (isset(
                                                    $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                        'stateName'
                                                    ]))
                                                @if (
                                                    !empty(
                                                        $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                            'stateName'
                                                        ]
                                                    ))
                                                    {{ $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['stateName'] }}
                                                @else
                                                    " "
                                                @endif
                                            @else
                                                ''
                                            @endif
                                        </p>
                                        <p><strong>geocodelvl:</strong>
                                            @if (isset(
                                                    $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                        'geocodelvl'
                                                    ]))
                                                @if (
                                                    !empty(
                                                        $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                            'geocodelvl'
                                                        ]
                                                    ))
                                                    {{ $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['geocodelvl'] }}
                                                @else
                                                    " "
                                                @endif
                                            @else
                                                ''
                                            @endif
                                        </p>
                                        <p><strong>floorNumber:</strong>
                                            @if (isset(
                                                    $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                        'floorNumber'
                                                    ]))
                                                @if (
                                                    !empty(
                                                        $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                            'floorNumber'
                                                        ]
                                                    ))
                                                    {{ $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['floorNumber'] }}
                                                @else
                                                    " "
                                                @endif
                                            @else
                                                ''
                                            @endif
                                        </p>
                                        <p><strong>longitude:</strong>
                                            @if (isset(
                                                    $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                        'longitude'
                                                    ]))
                                                @if (
                                                    !empty(
                                                        $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress'][
                                                            'longitude'
                                                        ]
                                                    ))
                                                    {{ $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields']['principalPlaceOfBusinessAddress']['longitude'] }}
                                                @else
                                                    " "
                                                @endif
                                            @else
                                                ''
                                            @endif
                                        </p>
                                        <p><strong>natureOfPrincipalPlaceOfBusiness:</strong>
                                            @if (isset(
                                                    $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields'][
                                                        'natureOfPrincipalPlaceOfBusiness'
                                                    ]))
                                                @if (
                                                    !empty(
                                                        $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields']['natureOfPrincipalPlaceOfBusiness']
                                                    ))
                                                    {{ $taxpayar_gstin_response['taxpayer_gstin']['principalPlaceOfBusinessFields']['natureOfPrincipalPlaceOfBusiness'] }}
                                                @else
                                                    " "
                                                @endif
                                            @else
                                                ''
                                            @endif
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
