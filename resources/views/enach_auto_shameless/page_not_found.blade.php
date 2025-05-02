<html>

<head>
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<style>
    main {
        background: lightseagreen url("https://static.pexels.com/photos/5412/water-blue-ocean.jpg") no-repeat center center;
        background-size: cover;
        animation: fadein 4s;
        -webkit-filter: brightness(0.9);
        filter: brightness(0.9);
        width: 100%;
        height: 100vh;
        display: inline-block;
        position: relative;
    }

    .loading {
        text-transform: uppercase;
        font-family: Arial, sans-serif;
        font-weight: bold;
        font-size: 100pt;
        text-align: center;
        height: 120px;
        line-height: 110px;
        vertical-align: bottom;
        position: absolute;
        left: 0;
        right: 0;
        top: 100px;
        bottom: 0;
        display: block;
    }

    @keyframes wave-animation {
        0% {
            background-position: 0 bottom;
        }

        100% {
            background-position: 200px bottom;
        }
    }

    @keyframes loading-animation {
        0% {
            background-size: 200px 0px;
        }

        100% {
            background-size: 200px 200px;
        }
    }
  .wave {
        background-image: url("http://vignette4.wikia.nocookie.net/camphalfbloodroleplay/images/b/bb/Large-wave-divider.png");
        -moz-background-clip: text;
        -o-background-clip: text;
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        text-shadow: 0px 0px rgba(155, 255, 255, 0.06);
        animation: wave-animation 3s infinite linear,
            loading-animation 4s infinite linear alternate;
        background-size: 200px 100px;
        background-repeat: repeat-x;
        opacity: 1;
    }
   .not-found {
        text-align: center;
        font-size: 55px;
        margin-top: 350px;
        font-family: Arial;
        animation: wave-animation 2.5s infinite linear,
            loading-animation 10s infinite linear alternate;
    }
  .search {
        display: block;
        margin-top: 50px;
        margin-left: -20px;
        width: 100%;
    }
     .search-container {
        width: 490px;
        display: block;
        margin: 0 auto;
    }
   input#search-bar {
        margin: 0 auto;
        width: 100%;
        height: 45px;
        padding: 0 20px;
        font-size: 1rem;
        border: 1px solid #d0cfce;
        outline: none;
        &:focus {
            border: 1px solid #008abf;
            transition: 0.35s ease;
            color: #008abf;

            &::-webkit-input-placeholder {
                transition: opacity 0.45s ease;
                opacity: 0;
            }

            &::-moz-placeholder {
                transition: opacity 0.45s ease;
                opacity: 0;
            }

            &:-ms-placeholder {
                transition: opacity 0.45s ease;
                opacity: 0;
            }
        }
    }
   .search-icon {
        position: relative;
        float: right;
        width: 75px;
        height: 75px;
        top: -62px;
        right: -45px;
    }

    @keyframes fadein {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    /* Firefox < 16 */

    @-moz-keyframes fadein {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    /* Safari, Chrome and Opera > 12.1 */

    @-webkit-keyframes fadein {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    .e_mandate {
        text-align: center;
        font-size: 25px;
        margin-top: 10px;
        font-family: Arial;
         animation: wave-animation 2.5s infinite linear,
            loading-animation 10s infinite linear alternate;
    }
     a {
       text-decoration: none;
       color: white;
     }
</style>

<body>
    <main>
        <div class="loading wave">
            404
        </div>
        <div class="not-found wave">
            Page Not Found
        </div>
        <div class="search">
            <h4 class="e_mandate"><a href="{{ route('e-nach-initiate-payment') }}">Go to Mandate</a></h4>
        </div>
    </main>
</body>
</html>
