
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <script src="https://cdn.pagesense.io/js/895107392/8edde5c9c87c4abdab8f2fea45daae45.js"></script> 
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5MZNFDVV');</script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="facebook-domain-verification" content="iud4te9jri06dhmivt8opzx8oh4zu8" />
   
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <link rel = "icon" href ="{{asset('logos/regtech.png')}}" type = "image/x-icon">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Add this in the <head> section -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script async src="https://www.googletagmanager.com/gtag/js?id=G-30C9CEEDRW"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-30C9CEEDRW');
</script>


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" >

</head>
<body class="bg-white">
@include('layouts.navbar')
    <div id="app">
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5MZNFDVV"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

       <main class="">
            @yield('content')
        </main>
    </div>
   

    @include('layouts.footer')
     <a href="https://wa.me/918470067555" class="whatsapp-float" target="_blank">
    <i class="fab fa-whatsapp"></i>
</a>

<style>
.whatsapp-float {
    position: fixed;
    width: 60px;
    height: 60px;
    bottom: 90px;
    right: 25px;
    background-color: #25d366;
    color: white;
    border-radius: 50px;
    text-align: center;
    font-size: 30px;
    box-shadow: 2px 2px 5px rgba(0,0,0,0.3);
    z-index: 1000;
}

.whatsapp-float i {
    margin-top: 15px;
}
</style>
</body>
</html>
