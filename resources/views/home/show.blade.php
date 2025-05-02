
@extends('layouts.app')

@section('content')

<style>
    @media (min-width: 768px) {
        .blog-image {
            width: 65%;
            height: 65%;
            margin-top: 10px
        }
    }
</style>

    @include('home.services.elements.header_img', [
            'image' => 'images/image4.jpg',
            'caption' => 'DB Blogs'
        ])

    <div class="container">
        <div class="row justify-content-center">

            <main role="main" class="col-sm-12 col-lg-10 mx-5 my-5">

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="row ml-md-1 mr-md-3">
                        <div class="col-sm-12">
                            <div class="card mb-4 ml-md-2" >
                                    <div class=" mx-md-auto blog-image">
                                        <img class="card-img-top" src="{{ url("blog_images/$post->filename")}}" alt="Blog Post Image" >
                                    </div>
                                    <div class="card-body">
                                    <h2 class="card-title font-weight-bold" style="color:navy">{{ $post->title }}</h2>
                                    <!-- <p class="text-muted">posted at {{$post->created_at}} by admin</p> -->
                                    <p class="card-text lead">
                                        {{ $post->content }}
                                    </p>

                                    <a href="{{ url()->previous() }}" class="card-link btn btn-primary float-left mb-2 mr-4">Go back</a>

                                </div>

                            </div>

                        </div>

                </div>


            </main>
        </div>

    </div>

@endsection

