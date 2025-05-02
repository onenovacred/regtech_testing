@extends('layouts.app')

@section('title', 'RegTech')


@section('content')

    {{-- header image and caption --}}
    @include('home.services.elements.header_img2', [
        'image' => 'images/image-000.jpg',
        // 'image' => 'Images/collection1.jpg',
        // 'caption1' => 'Collect Kart',
        'caption2' => 'RegTech API'
    ])

    @include('home.services.elements.sidebar')

{{-- <div class="">
    <nav class="navbar navbar-light bg-danger">
      <button class="navbar-toggler font-weight-bold border-0" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        Customer Verification API's
      </button>
    </nav>
    <div class="collapse" id="navbarToggleExternalContent">
        <div class="pl-5 pt-2 pb-3 list-unstyled" style="background-color: rgb(6, 6, 59)">
            <li><a class="text-white" href="#customer_verification">Customer Verification</a></li>
            <li><a class="text-white" href="#bank">Bank Account Verification</a></li>
            <li><a class="text-white" href="#e_kyc">E-Kyc</a></li>
            <li><a class="text-white" href="#video_kyc">Video-Kyc</a></li>
            <li><a class="text-white" href="#e_sign">E-sign</a></li>
            <li><a class="text-white" href="#offline_aadhar">Offline Aadhar</a></li>
            <li><a class="text-white" href="#aadhar_masking">Aadhar Masking</a></li>
            <li><a class="text-white" href="#db_fmatch">DB Fmatch</a></li>
            <li><a class="text-white" href="#enach">e-NACH/e-Mandate</a></li>
            <li><a class="text-white" href="#customer_acquisition">Verified Customer Acquisition</a></li>
            <li><a class="text-white" href="#vehicle_verification">Vehicle Verification</a></li>

        </div>
      </div>
  </div> --}}

   <div class="container p-5">

        <div class="row container">

            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4 pb-3">
                <img src="{{asset('images/customer_verification.png')}}" width="100%" height="100%">
            </div>
            <div id="customer_verification" class="col-xs-12 col-sm-12 col-md-7 col-lg-8 text-justify">
                <h3 class="font-weight-bold">Customer Verification</h3>

                <p class="lead">Financial services are always at highest to risk of fraud.
                    RegTech reliable and digitally evolved customer verification services are best tool to prevent fraud.
                    Our Fintech Correspondants are well equipped with skill and technology to detect fraud on the ground.
                </p>

                <ul class="list-unstyled align-items-start lead">
                    <li> <span class="font-weight-bold">&#10003;</span> Original Seen and Verified (OSV) </li>
                    <li> <span class="font-weight-bold">&#10003;</span> Contact Point Verification</li>
                    <li> <span class="font-weight-bold">&#10003;</span> Permanent address visit for skip tracing</li>
                </ul>
            </div>

            {{-- 5 api information --}}

            <div class="col-2" style="width: 100px; height: 100px; padding: 0">
                <img src="{{asset('images/aadhar_thumbnail.png')}}" width="100%" height="100%">
            </div>
            <div class="col-10 text-justify">
                <h5 class="font-weight-bold">Aadhaar Verification</h5>

                <p class="lead">It is an excellent API for paperless KYC purposes in which all the details captured
                    and being verified with details obtained from the UIDAI server.
                    It is based on the specially designed algorithm, capturing real-time detail from the customer's aadhar card.
                </p>

            </div>


            <div class="col-2" style="width: 100px; height: 100px; padding: 0">
                <img src="{{asset('images/pan_thumbnail.png')}}" width="100%" height="100%">
            </div>
            <div class="col-10 text-justify">
                <h5 class="font-weight-bold">Pan Verification</h5>

                <p class="lead">The best feature of this API is instantaneous verification response time as it captures
                    all the details such as PAN number or image within seconds and matches with the details obtained from
                    National Depository Securities Ltd. (NSDL)
                </p>

            </div>


            <div class="col-2" style="width: 100px; height: 100px; padding: 0">
                <img src="{{asset('images/driving_license.png')}}" width="100%" height="100%">
            </div>
            <div class="col-10 text-justify">
                <h5 class="font-weight-bold">Driving License Verification</h5>

                <p class="lead">If there is a need for driving license verification, it is the best for yse by government or
                    insurace companies, which provides an accurate result than physical verification.
                    It captured all the details immediately and matched with factual data obtained from the
                    Ministry of Road Transport & Highways server.
                </p>

            </div>


            <div class="col-2" style="width: 100px; height: 100px; padding: 0">
                <img src="{{asset('images/voter_id.png')}}" width="100%" height="100%">
            </div>
            <div class="col-10 text-justify">
                <h5 class="font-weight-bold">Voter Id Verification</h5>

                <p class="lead">The primary input for verifying voter id is the EPIC number,
                    which works as the input. After collection all the details, real-time verification occurs
                    by checking finding equivalence between authenticated data from the
                    Election Commission of India and user-filled data.
                </p>

            </div>


            <div class="col-2" style="width: 100px; height: 100px; padding: 0">
                <img src="{{asset('images/passport.png')}}" width="100%" height="100%">
            </div>
            <div class="col-10 text-justify">
                <h5 class="font-weight-bold">Passport Verification</h5>

                <p class="lead">Its process is based on the unique algorithm designed as an MRZ algorithm.
                    According to the process, the system generated the MRZ code based on the input and matchded it
                    with the client's data. All the details will be verified based on details from the Passport Seva Kendra portal.
                </p>

            </div>

            {{-- end of 5 api --}}

            <div class="col-sm-12 pt-sm-3">
                <hr>
            </div>

            <div id="bank" class="col-xs-12 col-sm-12 col-md-7 col-lg-8">

                <p>
                    <h3 class="font-weight-bold text-left">Bank Account Verification</h3>
                </p>
                <p class="text-justify">
                    <span class="lead">
                        customer's bank details can be verified with accuracy by using the details such as account number, IFSC code, or cheque image.
                        All the details will be matched with the details obtained from the bank's IMPS network.
                    </span>
                </p>


            </div>
            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
                <img src="{{asset('images/bank.png')}}" width="100%" height="100%">
            </div>

            <div class="col-sm-12">
                <hr>
            </div>

            <div id="e_kyc" class="col-xs-12 col-sm-12 col-md-12 col-lg-7">

                <p>
                    <h3 class="font-weight-bold text-justify">Know the Customer's Authenticity With Our e-KYC SERVICE.</h3>
                </p>
                <p class="text-justify">
                    <span class="lead">SEBI registered banking and financial services companies who wants to perform the transaction for investing in the financial market has to follow a process of
                        "Know your client" details of which can be verified and validated through a KRA - 'KYC Registration Agency'.
                        RegTech API service ensure that "Know your client" information is extracted once Pan Card Number and Date of birst is provided.                    </span>
                </p>


            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5">
                <img src="{{asset('images/kyc-services.jpg')}}" width="100%" height="100%">
            </div>

            <div class="col-lg-6 pt-4 row text-center text-sm-center text-md-left text-lg-left">
                <div class="col-md-3">
                    <img src="{{asset('webicon/newspaper.png')}}">
                </div>
                <div class="col-md-9">
                    <h5 class="font-weight-bold">Reports and Analytics</h5>
                <p class="lead">Point to point analytics for informed decision making and audit-ready reports.</p>
                </div>
            </div>
            <div class="col-lg-6 pt-4 row text-center text-sm-center text-md-left text-lg-left">
                <div class="col-md-3">
                    <img src="{{asset('webicon/ai.png')}}">
                </div>
                <div class="col-md-9">
                    <h5 class="font-weight-bold">Data Science/AI</h5>
                <p class="lead">AI calculations and algorithms for early fraud detection</p>
                </div>
            </div>
            <div class="col-lg-6 pt-4 row text-center text-sm-center text-md-left text-lg-left ">
                <div class="col-md-3">
                    <img src="{{asset('webicon/audit.png')}}">
                </div>
                <div class="col-md-9">
                    <h5 class="font-weight-bold">Audit and Compilance</h5>
                <p class="lead">Processes consistent with government and industry models, and reports prepared for comprehensive audits</p>
                </div>
            </div>
            <div class="col-lg-6 pt-4 row text-center text-sm-center text-md-left text-lg-left">
                <div class="col-md-3">
                    <img src="{{asset('webicon/shield.jpg')}}">
                </div>
                <div class="col-md-9">
                    <h5 class="font-weight-bold">Security</h5>
                <p class="lead">Invulnerable information security and complete lawful and statutory compliance.</p>
                </div>
            </div>

            <div class="col-sm-12 pt-sm-3">
                <hr>
            </div>

            <div id="video_kyc" class="col-xs-12 col-sm-12 col-md-12 col-lg-7">

                <p>
                    <h3 class="font-weight-bold text-justify">Speed up the KYC process With Our Video-KYC SERVICE.</h3>
                </p>
                <p class="text-justify">
                    <strong style="font-size: 125%">RegTech Video KYC</strong>
                    <span class="lead">helps enterprises speed-up customer on-boarding process by automating the document collection and verification processes.
                        RegTech Video KYC includes a live video meeting with a client that builds up their presence during the KYC process, confirming their identity through the RegTech video KYC as per the government ID card and records it with the end goal of review and consistency.
                    </span>
                </p>
                <p class="text-justify lead">
                    The procedure for video KYC can be done anywhere even in the comfort of your own home!
                    All you need is a pc, cell phone, or tablet with a working internet connection Customer onboarding process is extremely fast and reliable.
                    It can eliminate 90% cost over physical verifications process.
                </p>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5">
                <img src="{{asset('images/video-kyc.png')}}" width="100%" height="90%">
                <a class="text-dark" href="#demo" style="color: #cc0000"><h4 class="text-center pt-3 font-weight-bolder" style="color: #cc0000">Schedule a Demo</h4></a>
            </div>

            <div class="col-lg-6 pt-4 row text-center text-sm-center text-md-left text-lg-left">
                <div class="col-md-3">
                    <img src="{{asset('webicon/digital-solution-icon.png')}}">
                </div>
                <div class="col-md-9">
                    <h5 class="font-weight-bold">Digital Solution</h5>
                <p class="lead">KYC can be possible in the comfort of your home</p>
                </div>
            </div>
            <div class="col-lg-6 pt-4 row text-center text-sm-center text-md-left text-lg-left">
                <div class="col-md-3">
                    <img src="{{asset('webicon/Accuracy-icon.png')}}">
                </div>
                <div class="col-md-9">
                    <h5 class="font-weight-bold">Accuracy</h5>
                <p class="lead">Crosscheck from Government issued ID</p>
                </div>
            </div>
            <div class="col-lg-6 pt-4 row text-center text-sm-center text-md-left text-lg-left">
                <div class="col-md-3">
                    <img src="{{asset('webicon/fast-reliable-icon.png')}}">
                </div>
                <div class="col-md-9">
                    <h5 class="font-weight-bold">Fast and Reliable</h5>
                <p class="lead">Swift on boarding process</p>
                </div>
            </div>
            <div class="col-lg-6 pt-4 row text-center text-sm-center text-md-left text-lg-left">
                <div class="col-md-3">
                    <img src="{{asset('webicon/cost-effective-icon.png')}}">
                </div>
                <div class="col-md-9">
                    <h5 class="font-weight-bold">Cost effective</h5>
                <p class="lead">Over physical verification process</p>
                </div>
            </div>


            <div class="col-sm-12 pt-sm-3">
                <hr>
            </div>

            <div id="e_sign" class="col-xs-12 col-sm-12 col-md-12 col-lg-7">

                <p>
                    <h3 class="font-weight-bold text-justify">Get Your KYC Done in Minutes With RegTech e-Sign</h3>
                </p>
                <p class="text-justify">
                    <strong style="font-size: 125%">We provide a e-sign OTP based signature service, authenticating the Aadhar holder via Aadhar based e-KYC service.</strong><br>
                    <span class="lead">Our eSign API has been designed to replace physical paper based signature to sign any document.
                        This helps signatory to sign a digital document using Aadhar or PAN based OTP authentication.
                        Cost effective, secure and easy to integrate.
                    </span>
                </p>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5">
                <img src="{{asset('images/esign.jpg')}}" width="100%" height="100%">
            </div>

            <div class="col-lg-6 pt-4 row text-center text-sm-center text-md-left text-lg-left">
                <div class="col-md-3">
                    <img src="{{asset('webicon/api.png')}}">
                </div>
                <div class="col-md-9">
                    <h5 class="font-weight-bold">API's & SDK's</h5>
                <p class="lead">Consistently integrable APIs and SDKs for realtime results</p>
                </div>
            </div>
            <div class="col-lg-6 pt-4 row text-center text-sm-center text-md-left text-lg-left">
                <div class="col-md-3">
                    <img src="{{asset('webicon/workflow.png')}}">
                </div>
                <div class="col-md-9">
                    <h5 class="font-weight-bold">WorkFlows</h5>
                <p class="lead">A workflow consists of an orchestrated and repeatable pattern of activity, enabled by the systematic organization.</p>
                </div>
            </div>

            <div class="col-lg-6 pt-4 row text-center text-sm-center text-md-left text-lg-left">
                <div class="col-md-3">
                    <img src="{{asset('webicon/digital-solution-icon.png')}}">
                </div>
                <div class="col-md-9">
                    <h5 class="font-weight-bold">Digital Solution</h5>
                <p class="lead">KYC can be possible in the comfort of your home</p>
                </div>
            </div>
            <div class="col-lg-6 pt-4 row text-center text-sm-center text-md-left text-lg-left">
                <div class="col-md-3">
                    <img src="{{asset('webicon/Accuracy-icon.png')}}">
                </div>
                <div class="col-md-9">
                    <h5 class="font-weight-bold">Accuracy</h5>
                <p class="lead">Crosscheck from Government issued ID</p>
                </div>
            </div>

            <div class="col-sm-12 pt-sm-3">
                <hr>
            </div>

            <div id="offline_aadhar" class="col-xs-12 col-sm-12 col-md-8 col-lg-7">

                <p>
                    <h3 class="font-weight-bold text-justify">RegTech Offline Aadhaar KYC for enterprises</h3>
                </p>
                <p class="text-justify lead">
                    KYC Aadhaar is the paperless Aadhaar Offline based KYC arrangement, for enterprise searching for an option for Aadhaar based eKYC and for the individuals who are attempting to automate their client on-boarding and confirmation process utilizing their application or web-based interface.
                </p>
                <p class="text-justify">
                    <strong style="font-size: 125%">How it works</strong> <br>
                    <span class="lead">Client downloads offline Aadhaar from UIDAI and shares it with you which validates and confirms customers identity</span>
                </p>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-5">
                <img src="{{asset('images/offlineaadhar.png')}}" width="100%" height="90%">
                <a class="text-dark" href="#demo"><h4 class="text-center pt-3 font-weight-bolder" style="color: #cc0000">Schedule a Demo</h4></a>
            </div>


            <div class="col-lg-6 pt-4 row text-center text-sm-center text-md-left text-lg-left">
                <div class="col-md-3">
                    <img src="{{asset('webicon/privacy.png')}}">
                </div>
                <div class="col-md-9">
                    <h5 class="font-weight-bold">Privacy</h5>
                <p class="lead">No biometrics required for such verification</p>
                </div>
            </div>
            <div class="col-lg-6 pt-4 row text-center text-sm-center text-md-left text-lg-left">
                <div class="col-md-3">
                    <img src="{{asset('webicon/security.jpg')}}">
                </div>
                <div class="col-md-9">
                    <h5 class="font-weight-bold">Security</h5>
                <p class="lead">It is digitally signed by UIDAI to verify authenticity and detect any tampering</p>
                </div>
            </div>
            <div class="col-lg-6 pt-4 row text-center text-sm-center text-md-left text-lg-left">
                <div class="col-md-3">
                    <img src="{{asset('webicon/inclusion.png')}}">
                </div>
                <div class="col-md-9">
                    <h5 class="font-weight-bold">Inclusion</h5>
                <p class="lead">Aadhaar Paperless Offline e-KYC is voluntary and Aadhaar number holder driven</p>
                </div>
            </div>
            <div class="col-lg-6 pt-4 row text-center text-sm-center text-md-left text-lg-left">
                <div class="col-md-3">
                    <img src="{{asset('webicon/Accuracy-icon.png')}}">
                </div>
                <div class="col-md-9">
                    <h5 class="font-weight-bold">Accuracy</h5>
                <p class="lead">Crosscheck from Government issued ID</p>
                </div>
            </div>


            <div class="col-sm-12 ">
                <hr>
            </div>


            <div id="aadhar_masking" class="col-xs-12 col-sm-12 col-md-12 col-lg-7">

                <p>
                    <h3 class="font-weight-bold text-justify">Aadhar Maasking</h3>
                </p>
                <p class="text-justify">
                    <span class="font-weight-bold" style="font-size: 125%"><span class="text-danger">Reg</span><span class="text-dark">Tech</span></span>
                    <span class="lead">Data Masking API covers the Aadhaar Numbers to make Aadhaar cards usable as Officially Valid Documents (OVDs)</span>
                </p>
                <p class="text-justify lead">
                    It is the best example of data masking API compared to the other running in the market.
                    The Aadhaar masking provides the full security to the UIDAI information
                    printed on the card as it conceals the first 8 digits and reveals only the last four digits,
                    which is allowed by the RBI as OVD.
                </p>
                <p class="text-justify lead">
                    This image can be stored for your KYC records to get consistent with the most recent guidelines.
                </p>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5">
                <img src="{{asset('images/mask-adhar.png')}}" width="100%" height="90%">
                <a class="text-dark" href="#demo"><h4 class="text-center pt-3 font-weight-bolder" style="color: #cc0000">Schedule a Demo</h4></a>
            </div>

            <div class="col-lg-6 pt-4 row text-center text-sm-center text-md-left text-lg-left">
                <div class="col-md-3">
                    <img src="{{asset('webicon/precisely-accurate.png')}}">
                </div>
                <div class="col-md-9 pt-md-3">
                    <h5 class="font-weight-bold">Precisely Accurate</h5>
                </div>
            </div>
            <div class="col-lg-6 pt-4 row text-center text-sm-center text-md-left text-lg-left">
                <div class="col-md-3">
                    <img src="{{asset('webicon/realtime-icon.png')}}">
                </div>
                <div class="col-md-9 pt-md-3">
                    <h5 class="font-weight-bold">Real time</h5>
                </div>
            </div>
            <div class="col-lg-6 pt-4 row text-center text-sm-center text-md-left text-lg-left">
                <div class="col-md-3">
                    <img src="{{asset('webicon/trusted-icon.png')}}">
                </div>
                <div class="col-md-9 pt-md-3">
                    <h5 class="font-weight-bold">Trusted</h5>
                </div>
            </div>
            <div class="col-lg-6 pt-4 row text-center text-sm-center text-md-left text-lg-left">
                <div class="col-md-3">
                    <img src="{{asset('webicon/image-format-icon.png')}}">
                </div>
                <div class="col-md-9 pt-md-3">
                    <h5 class="font-weight-bold">Supports all image formats</h5>
                </div>
            </div>

            <div class="col-sm-12 pt-sm-3">
                <hr>
            </div>

            <div id="db_fmatch" class="col-xs-12 col-sm-12 col-md-12 col-lg-8">

                <p>
                    <h3 class="font-weight-bold text-justify">Face Match</h3>
                </p>
                <p class="text-justify lead">
                    Be assure that two pictures are of a similar individual with the best in class RegTech Face Match algorithm using artificial intelligence and machine learning. It verifies, analyses and identifies faces in real-time.
                </p>
                <p class="text-justify lead">
                    RegTech algorithm excels in every challenging situation including light and angle variability, blur and pixelation, age, and gender.
                </p>
                <p class="text-justify lead">
                    RegTech empowers enterprises who need face match that is accurate in testing situations to give unrivalled degrees of security, ongoing execution, and can be used in any given conditions.
                </p>
                <p class="text-justify lead">
                    RegTech Face match helps in protecting individuals and organisations against frauds and mitigations where an attacker is using video, images, or masks to spoof a system 100% Accuracy Industry-leading performance with challenging angles and lighting conditions
                </p>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                <img class="pt-lg-5" src="{{asset('images/facematch.png')}}" width="100%" height="80%">
                <a class="text-dark" href="#demo"><h4 class="text-center pt-3 font-weight-bolder" style="color: #cc0000">Schedule a Demo</h4></a>
            </div>

            <div class="col-lg-6 pt-4 row text-center text-sm-center text-md-left text-lg-left">
                <div class="col-md-3">
                    <img src="{{asset('webicon/digital-solution-icon.png')}}">
                </div>
                <div class="col-md-9 pt-md-3">
                    <h5 class="font-weight-bold">Well Designed</h5>
                    <p class="lead">Easy to use interface</p>
                </div>
            </div>
            <div class="col-lg-6 pt-4 row text-center text-sm-center text-md-left text-lg-left">
                <div class="col-md-3">
                    <img src="{{asset('webicon/age-estimation-icon.png')}}">
                </div>
                <div class="col-md-9 pt-md-3">
                    <h5 class="font-weight-bold">Age Estimation</h5>
                    <p class="lead">Estimates the age of the user</p>
                </div>
            </div>
            <div class="col-lg-6 pt-4 row text-center text-sm-center text-md-left text-lg-left">
                <div class="col-md-3">
                    <img src="{{asset('webicon/emotions-detection.png')}}">
                </div>
                <div class="col-md-9 pt-md-3">
                    <h5 class="font-weight-bold">Emotions Detection</h5>
                    <p class="lead">Detects through facial expression</p>
                </div>
            </div>
            <div class="col-lg-6 pt-4 row text-center text-sm-center text-md-left text-lg-left">
                <div class="col-md-3">
                    <img src="{{asset('webicon/affordable-icon.png')}}">
                </div>
                <div class="col-md-9 pt-md-3">
                    <h5 class="font-weight-bold">Affordable</h5>
                    <p class="lead">Usage-based pricing</p>
                </div>
            </div>


            <div class="col-sm-12 pt-sm-3">
                <hr>
            </div>

            <div id="enach" class="col-xs-12 col-sm-12 col-md-12 col-lg-7">

                <p>
                    <h3 class="font-weight-bold text-justify">Easily Handle Recurring Payments With NACH Debit</h3>
                </p>
                <p class="text-justify">
                    <strong style="font-size: 125%">Handle your recurring payments and schedule your premium payments easily using our e-Nach Service.</strong><br>
                    <span class="lead">Our simple online process helps customers to keep track of individual premium payments.
                    RegTech is well reputed in providing easier, cheaper, faster and safer paperless transaction between banks and customers.
                    Our Nach platform provides simple dashboards, rest APIs and mobile SDKs for easy management of subscriptions, mandates, payments, and settlements.
                    We help customers to create plans for variable amounts and ad-hoc payments. Our e-Nach and e-Mandates do not involve cheques, cash, and digital wallets.
                    </span>
                </p>


            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5">
                <img src="{{asset('images/enach.jpg')}}" width="100%" height="100%">
            </div>

            <div class="col-lg-6 pt-4 row text-center text-sm-center text-md-left text-lg-left">
                <div class="col-md-3">
                    <img src="{{asset('webicon/api.png')}}">
                </div>
                <div class="col-md-9">
                    <h5 class="font-weight-bold">API's & SDK's</h5>
                <p class="lead">Consistently integrable APIs and SDKs for realtime results</p>
                </div>
            </div>
            <div class="col-lg-6 pt-4 row text-center text-sm-center text-md-left text-lg-left">
                <div class="col-md-3">
                    <img src="{{asset('webicon/workflow.png')}}">
                </div>
                <div class="col-md-9">
                    <h5 class="font-weight-bold">WorkFlows</h5>
                <p class="lead">A workflow consists of an orchestrated and repeatable pattern of activity, enabled by the systematic organization.</p>
                </div>
            </div>
            <div class="col-lg-6 pt-4 row text-center text-sm-center text-md-left text-lg-left ">
                <div class="col-md-3">
                    <img src="{{asset('webicon/audit.png')}}">
                </div>
                <div class="col-md-9">
                    <h5 class="font-weight-bold">Audit and Compilance</h5>
                <p class="lead">Processes consistent with government and industry models, and reports prepared for comprehensive audits</p>
                </div>
            </div>
            <div class="col-lg-6 pt-4 row text-center text-sm-center text-md-left text-lg-left">
                <div class="col-md-3">
                    <img src="{{asset('webicon/shield.jpg')}}">
                </div>
                <div class="col-md-9">
                    <h5 class="font-weight-bold">Security</h5>
                <p class="lead">Invulnerable information security and complete lawful and statutory compliance.</p>
                </div>
            </div>

        </div>


        {{-- General features icons --}}
        <div class="row container justify-content-center text-bold">

            <div class="col-sm-12 pt-sm-3">
                <hr>
            </div>

            <div id="customer_acquisition" class="col-auto my-3 bg-danger" style="box-shadow: 6px -7px 2px -3px  rgb(6, 6, 59); border: 2px solid rgb(6, 6, 59); border-radius: 20px">
                <h3 class="font-weight-bold text-white p-1">Verified Customer Acquisition</h3>
            </div>

            <div class="col-sm-12 mb-4 lead p-2" style="box-shadow: 6px -7px 2px 1px  rgb(6, 6, 59); border: 2px solid rgb(6, 6, 59); border-radius: 20px">
                <h5 class="font-weight-bold text-danger">CIN LLPIN Validation</h5>
                It is used to extract the details such as company name, address, director's details, and the annual return date.
                All the details are verified using the data obtained from the Ministry of Corporate Affairs.
            </div>

            <div class="col-sm-12 mb-4 lead p-2" style="box-shadow: 6px -7px 2px 1px rgb(230, 25, 25); border: 2px solid rgb(230, 25, 25); border-radius: 20px">
                <h5 class="font-weight-bold text-danger">DIN Verfication</h5>
                The director or director's details can be verified using this API based on data
                obtained from the Ministry of Corporate Affairs.
            </div>

            <div class="col-sm-12 mb-4 lead p-2" style="box-shadow: 6px -7px 2px 1px  rgb(6, 6, 59); border: 2px solid rgb(6, 6, 59); border-radius: 20px">
                <h5 class="font-weight-bold text-danger">ITR Verfication</h5>
               A great option to verify the ITR details where PAN number works as the input, and in the form of output,
               it produces details associated with PAN. The details verified using the data obtained from the GST Portal.
            </div>

            <div class="col-sm-12 mb-4 lead p-2" style="box-shadow: 6px -7px 2px 1px rgb(230, 25, 25); border: 2px solid rgb(230, 25, 25); border-radius: 20px">
                <h5 class="font-weight-bold text-danger">GSTIN Verification</h5>
                It is used to verify GST details by capturing the GST certificate image or GSTIN number, which produces the
                company name, address, filling status, and company type.
            </div>

            <div class="col-sm-12 mb-4 lead p-2" style="box-shadow: 6px -7px 2px 1px  rgb(6, 6, 59); border: 2px solid rgb(6, 6, 59); border-radius: 20px">
                <h5 class="font-weight-bold text-danger">Shops and Establishment</h5>
                Here, inputs required are shop establishment id or S&E certificate image.
                All the details are verified by obtaining the data extracted from the portals of various states.
            </div>

            <div id="vehicle_verification" class="col-auto my-3" style="background-color: rgb(6, 6, 59); box-shadow: 6px -7px 2px -3px  rgb(230, 25, 25); border: 2px solid rgb(230, 25, 25); border-radius: 20px">
                <h3 class="font-weight-bold text-white p-1">Vehicle Verification</h3>
            </div>

            <div class="col-sm-12 mb-4 lead p-2" style="box-shadow: 6px -7px 2px 1px  rgb(230, 25, 25); border: 2px solid rgb(230, 25, 25); border-radius: 20px">
                <h5 class="font-weight-bold text-danger">Basic Vehicle RC verification</h5>
                It is used to verify the RC details by matching the details obtained from the Ministry of Road, Transport, and highways.
            </div>

            <div class="col-sm-12 mb-4 lead p-2" style="box-shadow: 6px -7px 2px 1px rgb(6, 6, 59); border: 2px solid rgb(6, 6, 59); border-radius: 20px">
                <h5 class="font-weight-bold text-danger">Advance Vehicle RC Verfication</h5>
                The advanced version of the RC verification in which complete details are
                extracted by only providing RC number, engine number, and chassis number.
            </div>

            <div  class="col-xs-12 col-sm-12 col-md-7 col-lg-7 bg-danger text-white">

                <h3 class="font-weight-bold p-3"><span class="bg-white text-danger p-1" style="border: 1px solid white; border-radius: 20px" >Key Features</span></h3>
                <ul class="list-unstyled font-weight-bold pl-md-1 pl-lg-3">
                    <li> <span class="font-weight-bold">&#10003;</span> Error-proof documentation</li>
                    <li> <span class="font-weight-bold">&#10003;</span> Fraud detection & reporting</li>
                    <li> <span class="font-weight-bold">&#10003;</span> Real-time verification & validation</li>
                    <li> <span class="font-weight-bold">&#10003;</span> Analytics based on AI/Machine Learning</li>
                    <li> <span class="font-weight-bold">&#10003;</span> Geotagging & date-time stamp</li>
                    <li> <span class="font-weight-bold">&#10003;</span> End to end data encryption</li>
                    <li> <span class="font-weight-bold">&#10003;</span> Unique payment collection method</li>
                    <li> <span class="font-weight-bold">&#10003;</span> Impactful Dashboard</li>
                    <li> <span class="font-weight-bold">&#10003;</span> Efficient report creation and data collection</li>
                </ul>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 text-white" style="background-color: rgb(6, 6, 59)">

                <h3 class="font-weight-bold p-3"><span class="bg-white text-danger p-1" style="border: 1px solid white; border-radius: 20px" >Perks</span></h3>
                <ul class="list-unstyled font-weight-bold pl-md-1 pl-lg-3">
                    <li> <span class="font-weight-bold">&#10003;</span> Plug 'N' Play approach</li>
                    <li> <span class="font-weight-bold">&#10003;</span> Fast Customer onboarding</li>
                    <li> <span class="font-weight-bold">&#10003;</span> Cost effective</li>
                    <li> <span class="font-weight-bold">&#10003;</span> Time effective</li>
                    <li> <span class="font-weight-bold">&#10003;</span> Real-time Scheduling</li>
                    <li> <span class="font-weight-bold">&#10003;</span> Scalable</li>
                    <li> <span class="font-weight-bold">&#10003;</span> Compilance with Mandate</li>
                    <li> <span class="font-weight-bold">&#10003;</span> Platform Independent</li>
                </ul>

            </div>

        </div>

   </div>


    {{-- grey strip --}}
    <div class="p-4 text-center" style=" background-color: lightgrey;">

        <h2 class="font-weight-bold">
            Customer Verification Brouchure
        </h2>

        {{-- modal start --}}

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-danger text-sm-center font-weight-bold" data-toggle="modal" data-target="#myModal">
            Download Now
        </button>

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body text-justify lead">

                        <form action="{{ url('/forms/brouchure_req3') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="name">Full Name*</label>
                                <input type="text" class="form-control" name="full_name" id="name">
                                </div>
                            <div class="form-group">
                                <label for="Email">Email ID*</label>
                                <input type="email" class="form-control" name="email_id" id="Email">
                            </div>
                            <div class="form-group">
                                <label for="contact">Contact No.*</label>
                                <input type="tel" class="form-control" name="contact_no" id="contact">
                            </div>
                            <button type="submit" class="btn btn-outline-primary">Submit</button>
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        {{-- modal end --}}

    </div>


    {{-- contact us text and form --}}
    <span id="demo"></span>
    @include('home.services.elements.contactus_form')

@endsection
