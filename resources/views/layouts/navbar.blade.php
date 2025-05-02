<div class="container">

    <div class="container-fluid pl-sm-5 pr-sm-5">

 <nav class="navbar navbar-expand-lg navbar-light" style="padding:1rem 1rem;font-size: 16px; font-weight: bold">
    <a class="" href="{{ url('/')}}" style="width:39%"><img src="{{asset('logos/regtech.png')}}" height="50px" style="margin:-20px; width:13%"><img class="pt-2 pl-2" src="{{asset('logos/regtech4.png')}}" style="width: 40%"></a>
    
    
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse pl-sm-3" id="navbarText">
      <ul class="navbar-nav ml-sm-auto ml-md-auto ml-lg-auto">
        <li class="nav-item active">
          <a class="nav-link text-dark text-decoration-none" href="{{ url('/')}}">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark text-decoration-none" href="{{url('/company')}}">Company</a>
        </li>

        <!-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark text-decoration-none" href="" data-toggle="dropdown">Collect Kart</a>
            <ul class="dropdown-menu">

            <li><a class="dropdown-item" href="/db_doc_collection">DB Document Collection</a></li>

            <li><a class="dropdown-item" href="/debt_recovery">DB Debt Recovery</a></li>
            <li><a class="dropdown-item" href="/yesbank">Yes Bank</a></li>
            <li><a class="dropdown-item" href="/consumer">Consumer</a></li>
                <li><a class="dropdown-item" href="/customer_verification"> DB Reg Tech API </a>
                    {{-- <ul class="submenu dropdown-menu">
                        <li><a class="dropdown-item" href="/customer_verification">Customer Verification</a></li>
                        <li><a class="dropdown-item" href="/e_kyc">E-Kyc</a></li>
                        <li><a class="dropdown-item" href="/video_kyc">Video-Kyc</a></li>
                        <li><a class="dropdown-item" href="/e_sign">E-sign</a></li>
                        <li><a class="dropdown-item" href="/offline_aadhar">Offline Aadhar</a></li>
                        <li><a class="dropdown-item" href="/aadhar_masking">Aadhar Masking</a></li>
                        <li><a class="dropdown-item" href="/db_fmatch">DB Fmatch</a></li>
                        <li><a class="dropdown-item" href="/e_nach_e_mandate">e-NACH/e-Mandate</a></li>
                    </ul> --}}
                </li>

            </ul>
        </li> -->

        <li class="nav-item">
            <a class="nav-link text-dark text-decoration-none" href="{{ url('/careers')}}">Careers</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-dark text-decoration-none" href="{{ url('/blog')}}">Blog</a> <!--{{ url('/blog')}}-->
        </li>
        <li class="nav-item">
            <a class="nav-link text-dark text-decoration-none" href="{{ url('/contact')}}">Contact Us</a>
        </li>
	<!-- <li>
        <a class="nav-link text-dark text-decoration-none" href="http://collectkart.docboyz.in/registration_user">Register</a>
        </li> -->
      </ul>
     
     <!-- added things of app.blade.php -->
          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-sm-auto ml-md-auto ml-lg-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link text-dark text-decoration-none" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            {{-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-dark text-decoration-none" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif --}}
                        @else
                            <li class="nav-item dropdown">
                                <!-- <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a> -->

                                <!-- <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown"> -->
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                <!-- </div> -->
                            </li>
                        @endguest
                    </ul>
                    <!-- ended the added things of app.blade.php -->
    
      <div class="ml-sm-auto ml-md-auto ml-lg-auto">
        <a class="p-1 text-dark text-decoration-none" href="https://www.facebook.com/BoyzDoc/">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
            </svg>
        </a>

        <a class="p-1 text-dark text-decoration-none" href="https://twitter.com/docboyz_">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
            </svg>
        </a>
    </div>
    <div class="ml-sm-auto ml-md-auto ml-lg-auto">
        <a class="p-1 text-dark text-decoration-none" href="https://www.youtube.com/channel/UCzZw2HziZqBSaxTbuXNTn0g">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
                <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.122C.002 7.343.01 6.6.064 5.78l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z"/>
            </svg>
        </a>

        <a class="p-1 text-dark text-decoration-none" href="https://www.linkedin.com/company/docboyz">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z"/>
            </svg>
        </a>
       
    </div>
    @if(Route::is('yesbank'))
        <a class="" href="{{ url('/')}}"><img src="{{asset('logos/YES BANK_Original Logo.jpg')}}" height="60px" alt="image is not found"></a>
         @endif 
    </div>

  </nav>
  <!-- @if(Route::is('yesbank'))
     <nav class="navbar navbar-expand-lg navbar-light" style="font-size: 16px; font-weight: bold">
    <a class="" href="{{ url('/')}}"><img src="{{asset('logos/yesbank.jpeg')}}" height="40px" alt="image is not found"></a>
    </nav>
     @endif  -->
</div>

</div>
