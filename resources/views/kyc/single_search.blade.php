@extends('adminlte::page')

@section('title', 'Single Search API')

@section('content_header')
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css" />
    <style type="text/css">
        .bootstrap-select.btn-group .dropdown-menu li a {
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .dropdown-menu>.active>a,
        .dropdown-menu>.active>a:hover,
        .dropdown-menu>.active>a:focus {
            color: #fff;
            text-decoration: none;
            background-color: #428bca;
            outline: 0;
        }

        .dropdown-menu>li>a {
            display: block;
            padding: 3px 20px;
            clear: both;
            font-weight: 400;
            line-height: 1.42857143;
            color: #333;
            white-space: nowrap;
        }

        .multiselect,
        .bs-select-all,
        .bs-deselect-all {
            border: 1px solid #ced4da !important;
        }
    </style>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Search</h3>
                    <a role = "button" class = "btn btn-light float-right" href="{{ route('kyc.single.search.api') }}">
                        Search API
                    </a>
                </div>
                <div class="card-body">
                    <!--Bhunaksha  Error-->
                    @include('kyc.single_api_error.bhunaksh_api_error')
                    <!--Rc Api Error-->
                    @include('kyc.single_api_error.rc_validation_api_error')
                    <!--Voter Validation Api Error-->
                    @include('kyc.single_api_error.voter_validation_api_error')
                    <!--aadhaar validation Api Error-->
                    @include('kyc.single_api_error.aadhar_validation_error')

                    @include('kyc.single_api_error.aadhar_otp_genrate_error')

                    @include('kyc.single_api_error.license_validation_error')
                    @include('kyc.single_api_error.udayamcard_error')
                    @include('kyc.single_api_error.upi_validation_error')
                    @include('kyc.single_api_error.udyamaadhar_error')
                    @include('kyc.single_api_error.pancard_ocr_error')
                    @include('kyc.single_api_error.voterId_ocr_error')
                    @include('kyc.single_api_error.passport_ocr_error')
                    @include('kyc.single_api_error.aadhar_masking_ocr_error')
                    @include('kyc.single_api_error.aadhar_ocr_error')
                    @include('kyc.single_api_error.licence_ocr_error')
                    @include('kyc.single_api_error.verify_address_error')
                    @include('kyc.single_api_error.get_place_api_error')
                    @include('kyc.single_api_error.create_geofence_error')
                    @include('kyc.single_api_error.get_coordinate_error')
                    @include('kyc.single_api_error.auto_complate_error')
                    @include('kyc.single_api_error.udayamv2_error')
                    @include('kyc.single_api_error.searchkyclite_error')
                    @include('kyc.single_api_error.bankstament_error')
                    <!--Error PAN TO GST--->
                    @include('kyc.single_api_error.pantogstdetaile_error')
                    <!---Error PAN TO GST END-->
                    @include('kyc.single_api_error.basicgstinverification_error')
                    @include('kyc.single_api_error.corporate_basic_error')
                    @include('kyc.single_api_error.corpoarate_advance_error')
                    @include('kyc.single_api_error.dedupe_api_error')
                    @include('kyc.single_api_error.equifax_score_api_error')
                    @include('kyc.single_api_error.checkemail_verify_error')
                    @include('kyc.single_api_error.email_verify_error')
                    @include('kyc.single_api_error.telecom_api_error')
                    @include('kyc.single_api_error.gstin_api_error')
                    @include('kyc.single_api_error.bank_verification_ifsc_error')
                    @include('kyc.single_api_error.pancard_verification_error')
                    @include('kyc.single_api_error.pancard_info_error')
                    @include('kyc.single_api_error.pancard_details_error')
                    @include('kyc.single_api_error.passport_varification_error')
                    @include('kyc.single_api_error.bank_analyser_error')
                    @include('kyc.single_api_error.face_match_api_error')
                    @include('kyc.single_api_error.aadhar_uplode_error')
                    @include('kyc.single_api_error.aadharmasking_error')
                    @include('kyc.single_api_error.voter_upload_error')
                    @include('kyc.single_api_error.pancardupload_error')
                    @include('kyc.single_api_error.passport_create_client_error')
                    @include('kyc.single_api_error.passportUpload_error')
                    @include('kyc.single_api_error.passport_verify_error')
                    @include('kyc.single_api_error.corpoarate_cin_error')
                    @include('kyc.single_api_error.corpoarate_din_error')
                    @include('kyc.single_api_error.rc_validation_lite_error')
                    @include('kyc.single_api_error.fast_tag_information_error')
                    @include('kyc.single_api_error.rc_full_validation_error')
                    @include('kyc.single_api_error.bank_statement_error')
                    @include('kyc.single_api_error.bank_validation_error')
                    @include('kyc.single_api_error.license_upload_error')
                    @include('kyc.single_api_error.electricity_error')
                    @include('kyc.single_api_error.shopestablishment_error')
                    @include('kyc.single_api_error.fssai_validation_error')
                    @include('kyc.single_api_error.epfo_details_error')
                    @include('kyc.single_api_error.uan_details_error')
                    @include('kyc.single_api_error.company_search_error')
                    @include('kyc.single_api_error.company_details_error')
                    @include('kyc.single_api_error.search_data_error')
                    @include('kyc.single_api_error.search_lite_data_error')
                    @include('kyc.single_api_error.bypancard_error')
                    @include('kyc.single_api_error.gstin_details_error')
                    @include('kyc.single_api_error.company_product_error')
                    @include('kyc.single_api_error.land_api_error')
                    @include('kyc.single_api_error.community_area_error')
                    @include('kyc.single_api_error.pincode_error')
                    @include('kyc.single_api_error.imagescanner')
                    @include('kyc.single_api_error.face_decation_error')
                    @include('kyc.single_api_error.detection_emotion_error')
                    @include('kyc.single_api_error.aadhar_extract_error')
                    @include('kyc.single_api_error.license_extract_error')
                    @include('kyc.single_api_error.extract_pancard_error')
                    @include('kyc.single_api_error.extract_voterid_error')
                    @include('kyc.single_api_error.facematch_details_error')
                    @include('kyc.single_api_error.statement_reader_error')
                    @include('kyc.single_api_error.bank_statement_analyser_error')
                    @include('kyc.single_api_error.predictppl_error')
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <form role="form" method="post" action="{{ route('kyc.single.search') }}"
                                enctype="multipart/form-data" id="formSubmitted">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for=""><strong>Search Api</strong></label>
                                    </div>
                                    <select name="apies" id="select_apis" class="form-control selectpicker multiselect"
                                        data-live-search="true" data-actions-box="true">
                                        <option value="">Select Api</option>
                                        <option value="RcValidation">RC Validation</option>
                                        <option value="RcValidationTest">RC Validation Test</option>
                                        <option value="RcValidationLite">RC Validation Lite</option>
                                        <option value="RcFullValidation">RC Full Validation</option>
                                        <option value="FastTagInformation">Fast Tag Information</option>
                                        <option value="SearchKyclite">SearchKyclite</option>
                                        <option value="VoterId">VoterID Validation</option>
                                        <option value="AadharCardVerification">Aadhar Validation</option>
                                        <option value="OTPAadharCard">Aadhar OTP Genrate</option>
                                        <option value="DrivingVerification">Driving Verification</option>
                                        <option value="DrivingLicenseUpload">Driving License Upload</option>
                                        <option value="UdyamSearch">Udyam Search</option>
                                        <option value="UdyamSearchv2">Udyam Searchv2</option>
                                        <option value="UdhyogAadhaar">Udhyog Aadhaar</option>
                                        <option value="PancardOcr">Pan Card OCR</option>
                                        <option value="VoterIdOcr">VoterID OCR</option>
                                        <option value="PassportOcr">Passport OCR</option>
                                        <option value="AadharOcr">Aadhar OCR</option>
                                        <option value="AadharMaskOcr">Aadhar OCR Masking</option>
                                        <option value="DrivingLicenseOcr">Driving License OCR</option>
                                        <option value="BhunakshaApi">Bhunaksha</option>
                                        <option value="verifyAddress">VerifyAddress</option>
                                        <option value="getPlace">Get Place</option>
                                        <option value="CreateGeofence">Create Geofence</option>
                                        <option value="GETCoordinate">GET Coordinate </option>
                                        <option value="AutoComplateAddress">Auto Complate</option>
                                        <option value="BankStatement">Bank Statement</option>
                                        <option value="BankValidation">Bank Validation</option>
                                        <option value="Ifsc">Verify IFSC</option>
                                        <option value="BankAnalyser">Bank Statement Analyser</option>
                                        <option value="BankStatements">BankStatement Reader</option>
                                        <option value="PANTOGST">PAN Card GST</option>
                                        <option value="BasicGstin">GSTIN Basic</option>
                                        <option value="Pancard">Pancard</option>
                                        <option value="CorpoarteCin">Cin</option>
                                        <option value="CorpoarteDin">Din</option>
                                        <option value="CinBasic">Cin Basic</option>
                                        <option value="CinAdvanced">Cin Advanced</option>
                                        <option value="dedupe">Dedupe</option>
                                        {{-- <option value="CRIF">CRIF</option> --}}
                                        <option value="EquifaxScroe">Score</option>
                                        <option value="Ecredit">Ecredit</option>
                                        <option value="EmailVerify">Email Verify</option>
                                        <option value="CheckEmailVerify">Check Email Verify</option>
                                        <option value="Ckyc">Ckyc</option>
                                        <option value="GSTIN">GSTIN</option>
                                        <option value="Pancard_Verification">Pan Card Validation</option>
                                        <option value="PANCARDINFO">PAN CARD INFO</option>
                                        <option value="PANCARDDETAILS">PAN DETAILS</option>
                                        <option value="PassportVerification">Passport Verification</option>
                                        <option value="PassportCreateClient">Passport Create Client</option>
                                        <option value="PassportUpload">Passport Upload</option>
                                        <option value="PassportVerify">Passport Verify</option>
                                        <option value="FaceMatch">Face Match</option>
                                        <option value="AadharUpload">Aadhar Upload</option>
                                        <option value="AadharMasking">Aadhar Masking</option>
                                        <option value="VoterUpload">Voter Upload</option>
                                        <option value="PanUpload">Pan Card Upload</option>
                                        <option value="Electricity">Electricity</option>
                                        <option value="ShopestaBlishment">Shop & Establishment</option>
                                        <option value="TelecomApi">Telecom</option>
                                        <option value="UPIValidation">UPI Validation</option>
                                        <option value="FSSAI">FSSAI</option>
                                        <option value="EPFOWithoutOTP">EPFO Without OTP</option>
                                        <option value="UANDetails">UAN Details</option>
                                        <option value="CompanySearch">Company Search</option>
                                        <option value="CompanyDetails">Company Details</option>
                                        <option value="SearchData">Search Data</option>
                                        <option value="SearchLiteData">Search Lite Data</option>
                                        <option value="ByPancard">By Pancard</option>
                                        <option value="GstinDetails">Gstin Details</option>
                                        <option value="CompanyProduct">Company Product</option>
                                        <option value="LandRecord">Land Record</option>
                                        <option value="CommunityArea">Community Area</option>
                                        <option value="Pincode">Pincode</option>
                                        <option value="ImageScanner">Image Scanner</option>
                                        <option value="FaceDetection">Face Detection</option>
                                        <option value="FaceMatch1">Face Match v1</option>
                                        <option value="DetectedEmotion">Detected Emotion</option>
                                        <option value="ExtractAadhar">Extract Aadhar</option>
                                        <option value="ExtractDrivingLicense">Extract Driving License</option>
                                        <option value="ExtractPanCard">Extract Pan Card</option>
                                        <option value="ExtractVoterId">Extract VoterId</option>
                                        <option value="BankAnalyserv1">Bank Statement Analyser v1</option>
                                        <option value="BankStatementReaderv1">Bank Statement Reader v1</option>
                                        <option value="PredictPPLAPI">Predict PPL</option>
                                    </select>
                                </div>
                                <div class="form-group" id="RcValidation" style="display:none;">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="name">RC Number</label>
                                        <input type="text" class="form-control" id="rc_number" name="rc_number"
                                            value="{{ old('rc_number') }}" placeholder="Ex: MH12PQ1234">
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                                <div class="form-group" id="SearchKyclite" style="display:none;">
                                    <label for="name">PAN Number</label>
                                    <input type="text" class="form-control" maxlength="10" minlength="10"
                                        id="panNumber" name="panNumber" value="{{ old('panNumber') }}"
                                        placeholder="Ex: ABCDE1234N">
                                    <div class="form-group">
                                        <label for="name">Date of Birth (DOB)</label>
                                        <input type="text" class="form-control" id="date_of_birth"
                                            name="date_of_birth" value="{{ old('date_of_birth') }}"
                                            placeholder="YYYY-MM-DD" />
                                    </div>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                </div>
                                <div class="form-group" id="VoterID" style="display:none;">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="name">Voter ID Number</label>
                                        <input type="text" class="form-control" id="voter_number" name="voter_number"
                                            value="{{ old('voter_number') }}" placeholder="Ex: NLN1234567">
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                                <div class="form-group" id="aadharCardVerification" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Aadhaar Number</label>
                                        <input type="text" class="form-control" maxlength="12" minlength="12"
                                            id="aadhaar_number" name="aadhaar_number" value="{{ old('aadhaar_number') }}"
                                            placeholder="Ex: 1111 2222 3333">
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                                <div class="form-group" id="OTPAadharCard" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Aadhaar Number</label>
                                        <input type="text" class="form-control" maxlength="12" minlength="12"
                                            id="otp_aadhaar_number" name="otp_aadhaar_number"
                                            value="{{ old('otp_aadhaar_number') }}" placeholder="Ex: 1111 2222 3333">
                                    </div>
                                    <button type="submit" class="btn btn-success">Get OTP</button>
                                    <br>
                                    <a href="{{ url('/kyc/single/search/aadhaar_otp_submit') }}"
                                        class="mt-2 btn btn-success">Click to Submit OTP</a>
                                </div>
                                <div class="form-group" id="drivingVerification" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">License Number</label>
                                        <input type="text" class="form-control" id="license_number"
                                            name="license_number" value="{{ old('license_number') }}"
                                            placeholder="Ex: MH121020152012">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Date of Birth (DOB)</label>
                                        <input type="text" class="form-control" id="dob" name="dob"
                                            value="{{ old('dob') }}" placeholder="DD/MM/YYYY">
                                    </div>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                </div>
                                <div class="form-group" id="udyamSearch" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Udyam Number</label>
                                        <input type="text" class="form-control" maxlength="20" minlength="10"
                                            id="udyam_number" name="udyam_number" value=""
                                            placeholder="Ex: ABCDE1234N">
                                    </div>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                </div>
                                <div class="form-group" id="UdyamSearchv2" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Udyam Number</label>
                                        <input type="text" class="form-control" maxlength="20" minlength="10"
                                            name="udyam_numberv2" value="" placeholder="Ex: ABCDE1234N">
                                    </div>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                </div>
                                <div class="form-group" id="udhyogAadhaar" style="display:none;">
                                    <label for="name">UAN Number</label>
                                    <input type="text" class="form-control" maxlength="20" minlength="10"
                                        id="udyogadhar_number" name="udyogadhar_number"
                                        value="{{ old('udyogadhar_number') }}" placeholder="Ex: ABCDE1234N" />
                                    <button type="submit" class="btn btn-success mt-2">Verify</button>
                                </div>
                                <div class="form-group" id="upi_validation" style="display:none;">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="name">Name<span style="color:red">*</span></label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="" placeholder="Enter Name">
                                        </div>
                                        <div class="form-group">
                                            <label for="name">UPI ID<span style="color:red">*</span></label>
                                            <input type="text" class="form-control" id="upi_id" name="upi_id"
                                                value="" placeholder="Enter upi id">
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Order ID</label>
                                            <input type="text" class="form-control" id="order_id" name="order_id"
                                                value="" placeholder="Enter order id">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                                <div class="form-group" id="pancardOcr" style="display:none;">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="name">Upload Pancard Image</label>
                                            <input type="file" class="form-control" id="panocrfile" name="panocrfile"
                                                value="{{ old('panocrfile') }}" />
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                                <div class="form-group" id="voterIdOcr" style="display:none;">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="name">Upload VoterId Image</label>
                                            <input type="file" class="form-control" id="voteridocrfile"
                                                name="voteridocrfile" value="{{ old('voteridocrfile') }}" />
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                                <div class="form-group" id="passportOcr" style="display:none;">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="name">Upload Passport Image</label>
                                            <input type="file" class="form-control" id="passportocrfile"
                                                name="passportocrfile" value="{{ old('passportocrfile') }}" />
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                                <div class="form-group" id="aadharOcr" style="display:none;">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="name">Upload Aadhar Image</label>
                                            <input type="file" class="form-control" id="aadharocrfile"
                                                name="aadharocrfile" value="{{ old('aadharocrfile') }}" />
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                                <div class="form-group" id="aadharMaskOcr" style="display:none;">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="name">Upload Aadhar Image</label>
                                            <input type="file" class="form-control" id="aadharmaskocrfile"
                                                name="aadharmaskocrfile" value="{{ old('aadharmaskocrfile') }}" />
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                                <div class="form-group" id="drivingLicenseOcr" style="display:none;">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="name">Upload Driving Lincense Image</label>
                                            <input type="file" class="form-control" id="drivingocrfile"
                                                name="drivingocrfile" value="{{ old('drivingocrfile') }}" />
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                                <div class="form-group" id="bhunakshaApi" style="display:none;">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for=""><strong>State</strong></label>
                                        </div>
                                        <select name="states" id="states_select_form"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true">
                                            <option value="">Select State</option>
                                            <option value="bihar">Bihar</option>
                                            <option value="jharkhand">Jharkhand</option>
                                            <option value="up">Uttar Pradesh</option>
                                            <option value="chhattisgarh">Chhattisgarh</option>
                                            <option value="rajasthan">Rajasthan</option>
                                            <option value="lakshadweep">Lakshadweep</option>
                                            <option value="kerala">Kerala</option>
                                            <option value="goa">Goa</option>
                                            <option value="odisha">Odisha</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="bihar_info" style="display:none;">
                                        <label for="name">District</label>
                                        <select name="br_district" id="br_district"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true">
                                            <option>Select District</option>
                                        </select>
                                        <label for="name">Subdiv</label>
                                        <select name="br_subdiv" id="br_subdiv"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true">
                                        </select>
                                        <label for="name">Circle</label>
                                        <select name="br_circle" id="br_circle"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true">

                                        </select>
                                        <label for="name">Mauza</label>
                                        <select name="br_mauza" id="br_mauza"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true">
                                        </select>
                                        <label for="name">SurveyType</label>
                                        <select name="br_surveytype" id="br_surveytype"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true">
                                        </select>
                                        <label for="name">Mapinstance</label>
                                        <select name="br_mapinstance" id="br_mapinstance"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true">
                                        </select>
                                        <label for="name">Sheet Number</label>
                                        <select name="br_sheet_number" id="br_sheet_number"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true">
                                        </select>
                                        <label for="name">Plot Number</label>
                                        <input type="text" class="form-control" name="br_plot_number"
                                            id="br_plot_number" placeholder="Enter Plot Number" value="">
                                    </div>
                                    <div class="form-group" id="jharkhand_info" style="display:none;">
                                        <label for="name">District</label>
                                        <?php
                                        $jharkhand_district = DB::table('jharkhand')->select('District')->groupBy('District')->get();
                                        ?>
                                        <select name="jhar_district" id="jhar_district"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true">
                                            <option value="">Select Distract</option>
                                            @if (isset($jharkhand_district))
                                                @foreach ($jharkhand_district as $district)
                                                    <option value="{{ $district->District }}">{{ $district->District }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <label for="name">Circle</label>
                                        <select name="jhar_circle" id="jhar_circle"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true">
                                        </select>
                                        <label for="name">Halka</label>
                                        <select name="jhar_halka" id="jhar_halka"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true">
                                        </select>
                                        <label for="name">Mauza</label>
                                        <select name="jhar_mauza" id="jhar_mauza"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true">
                                        </select>
                                        <label for="name">Sheet Number</label>
                                        <select name="jhar_sheetno" id="jhar_sheetno"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true">
                                        </select>
                                        <label for="name">Plot Number</label>
                                        <input type="text" class="form-control" name="jhar_ploat_number"
                                            id="jhar_ploat_number" placeholder="Enter plot_number" value="">
                                    </div>
                                    <div class="form-group" id="uttar_pradesh_info" style="display:none;">
                                        <label for="name">District</label>
                                        <select name="up_district" id="up_district"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true">
                                            <option>Select District</option>
                                        </select>
                                        <label for="name">Tehsil</label>
                                        <select name="up_tehsil" id="up_tehsil"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true">
                                        </select>
                                        <label for="name">Village</label>
                                        <select name="up_village" id="up_village"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true">
                                        </select>
                                        <label for="name">Plot Number</label>
                                        <input type="text" class="form-control" name="up_plot_number"
                                            id="up_plot_number" placeholder="Enter plot_number" value="">
                                    </div>
                                    <div class="form-group" id="chhattisgarh_info" style="display:none;">
                                        <label for="name">District</label>
                                        <?php
                                        $chhattisgarh_district = DB::table('chhattisgarh')->select('District')->groupBy('District')->get();
                                        ?>
                                        <select name="chha_distract" id="chha_distract"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true">
                                            <option value="">Select Distract</option>
                                            @if (isset($chhattisgarh_district))
                                                @foreach ($chhattisgarh_district as $district)
                                                    <option value="{{ $district->District }}">{{ $district->District }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <label for="name">Tehsil</label>
                                        <select name="chha_tehsil" id="chha_tehsil"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true">
                                        </select>
                                        <label for="name">RI Circle</label>
                                        <select name="chha_ri_circle" id="chha_ri_circle"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true">
                                        </select>
                                        <label for="name">Village</label>
                                        <select name="chha_village" id="chha_village"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true">
                                        </select>
                                        <label for="name">Plot Number</label>
                                        <input type="text" class="form-control" name="chha_plot_number"
                                            id="chha_plot_number" placeholder="Enter Plot Number" value="">
                                    </div>
                                    <div class="form-group" id="rajasthan_info" style="display:none;">
                                        <label for="name">District</label>
                                        <?php
                                        $rajshthan_district = DB::table('rajasthan')->select('District')->groupBy('District')->get();
                                        ?>
                                        <select name="ra_district" id="ra_district"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true">
                                            <option value="">Select Distract</option>
                                            @if (isset($rajshthan_district))
                                                @foreach ($rajshthan_district as $district)
                                                    <option value="{{ $district->District }}">{{ $district->District }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <label for="name">Tehsil</label>
                                        <select name="ra_tehsil" id="ra_tehsil"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true">
                                        </select>
                                        <label for="name">RI Circle</label>
                                        <select name="ra_ri_circle" id="ra_ri_circle"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true">
                                        </select>
                                        <label for="name">Halkas</label>
                                        <select name="ra_ri_halkas" id="ra_ri_halkas"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true">
                                        </select>
                                        <label for="name">Village</label>
                                        <select name="ra_village" id="ra_village"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true">
                                        </select>
                                        <label for="name">Sheetno</label>
                                        <select name="ra_sheet_number" id="ra_sheet_number"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true">
                                        </select>
                                        <label for="name">Plot Number</label>
                                        <input type="text" class="form-control" name="ra_plot_number"
                                            id="ra_plot_number" placeholder="Enter plot number" value="">
                                    </div>
                                    <div class="form-group" id="lakshadweep_info" style="display:none;">
                                        <label for="name">District</label>
                                        <?php
                                        $lakshadweep_district = DB::table('lakshadweep')->select('District')->groupBy('District')->get();
                                        ?>
                                        <select name="laksh_district" id="laksh_district"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true">
                                            <option value="">Select Distract</option>
                                            @if (isset($lakshadweep_district))
                                                @foreach ($lakshadweep_district as $district)
                                                    <option value="{{ $district->District }}">{{ $district->District }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <label for="name">Taluk</label>
                                        <select name="laksh_taluk" id="laksh_taluk"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true">
                                        </select>
                                        <label for="name">Village</label>
                                        <select name="laksh_village" id="laksh_village"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true">
                                        </select>
                                        <label for="name">Survey</label>
                                        <select name="laksh_survey" id="laksh_survey"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true">
                                        </select>
                                        <label for="name">Plot Number</label>
                                        <input type="text" class="form-control" name="laksh_plot_number"
                                            id="laksh_plot_number" placeholder="Enter plot_number" value="">
                                    </div>
                                    <div class="form-group" id="kerala_info" style="display:none;">
                                        <label for="name">District</label>
                                        <?php
                                        $kerala_district = DB::table('kerala')->select('District')->groupBy('District')->get();
                                        ?>
                                        <select name="ker_district" id="ker_district"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true">
                                            <option value="">Select Distract</option>
                                            @if (isset($kerala_district))
                                                @foreach ($kerala_district as $district)
                                                    <option value="{{ $district->District }}">{{ $district->District }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <label for="name">Taluk</label>
                                        <select name="ker_taluk" id="ker_taluk"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true">
                                        </select>
                                        <label for="name">Village</label>
                                        <select name="ker_village" id="ker_village"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true">
                                        </select>
                                        <label for="name">Block Number</label>
                                        <select name="ker_blockno" id="ker_blockno"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true">
                                        </select>
                                        <label for="name">Survey Number</label>
                                        <select name="ker_survey_number" id="ker_survey_number"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true">
                                        </select>
                                        <label for="name">Sub Division Number</label>
                                        <select name="ker_subdivno" id="ker_subdivno"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true">
                                        </select>
                                    </div>
                                    <div class="form-group" id="goa_info" style="display:none;">
                                        <label for="name">District</label>
                                        <?php
                                        $goa_district = DB::table('goa')->select('District')->groupBy('District')->get();
                                        ?>
                                        <select name="goa_district" id="goa_district"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true">
                                            <option value="">Select Distract</option>
                                            @if (isset($goa_district))
                                                @foreach ($goa_district as $district)
                                                    <option value="{{ $district->District }}">{{ $district->District }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <label for="name">Taluka</label>
                                        <select name="goa_taluka" id="goa_taluka"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true">
                                        </select>
                                        <label for="name">Village</label>
                                        <select name="goa_village" id="goa_village"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true">
                                        </select>
                                        <label for="name">Sheet Number</label>
                                        <select name="goa_sheet_number" id="goa_sheet_number"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true">
                                        </select>
                                        <label for="name">Plot Number</label>
                                        <input type="text" class="form-control" name="goa_plot_number"
                                            id="goa_plot_number" placeholder="Enter plot_number" value="">
                                    </div>
                                    <div class="form-group" id="odisha_info" style="display:none;">
                                        <?php
                                        $odisha_district = DB::table('odisha')->select('District')->groupBy('District')->get();
                                        ?>
                                        <label for="name">District</label>
                                        <select name="odi_district" id="odi_district"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true">
                                            <option value="">Select Distract</option>
                                            @if (isset($odisha_district))
                                                @foreach ($odisha_district as $district)
                                                    <option value="{{ $district->District }}">{{ $district->District }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <label for="name">Tehsil</label>
                                        <select name="odi_tehsil" id="odi_tehsil"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true">
                                        </select>
                                        <label for="name">RI Circle</label>
                                        <select name="odi_ri_circle" id="odi_ri_circle"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true">
                                        </select>
                                        <label for="name">Village</label>
                                        <select name="odi_village" id="odi_village"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true">
                                        </select>
                                        <label for="name">Sheet Number</label>
                                        <select name="odi_sheetnumber" id="odi_sheetnumber"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true">
                                        </select>
                                        <label for="name">Plot Number</label>
                                        <input type="text" class="form-control" name="odi_plot_number"
                                            id="odi_plot_number" placeholder="Enter plot_number" value="">
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                                <div class="form-group" id="verify_address" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Address</label>
                                        <input type="text" class="form-control" id="verify_address"
                                            name="verify_address" placeholder="Enter a address" />
                                    </div>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                </div>
                                <div class="form-group" id="get_place" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Longitude</label>
                                        <input type="text" class="form-control" id="gp_longitude" name="gp_longitude"
                                            placeholder="Enter a Longitude" />
                                        <label for="name">Latitude</label>
                                        <input type="text" class="form-control" id="gp_latitude" name="gp_latitude"
                                            placeholder="Enter a Latitude" />
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                                <div class="form-group" id="create_geofence" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Longitude</label>
                                        <input type="text" class="form-control" id="cregeo_longitude"
                                            name="cregeo_longitude" placeholder="Enter a Longitude" />
                                        <label for="name">Latitude</label>
                                        <input type="text" class="form-control" id="cregeo_latitude"
                                            name="cregeo_latitude" placeholder="Enter a Latitude" />
                                        <label for="name">Radius</label>
                                        <input type="number" class="form-control" id="cregeo_radius"
                                            name="cregeo_radius" placeholder="Enter a radius" min="1" />
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                                <div class="form-group" id="get_coordinate" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Address</label>
                                        <input type="text" class="form-control" id="coordinate_address"
                                            name="coordinate_address" placeholder="Enter a Address" />
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                                <div class="form-group" id="address_autocomplate" style="display:none;">
                                    <label for="name">Text</label>
                                    <input type="text" class="form-control" id="autoaddress_text"
                                        name="autoaddress_text" placeholder="Enter a text" />
                                    <label for="name">Max Result</label>
                                    <input type="number" class="form-control" id="autoaddress_max_result"
                                        name="autoaddress_max_result" placeholder="Enter a max result" min='1' />
                                    <select name="address_show" id="address_show"
                                        class="form-control selectpicker multiselect mt-1" data-live-search="true"
                                        data-actions-box="true">
                                    </select>
                                    <span class="text-danger" id="error_messagess"></span>
                                    <button type="submit" class="btn btn-success mt-1">Submit</button>
                                </div>
                                <div class="form-group" id="bankstatements" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Bank Statement</label>
                                        <input type="file" class="form-control" name="bank_statement">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Bank</label>
                                        <input type="text" class="form-control" name="bank_name" id="bank_name"
                                            placeholder = "SBI" />
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Account Type</label>
                                        <input type="text" class="form-control" name="accounttype" id="accounttype"
                                            placeholder = "SAVING" />
                                    </div>
                                    <button type="submit" class="btn btn-success">Upload</button>
                                </div>
                                <div class="form-group" id="pantogst" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Pan Number</label>
                                        <input type="text" class="form-control" name="pancardNumber"
                                            id="pancardNumber" placeholder = "Enter pan number" />
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                                <div class="form-group" id="basicgstin" style="display:none;">
                                    <div class="form-group">
                                        <label>Gstin Number</label>
                                        <input type="text" class="form-control" id="gstinNumber" name="gstinNumber"
                                            value="{{ old('gstinNumber') }}" placeholder="Ex: 09AABCM1857H2ZTF" />
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                                <div class="form-group" id="pancard" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Pan Number</label>
                                        <input type="text" class="form-control" name="pan_no" id="pan_no"
                                            placeholder = "Enter pan number" />
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                                <div class="form-group" id="cinBasic" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Cin Number.</label>
                                        <input type="text" class="form-control" name="cin_number" id="cin_number"
                                            placeholder = "Enter cin number" />
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                                <div class="form-group" id="cinAdvanced" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Cin Number.</label>
                                        <input type="text" class="form-control" name="cinNumber" id="cinNumber"
                                            placeholder = "Enter cin number" />
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                                <div class="form-group" id="dedupeApi" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Bucket Name</label>
                                        <input type="text" class="form-control" id="bucket_name" name="bucket_name"
                                            placeholder="Enter a bucket name" />
                                        <label for="name">Prefix</label>
                                        <input type="text" class="form-control" id="prefix" name="prefix"
                                            placeholder="Enter a prefix" />
                                        <label for="name">Aws Access Key Id</label>
                                        <input type="text" class="form-control" id="aws_access_key_id"
                                            name="aws_access_key_id" placeholder="Enter a aws_access_key_id" />
                                        <label for="name">Aws Secret Access Key</label>
                                        <input type="text" class="form-control" id="aws_secret_access_key"
                                            name="aws_secret_access_key" placeholder="Enter a aws access key id" />
                                        <label for="name">Region Name</label>
                                        <input type="text" class="form-control" id="region_name" name="region_name"
                                            placeholder="Enter a region name" />
                                        <br />
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                                <div class="form-group" id="scoreApi" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">First Name</label>
                                        <input type="text" class="form-control" name="FirstName" id="sfname"
                                            placeholder="Enter First Name" value="" autofocus>
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Last Name</label>
                                        <input type="text" class="form-control" name="LastName" id="slname"
                                            placeholder="Enter Last Name" value="">

                                    </div>

                                    <div class="form-group">
                                        <label for="name">Phone Number</label>
                                        <input type="text" class="form-control" name="MobileNumber"
                                            id="sphone_number" placeholder="Enter phone number" value="">

                                    </div>

                                    <div class="form-group">
                                        <label for="name">Date of Birth (DOB)</label>
                                        <input type="text" class="form-control" id="sdob" name="sdob"
                                            value="" placeholder="YYYY-MM-DD">
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for=""><strong>Select ID Type</strong></label>
                                        </div>
                                        <select name="id_type[]" id="id_type"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true" multiple>
                                            <option value="" selected>Select ID Type</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="span_no">
                                        <label for="name">PAN Card Number</label>
                                        <input type="text" class="form-control" name="sIdValue" id="span_num"
                                            placeholder="Enter pan card number" value="">
                                    </div>
                                    <button type="submit" id="submitForm"
                                        class="btn btn-success offset-md-4">Submit</button>
                                </div>
                                <div class="form-group" id="creditApi" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">First Name</label>
                                        <input type="text" class="form-control" name="crfname" id = "crfname"
                                            placeholder = "Enter First Name" value="VIJAY" autofocus required>
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Last Name</label>
                                        <input type="text" class="form-control" name="crlname" id = "crlname"
                                            placeholder = "Enter Last Name" value="MEHTA">
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Phone Number</label>
                                        <input type="text" class="form-control" name="crphone_number"
                                            id = "crphone_number" placeholder = "Enter phone number"
                                            value="7830645084">
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Date of Birth (DOB)</label>
                                        <input type="text" class="form-control" id="crdob" name="crdob"
                                            value="{{ old('dob') }}" placeholder="YYYY-MM-DD">
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for=""><strong>Select ID Type</strong></label>
                                        </div>
                                        <select name="id_type[]" id="crid_type"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true" multiple>
                                            <option value="" selected>Select ID Type</option>
                                        </select>
                                    </div>
                                    <div class="row checkAllCheckBox" style="display: none">
                                        <div class="col-md-3">
                                            <label class="ui-check m-a-0">
                                                <input id="checkAllRadius" type="checkbox" class=""><i></i>
                                                Check All
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group" id="aadhar_noc">
                                        <label for="name">Aadhar Card Number</label>
                                        <input type="text" class="form-control" name="craadhar_num"
                                            id = "craadhar_num" placeholder = "Enter aadhar card number"
                                            value = "">
                                    </div>

                                    <div class="form-group" id="pan_noc">
                                        <label for="name">PAN Card Number</label>
                                        <input type="text" class="form-control" name="crpan_num" id = "crpan_num"
                                            placeholder = "Enter pan card number" value = "">
                                    </div>

                                    <div class="form-group" id="driving_licencec">
                                        <label for="name">Driving Licence Number</label>
                                        <input type="text" class="form-control" name="crdriving_num"
                                            id = "crdriving_num" placeholder = "Enter driving licence number"
                                            value = "">
                                    </div>

                                    <div class="form-group" id="voter_idc">
                                        <label for="name">Voter ID</label>
                                        <input type="text" class="form-control" name="crvoter_num"
                                            id = "crvoter_num" placeholder = "Enter voter id" value = "">
                                    </div>

                                    <div class="form-group" id="passportc">
                                        <label for="name">Passport Number</label>
                                        <input type="text" class="form-control" name="crpassport_num"
                                            id = "crpassport_num" placeholder = "Enter passport number"
                                            value = "">
                                    </div>

                                    <button type="submit" id = "crsubmitForm"
                                        class="btn btn-success offset-md-4">Submit</button>
                                </div>
                                <div class="form-group" id="emailVerify" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Email</label>
                                        <input type="text" class="form-control" id="verify_email_id"
                                            name="verify_email_id" placeholder="Enter a email" />
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                                <div class="form-group" id="checkemailVerify" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Email Id</label>
                                        <input type="text" class="form-control" id="check_verify_email_id"
                                            name="check_verify_email_id" placeholder="Enter a email" />
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                                <div class="form-group" id="ckycSearch" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">PAN Number</label>
                                        <input type="text" class="form-control" maxlength="10" minlength="10"
                                            id="pan_number_ckyc" name="pan_number_ckyc"
                                            value="{{ old('pan_number_ckyc') }}" placeholder="Ex: ABCDE1234N" />
                                    </div>
                                    <div class="form-group">
                                        <label for="name">DOB</label>
                                        <input type="text" class="form-control" id="dob_ckyc" name="dob_ckyc"
                                            value="{{ old('dob_ckyc') }}" placeholder="Ex: DD-MM-YYYY">
                                    </div>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                </div>
                                <div class="form-group" id="telecom_api" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Telecom Number</label>
                                        <input type="text" class="form-control" maxlength="10" minlength="10"
                                            id="mobile_number_telcom" name="mobile_number_telcom"
                                            value="{{ old('mobile_number_telcom') }}" placeholder="Ex: ABCDE1234N" />

                                        <br />
                                        <button type="submit" class="btn btn-success">Get OTP</button>
                                        <br>
                                        <a href="{{ url('/kyc/single/search/telecom_submit_otp_search') }}"
                                            class="mt-2 btn btn-success">Submit OTP</a>
                                    </div>

                                </div>
                                <div class="form-group" id="gstinapi" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">CORPORATE GSTIN NUMBER</label>
                                        <input type="text" class="form-control" id="corporate_gstinv2"
                                            name="corporate_gstinv2" value="{{ old('corporate_gstinv2') }}"
                                            placeholder="Ex: ABCDE1234N" />
                                    </div>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                </div>
                                <div class="form-group" id="bankifsc" style="display:none;">
                                    <label for="name">IFSC Code</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="bank_ifsc_code"
                                            id="bank_ifsc_code" value="{{ old('bank_ifsc_code') }}"
                                            placeholder="Enter IFSC">
                                    </div>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                </div>
                                <div class="form-group" id="pancardverification" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">PAN Number</label>
                                        <input type="text" class="form-control" maxlength="10" minlength="10"
                                            id="verify_pan_number" name="verify_pan_number"
                                            value="{{ old('verify_pan_number') }}" placeholder="Ex: ABCDE1234N" />
                                    </div>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                </div>
                                <div class="form-group" id="pancardinfoDetails" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Pan Number</label>
                                        <input type="text" class="form-control" id="paninfo_number"
                                            name="paninfo_number" value="{{ old('paninfo_number') }}"
                                            placeholder="Ex: ABCDE1234N" />
                                    </div>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                </div>
                                <div class="form-group" id="pancardDetail" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Pan Number</label>
                                        <input type="text" class="form-control" id="pandetails_number"
                                            name="pandetails_number" value="{{ old('pandetails_number') }}"
                                            placeholder="Ex: ABCDE1234N" />
                                    </div>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                </div>
                                <div class="form-group" id="passportverification" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">File Number</label>
                                        <input type="text" class="form-control" id="passport_file_number"
                                            name="passport_file_number" value="{{ old('passport_file_number') }}"
                                            placeholder="Ex: PN1067476816213" />

                                    </div>
                                    <div class="form-group">
                                        <label for="name">DOB</label>
                                        <input type="text" class="form-control" id="passport_dob"
                                            name="passport_dob" value="{{ old('passport_dob') }}"
                                            placeholder="YYYY-MM-DD" />
                                    </div>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                </div>
                                <div class="form-group" id="bank_analayser" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Bank Statement</label>
                                        <input type="file" class="form-control" name="bank_statement_file"
                                            id="bank_statement_file" />
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Bank</label>
                                        <input type="text" class="form-control" name="analayser_bank_name"
                                            id = "analayser_bank_name" placeholder = "Enter Bank Name"
                                            value="SBI" />
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Password</label>
                                        <input type="text" class="form-control" name="bank_password"
                                            id = "bank_password" placeholder = "Enter Password" value="Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Account Type</label>
                                        <input type="text" class="form-control" name="bank_account_type"
                                            id = "bank_account_type" placeholder = "Enter Account Type"
                                            value="SAVING" />
                                    </div>
                                    <button type="submit" class="btn btn-success">Upload</button>
                                </div>
                                <div class="form-group" id="fatch_match" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Document Image</label>
                                        <input type="file" class="form-control" id="doc_img" name="doc_img"
                                            value="" />
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Selfie Image</label>
                                        <input type="file" class="form-control" id="selfie" name="selfie"
                                            value="" />
                                    </div>
                                    <button type="submit" class="btn btn-success">Upload</button>
                                </div>
                                <div class="form-group" id="aadhar_upload" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Aadhaar PDF</label>
                                        <input type="file" class="form-control" id="aadhaar_image_pdf"
                                            name="aadhaar_image_pdf" value="" />
                                    </div>
                                    <button type="submit" class="btn btn-success">Upload</button>
                                </div>
                                <div class="form-group" id="aadhar_masking" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Aadhaar Front</label>
                                        <input type="file" class="form-control" id="aadhaar_front_image"
                                            name="aadhaar_front_image" value="" />
                                        <label for="name">Aadhaar Back</label>
                                        <input type="file" class="form-control" id="aadhaar_front_back"
                                            name="aadhaar_front_back" value="" />
                                    </div>
                                    <button type="submit" class="btn btn-success">Upload</button>
                                </div>
                                <div class="form-group" id="voter_upload" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Voter Image</label>
                                        <input type="file" class="form-control" id="voter_image"
                                            name="voter_image" value="" />
                                    </div>
                                    <button type="submit" class="btn btn-success">Upload</button>
                                </div>
                                <div class="form-group" id="pancard_image" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Pan Image</label>
                                        <input type="file" class="form-control" id="pancard_image"
                                            name="pancard_image" value="" />
                                    </div>
                                    <button type="submit" class="btn btn-success">Upload</button>
                                </div>
                                <div class="form-group" id="passport_create_client" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Create Passport Client</label>
                                        <input type="text" class="form-control" id="passport_clientid"
                                            name="passport_clientid" value="" />
                                    </div>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                </div>
                                <div class="form-group" id="passport_upload" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Client Id</label>
                                        <input type="text" class="form-control" id="passport_upload_client_id"
                                            name="passport_upload_client_id" value="" placeholder="client_id" />
                                        <label for="name">Passport File</label>
                                        <input type="file" class="form-control" id="passport_upload_file"
                                            name="passport_upload_file" value="" />
                                    </div>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                </div>
                                <div class="form-group" id="passport_verify" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Client Id</label>
                                        <input type="text" class="form-control" id="passport_verify_client_id"
                                            name="passport_verify_client_id" value="" placeholder="client_id" />
                                    </div>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                </div>
                                <div class="form-group" id="corpoarate_cin" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">CORPORATE CIN Number</label>
                                        <input type="text" class="form-control" id="corpoarate_number_cin"
                                            name="corpoarate_number_cin" value=""
                                            placeholder="Ex:ZABCA1234OPI90876S" />
                                    </div>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                </div>
                                <div class="form-group" id="corpoarate_din" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">CORPORATE DIN NUMBER</label>
                                        <input type="text" class="form-control" id="corpoarate_number_din"
                                            name="corpoarate_number_din" value="" placeholder="EX:ABCDE12345" />
                                    </div>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                </div>
                                <div class="form-group" id="rcvalidation_test" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">RC NUMBER</label>
                                        <input type="text" class="form-control" id="rc_number_test"
                                            name="rc_number_test" value="" placeholder="EX:ABCDE12345" />
                                    </div>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                </div>
                                <div class="form-group" id="rcvalidation_lite" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">RC NUMBER</label>
                                        <input type="text" class="form-control" id="rc_number_lite"
                                            name="rc_number_lite" value="" placeholder="EX:ABCDE12345" />
                                    </div>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                </div>
                                <div class="form-group" id="rc_full_validation" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">RC NUMBER</label>
                                        <input type="text" class="form-control" id="rc_fnumber" name="rc_fnumber"
                                            value="" placeholder="EX:ABCDE12345" />
                                    </div>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                </div>
                                <div class="form-group" id="fast_tag_information" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">RC NUMBER</label>
                                        <input type="text" class="form-control" id="rc_fast_number"
                                            name="rc_fast_number" value="" placeholder="EX:ABCDE12345" />
                                    </div>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                </div>
                                <div class="form-group" id="bank2_statement" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Bank statement</label>
                                        <input type="file" class="form-control" id="bankstatement_file"
                                            name="bankstatement_file" value="" />
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Bank Name</label>
                                        <input type="text" class="form-control" id="stbank_name"
                                            name="stbank_name" value="" placeholder="Enter a bank name" />
                                    </div>
                                    <div class="form-group">
                                        <label for="name">AccountType</label>
                                        <input type="text" class="form-control" id="staccountType"
                                            name="staccountType" value="" placeholder="Enter account type" />
                                    </div>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                </div>
                                <div class="form-group" id="bank_validation" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Account Number</label>
                                        <input type="text" class="form-control" id="bank_validation_account_number"
                                            name="bank_validation_account_number" value=""
                                            placeholder="Enter a account number" />
                                    </div>
                                    <div class="form-group">
                                        <label for="name">IFSC Code</label>
                                        <input type="text" class="form-control" id="bank_validation_ifsc_number"
                                            name="bank_validation_ifsc_number" value=""
                                            placeholder="Enter IFSC  Code" />
                                    </div>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                </div>
                                <div class="form-group" id="driving_license_upload" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">License Front Image</label>
                                        <input type="file" class="form-control" id="license_front_image"
                                            name="license_front_image" value="" />
                                        @error('license_front_image')
                                            <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">License Back Image</label>
                                        <input type="file" class="form-control" id="license_back_image"
                                            name="license_back_image" value="" />
                                        @error('license_back_image')
                                            <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                </div>
                                <div class="form-group" id="electricity" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Consumer Number with Billing Unit</label>
                                        <input type="text" class="form-control" id="ele_idNumber"
                                            name="ele_idNumber" value=""
                                            placeholder="Consumer Number with Billing Unit" />
                                        @error('ele_idNumber')
                                            <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                </div>
                                <div class="form-group" id="shopestablishment" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Shop establishment Number</label>
                                        <input type="text" class="form-control" id="establ_id_number"
                                            name="establ_id_number" value="" placeholder="Ex:ABCDE78543" />
                                        @error('establ_id_number')
                                            <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                </div>
                                <div class="form-group" id="fssai" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">FSSAI Number</label>
                                        <input type="text" class="form-control" id="fssi_id_number"
                                            name="fssi_id_number" value="" placeholder="Ex:22819015001312" />
                                        @error('fssi_id_number')
                                            <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                </div>
                                <div class="form-group" id="epfo_without_otp" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="employee_name"
                                            name="employee_name" value="" placeholder="Enter employee name" />
                                        @error('employee_name')
                                            <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                        <label for="name">Company Name</label>
                                        <input type="text" class="form-control" id="company_name"
                                            name="company_name" value="" placeholder="Enter company name" />
                                        @error('company_name')
                                            <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                </div>
                                <div class="form-group" id="uan_details" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Mobile Number</label>
                                        <input type="text" class="form-control" id="u_mobile_number"
                                            name="u_mobile_number" value="" placeholder="Enter mobile number" />
                                        @error('u_mobile_number')
                                            <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                </div>
                                <div class="form-group" id="company_search" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Company Name</label>
                                        <input type="text" class="form-control" id="scompany_name"
                                            name="scompany_name" value="" placeholder="Enter Company Name" />
                                        @error('scompany_name')
                                            <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                        <label for="name">Data Count</label>
                                        <input type="text" class="form-control" id="sdata_count"
                                            name="sdata_count" value="" placeholder="e.g 10" />
                                        @error('sdata_count')
                                            <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                </div>
                                <div class="form-group" id="company_details" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Company Code</label>
                                        <input type="text" class="form-control" id="dcompany_code"
                                            name="dcompany_code" value="" placeholder="Enter Company Code" />
                                        @error('dcompany_code')
                                            <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <label for="name">Data Count</label>
                                    <input type="text" class="form-control" id="ddata_code" name="ddata_code"
                                        value="" placeholder="e.g 10" />
                                    @error('ddata_code')
                                        <div style="color: red;">{{ $message }}</div>
                                    @enderror
                                    <button type="submit" class="btn btn-success">Verify</button>
                                </div>
                                <div class="form-group" id="crif_report" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Full Name</label>
                                        <input type="text" class="form-control" id="criffullname"
                                            name="criffullname" placeholder="Ex: XYZ XYZ" />
                                    </div>
                                    <div class="form-group">
                                        <label for="pan">PAN Card</label>
                                        <input type="text" class="form-control" id="crifpan" name="crifpan"
                                            maxlength="10" placeholder="Ex: XYZ XYZ">
                                    </div>
                                    <div class="form-group">
                                        <label for="mno">Mobile Number</label>
                                        <input type="text" class="form-control" id="crifmno" name="crifmno"
                                            value="" placeholder="Ex: 8989345677">
                                    </div>
                                    <div class="form-group">
                                        <label for="dob">DOB</label>
                                        <input type="text" class="form-control" id="crifdob" name="crifdob"
                                            value="" placeholder="Ex: XXXX-XX-XX">
                                    </div>
                                    <label class = "col-form-label" for = "sex">Gender</label>
                                    <div class = "row">
                                        <div class = "form-group px-3">
                                            <input type = "radio" class = "form-check-input" name = "crifgender"
                                                id = "crifgenderm" value = "male">
                                            <label for = "male" class = "form-check-label">
                                                Male
                                            </label>
                                        </div>
                                        <div class = "form-group px-3">
                                            <input type = "radio" class = "form-check-input" name = "crifgender"
                                                id = "crifgenderf" value = "female">
                                            <label class = "form-check-label" for = "female">
                                                Female
                                            </label>
                                        </div>
                                    </div>

                                    <div class = "form-group">
                                        <label for = "zipcode" class = "col-form-label">ZipCode</label>
                                        <input type = "text" class = "form-control" id = "crifzipcode"
                                            name = "crifzipcode" value = "175024">
                                    </div>

                                    <div class = "form-group">
                                        <label for = "addrline1" class = "col-form-label">Address Line 1
                                        </label>
                                        <input type = "text" value = "Address line 1" class = "form-control"
                                            id = "crifaddrline1" name = "crifaddrline1">
                                    </div>

                                    <div class = "form-group">
                                        <label for = "addrline1" class = "col-form-label">Address Line 2
                                        </label>
                                        <input type = "text" value = "Address line 2" class = "form-control"
                                            id = "crifaddrline2" name = "crifaddrline2">
                                    </div>

                                    <div class = "form-group">
                                        <label for = "city" class = "col-form-label">City</label>
                                        <input type = "text" value = "hyderabad" class = "form-control"
                                            id = "crifcity" name = "crifcity">
                                    </div>
                                    <button id="submitFormcrif" type="submit" class="btn btn-success">Verify</button>
                                </div>
                                <div class="form-group" id="search_data" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Pan Number</label>
                                        <input type="text" class="form-control" id="sdata_panNumber"
                                            name="sdata_panNumber" value="" placeholder="Ex:ABCDE1234N" />
                                        @error('sdata_panNumber')
                                            <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <label for="name">Date of Birth (DOB)</label>
                                    <input type="text" class="form-control" id="sdata_dob" name="sdata_dob"
                                        value="" placeholder="YYYY-MM-DD" />
                                    @error('sdata_dob')
                                        <div style="color: red;">{{ $message }}</div>
                                    @enderror
                                    <br />
                                    <button type="submit" class="btn btn-success">Verify</button>
                                </div>
                                <div class="form-group" id="search_lite_data" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Pan Number</label>
                                        <input type="text" class="form-control" id="slitedata_panNumber"
                                            name="slitedata_panNumber" value="" placeholder="Ex:ABCDE1234N" />
                                        @error('slitedata_panNumber')
                                            <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <label for="name">Date of Birth (DOB)</label>
                                    <input type="text" class="form-control" id="slitedata_dob"
                                        name="slitedata_dob" value="" placeholder="YYYY-MM-DD" />
                                    @error('slitedata_dob')
                                        <div style="color: red;">{{ $message }}</div>
                                    @enderror
                                    <br />
                                    <button type="submit" class="btn btn-success">Verify</button>
                                </div>
                                <div class="form-group" id="bypancard_api" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Pan Number</label>
                                        <input type="text" class="form-control" id="by_panNumber"
                                            name="by_panNumber" value="" placeholder="Ex:ABCDE1234N" />
                                        @error('by_panNumber')
                                            <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <br />
                                    <button type="submit" class="btn btn-success">Verify</button>
                                </div>
                                <div class="form-group" id="gstindetails_api" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">GSTIN Number</label>
                                        <input type="text" class="form-control" id="gstin_details_number"
                                            name="gstin_details_number" value=""
                                            placeholder="Enter a gstin number." />
                                        @error('gstin_details_number')
                                            <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <br />
                                    <button type="submit" class="btn btn-success">Verify</button>
                                </div>
                                <div class="form-group" id="company_product_details" style="display:none;">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for=""><strong>Select Company Details</strong></label>
                                        </div>
                                        <select name="company_product_details_id" id="company_product_details_id"
                                            class="form-control selectpicker multiselect" data-live-search="true"
                                            data-actions-box="true" multiple>
                                            <option value="procompany_name">Company Name</option>
                                            <option value="prolicense_no">License No</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="pro_company_name_id">
                                        <label for="name">CompanyName</label>
                                        <input type="text" class="form-control" id="pro_company_name"
                                            name="pro_company_name" value="" placeholder="Enter company number">
                                    </div>
                                    <div class="form-group" id="companypro_license_no_id">
                                        <label for="name">LicenseNo</label>
                                        <input type="text" class="form-control" id="pro_license_no"
                                            name="pro_license_no" value=""
                                            placeholder="Enter company license_no">
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>

                                </div>
                                <div class="form-group" id="land_record_details" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Url</label>
                                        <input type="text" class="form-control" id="lurl" name="lurl"
                                            value="{{ old('lurl') }}"
                                            placeholder="Ex: https://bhunaksha.cg.nic.in/" />
                                        @error('lurl')
                                            <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Original Ploat Number</label>
                                        <input type="text" class="form-control" id="loriginal_ploat_number"
                                            name="loriginal_ploat_number" value="{{ old('loriginal_ploat_number') }}"
                                            placeholder="Ex: 3459" />
                                        @error('loriginal_ploat_number')
                                            <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">GST StateCode</label>
                                        <input type="text" class="form-control" id="lgst_state_code"
                                            name="lgst_state_code" value="{{ old('lgst_state_code') }}"
                                            placeholder="Ex: 22" />
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Levels</label>
                                        <input type="text" class="form-control" id="l_levels" name="l_levels"
                                            value="{{ old('l_levels') }}" placeholder="Ex: 3459" />
                                        @error('l_levels')
                                            <div style="color: red;">{{ $message }}</div>
                                        @enderror

                                    </div>
                                    <div class="form-group">
                                        <label for="name">X-Coordinate</label>
                                        <input type="text" class="form-control" id="lx_coordinate"
                                            name="lx_coordinate" value="{{ old('lx_coordinate') }}"
                                            placeholder="Ex: -1985.1836332116745" />
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Y-Coordinate</label>
                                        <input type="text" class="form-control" id="ly_coordinate"
                                            name="ly_coordinate" value="{{ old('ly_coordinate') }}"
                                            placeholder="Ex: 3625.746517505414" />
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                                <div class="form-group" id="community_area_form" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Latitude</label>
                                        <input type="text" class="form-control" id="comm_latitude"
                                            name="comm_latitude" value="" placeholder="Enter Latitude" />
                                        @error('comm_latitude')
                                            <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Longitude</label>
                                        <input type="text" class="form-control" id="comm_longitude"
                                            name="comm_longitude" value="" placeholder="Enter Longitude" />
                                        @error('comm_longitude')
                                            <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                                <div class="form-group" id="pincode_api_form" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">From Pincode</label>
                                        <input type="text" class="form-control" id="from_pincode"
                                            name="from_pincode" value="" placeholder="Enter pincode" />
                                        @error('from_pincode')
                                            <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">To Pincode</label>
                                        <input type="text" class="form-control" id="to_pincode" name="to_pincode"
                                            value="" placeholder="Enter pincode" />
                                        @error('to_pincode')
                                            <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                                <div class="form-group" id="imagescanner_form" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Upload Image</label>
                                        <input type="file" class="form-control" name="scimage_file" />
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                                <div class="form-group" id="face_dedetection_form" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Upload Image</label>
                                        <input type="file" class="form-control" name="fdimage_file" />
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                                <div class="form-group" id="emotion_dedetection_form" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Upload Image</label>
                                        <input type="file" class="form-control" name="edimage_file" />
                                        @error('edimage_file')
                                            <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                                <div class="form-group" id="extract_aadhar_card" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Upload Image</label>
                                        <input type="file" class="form-control" name="extaadharimage_file" />
                                        @error('extaadharimage_file')
                                            <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                                <div class="form-group" id="extract_driving_license" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Upload Image</label>
                                        <input type="file" class="form-control" name="extdlimage_file" />
                                        @error('extdlimage_file')
                                            <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                                <div class="form-group" id="extract_pancard_card" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Upload Image</label>
                                        <input type="file" class="form-control" name="extpanimage_file" />
                                        @error('extpanimage_file')
                                            <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                                <div class="form-group" id="extract_voter_id" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Upload Image</label>
                                        <input type="file" class="form-control" name="extvoterimage_file" />
                                        @error('extvoterimage_file')
                                            <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                                <div class="form-group" id="facematch_one_form" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Face Image</label>
                                        <input type="file" class="form-control" name="knownimage_file" />
                                        @error('knownimage_file')
                                            <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                        <label for="name">Image</label>
                                        <input type="file" class="form-control" name="faceimage_file" />
                                        @error('faceimage_file')
                                            <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                                <div class="form-group" id="bankanalyser_one_form" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Uplode file</label>
                                        <input type="file" class="form-control" name="ananstatementpdffile" />
                                        @error('ananstatementpdffile')
                                            <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                        <label for="name">Bank Name</label>
                                        <input type="text" class="form-control" name="ananbank_name"
                                            placeholder="Bank Name" />
                                        @error('ananbank_name')
                                            <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                        <label for="name">AccountType</label>
                                        <input type="text" class="form-control" name="ananaccount_type"
                                            placeholder="Account Type" />
                                        <label for="name">Password</label>
                                        <input type="text" class="form-control" name="ananpassword"
                                            placeholder="Enter a password" />
                                    </div>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                </div>
                                <div class="form-group" id="bankstatementreader_one_form" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Uplode file</label>
                                        <input type="file" class="form-control" name="bankstatementpdffile" />
                                        @error('bankstatementpdffile')
                                            <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                        <label for="name">Bank Name</label>
                                        <input type="text" class="form-control" name="statementbank_name"
                                            placeholder="Bank Name" />
                                        @error('statementbank_name')
                                            <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                        <label for="name">AccountType</label>
                                        <input type="text" class="form-control" name="statementaccount_type"
                                            placeholder="Account Type" />
                                        <label for="name">Password</label>
                                        <input type="text" class="form-control" name="statementpassword"
                                            placeholder="Enter a password" />
                                    </div>
                                    <button type="submit" class="btn btn-success">Verify</button>
                                </div>
                                <div class="form-group" id="predictppl_one_form" style="display:none;">
                                    <div class="form-group">
                                        <label for="name">Uplode file</label>
                                        <input type="file" class="form-control" name="predictppl_csv"
                                            id="predictppl_csv" />
                                        @error('predictppl_csv')
                                            <div style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" id="predict_report_downloadExcel"
                                        class="btn btn-success">Verify</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div id="result_form">
                <!--Bhunaksh-->
                @include('kyc.single_api_response.bhunaksha_api')


                <!---Udayam Search -->
                @include('kyc.single_api_response.udyamsearch')
                <!--Udhogaadhar -->
                @include('kyc.single_api_response.udyamaadhar')

                <!--udyamsearchv2-->
                @include('kyc.single_api_response.udyamcardv2')

            </div>
        </div>
    </div>
    @include('kyc.single_api_response.search_lite_data')
    @include('kyc.single_api_response.rc_full_validation')
    @include('kyc.single_api_response.fast_tag_information')
    <!--Aadhar Varifaction--->
    @include('kyc.single_api_response.aadhar_validation')
    <!--OtP Aadhar Card-->
    @include('kyc.single_api_response.otp_genrate')
    <!--Driving Lineces--->
    @include('kyc.single_api_response.license_validation')

    <!--Voter Validation-->
    @include('kyc.single_api_response.voter_validation')
    <!--Rc validation-->
    @include('kyc.single_api_response.rc_validation')
    <!--SearchKyc-->
    @include('kyc.single_api_response.searchkyclite')
    <!--End Searchkyc-->
    <!--Equifax Score Api End-->
    @include('kyc.single_api_response.equifax_score')

    <!--Upi Validation-->
    @include('kyc.single_api_response.upi_validation')
    <!--PanCard OCR Api-->
    @include('kyc.single_api_response.pancard_ocr')
    <!--VoterId OCR Api-->
    @include('kyc.single_api_response.voterid_ocr')
    <!--Passport OCR Api-->
    @include('kyc.single_api_response.passport_ocr')
    <!--Aadhar Mask Card OCR-->
    @include('kyc.single_api_response.aadhar_mask_ocr')
    <!--Aadhar Card OCR -->
    @include('kyc.single_api_response.aadhar_ocr')
    <!--Driving Linces OCR-->
    @include('kyc.single_api_response.driving_license_ocr')
    <!--Address Verify-->
    @include('kyc.single_api_response.address_verify')
    <!-- Create GeoFence-->
    @include('kyc.single_api_response.create_geofence')
    <!--GET Coordiniate-->
    @include('kyc.single_api_response.get_coordinate')
    <!--Auto Complate Api-->
    @include('kyc.single_api_response.auto_complate')
    <!--PANTOGST Start-->
    @include('kyc.single_api_response.pantogst_details')
    <!--PANTOGST END-->
    <!--Basic GSTIN Start-->
    @include('kyc.single_api_response.basic_gstinverification')
    <!--pancard end-->
    @include('kyc.single_api_response.pancard')
    <!--Corporate Basic Cin -->
    @include('kyc.single_api_response.corporate_basic_cin')
    <!--Corporate advanced start-->
    @include('kyc.single_api_response.corporate_advance_cin')
    <!--Corporate advanced end-->
    <!--Dedup Api Start-->
    @include('kyc.single_api_response.dedupe')

    <!--Email verify--->
    @include('kyc.single_api_response.verify_email')
    <!--Check Verify Email--->
    @include('kyc.single_api_response.check_email_verify')
    <!--Ckyc Search Start--->
    @include('kyc.single_api_response.ckycsearch')
    <!--Ckyc Search End--->
    <!--Telecom Start --->
    @include('kyc.single_api_response.telecom')
    <!--Telecom End--->
    <!--Gstin API Start--->
    @include('kyc.single_api_response.gstin')
    <!--Gstin API End--->
    <!--Bank Ifsc Code--->
    @include('kyc.single_api_response.bank_verification_ifsc')
    <!--Bank Ifsc Code-->
    <!--Pancard Verification Start-->
    @include('kyc.single_api_response.pancard_validation')
    <!--Pancard info Start-->
    @include('kyc.single_api_response.pancard_info')
    <!--Pancard details Start-->
    @include('kyc.single_api_response.pancard_details')
    <!--Passport Api Start-->
    @include('kyc.single_api_response.passport_verification')
    <!--Passport Api End -->
    <!--FaceMatch Api start -->
    @include('kyc.single_api_response.face_match')
    <!--Aadhar Upload Api start -->
    @include('kyc.single_api_response.aadhar_upload')
    <!--Aadhar Masking --->
    @include('kyc.single_api_response.aadharmasking')
    <!--Voter Upload --->
    @include('kyc.single_api_response.voter_upload')
    <!--Pancard Upload-->
    @include('kyc.single_api_response.pancardupload')
    <!--Passport Create Client -->
    @include('kyc.single_api_response.passport_create_client')
    <!--Passport Create Client -->
    @include('kyc.single_api_response.passport_upload')
    <!--Passport Verify -->
    @include('kyc.single_api_response.passport_verify')
    <!--Corparate Cin -->
    @include('kyc.single_api_response.corpoarate_cin')
    @include('kyc.single_api_response.corpoarate_din')
    @include('kyc.single_api_response.rc_validationlite')
    @include('kyc.single_api_response.bypancard');
    @include('kyc.single_api_response.gstin_details');
    @include('kyc.single_api_response.bank_validation')
    @include('kyc.single_api_response.licenseupload')
    @include('kyc.single_api_response.electricity')
    @include('kyc.single_api_response.shopestablishment')
    @include('kyc.single_api_response.fssai_validation')
    @include('kyc.single_api_response.epfo_details')
    @include('kyc.single_api_response.uan_details')
    @include('kyc.single_api_response.company_search')
    @include('kyc.single_api_response.company_details')
    @include('kyc.single_api_response.search_data')
    @include('kyc.single_api_response.company_product')
    @include('kyc.single_api_response.land_api')
    @include('kyc.single_api_response.community_area')
    @include('kyc.single_api_response.pincode')
    @include('kyc.single_api_response.imagescanner')
    @include('kyc.single_api_response.face_decation')
    @include('kyc.single_api_response.detection_emotion')
    @include('kyc.single_api_response.aadhar_extract')
    @include('kyc.single_api_response.license_extract')
    @include('kyc.single_api_response.extract_pancard')
    @include('kyc.single_api_response.extract_voterid')
    @include('kyc.single_api_response.facematch_details')
    @include('kyc.single_api_response.predictppl')

@stop
@section('custom_js')
    <script>
        let equifaxScoreIdTypesUrl = '{!! route('other.equifax_score_idtypes') !!}';
        let autoComplateUrl = '{{ url('kyc/autopopulate/search_all') }}';
        let idtypes = '{!! route('idtypes') !!}';
        let sendotpEcredit = "{{ url('/sendotp') }}";
        let EcreditVerifyOtp = "{{ url('/verifyotp') }}";
        let creditToken = "{{ csrf_token() }}";
    </script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
    <script src="{{ asset('search_api_script/change_api_from.js') }}"></script>
    <script src="{{ asset('search_api_script/change_bhunaksha_state_dropdown_api.js') }}"></script>
    <script src="{{ asset('search_api_script/auto_complate_address_api.js') }}"></script>
    <script src="{{ asset('search_api_script/equifax_score_api.js') }}"></script>
    <script src="{{ asset('search_api_script/ecredit_api.js') }}"></script>
    <script src="{{ asset('search_api_script/crif_api.js') }}"></script>
    <script src="{{ asset('search_api_script/company_product_api.js') }}"></script>
@stop
