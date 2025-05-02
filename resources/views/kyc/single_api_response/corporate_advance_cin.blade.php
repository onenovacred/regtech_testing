<div class="col-md-12">
    @if (!empty($corporate_advance['corporate_cin']["data"]) && !empty($corporate_advance['statusCode']) && $corporate_advance['statusCode']==200)
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">CORPORATE CIN Details</h3>
        </div>
        <div class="card-body">
            <div class="row">
                    <div class="col-md-6">
                        <p><strong>cinNumber:</strong>{{ isset($corporate_advance['corporate_cin']["data"]['cin']) ? $corporate_advance['corporate_cin']["data"]['cin'] : 'null' }}
                        </p>
                        <p><strong>numberOfMembers:</strong>{{ isset($corporate_advance['corporate_cin']["data"]['numberOfMembers']) ? $corporate_advance['corporate_cin']["data"]['numberOfMembers'] : 'null' }}
                        </p>
                        <p><strong>subCategory:</strong>{{ isset($corporate_advance['corporate_cin']["data"]['subCategory']) ? $corporate_advance['corporate_cin']["data"]['subCategory'] : 'null' }}
                        </p>
                        <p><strong>classType:</strong>{{ isset($corporate_advance['corporate_cin']["data"]['class']) ? $corporate_advance['corporate_cin']["data"]['class'] : 'null' }}
                        </p>
                        <p><strong>companyType:</strong>{{ isset($corporate_advance['corporate_cin']["data"]['companyType']) ? $corporate_advance['corporate_cin']["data"]['companyType'] : 'null' }}
                        </p>
                        <p><strong>companyName:</strong>{{ isset($corporate_advance['corporate_cin']["data"]['companyName']) ? $corporate_advance['corporate_cin']["data"]['companyName'] : 'null' }}
                        </p>
                        <p><strong>paidUpCapital</strong>:{{ isset($corporate_advance['corporate_cin']["data"]['paidUpCapital']) ? $corporate_advance['corporate_cin']["data"]['paidUpCapital'] : 'null' }}
                        </p>
                        <p><strong>authorisedCapital</strong>:{{ isset($corporate_advance['corporate_cin']["data"]['authorisedCapital']) ? $corporate_advance['corporate_cin']["data"]['authorisedCapital'] : 'null' }}
                        </p>
                        <p><strong>whetherListed</strong>:{{ isset($corporate_advance['corporate_cin']["data"]['whetherListed']) ? $corporate_advance['corporate_cin']["data"]['whetherListed'] : 'null' }}
                        </p>
                        <p><strong>dateOfIncorporation</strong>:{{ isset($corporate_advance['corporate_cin']["data"]['dateOfIncorporation']) ? $corporate_advance['corporate_cin']["data"]['dateOfIncorporation'] : 'null' }}
                        </p>
                        <p><strong>lastAgmDate</strong>:{{ isset($corporate_advance['corporate_cin']["data"]['lastAgmDate']) ? $corporate_advance['corporate_cin']["data"]['lastAgmDate'] : 'null' }}
                        </p>
                        <p><strong>registrationNumber</strong>:{{ isset($corporate_advance['corporate_cin']["data"]['registrationNumber']) ? $corporate_advance['corporate_cin']["data"]['registrationNumber'] : 'null' }}
                        </p>
                        <p><strong>registeredAddress</strong>:{{ isset($corporate_advance['corporate_cin']["data"]['registeredAddress']) ? $corporate_advance['corporate_cin']["data"]['registeredAddress'] : 'null' }}
                        </p>
                        <p><strong>activeCompliance</strong>:{{ isset($corporate_advance['corporate_cin']["data"]['activeCompliance']) ? $corporate_advance['corporate_cin']["data"]['activeCompliance'] : 'null' }}
                        </p>
                     </div>
                     <div class="col-md-6">
                        <p><strong>suspendedAtStockExchange</strong>:{{ isset($corporate_advance['corporate_cin']["data"]['suspendedAtStockExchange']) ? $corporate_advance['corporate_cin']["data"]['suspendedAtStockExchange'] : 'null' }}
                        </p>
                        <p><strong>balanceSheetDate</strong>:{{ isset($corporate_advance['corporate_cin']["data"]['balanceSheetDate']) ? $corporate_advance['corporate_cin']["data"]['balanceSheetDate'] : 'null' }}
                        </p>
                        <p><strong>category</strong>:{{ isset($corporate_advance['corporate_cin']["data"]['category']) ? $corporate_advance['corporate_cin']["data"]['category'] : 'null' }}
                        </p>
                        <p><strong>status</strong>:{{ isset($corporate_advance['corporate_cin']["data"]['status']) ? $corporate_advance['corporate_cin']["data"]['status'] : 'null' }}
                        </p>
                        <p><strong>rocOffice</strong>:{{ isset($corporate_advance['corporate_cin']["data"]['rocOffice']) ? $corporate_advance['corporate_cin']["data"]['rocOffice'] : 'null' }}
                        </p>
                        <p><strong>countryOfIncorporation</strong>:{{ isset($corporate_advance['corporate_cin']["data"]['countryOfIncorporation']) ? $corporate_advance['corporate_cin']["data"]['countryOfIncorporation'] : 'null' }}
                        </p>
                        <p><strong>descriptionOfMainDivision</strong>:{{ isset($corporate_advance['corporate_cin']["data"]['descriptionOfMainDivision']) ? $corporate_advance['corporate_cin']["data"]['descriptionOfMainDivision'] : 'null' }}
                        </p>
                        <p><strong>addressOtherThanRegisteredOffice</strong>:{{ isset($corporate_advance['corporate_cin']["data"]['addressOtherThanRegisteredOffice']) ? $corporate_advance['corporate_cin']["data"]['addressOtherThanRegisteredOffice'] : 'null' }}
                        </p>
                        <p><strong>emailId</strong>:{{ isset($corporate_advance['corporate_cin']["data"]['emailId']) ? $corporate_advance['corporate_cin']["data"]['emailId'] : 'null' }}
                        </p>
                        <p><strong>natureOfBusiness</strong>:{{ isset($corporate_advance['corporate_cin']["data"]['natureOfBusiness']) ? $corporate_advance['corporate_cin']["data"]['natureOfBusiness'] : 'null' }}
                        </p>
                        <p><strong>noOfDirectors</strong>:{{ isset($corporate_advance['corporate_cin']["data"]['noOfDirectors']) ? $corporate_advance['corporate_cin']["data"]['noOfDirectors'] : 'null' }}
                        </p>
                        <p><strong>statusForEfiling</strong>:{{ isset($corporate_advance['corporate_cin']["data"]['statusForEfiling']) ? $corporate_advance['corporate_cin']["data"]['statusForEfiling'] : 'null' }}
                        </p>
                        <p><strong>statusUnderCirp</strong>:{{ isset($corporate_advance['corporate_cin']["data"]['statusUnderCirp']) ? $corporate_advance['corporate_cin']["data"]['statusUnderCirp'] : 'null' }}
                        </p>
                        <p><strong>pan</strong>:{{ isset($corporate_advance['corporate_cin']["data"]['pan']) ? $corporate_advance['corporate_cin']["data"]['pan'] : 'null' }}
                        </p>

                  </div>
              
                 @if(isset($corporate_advance['corporate_cin']["data"]['splitAddress']))
                      <div class="row">
                         <div class="col-md-12">
                            <h3 class="text-center">Company SplitAddress</h3>
                            <hr/>
                         </div>
                     <div class="col-md-6">
                        <p><strong>District</strong>:{{ isset($corporate_advance['corporate_cin']["data"]['splitAddress']['district'][0]) ? $corporate_advance['corporate_cin']["data"]['splitAddress']['district'][0] : 'null' }}
                       </p>
                       <p><strong>State</strong>:{{ isset($corporate_advance['corporate_cin']["data"]['splitAddress']['state'][0][0]) ? $corporate_advance['corporate_cin']["data"]['splitAddress']['state'][0][0] : 'null' }}
                       </p>
                       <p><strong>AddressLine</strong>:{{ isset($corporate_advance['corporate_cin']["data"]['splitAddress']['addressLine']) ? $corporate_advance['corporate_cin']["data"]['splitAddress']['addressLine']: 'null' }}
                       </p>
                     </div>
                     <div class="col-md-6">
                       <p><strong>Pincode</strong>:{{ isset($corporate_advance['corporate_cin']["data"]['splitAddress']['pincode']) ? $corporate_advance['corporate_cin']["data"]['splitAddress']['pincode']: 'null'}}
                       </p>
                       <p><strong>Country</strong>:{{isset($corporate_advance['corporate_cin']["data"]['splitAddress']['country'][2]) ? $corporate_advance['corporate_cin']["data"]['splitAddress']['country'][2] : 'null' }}
                       </p>
                       <p><strong>City</strong>:{{ isset($corporate_advance['corporate_cin']["data"]['splitAddress']['city'][0]) ? $corporate_advance['corporate_cin']["data"]['splitAddress']['city'][0] : 'null' }}
                       </p>
                     </div>
                      </div> 
                          
                 @endif
                 <div class="col-md-12">
                     @if (isset($corporate_advance['corporate_cin']["data"]['directors']))
                        <h3 class="text-center">Directors Details </h3>
                        <hr/>
                          <table class = "table text-center table-bordered table-responsive" cellspacing="0">
                                        <tbody>
                                            <tr class = "company-data">
                                                <th class="text-center">Din</th>
                                                <th class="text-center">Designation</th>
                                                <th class="text-center">DateOfAppointment</th>
                                                <th class="text-center">Address</th>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">WhetherDscRegistered</th>
                                                <th class="text-center">DscExpiryDate</th>
                                                <th class="text-center">PanNumber</th>
                                                <th class="text-center">FatherName</th>
                                                <th class="text-center">DOB</th>
                                                <th class="text-center">Split Address</th>
                                                <th class="text-center">List Of Company</th>
                                                <th class="text-center">DinNumber</th>

                                            </tr>
                                            @foreach ($corporate_advance['corporate_cin']["data"]['directors'] as $director)
                                            <tr class="td-elements">
                                                <td>{{ isset($director['din'])?$director['din']:null}}</td>
                                                <td>{{ isset($director['designation'])?$director['designation']:null}}</td>
                                                <td>{{ isset($director['dateOfAppointment'])?$director['dateOfAppointment']:null}}</td>
                                                <td>{{ isset($director['address'])?$director['address']:null}}</td>
                                                <td>{{ isset($director['name'])?$director['name']:null}}</td>
                                                <td>{{ isset($director['whetherDscRegistered'])?$director['whetherDscRegistered']:null}}</td>
                                                <td>{{ isset($director['dscExpiryDate'])?$director['dscExpiryDate']:null}}</td>
                                                <td>{{ isset($director['pan'])?$director['pan']:null}}</td>
                                                <td>{{ isset($director['fatherName'])?$director['fatherName']:null}}</td>
                                                <td>{{ isset($director['dob'])?$director['dob']:null}}</td>
                                                <td>
                                                       @if(isset($director['splitAddress']))
                                                       <p><strong>District</strong>:{{ isset($director['splitAddress']['district'][0])?$director['splitAddress']['district'][0]:null}}</p>
                                                       <p><strong>State</strong>:{{ isset($director['splitAddress']['state'][0][0])?$director['splitAddress']['state'][0][0]:null}}</p>
                                                       <p><strong>City</strong>:{{ isset($director['splitAddress']['city'][0])?$director['splitAddress']['city'][0]:null}}</p>
                                                       <p><strong>Pincode</strong>:{{ isset($director['splitAddress']['pincode'])?$director['splitAddress']['pincode']:null}}</p>
                                                       <p><strong>Country</strong>:{{ isset($director['splitAddress']['country'][2])?$director['splitAddress']['country'][2]:null}}</p>
                                                       <p><strong>AddressLine</strong>:{{ isset($director['splitAddress']['addressLine'])?$director['splitAddress']['addressLine']:null}}</p>
                                                       @endif
                                                </td>
                                                <td>
                                                      @if(isset($director['otherDirectorships']['listOfCompanies']))
                                                      @foreach ($director['otherDirectorships']['listOfCompanies'] as $listofCompany )
                                                      <p><strong>CIN</strong>:{{isset($listofCompany['cin'])?$listofCompany['cin']:'null'}}</p>
                                                      <p><strong>CompanyName</strong>:{{isset($listofCompany['companyName'])?$listofCompany['companyName']:'null'}}</p>
                                                      <p><strong>BeginDate</strong>:{{isset($listofCompany['beginDate'])?$listofCompany['beginDate']:'null'}}</p>
                                                      <p><strong>EndDate</strong>:{{ isset($listofCompany['endDate'])?$listofCompany['endDate']:'null'}}</p>  
                                                      @endforeach
                                                     @endif
                                                </td>
                                                <td>{{isset($director['otherDirectorships']['din'])?$director['otherDirectorships']['din']:'null'}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                  </table>
                        @endif  
                </div>
            </div>
        </div>
    </div>
  @endif
   @include('kyc.equifax_single_otp_modal')
</div>