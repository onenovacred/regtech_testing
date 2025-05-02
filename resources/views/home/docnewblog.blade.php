@extends('layouts.app')
@section('title',$blogDetails->page_title)
<meta name="keywords" content="{{$blogDetails->meta_keyword}}">
<meta name="description" content="{{$blogDetails->meta_description}}">
<style>
    .main-container {
        text-align: center;
        padding: 15px;
    }

    .main-image {
        width: 76%;
        max-height: 482px;
        display: block;
        margin: 0 auto;
        object-fit: inherit;

    }

    .details_description {
        padding-top: 15px;
        padding-right: 194px;
        padding-left: 194px;
        text-align: justify;
    }

    .details_description p h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    span {
        text-align: justify;
    }

    .title-container {
        text-align: center;
        padding: 10px;
        margin-right: 14px;
        margin-left: 14px;
    }

    .main-title  h1{
        padding-top: 12px;
        font-weight:600 !important;
    }

    @media screen and (max-width: 768px) {
        .main-container {
            text-align: center;
            padding: 15px;
        }

        .main-image {
            width: 100%;
            max-height: 482px;
            display: block;
            margin: 0 auto;
            object-fit: inherit;

        }

        .title-container {
            text-align: center;
            padding: 15px;
            background-color: #f6f7f9;
            margin-right: 14px;
            margin-left: 14px;
        }

        .details_description {
            padding: 15px;
            text-align: justify;

        }

        .details_description p h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        span {
            text-align: justify;
        }

        .main-title h1 {
            padding-top: 12px;
            font-weight:600 !important;
        }
    }
</style>
@section('content')
    <div class="container-fluid">
        <div class="row mt-2">
            <main role="main" class="m-auto">
             <section id="blog" class="blog">
                    <div class="row">
                        <div class="col-lg-12  col-md-12 col-sm-12">
                            <div class="main-container">
                                <img src="{{ asset('uploads/docblog/' . $blogDetails->image) }}" alt="{{$blogDetails->alt_text}}"
                                    title="{{ $blogDetails->title_image }}"
                                     class="main-image" />
                            </div>
                        </div><!-- End blog entries list -->
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="title-container">
                                <div class="main-title">
                                    <h1>{{ $blogDetails->page_title}}</h1>
                                </div>
                            </div>
                        </div><!-- End blog sidebar -->
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <article class="">
                                <div class="details_description">
                                    <p>
                                        {!! $blogDetails->description !!}
                                    </p>
                                </div>
                            </article>
                        </div><!-- End blog sidebar -->
                    </div>
                </section>
            </main>
        </div>
    </div>
@endsection
