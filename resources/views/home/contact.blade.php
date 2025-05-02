@extends('layouts.app')

@section('title', 'Home Page')


@section('content')

    @include('home.services.elements.header_img', [
        'image' => 'images/contact.jpg',
        // 'caption' => 'Contact Us'
    ])

    <div class="container p-5">

        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-6 pl-sm-0 pl-md-0 pl-lg-5">
                <h3 class="font-weight-bold">Contact Details</h3>

                <div class="row">
                    <!-- <div class="col-2 pt-1 text-right">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-geo-alt-fill text-danger" viewBox="0 0 16 16">
                            <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                        </svg>
                    </div> -->
                    <!-- <div class="col-9 pt-1 lead">
                        <span> <span class="font-weight-bold">Corporate Office: </span>
                        </br>
                        <span class="font-weight-bold">Pune:</span>
                        </br>
                        ZapFin Teknologies Pvt Ltd (DocBoyz),
                        105, Hermes Waves
                        Central Avenue Road
                        Kalyani Nagar, Pune,
                        Maharashtra - 411006, India</span>
                        <br><br>
                        <span>CIN: U72900PN2018PTC180125</span><br>
                        <span>GSTIN: 27AABCZ2858B1ZC</span>
                        </br>
                        
                        </br>
                        <span class="font-weight-bold">Mumbai:</span>
                        </br>
                        
                        C-106 Kanishka
                        GE Links CHS, Ram Mandir Road
                        Goregaon West,
                        Mumbai -400104, India</span>
                        <br><br>
                    </div> -->

                    <div class="col-2 pt-4 text-right">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-telephone-fill text-danger" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                        </svg>
                    </div>
                    <div class="col-9 pt-4 lead">
                        <span> <span class="font-weight-bold">Customers: </span> +91 7766969646</span>
                    </div>

                    <div class="col-2 pt-4 text-right">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-phone-vibrate-fill text-danger" viewBox="0 0 16 16">
                            <path d="M4 4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4zm5 7a1 1 0 1 0-2 0 1 1 0 0 0 2 0zM1.807 4.734a.5.5 0 1 0-.884-.468A7.967 7.967 0 0 0 0 8c0 1.347.334 2.618.923 3.734a.5.5 0 1 0 .884-.468A6.967 6.967 0 0 1 1 8c0-1.18.292-2.292.807-3.266zm13.27-.468a.5.5 0 0 0-.884.468C14.708 5.708 15 6.819 15 8c0 1.18-.292 2.292-.807 3.266a.5.5 0 0 0 .884.468A7.967 7.967 0 0 0 16 8a7.967 7.967 0 0 0-.923-3.734zM3.34 6.182a.5.5 0 1 0-.93-.364A5.986 5.986 0 0 0 2 8c0 .769.145 1.505.41 2.182a.5.5 0 1 0 .93-.364A4.986 4.986 0 0 1 3 8c0-.642.12-1.255.34-1.818zm10.25-.364a.5.5 0 0 0-.93.364c.22.563.34 1.176.34 1.818 0 .642-.12 1.255-.34 1.818a.5.5 0 0 0 .93.364C13.856 9.505 14 8.769 14 8c0-.769-.145-1.505-.41-2.182z"/>
                        </svg>
                    </div>
                    <div class="col-9 pt-4 lead">
                        <span> <span class="font-weight-bold">Media & Investor: </span> +91 8080987605</span>
                    </div>

                    <div class="col-2 pt-4 text-right">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-envelope-fill text-danger" viewBox="0 0 16 16">
                            <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/>
                        </svg>
                    </div>
                    <div class="col-9 pt-4 lead">
                        <span class="font-weight-bold">Email: </span> <a href="mailto:info@docboyz.in" class="text-dark">info@docboyz.in</a>
                    </div>

                    <!-- <div class="col-2 pt-4 text-right">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-phone text-danger" viewBox="0 0 16 16">
                            <path d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h6zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H5z"/>
                            <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                        </svg>
                    </div>
                    <div class="col-9 pt-4 font-weight-bold ">
                        <a href="https://play.google.com/store/apps/details?id=com.docboyzpro" class="text-dark" style="font-size: 125%">Get the App</a>
                    </div> -->

                    <div class="col-sm-12 pt-4 pb-5 align-content-start">

                        <strong style="font-size: 125%">Social Contacts: </strong>

                        <a class="pl-2 text-danger text-decoration-none" href="https://www.facebook.com/BoyzDoc/">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                            </svg>
                        </a>

                        <a class="pl-2 text-danger text-decoration-none" href="https://twitter.com/docboyz_">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                                <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
                            </svg>
                        </a>

                        <a class="pl-2 text-danger text-decoration-none" href="https://www.youtube.com/channel/UCzZw2HziZqBSaxTbuXNTn0g">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
                                <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.122C.002 7.343.01 6.6.064 5.78l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z"/>
                            </svg>
                        </a>

                        <a class="pl-2 text-danger text-decoration-none" href="https://www.linkedin.com/company/docboyz">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                                <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z"/>
                            </svg>
                        </a>
                    </div>
                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-6 pr-sm-0 pr-md-0 pr-lg-5">

                <h3 class="font-weight-bold">Quick Enquiry Here</h3>

                    <div class="card">
                        <div class="card-body lead">

                            <form action="{{ url('/forms/enquiry') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="Name">Name</label>
                                    <input type="text" style="background-color: lightgrey" class="form-control" name="full_name" id="name" placeholder="Name">
                                </div>
                                <div class="form-group">
                                <label for="Email">Email address</label>
                                <input type="email" style="background-color: lightgrey" class="form-control" name="email_id" id="Email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="tel" style="background-color: lightgrey" class="form-control" name="phone" id="phone" placeholder="Phone">
                                </div>
                                <div class="form-group">
                                    <label for="Select1">Enquire For</label>
                                    <select class="form-control" style="background-color: lightgrey" name="enquiry_for" id="Select1" required>
                                    {{-- <option>Enquiry for</option> --}}
                                    <option value="select">Select</option>
                                    <option>Document Collection</option>
                                    <option>Debt Recovery</option>
                                    <option>RegTech API</option>
                                    <option>Other</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="message">Message</label>
                                    <textarea class="form-control" style="background-color: lightgrey" name="message" id="message" rows="1" placeholder="Message"></textarea>
                                </div>
                                <button type="submit" class="btn btn-danger">Submit Here</button>
                            </form>

                        </div>
                    </div>

            </div>

        </div>

    </div>

@endsection
