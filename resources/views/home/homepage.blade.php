@extends('layouts.app')

@section('title', 'Home Page')

@section('content')


    <div style="background-color: rgb(173, 216, 230);">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">

            <!-- Indicators -->
            <ul class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
            </ul>

            <!-- The slideshow -->
            <div class="container">
                <div class="container pl-md-5 pr-md-5 pb-sm-3">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7 pl-sm-3 pt-sm-5 ">
                                        <div class="card bg-transparent border-0">
                                          <div class="card-body">
                                            <h5 class="font-weight-bold">A Phygital Collection platform dedicated to Bank & NBFC</h5>
                                            <h1 class="font-weight-bold">Efficient Debt Collection</h1>
                                            <!-- <div style="text-align:center"> -->
                                            <h3 class="font-weight-bold">Improve Debt recovery efficiency by 40%</h3>
                                            <!-- </div> -->
                                          </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 pt-sm-3">
                                        <div class="card bg-transparent border-0">
                                            <img src="{{asset('images/0001.png')}}" width="100%" height="100%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item ">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7 pl-sm-3 pt-sm-5 ">
                                        <div class="card bg-transparent border-0">
                                          <div class="card-body">
                                            <h5 class="font-weight-bold">A Phygital Collection platform dedicated to Bank & NBFC</h5>
                                            <h1 class="font-weight-bold">Seamless Document Collection</h1>
                                            <div style="text-align:center">
                                            <h3 class="font-weight-bold">Reduce Customer on-boarding time by 40%</h3>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 pt-sm-3">
                                        <div class="card bg-transparent border-0">
                                            <img src="{{asset('images/0002.png')}}" width="100%" height="100%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7 pl-sm-3 pt-sm-5 ">
                                        <div class="card bg-transparent border-0">
                                          <div class="card-body">
                                            <h5 class="font-weight-bold">A Phygital Collection platform dedicated to Bank & NBFC</h5>
                                            <h1 class="font-weight-bold">Faster Customer Verification</h1>
                                            <!-- <div style="text-align:center"> -->
                                            <h3 class="font-weight-bold">Save Process operation cost by 40%</h3>
                                            <!-- </div> -->
                                          </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 pt-sm-3">
                                        <div class="card bg-transparent border-0">
                                            <img src="{{asset('images/0003.png')}}" width="100%" height="100%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#myCarousel" data-slide="next">
            <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div>



    <!-- START THE FEATURETTES -->
    <div class="container pl-sm-5 pr-sm-5">
        <div class="container">

            <div class="text-center p-4">
                <h2 class="font-weight-bold" >
                    <span style="border-bottom: 2px solid #000 ; padding-bottom: 0px; padding-left: 5px; padding-right: 5px">Our Services & Solutions</span>
                </h2>
            </div>

            <div class="row featurette">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                    <div class="card bg-transparent border-0 ">
                        <img src="{{asset('images/2.jpg')}}" width="" height="">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                    <div class="card bg-transparent border-0">
                        <div class="card-body">
                            <h3 class="featurette-heading font-weight-bold">DocBoyz</h3>
                            <p class="lead text-justify">A Phygital platform designed for collection of documents, customer data and Delinquent debt.
                                A multi-tenant architecture offer flexibility of endless expansion without any hassle.
                                Helping BFSI companies in expanding pan-India operation on our
                                Fintech correspondents/Agency Network.</p>

                            <p><a class="btn btn-outline-dark" href="{{ url('/db_doc_collection')}}" role="button">View More</a></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row featurette pt-4">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                    <div class="card bg-transparent border-0">
                        <div class="card-body">
                            <h3 class="featurette-heading font-weight-bold">Collect Kart</h3>
                            <p class="lead text-justify">Debt Recovery platform with ease and intelligence.
                                Collect Kart is designed for Banks and NBFC to collect their overdue payment.
                                We faciliate the efficient debt recovery with the help of technology and human network.
                                Our platform will help in adopting the new approch for collection,
                                where process is more consultative than coercive. </p>

                            <p><a class="btn btn-outline-dark" href="{{ url('/debt_recovery')}}" role="button">View More</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                    <div class="card bg-transparent border-0">
                        <img src="{{asset('images/2.jpg')}}" width="" height="">
                    </div>
                </div>
            </div>

        </div>

    </div>

        <!-- END THE FEATURETTES -->

        <div class="pt-5 pl-5 pr-5" style="background-color: lightgrey;">

            <div class="container">
                <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 pl-sm-5 pr-sm-5  text-bold align-content-start">
                    <h1 class="font-weight-bold">Our Pan India Presence</h1>
                    <p class="lead">It is supported by digitally enables pan-Inbia network of Fintech correspondent and Debt collection agencies</p>

                    {{-- stats --}}
                    
                        <div class="row" >
                            <!-- column  -->
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 pb-3">
                                <div class="">
                                    <h2 class="m-b-0 font-weight-bold"><span class="counter">24</span>+</h2>
                                    <h5 class="font-weight-bold">States and Union Territories</h5>
                                </div>
                            </div>
                            <!-- column  -->

                            <!-- column  -->
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 pb-3" >
                                <div class="">
                                    <h2 class="font-weight-bold m-b-0"><span class="counter">580</span>+</h2>
                                    <h5 class="font-weight-bold">Locations</h5>
                                </div>
                            </div>
                            <!-- column  -->

                            <!-- column  -->
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 " >
                                <div class="">
                                    <h2 class="font-weight-bold m-b-0"><span class="counter">10,000</span>+</h2>
                                    <h5 class="font-weight-bold">Fintech Correspondents</h5>
                                </div>
                            </div>
                            <!-- column  -->
                        </div>
                    </div>

                    {{-- end stats --}}

                    <div class="text-center col-lg-6">
                        <img class="featurette-image " src="{{asset('images/india_map.png')}}" width="100%" height="300">
                    </div>

                </div>
            </div>

        </div>

    <div class="container p-5">
        <div class="row text-bold pl-md-5 pr-md-5">
            <div class="col-sm-12 align-content-start text-lg-center">
                <h3 class="font-weight-bold">Delivering Seamless Fintech Logistic Services</h3>
                <p class="lead">Our platform offer complete logistics solution for collection of documents and Debt online and offline.
                    It is supported by digitally enables pan-India network of Fintech correspondent and Debt Collection agencies.
                </p>
            </div>
            <div class="row text-center pl-lg-5">
                <div class="pl-xl-5 col-xs-12 col-sm-12 col-md-3 col-xl-auto">
                    <img src="{{asset('webicon/stopwatch.svg')}}" width="70" height="70">
                    <h5 class="pt-sm-2 font-weight-bolder">Speed</h5>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-3 col-xl-auto">
                    <img src="{{asset('webicon/accuracy.svg')}}" width="70" height="70">
                    <h5 class="pt-sm-2 font-weight-bolder">100% Accuracy</h5>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-3 col-xl-auto">
                    <img src="{{asset('webicon/real_time_update.svg')}}" width="70" height="70">
                    <h5 class="pt-sm-2 font-weight-bolder">Real time update</h5>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-3 col-xl-auto">
                    <img src="{{asset('webicon/data_security.svg')}}" width="70" height="70">
                    <h5 class="pt-sm-2 font-weight-bolder">Data Security</h5>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-xl-auto">
                    <img src="{{asset('webicon/integration.svg')}}" width="70" height="70">
                    <h5 class="pt-2 font-weight-bolder">Seamless Integration</h5>
                </div>
            </div>
        </div>
    </div>


    {{-- grey strip --}}
    <!-- <div style="position: fixed;  bottom: 0; width: 100%;"> -->
    @include('home.services.elements.grey_strip')
    <!-- </div> -->

    @include('home.services.elements.partner_logos')


@endsection

