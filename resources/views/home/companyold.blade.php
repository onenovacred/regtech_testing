@extends('layouts.app')

@section('title', 'Company Page')


@section('content')

<style>

.counter {
    padding: 20px 0;
}

.count-title {
    font-size: 40px;
    font-weight: normal;
    margin-top: 10px;
    margin-bottom: 0;
    text-align: center;
}

.count-text {
    margin-top: 10px;
    margin-bottom: 0;
    text-align: center;
}

</style>


        <div class="carousel-inner row">
            <div class="carousel-item active col-sm-12">
                <div class="carousel-caption pb-sm-5 mb-auto">
                    <h2 class="display-4 text-white">Our Mission</h2>
                    <p class="font-weight-bolder text-white lead">Organizing, optimizing, and setting the standards for Fintech logistics & Debt collection using technology in the forefront and human network in the core.</p>
                </div>
                <img src="{{asset('images/web_image5.jpg')}}" width="100%" height="250" style="filter: brightness(50%)">
            </div>
        </div>



<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<div class="container p-sm-5" style="width: 70%; position: relative; bottom: 100px">

		<div class="row text-center text-white bg-danger" style="border-radius: 20px;">
	        <div class="col-sm-auto">
                <div class="counter bg-danger">
                    <h2 class="timer count-title count-number font-weight-bold" data-to="24" data-speed="1500"></h2>
                    <h4 class="count-text ">States and Union Territories</h4>
                </div>
            </div>

            <div class="col-sm-auto">
               <div class="counter bg-danger">
                    <h2 class="timer count-title count-number font-weight-bold" data-to="580" data-speed="1500"></h2>
                    <span style="position: absolute; left: 190px; bottom: 50px;"><h1>+</h1></span>
                    <h4 class="count-text ">Locations</h4>
                </div>
            </div>

            <div class="col-sm-auto">
                <div class="counter bg-danger">
                    <h2 class="timer count-title count-number font-weight-bold" data-to="6000" data-speed="1500"></h2>
                    <span style="position: absolute; left: 204px; bottom: 50px;"><h1>+</h1></span>
                    <h4 class="count-text ">Fintech Correspondants</h4>
                </div>
            </div>

        </div>
</div>

<div class="container pl-5 pr-5" style="position: relative; bottom: 5rem;">

    <div class="row">

        <div class="col-sm-12 col-lg-6">

            <p>
                <h3 class="font-weight-bold">About Us</h3>
            </p>
            <p class="text-justify lead">
                We are India's first Phygital Fintech logistics company helping Banks, NBFCs,
                Fintech and Insurance companies in faster document collection, Customer Verification
                and Debt Collection. Our platform offer complete logistics solution for collection of documents and
                Debt, online and offline. It is supported by digitally enable pan-India network of Fintech Correspondants and Debt Collection agencies.
            </p>

        </div>

        <div class="col-sm-12 col-lg-6">
            <img src="{{asset('images/2.jpg')}}" width="100%" height="100%">
        </div>

    </div>

</div>

<div class="col-sm-10 container mt-n5" style="position: relative; bottom: 2rem;">
    <hr>
</div>

<div class="row-cols-sm-1 text-center">
    <h4 class="font-weight-bold ">
        <span style="border-bottom: 2px solid #000 ; padding-bottom: 0px; padding-left: 5px; padding-right: 5px">Our Journey</span>
    </h4>
    <img src="{{asset('images/our_journey.png')}}" style="width: 70%">
</div>

<div class="container">

    @include('home.services.elements.partner_logos')

    {{-- <div class="bg-white">

        <div class="text-center pt-sm-5">
            <h2>Recogintion and Co-operation</h2>
            <hr class="featurette-divider bg-dark" >
        </div>

        <div id="myCarousel2" class="carousel slide pb-lg-1" data-ride="carousel">

            <!-- Indicators -->
            <ul class="carousel-indicators">
            <li data-target="#myCarousel2" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel2" data-slide-to="1"></li>
            <li data-target="#myCarousel2" data-slide-to="2"></li>
            </ul>

            <!-- The slideshow -->
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active center">
                    <img src="{{asset('logos/1.jpeg')}}">
                </div>
                <div class="carousel-item center">
                    <img src="{{asset('logos/2.jpeg')}}" >
                </div>
                <div class="carousel-item center">
                    <img src="{{asset('logos/3.jpeg')}}" >
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#myCarousel2" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#myCarousel2" data-slide="next">
            <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div> --}}

</div>


    {{-- javascript for counter --}}
    <script>
        (function ($) {
            $.fn.countTo = function (options) {
                options = options || {};

                return $(this).each(function () {
                    // set options for current element
                    var settings = $.extend({}, $.fn.countTo.defaults, {
                        from:            $(this).data('from'),
                        to:              $(this).data('to'),
                        speed:           $(this).data('speed'),
                        refreshInterval: $(this).data('refresh-interval'),
                        decimals:        $(this).data('decimals')
                    }, options);

                    // how many times to update the value, and how much to increment the value on each update
                    var loops = Math.ceil(settings.speed / settings.refreshInterval),
                        increment = (settings.to - settings.from) / loops;

                    // references & variables that will change with each update
                    var self = this,
                        $self = $(this),
                        loopCount = 0,
                        value = settings.from,
                        data = $self.data('countTo') || {};

                    $self.data('countTo', data);

                    // if an existing interval can be found, clear it first
                    if (data.interval) {
                        clearInterval(data.interval);
                    }
                    data.interval = setInterval(updateTimer, settings.refreshInterval);

                    // initialize the element with the starting value
                    render(value);

                    function updateTimer() {
                        value += increment;
                        loopCount++;

                        render(value);

                        if (typeof(settings.onUpdate) == 'function') {
                            settings.onUpdate.call(self, value);
                        }

                        if (loopCount >= loops) {
                            // remove the interval
                            $self.removeData('countTo');
                            clearInterval(data.interval);
                            value = settings.to;

                            if (typeof(settings.onComplete) == 'function') {
                                settings.onComplete.call(self, value);
                            }
                        }
                    }

                    function render(value) {
                        var formattedValue = settings.formatter.call(self, value, settings);
                        $self.html(formattedValue);
                    }
                });
            };

            $.fn.countTo.defaults = {
                from: 0,               // the number the element should start at
                to: 0,                 // the number the element should end at
                speed: 1000,           // how long it should take to count between the target numbers
                refreshInterval: 100,  // how often the element should be updated
                decimals: 0,           // the number of decimal places to show
                formatter: formatter,  // handler for formatting the value before rendering
                onUpdate: null,        // callback method for every time the element is updated
                onComplete: null       // callback method for when the element finishes updating
            };

            function formatter(value, settings) {
                return value.toFixed(settings.decimals);
            }
        }(jQuery));

        jQuery(function ($) {
        // custom formatting example
        $('.count-number').data('countToOptions', {
            formatter: function (value, options) {
            return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
            }
        });

        // start all the timers
        $('.timer').each(count);

        function count(options) {
            var $this = $(this);
            options = $.extend({}, options || {}, $this.data('countToOptions') || {});
            $this.countTo(options);
        }
        });
    </script>

@endsection
