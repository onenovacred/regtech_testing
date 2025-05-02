<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Docboyz|Blog</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/blogs/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/blogs/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/blogs/docboyz/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">
        <div class="logo">
                <h1>
                    <img src="https://docboyz.in/logos/DocBoyz.png" alt="no logo" class="docboyz_logo"/>
                    <img src="https://docboyz.in/logos/DocBoyz1.png" alt="no image"
                    class="img-fluid logo1">
                </h1>
            </div>
           <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto " href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="#about">Company</a></li>
                    <li><a class="nav-link scrollto" href="#services">ContactUs</a></li>
                    <li><a class="active" href="blog.html">Blog</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->
    <main id="main">
        <!-- ======= Breadcrumbs ======= -->
        {{-- <section id="breadcrumbs" class="breadcrumbs">
            <div class="container-fluid">
                <div class="carousel-inner"><div class="carousel-item active"><img src="https://docboyz.in/images/image-000.jpg" alt="Collect Kart is an API Platform for debt collection to track all loan collection activity and legal activity." title="Document Collection Platform - Docboyz" width="100%" height="300" style="filter: brightness(75%);"> <div class="carousel-caption"><h1 class="display-4 text-white">Document Collection-DocBoyz</h1></div></div></div>
            </div>
        </section> --}}
        <!-- End Breadcrumbs -->
        <!-- ======= Blog Single Section ======= -->
        <section id="blog" class="blog">
            <div class="container">
                  <h1 class="blog-header">{{$blogDetails->title}}</h1>
                <div class="row">
                    <div class="col-lg-5 mt-4 entries">
                        <article class="entry entry-single">
                            <div class="entry-img">
                                <img src="{{ asset('uploads/docboyz/'.$blogDetails?->image) }}" alt="no image"
                                title="{{$blogDetails?->title}}" keyword="{{$blogDetails?->meta_keyword}}" meta-description="{{$blogDetails?->meta_description}}" class="img-fluid">
                            </div>
                        </article><!-- End blog entry -->
                    </div><!-- End blog entries list -->
                    <div class="col-lg-7">
                        <article class="">
                            <div class="entry-content">
                                <p>
                                  {!!$blogDetails?->description!!}
                                </p>
                        </article>
                    </div><!-- End blog sidebar -->

                </div>
               
            </div>
        </section><!-- End Blog Single Section -->

    </main><!-- End #main -->
    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-md-6 footer-contact">
                        {{-- <h3>Flexor</h3>
                        <p>
                            A108 Adam Street <br>
                            New York, NY 535022<br>
                            United States <br><br>
                            <strong>Phone:</strong> +1 5589 55488 55<br>
                            <strong>Email:</strong> info@example.com<br>
                        </p> --}}
                    </div>

                    <div class="col-lg-2 col-md-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-6 footer-newsletter">
                        {{-- <h4>Join Our Newsletter</h4>
                        <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
                        <form action="" method="post">
                            <input type="email" name="email"><input type="submit" value="Subscribe">
                        </form> --}}
                    </div>

                </div>
            </div>
        </div>

        {{-- <div class="container d-lg-flex py-4">

            <div class="me-lg-auto text-center text-lg-start">
                <div class="copyright">
                    &copy; Copyright <strong><span>Flexor</span></strong>. All Rights Reserved
                </div>
                <div class="credits">
                    <!-- All the links in the footer should remain intact. -->
                    <!-- You can delete the links only if you purchased the pro version. -->
                    <!-- Licensing information: https://bootstrapmade.com/license/ -->
                    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/flexor-free-multipurpose-bootstrap-template/ -->
                    Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                </div>
            </div>
            <div class="social-links text-center text-lg-right pt-3 pt-lg-0">
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
        </div> --}}
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/blogs/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/blogs/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/blogs/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/blogs/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/blogs/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/blogs/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>
