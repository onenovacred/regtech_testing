@extends('layouts.app')

@section('title', 'Blog')
<style>
    /* .square:hover {
        -webkit-transform: translate(20px, -10px);
        -ms-transform: translate(10px, -10px);
        transform: translate(10px, -10px);
        -webkit-box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
    } */
    .square {
        width: 390px;
        height:auto;
        background: white;
        border-radius: 4px;
        box-shadow: 0px 0px 14px #D9DBDF;
        -webkit-transition: all 0.3s ease;
        -o-transition: all 0.3s ease;
        transition: all 0.3s ease;
    }

    .title {
        text-align: left;
        padding-left: 30px;
        font-family: 'Merriweather', serif;
        margin: auto;
        font-size: 24px;
    }

    p {
        text-align: justify;
        padding-left: 30px;
        padding-right: 30px;
        font-family: 'Open Sans', sans-serif;
        font-size: 18px;
        color: #626262;
        line-height: 18px;
    }

    

    .card-paragraph {
        font-size: 16px;
        line-height: 1.5;
        margin: auto;
    }

    .image_size {
        min-width: 388px;

    }
    .button {
            position: relative;
            display: block;
            font-size: 14px;
            line-height: 26px;
            font-family: 'Lexend', sans-serif;
            font-weight: 700;
            text-transform: uppercase;
            text-align: center;
            background-color:#e5c6c6;
            color: #1e2434;
            padding: 13.5px 30px;

        }
    @media screen and (max-width: 768px) {
        .square:hover {
            -webkit-transform: translate(20px, -10px);
            -ms-transform: translate(10px, -10px);
            transform: translate(10px, -10px);
            -webkit-box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
        }

        .square {
            width: 390px;
            height:auto;
            background: white;
            border-radius: 4px;
            margin-left: 13px;
            box-shadow: 0px 0px 14px #D9DBDF;
            -webkit-transition: all 0.3s ease;
            -o-transition: all 0.3s ease;
            transition: all 0.3s ease;
        }

        .title {
            text-align: left;
            padding-left: 30px;
            font-family: 'Merriweather', serif;
            margin: auto;
            font-size: 24px;
        }

        p {
            text-align: justify;
            padding-left: 30px;
            padding-right: 30px;
            font-family: 'Open Sans', sans-serif;
            font-size: 18px;
            color: #626262;
            line-height: 18px;
        }

        .button {
            position: relative;
            display: block;
            font-size: 14px;
            line-height: 26px;
            font-family: 'Lexend', sans-serif;
            font-weight: 700;
            text-transform: uppercase;
            text-align: center;
            background-color:#e5c6c6;
            color: #1e2434;
            padding: 13.5px 30px;

        } 
         .card-paragraph {
            font-size: 16px;
            line-height: 1.5;
            margin: auto;
        }

        .image_size {
            min-width: 388px;
         }

    }
</style>
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                    <div class="pt-2 pb-2 mb-2">
                        <h1 class="text-center">OUR BLOG</h1>
                    </div>
                    <div class="row ml-md-1 mr-md-3">
                        @if (isset($blogs))
                            @foreach ($blogs as $item)
                                <div class="square card mb-3 ml-md-3">
                                    <img src="{{ asset('uploads/docblog/' . $item->image) }}" class="image_size">
                                    <div class="title">{{ $item->title }}</div>
                                    <p class="card-paragraph">
                                        {{ $item->meta_description }}
                                    </p>
                                    <div><a href="{{ url('docblog_details', $item->id) }}" target="__blank"
                                            class="button">Read More</a></div>
                                </div>
                            @endforeach
                        @endif
                    </div>
            </div>
        </div>
    </div>
@endsection
