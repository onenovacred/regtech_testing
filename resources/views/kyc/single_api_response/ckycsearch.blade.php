@if (!empty($searchkyc) && $searchkyc['response']['status'] == 'VALID' && $statusCodeCkyc == 200)
<div class="row">
<div class="col-md-6 offset-md-3">
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Ckyc Search Advance Details</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <p><strong>ConstitutionType:</strong>
                        {{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['constitution_type']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['constitution_type'] : 'null' }}
                    </p>
                    <p><strong>AccountType:</strong>
                        {{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['account_type']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['account_type'] : 'null' }}
                    </p>
                    <p><strong>CkycId:</strong>
                        {{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['ckyc_no']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['ckyc_no'] : 'null' }}
                    </p>
                    <p><strong>Prefix:</strong>
                        {{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['prefix']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['prefix'] : 'null' }}
                    </p>
                    <p><strong>First Name:</strong>
                        {{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['firstName']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['firstName'] : 'null' }}
                    </p>
                    <p><strong>Middle Name:</strong>
                        {{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['middleName']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['middleName'] : 'null' }}
                    </p>
                    <p><strong>Last Name:</strong>
                        {{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['lastName']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['lastName'] : 'null' }}
                    </p>
                    <p><strong>Full Name:</strong>
                        {{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['fullName']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['fullName'] : 'null' }}
                    </p>
                    <p><strong>Maiden Prefix:</strong>
                        {{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['maiden_prefix']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['maiden_prefix'] : 'null' }}
                    </p>
                    <p><strong>Maiden FirstName:</strong>
                        {{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['maiden_fname']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['maiden_fname'] : 'null' }}
                    </p>
                    <p><strong>Maiden MiddleName:</strong>
                        {{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['maiden_mname']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['maiden_mname'] : 'null' }}
                    </p>
                    <p><strong>Maiden LastName:</strong>
                        {{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['maiden_lname']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['maiden_lname'] : 'null' }}
                    </p>
                    <p><strong>Maiden FullName:</strong>
                        {{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['maiden_fullname']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['maiden_fullname'] : 'null' }}
                    </p>
                    <p><strong>Father or Spouse Flag:</strong>
                        {{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['father_or_spouse_flag']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['father_or_spouse_flag'] : 'null' }}
                    </p>
                    <p><strong>Father Prefix:</strong>
                        {{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['father_prefix']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['father_prefix'] : 'null' }}
                    </p>
                    <p><strong>Father FirstName:</strong>
                        {{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['father_fname']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['father_fname'] : 'null' }}
                    </p>
                    <p><strong>Father MiddleName:</strong>
                        {{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['father_mname']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['father_mname'] : 'null' }}
                    </p>
                    <p><strong>Father LastName:</strong>
                        {{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['father_lname']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['father_lname'] : 'null' }}
                    </p>
                    <p><strong>Father FullName:</strong>
                        {{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['father_fullname']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['father_fullname'] : 'null' }}
                    </p>
                    <p><strong>Mother Prefix:</strong>
                        {{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['mother_prefix']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['mother_prefix'] : 'null' }}
                    </p>
                    <p><strong>Mother FirstName:</strong>
                        {{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['mother_fname']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['mother_fname'] : 'null' }}
                    </p>
                    <p><strong>Mother MiddleName:</strong>
                        {{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['mother_mname']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['mother_mname'] : 'null' }}
                    </p>
                    <p><strong>Mother LastName:</strong>
                        {{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['mother_lname']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['mother_lname'] : 'null' }}
                    </p>
                    <p><strong>Mother FullName:</strong>
                        {{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['mother_fullname']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['mother_fullname'] : 'null' }}
                    </p>
                    <p><strong>Mobile Number:
                        </strong>{{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['mobNum'])?$searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['mobNum']: 'null' }}
                    </p>
                    <p><strong>Email:
                        </strong>{{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['email']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['email'] : 'null' }}
                    </p>
                    <p><strong>Age:
                    </strong>{{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['age']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['age'] : 'null' }}
                   </p>
                    <p><strong>Gender:
                      </strong>{{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['gender']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['gender'] : 'null' }}
                    </p>
                    <p><strong>DOB:
                    </strong>{{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['dob']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['dob'] : 'null' }}
                    </p>
                     <p><strong>Pan Number:
                        </strong>{{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['pan']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['pan'] : 'null' }}
                     </p>
                   
                       <h4 class="text-center">Corresponding  Address</h4>
                    <p><strong> Address:
                        </strong>{{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['corresLine1']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['corresLine1'] : 'null' }}</br>{{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['corresLine2']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['corresLine2'] : 'null' }}
                    </p></br>{{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['corres_line3']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['corres_line3'] : '' }}
                    <p><strong> City:
                        </strong>{{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['corresCity']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['corresCity'] : 'null' }}
                    </p>
                    <p><strong> Dist:
                        </strong>{{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['corresDist']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['corresDist'] : 'null' }}
                    </p>
                    <p><strong>Pincode:
                        </strong>{{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['corresPin']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['corresPin'] : 'null' }}
                    </p>
                    <p><strong>State:
                        </strong>{{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['corresState']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['corresState'] : 'null' }}
                    </p>
                    <p><strong>Country:
                    </strong>{{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['corresCountry']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['corresCountry'] : 'null' }}
                    </p>
                    <p><strong>POA:
                    </strong>{{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['corresPoa']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['corresPoa'] : 'null' }}
                    </p>
                    <hr/>
                     <h4 class="text-center">Permanent  Address</h4>
                    <p><strong>Address:
                        </strong>{{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['permLine1']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['permLine1'] : 'null' }}</br>
                        {{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['permLine2']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['permLine2'] : 'null' }}<br/>
                        {{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['perm_line3']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['perm_line3'] : '' }}
                      </p>
                    <p><strong>Dist:
                        </strong>{{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['permDist']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['permDist'] : 'null' }}
                    </p>
                    <p><strong>City:
                        </strong>{{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['permCity']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['permCity'] : 'null' }}
                    </p>
                    <p><strong> Pincode:
                        </strong>{{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['permPin']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['permPin'] : 'null' }}
                    </p>
                    <p><strong>State:
                        </strong>{{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['permState']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['permState'] : 'null' }}
                    </p>
                    <p><strong>Country:
                    </strong>{{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['permCountry']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['permCountry'] : 'null' }}
                   </p>
                   <p><strong>POA:
                     </strong>{{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['permPoa']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['permPoa'] : 'null' }}
                    </p>
                    <hr/>
                    <p><strong>Resi StdCode Of Identity:
                    </strong>{{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['resi_std_code']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['resi_std_code'] : 'null' }}
                   </p>
                    <p><strong>Resi Tel Number:
                    </strong>{{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['resi_tel_num']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['resi_tel_num'] : 'null' }}
                    </p>
                    <p><strong>Off Tel Number:
                    </strong>{{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['off_tel_num']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['off_tel_num'] : 'null' }}
                    </p>
                    <p><strong>Off Std Code:
                    </strong>{{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['off_std_code']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['off_std_code'] : 'null' }}
                    </p>
                    <p><strong>Remarks:
                    </strong>{{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['remarks']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['remarks'] : 'null' }}
                    </p>
                    <p><strong>Dec Date:
                    </strong>{{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['dec_date']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['dec_date'] : 'null' }}
                    </p>
                    <p><strong>Dec Place:
                    </strong>{{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['dec_place']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['dec_place'] : 'null' }}
                    </p>
                    <p><strong>Doc Sub:
                    </strong>{{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['doc_sub']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['doc_sub'] : 'null' }}
                    </p>
                    <p><strong>Kyc Date:
                    </strong>{{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['kyc_date']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['kyc_date'] : 'null' }}
                    </p>
                    <p><strong>Mask Kyc Name:
                    </strong>{{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['kyc_name']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['kyc_name'] : 'null' }}
                    </p>
                    <p><strong>Mask Kyc Designation:
                    </strong>{{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['kyc_designation']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['kyc_designation'] : 'null' }}
                    </p>
                    <p><strong>Mask Kyc Branch:
                    </strong>{{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['kyc_branch']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['kyc_branch'] : 'null' }}
                    </p>
                    <p><strong>Mask Kyc EmpCode:
                    </strong>{{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['kyc_empcode']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['kyc_empcode'] : 'null' }}
                    </p>
                    <p><strong>Mask Origin Name:
                    </strong>{{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['org_name']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['org_name'] : 'null' }}
                    </p>
                    <p><strong>Mask Origin Code:
                    </strong>{{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['org_code']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['org_code'] : 'null' }}
                    </p>
                    <p><strong>Number Of Identity:
                        </strong>{{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['numIdentity']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['numIdentity'] : 'null' }}
                    </p>
                    <p><strong>Number Of Related:
                        </strong>{{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['numRelated']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['numRelated'] : 'null' }}
                    </p>
                    <p><strong>Number Of Images:
                        </strong>{{ isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['numImages']) ? $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['numImages'] : 'null' }}
                    </p>
                    @if (isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['identity_details']))
                    <h4 class="text-center">Identity Details</h4>
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">IdentityType</th>
                            <th scope="col">IdentityNumber</th>
                            <th scope="col">IdverStatus</th>
                          </tr>
                          </thead>
                         <tbody>
                            @if(isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['identity_details']['identity']))
                            @foreach ($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['identity_details']['identity'] as $key =>$value )
                              <tr>
                                <td scope="col">{{isset($value['ident_type'])?$value['ident_type']:'null'}}</td>
                                <td scope="col">{{isset($value['ident_num'])?$value['ident_num']:'null'}}</td>
                                <td scope="col">{{isset($value['idver_status'])?$value['idver_status']:'null'}}</td>
                              </tr>  
                            @endforeach
                            @endif
                        </tbody>
                      </table>
                      @endif
                    <hr/>
                    <h4 class="text-center">Image Details</h4>
                    @if (isset(
                            $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['image_details'][
                                'image'
                            ][0]['sequence_no']) &&
                            $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['image_details'][
                                'image'
                            ][0]['sequence_no'] == '1')
                        <p><strong>Photograph:</strong></p>
                        @if(isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['image_details'][
                            'image'][0]['image_type']) && $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['image_details'][
                            'image'][0]['image_type']=="jpg")
                              <img src="data:image/jpeg;base64,{{ $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['image_details']['image'][0]['image_data'] }}"
                              alt="Image" width="500" height="500" />
                        @endif
                        @if(isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['image_details'][
                            'image'][0]['image_type']) && $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['image_details'][
                            'image'][0]['image_type']=="pdf")
                                <a href="#" id="downloadPdfBtn1" class="btn btn-success btn-sm">Download
                                    PDF</a>
                                    <script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                            var downloadPdfBtn = document.getElementById("downloadPdfBtn1");
                                            downloadPdfBtn.addEventListener("click", function(event) {
                                                event.preventDefault();
                                                var base64Pdf="{{ $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['image_details']['image'][0]['image_data'] }}";
                                                var byteCharacters = atob(base64Pdf);
                                                var byteNumbers = new Array(byteCharacters.length);
                                                for (var i = 0; i < byteCharacters.length; i++) {
                                                    byteNumbers[i] = byteCharacters.charCodeAt(i);
                                                }
                                                var byteArray = new Uint8Array(byteNumbers);
                                                var pdfBlob = new Blob([byteArray], {
                                                    type: 'application/pdf'
                                                });
                                                var link = document.createElement('a');
                                                link.href = window.URL.createObjectURL(pdfBlob);
                                                link.download = 'document.pdf';
                                                document.body.appendChild(link);
                                                link.click();
                                                document.body.removeChild(link);
                                            });
                                        });
                                    </script>

                        @endif
                       @endif
                    @if (isset(
                            $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['image_details'][
                                'image'
                            ][1]['sequence_no']) &&
                            $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['image_details'][
                                'image'
                            ][1]['sequence_no'] == '2')
                        </br>
                        <p><strong>Aadhar Card Pdf:</strong></p>
                        @if(isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['image_details'][
                            'image'][1]['image_type']) && $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['image_details'][
                            'image'][1]['image_type']=="jpg")
                              <img src="data:image/jpeg;base64,{{ $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['image_details']['image'][1]['image_data'] }}"
                              alt="Image" width="500" height="500" />
                        @endif
                        @if(isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['image_details'][
                            'image'][1]['image_type']) && $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['image_details'][
                            'image'][1]['image_type']=="pdf")
                                <a href="#" id="downloadPdfBtn2" class="btn btn-success btn-sm">Download
                                    PDF</a>
                                    <script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                            var downloadPdfBtn = document.getElementById("downloadPdfBtn2");
                                            downloadPdfBtn.addEventListener("click", function(event) {
                                                event.preventDefault();
                                                var base64Pdf="{{ $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['image_details']['image'][1]['image_data'] }}";
                                                var byteCharacters = atob(base64Pdf);
                                                var byteNumbers = new Array(byteCharacters.length);
                                                for (var i = 0; i < byteCharacters.length; i++) {
                                                    byteNumbers[i] = byteCharacters.charCodeAt(i);
                                                }
                                                var byteArray = new Uint8Array(byteNumbers);
                                                var pdfBlob = new Blob([byteArray], {
                                                    type: 'application/pdf'
                                                });
                                                var link = document.createElement('a');
                                                link.href = window.URL.createObjectURL(pdfBlob);
                                                link.download = 'document.pdf';
                                                document.body.appendChild(link);
                                                link.click();
                                                document.body.removeChild(link);
                                            });
                                        });
                                    </script>

                        @endif

                    @endif
                    @if (isset(
                            $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['image_details'][
                                'image'
                            ][2]['sequence_no']) &&
                            $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['image_details'][
                                'image'
                            ][2]['sequence_no'] == '3')
                        <p><strong>Aadhar Card/Pan Card:</strong></p>
                        @if(isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['image_details'][
                            'image'][2]['image_type']) && $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['image_details'][
                            'image'][2]['image_type']=="jpg")
                              <img src="data:image/jpeg;base64,{{ $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['image_details']['image'][2]['image_data'] }}"
                              alt="Image" width="500" height="500" />
                        @endif
                        @if(isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['image_details'][
                            'image'][2]['image_type']) && $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['image_details'][
                            'image'][2]['image_type']=="pdf")
                                <a href="#" id="downloadPdfBtn3" class="btn btn-success btn-sm">Download
                                    PDF</a>
                                    <script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                            var downloadPdfBtn = document.getElementById("downloadPdfBtn3");
                                            downloadPdfBtn.addEventListener("click", function(event) {
                                                event.preventDefault();
                                                var base64Pdf="{{ $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['image_details']['image'][2]['image_data'] }}";
                                                var byteCharacters = atob(base64Pdf);
                                                var byteNumbers = new Array(byteCharacters.length);
                                                for (var i = 0; i < byteCharacters.length; i++) {
                                                    byteNumbers[i] = byteCharacters.charCodeAt(i);
                                                }
                                                var byteArray = new Uint8Array(byteNumbers);
                                                var pdfBlob = new Blob([byteArray], {
                                                    type: 'application/pdf'
                                                });
                                                var link = document.createElement('a');
                                                link.href = window.URL.createObjectURL(pdfBlob);
                                                link.download = 'document.pdf';
                                                document.body.appendChild(link);
                                                link.click();
                                                document.body.removeChild(link);
                                            });
                                        });
                                    </script>

                        @endif

                    @endif
                    @if (isset(
                            $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['image_details'][
                                'image'
                            ][3]['sequence_no']) &&
                            $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['image_details'][
                                'image'
                            ][3]['sequence_no'] == '4')
                        <p><strong>Signature</strong> </p>
                        @if(isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['image_details'][
                            'image'][3]['image_type']) && $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['image_details'][
                            'image'][3]['image_type']=="jpg")
                              <img src="data:image/jpeg;base64,{{ $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['image_details']['image'][3]['image_data'] }}"
                              alt="Image" width="500" height="500" />
                        @endif
                        @if(isset($searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['image_details'][
                            'image'][3]['image_type']) && $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['image_details'][
                            'image'][3]['image_type']=="pdf")
                                <a href="#" id="downloadPdfBtn4" class="btn btn-success btn-sm">Download
                                    PDF</a>
                                    <script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                            var downloadPdfBtn = document.getElementById("downloadPdfBtn4");
                                            downloadPdfBtn.addEventListener("click", function(event) {
                                                event.preventDefault();
                                                var base64Pdf="{{ $searchkyc['response']['kycDetails']['personalIdentifiableData']['personalDetails']['image_details']['image'][3]['image_data'] }}";
                                                var byteCharacters = atob(base64Pdf);
                                                var byteNumbers = new Array(byteCharacters.length);
                                                for (var i = 0; i < byteCharacters.length; i++) {
                                                    byteNumbers[i] = byteCharacters.charCodeAt(i);
                                                }
                                                var byteArray = new Uint8Array(byteNumbers);
                                                var pdfBlob = new Blob([byteArray], {
                                                    type: 'application/pdf'
                                                });
                                                var link = document.createElement('a');
                                                link.href = window.URL.createObjectURL(pdfBlob);
                                                link.download = 'document.pdf';
                                                document.body.appendChild(link);
                                                link.click();
                                                document.body.removeChild(link);
                                            });
                                        });
                                    </script>

                        @endif

                      
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
@endif