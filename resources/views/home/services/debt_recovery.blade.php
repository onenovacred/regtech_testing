@extends('layouts.app')

@section('title', 'Collect Kart')


@section('content')

    {{-- header image and caption --}}
    @include('home.services.elements.header_img2', [
         'image' => 'images/image-000.jpg',
        // 'image' => 'Images/collection1.jpg',
        // 'caption1' => 'Collect Kart',
        'caption2' => 'Debt Recovery'
    ])

   <div class="container p-5">

        <div class="container">
            <p>
                <h3 class="text-center font-weight-bold"><span class="text-dark">Collect Kart Debt Collection- </span> <span class="text-danger text-capitalize">an innovative phygital platform by DocBoyz </span></h3>
            </p>
            <p class="text-justify lead">From a long time, Banking & Financial Services companies needed a solution,
                which will reduce cost of debt collection, improve collection process efficiency, provide better monitoring
                and faster resolution. So DocBoyz took the initiative and based on extensive research, developed this fantastic payment collection platform. <br>
                <span>&emsp; &emsp;</span> The unstructured data, poor management of communication, no centralized monitoring of communication and less logical decisions due unavailability of analytics, etc have been perennial problem of this sector. To overcome all these challenges and make payment collection easier & efficient- DB Collect Kart has been designed.</p>
        </div>

        <div class="pt-sm-3">
            <p>
                <h3 class="text-center font-weight-bold"><span class="text-dark">Collect Kart </span> <span class="text-danger text-capitalize">Sailent Features</span></h3>
            </p>
        </div>

        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-5 mt-sm-n3 mt-lg-n3">
                <img src="{{asset('images/1.jpg')}}" width="100%" height="100%">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-7 lead">
                <ul class="list-unstyled">
                    <li> <span class="font-weight-bold">&#10003;</span> Customization based on the client's process</li>
                    <li> <span class="font-weight-bold">&#10003;</span> Agency onboarding & Real-Time Monitoring</li>
                    <li> <span class="font-weight-bold">&#10003;</span> Cloud-Based Predictive Calling</li>
                    <li> <span class="font-weight-bold">&#10003;</span> Dashboard & Mobile App</li>
                    <li> <span class="font-weight-bold">&#10003;</span> Pan-India FC & Agencies Network</li>
                    <li> <span class="font-weight-bold">&#10003;</span> Seamless Integration with Enterprise Suite/LMS/CRM</li>
                    <li> <span class="font-weight-bold">&#10003;</span> Effective automated settlement</li>
                    <li> <span class="font-weight-bold">&#10003;</span> Automated allocation of cases to the agency representatives</li>
                    <li> <span class="font-weight-bold">&#10003;</span> Automated triggering</li>
                </ul>
            </div>

        </div>

        {{-- collect Kart platform --}}
        <div class="container pt-sm-5">
            <p>
                <h3 class="text-center font-weight-bold"><span class="text-dark">Collect Kart </span> <span class="text-danger text-capitalize">platform</span></h3>
            </p>
            <p class="text-justify lead">A well-versed makes it unique and a pioneer among other payment collection platforms.
                Its process provides all the easiness and gives 360 freedom to worl seamlessly
            </p>
        </div>

        <div class="row text-center" style="font-size: 16px">
            <div class="col-sm-12 col-md-6 col-lg-4 p-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-cloud-arrow-up-fill" viewBox="0 0 16 16">
                    <path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 5.146a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2z"/>
                </svg>
                <h4 class="font-weight-bolder">1. Case Upload</h4>
                <p class="">The client uploads the collection case using the DocBoyz Portal or API</p>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-4 p-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-telephone-forward-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511zm10.761.135a.5.5 0 0 1 .708 0l2.5 2.5a.5.5 0 0 1 0 .708l-2.5 2.5a.5.5 0 0 1-.708-.708L14.293 4H9.5a.5.5 0 0 1 0-1h4.793l-1.647-1.646a.5.5 0 0 1 0-.708z"/>
                </svg>
                <h4 class="font-weight-bolder">2. Predictive Calling</h4>
                <p class="">AI based platform assist call center agent for customer calling, call recording and payment followup.</p>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-4 p-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                    <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                    <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                </svg>
                <h4 class="font-weight-bolder">3. Assign FC</h4>
                <p class="">Call center agent assigns the case to a Fintech Correspondant for a physical visist if customer is not responding or not reacheable.</p>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-4 p-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
                <h4 class="font-weight-bolder">4. Skip tracing</h4>
                <p class="">Our platform research on data using AI and predicate ML about defaulter and trace the defaulter.</p>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-4 p-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-person-square" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                    <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12z"/>
                </svg>
                <h4 class="font-weight-bolder">5. Visit Customer</h4>
                <p class="">Our FC physically visits the customer for payment collection and help thems to understand consequences of payment default.</p>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-4 p-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-cash" viewBox="0 0 16 16">
                    <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
                    <path d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2H3z"/>
                </svg>
                <h4 class="font-weight-bolder">6. Customer pays</h4>
                <p class="">Payment is collected by the FC by CASH/CHEQUE/QR Code/UPI from the customer.</p>
            </div>
        </div>

        <div class="row">
            <div id="multitenant" class="col-xs-12 col-sm-12 col-md-8 col-lg-7">

                <p>
                    <h3 class="font-weight-bold text-justify">Multi Tenant</h3>
                </p>
                <p class="text-justify lead">
                    DocBoyz has created a multi tenant version of the DocBoyz platform. This is an aggregator of agencies working for a BFSI company. A BFSI company could onbaord on the DocBoyz multi tenant platform and invite all its agencies on to the platform.
                </p>
                <p class="text-justify lead">
                    This would ensure that all the agencies of the company use the same system (DocBoyz) to fulfil cases. All data and results received by the company would be from the same DocBoyz pipe. The agencies could take advantage of all features offered by the system. They can use the platform to do their work more effectively.
                </p>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-5 pt-md-3">
                <img src="{{asset('images/multitenant.png')}}" width="100%" height="80%">
                <h4 class="text-center pt-3 font-weight-bolder">Schedule a Demo</h4>
            </div>


            <div class="col-sm-12">
                <h3 class="font-weight-bold">General Features</h3>
            </div>

            <div class="col-lg-6 pt-4 row text-center text-sm-center text-md-left text-lg-left">
                <div class="col-md-3">
                    <img src="{{asset('webicon/flexibility.png')}}">
                </div>
                <div class="col-md-9">
                    <h5 class="font-weight-bold">Flexibility</h5>
                <p class="lead">To relay the cases directly to an agency</p>
                </div>
            </div>
            <div class="col-lg-6 pt-4 row text-center text-sm-center text-md-left text-lg-left">
                <div class="col-md-3">
                    <img src="{{asset('webicon/control-icon.png')}}">
                </div>
                <div class="col-md-9">
                    <h5 class="font-weight-bold">Control</h5>
                <p class="lead">Over number and type of cases done by the agencies</p>
                </div>
            </div>
            <div class="col-lg-6 pt-4 row text-center text-sm-center text-md-left text-lg-left">
                <div class="col-md-3">
                    <img src="{{asset('webicon/secured-icon.png')}}">
                </div>
                <div class="col-md-9">
                    <h5 class="font-weight-bold">Secured</h5>
                <p class="lead">The entire process happens on the secure DocBoyz platform</p>
                </div>
            </div>
            <div class="col-lg-6 pt-4 row text-center text-sm-center text-md-left text-lg-left">
                <div class="col-md-3">
                    <img src="{{asset('webicon/realtime-results-icon.png')}}">
                </div>
                <div class="col-md-9">
                    <h5 class="font-weight-bold">Realtime Results</h5>
                <p class="lead">Get the result real time as the case gets executed on the field</p>
                </div>
            </div>

        </div>


   </div>

    {{-- grey strip --}}
    @include('home.services.elements.grey_strip')


   <div class="container p-5">

        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-7 pl-sm-5">

                <h3 class="font-weight-bold">Benefits</h3>
                <ul class="list-unstyled lead">
                    <li> <span class="font-weight-bold">&#10003;</span> Improvement in the collection by 10x.</li>
                    <li> <span class="font-weight-bold">&#10003;</span> Swift action in each case.</li>
                    <li> <span class="font-weight-bold">&#10003;</span> AI technology-based effectual calling & supports performance tracking of agencies.</li>
                    <li> <span class="font-weight-bold">&#10003;</span> Hassle-free Reconcilation</li>
                    <li> <span class="font-weight-bold">&#10003;</span> Real-Time Monitoring</li>
                    <li> <span class="font-weight-bold">&#10003;</span> Ease in analysing data and helping in offering a customized resolution.</li>
                    <li> <span class="font-weight-bold">&#10003;</span> Better reach to borrowers</li>
                </ul>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-5 pr-sm-5">
                <img src="{{asset('images/3.jpg')}}" width="100%" height="100%">
            </div>

        </div>

    </div>

    {{-- grey strip --}}
    <div class="text-center p-3" style=" background-color: lightgrey;">

        <h2 class="font-weight-bold">
            Collect Kart Brouchure
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

                        <form action="{{ url('/forms/brouchure_req2') }}" method="POST">
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
    @include('home.services.elements.contactus_form')


@endsection
