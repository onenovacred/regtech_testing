{{-- header img and Caption
     included in blog, careers, contactus pages --}}


<div>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{asset($image)}}" width="100%" height="350" style="filter: brightness(75%);">
                <div class="carousel-caption">
                    <h1 class="display-4 text-white my-sm-5">@isset($caption)
                        {{ $caption }}
                    @endisset</h1>
                </div>
            </div>
        </div>
    </div>
</div>
