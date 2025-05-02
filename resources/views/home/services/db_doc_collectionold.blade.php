@extends('layouts.app')

@section('title', 'Document Collection')


@section('content')

    {{-- header image and caption --}}
    @include('home.services.elements.header_img2', [
        'image' => 'images/image-000.jpg',
        // 'image' => 'Images/collection1.jpg',
        // 'caption1' => 'Collect Kart',
        'caption2' => 'Document Collection'
    ])

    <div class="container p-5">

        <div class="row">
            <p>
                <h3 class="text-center font-weight-bold"><span class="text-dark">Collect Kart Document Collection- </span> <span class="text-danger text-capitalize">an innovative phygital platform by DocBoyz </span></h3>
            </p>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 pt-lg-3">

                <p class="text-justify lead">A Phygital platform designed for collection of documents and customer data.
                    A multi-tenant architecture offer flexibility of endless expansion without any hassle.
                    Helping BFSI companies in expanding pan-India operation on our Fintech correspondents/Agency Network.
                </p>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mt-lg-n2">
                <img src="{{asset('images/2.jpg')}}" width="100%" height="100%">
            </div>

            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <img src="{{asset('images/5.jpg')}}" width="100%" height="100%">
            </div>

            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

                <p>
                    <h3 class="font-weight-bold text-justify">Document Collection Services</h3>
                </p>
                <p class="text-justify lead">
                    DocBoyz provides best experience with speed in document collection for Banks & NBFCs.
                    Our pan-India Fintech correspondent network is well trained to handle any financial document
                    collection with full integrity and safety. They are courteous and equipped with our powerful DocBoyz collection app.
                    All the documents are scanned and transmitted digitally in real time using our platform.
                </p>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 pl-sm-5 pt-sm-5">

                <h3 class="font-weight-bold">Services</h3>
                <ul class="list-unstyled lead">
                    <li>
                        <span class="font-weight-bold">&#10003;</span>
                        Home Loans Documents
                    </li>
                    <li>
                        <span class="font-weight-bold">&#10003;</span>
                        Personal Loans Documents
                    </li>
                    <li>
                        <span class="font-weight-bold">&#10003;</span>
                        Auto Loan Documents
                    </li>
                    <li>
                        <span class="font-weight-bold">&#10003;</span>
                        Insurance Documents
                    </li>
                    <li>
                        <span class="font-weight-bold">&#10003;</span>
                        Payment Mandate and Contact Document
                    </li>
                </ul>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ">
                <img src="{{asset('images/3.jpg')}}" width="100%" height="100%">
            </div>

        </div>

        <div class="text-center pt-sm-3">
            <h2 class="font-weight-bold">DocBoyz <span class="text-danger">Eco System</span></h2>
            <h5 class="font-weight-bolder">DocBoyz Platform - complete eco-system for Collection</h5>
        </div>

        <div class="row justify-content-center pt-5">
            <div class="card" style="width: 18rem;">
                <img src="{{asset('images/dashboard.png')}}" class="card-img-top">
                <div class="card-body">
                    <h3 class="font-weight-bolder">Customer Portal</h3>
                    <p class="card-text lead">Customers can track their cases real time using the customer portal</p>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="{{asset('images/app_screen.png')}}" class="card-img-top pl-4 pr-4" height="160px">
                <div class="card-body">
                    <h3 class="font-weight-bolder">DocBoyz Mobile App</h3>
                    <p class="card-text lead">The mobile app is used by our Fintech Correspondents to seamlessly accept and digitally execute the case</p>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="{{asset('images/console.png')}}" class="card-img-top">
                <div class="card-body">
                    <h3 class="font-weight-bolder">DocBoyz Admin Console</h3>
                    <p class="card-text lead">DocBoyz administrator checks the pulse of the entire system using the admin console.</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center pt-5">
            <div class="card" style="width: 18rem;">
                <img src="{{asset('images/4.jpg')}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h3 class="font-weight-bolder">Customer APIs</h3>
                    <p class="card-text lead">DocBoyz exposes APIs to customes to easily integrate with their internal system</p>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="{{asset('images/website.png')}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h3 class="font-weight-bolder">Corporate Website</h3>
                    <p class="card-text lead">The mobile app is used by our Fintech Correspondents to seamlessly accept and digitally execute the case</p>
                </div>
            </div>
        </div>

        <div class="text-center pt-5">
            <h2 class="font-weight-bold">DocBoyz <span class="text-danger">Platform Features</span></h2>
            <h5 class="text-bold font-weight-bolder">Our cloud based platform and digitally enabled pan-India Fintech Correspondent Network.</h5>
        </div>

        {{-- card groups --}}
        <div class="row pl-lg-5 pr-lg-5 justify-content-center pt-2 text-center">

                <div class="card col-sm-6 col-md-4 col-lg-3 pt-md-0" style="width: 12rem; height: 10rem;">
                    <img src="{{asset('webicon/integration.svg')}}" class="card-img-top mt-sm-3" width="70" height="70">
                    <div class="card-body">
                        <h5>Self Intergrate API</h5>
                    </div>
                </div>
                <div class="card col-sm-6 col-md-4 col-lg-3 pt-md-0" style="width: 12rem; height: 10rem;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="card-img-top mt-sm-3" width="70" height="70" fill="currentColor" class="bi bi-person-bounding-box" viewBox="0 0 16 16">
                        <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z"/>
                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                    </svg>
                    <div class="card-body">
                        <h5>Digital KYC</h5>
                    </div>
                </div>
                <div class="card col-sm-6 col-md-4 col-lg-3" style="width: 12rem; height: 10rem;">
                    <img src="{{asset('webicon/fraud_detection.svg')}}" class="card-img-top mt-sm-3" width="70" height="70">
                    <div class="card-body">
                        <h5>Fraud Detection</h5>
                    </div>
                </div>
                <div class="card col-sm-6 col-md-4 col-lg-3" style="width: 12rem; height: 10rem;">
                    <img src="{{asset('webicon/data_encryption.svg')}}" class="card-img-top mt-xl-4" width="80" height="80">
                    <div class="card-body">
                        <h5>Data Encryption</h5>
                    </div>
                </div>

                <div class="card col-sm-6 col-md-4 col-lg-3" style="width: 12rem; height: 10rem;">
                    <img src="{{asset('webicon/stopwatch.svg')}}" class="card-img-top mt-sm-3" width="70" height="70">
                    <div class="card-body">
                        <h5>Real Time Verification</h5>
                    </div>
                </div>
                <div class="card col-sm-6 col-md-4 col-lg-3" style="width: 12rem; height: 10rem;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="card-img-top mt-sm-3" width="70" height="70" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                        <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/>
                        <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                    </svg>
                    <div class="card-body">
                        <h5>Geo Tagging</h5>
                    </div>
                </div>
                <div class="card col-sm-6 col-md-4 col-lg-3" style="width: 12rem; height: 10rem;">
                    <img src="{{asset('webicon/data_security.svg')}}" class="card-img-top mt-sm-3" width="75" height="75">
                    <div class="card-body">
                        <h5>Secured</h5>
                    </div>
                </div>
                <div class="card col-sm-6 col-md-4 col-lg-3" style="width: 12rem; height: 10rem;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="card-img-top mt-sm-3" width="70" height="70" fill="currentColor" class="bi bi-calendar2-check" viewBox="0 0 16 16">
                        <path d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z"/>
                        <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z"/>
                    </svg>
                    <div class="card-body">
                        <h5>Pickup Scheduling</h5>
                    </div>
                </div>

                <div class="card col-sm-6 col-md-4 col-lg-3" style="width: 12rem; height: 10rem;">
                    <img src="{{asset('webicon/audit.svg')}}" class="card-img-top mt-sm-3" width="70" height="70">
                    <div class="card-body">
                        <h5>Transparent process</h5>
                    </div>
                </div>
                <div class="card col-sm-6 col-md-4 col-lg-3" style="width: 12rem; height: 10rem;">
                    <img src="{{asset('webicon/rocket.svg')}}" class="card-img-top mt-sm-3" width="75" height="75">
                    <div class="card-body">
                        <h5>Fast</h5>
                    </div>
                </div>
                <div class="card col-sm-6 col-md-4 col-lg-3" style="width: 12rem; height: 10rem;">
                    <img src="{{asset('webicon/real_time_tracking.svg')}}" class="card-img-top mt-sm-3" width="75" height="75">
                    <div class="card-body">
                        <h5>Real Time Tracking</h5>
                    </div>
                </div>
                <div class="card col-sm-6 col-md-4 col-lg-3" style="width: 12rem; height: 10rem;">
                    <img src="{{asset('webicon/network.svg')}}" class="card-img-top mt-sm-3" width="70" height="70">
                    <div class="card-body">
                        <h5>Pan-India Network</h5>
                    </div>
                </div>
        </div>

        {{-- card groups 2
        <div class="row justify-content-center text-center">


        </div>

       //card groups 3-
        <div class="row justify-content-center text-center">


        </div> --}}

        <div class="row pt-5">
            <div class="col-sm-7">
                <h2 class="font-weight-bold">Easy to use and intuitive user interface</h2>
                <span class="lead">Which has been well adopted by FCs</span> <br>
                <a href="https://play.google.com/store/apps/details?id=com.docboyzpro"><img src="{{asset('images/google_play.png')}}" width="120" height="120"></a>
            </div>
            <div class="col-sm-5">
                <img src="{{asset('images/app_screen.png')}}" width="100%" height="100%">
            </div>

        </div>

    </div>


    {{-- grey strip --}}
    @include('home.services.elements.grey_strip')

    {{-- partner logos --}}
    @include('home.services.elements.partner_logos')

    {{-- grey strip --}}
    <div class="p-4 text-center" style=" background-color: lightgrey;">

        <h2 class="font-weight-bold">
            Product Brouchure
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

    {{-- contact us form and text --}}
    @include('home.services.elements.contactus_form')

@endsection
