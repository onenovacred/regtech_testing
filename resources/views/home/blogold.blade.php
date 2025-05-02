@extends('layouts.app')

@section('title', 'Blog')


@section('content')

    @include('home.services.elements.header_img', [
        'image' => 'images/image4.jpg',
        'caption' => 'DB Blogs'
    ])


<div class="container">
    <div class="row">

        <main role="main" class="col-12 m-auto">
            <div class="d-flex justify-content-between  align-items-center pt-2 pb-2 mb-3 border-bottom">
                <h1>All Posts</h1>
            </div>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <div class="row ml-md-1 mr-md-3">
                @foreach($posts as $post)
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card mb-4 ml-md-2">
                            <img class="card-img-top h-25" src="{{ url("blog_images/$post->filename")}}" alt="Blog Post Image">                            <div class="card-body">
                                <h5 class="card-title font-weight-bold">{{ $post->title }}</h5>
                                <p class="text-muted">posted at {{$post->created_at}} by admin</p>
                                <p class="card-text lead">
                                    {{ \Illuminate\Support\Str::limit($post->content, 200, "\r\n\n .....") }}
                                </p>

                                <a href="{{ route('blog.show', $post->id) }}" class="card-link btn btn-primary float-left mb-2 mr-4 font-weight-bold">Read More</a>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


        </main>
    </div>

    {!! $posts->links("pagination::bootstrap-4") !!}
</div>

   {{-- <div class="container pt-5 pb-4 pl-sm-0 pl-md-5">
    <div class="pl-4">
        <div class="card text-center" style="width: 18rem;">
            <img src="{{asset('images/1.jpg')}}" class="card-img-top">
            <div class="card-body">
                <h3 class="font-weight-bold">How we do e-kyc ?</h3>
                <span class="text-muted">By admin</span>
                <p class="card-text" style="font-size: 14px"> <strong><span class="text-dark">Nach andHandle your recurring payments and schedule your premium payments easily using our e-Nach Service.</span></strong> <br>
                    <span>Our simple online process helps customers to keep track of individual premium payments.
                        DocBoyz is well reputed in providing easier, cheaper, faster and safer paperless transaction between banks and customers.
                        Our Nach platform provides simple dashboard, rest API and mobile SDKs for easy management of subscritptions, mandates, payments and settlements.
                        We help customers to create plans for variable amounts and ad-hoc payments. Our e- e-Mandates do not involve cheques, cash, and digital wallets.
                    </span>
               </p>
            </div>
        </div>
    </div>
   </div> --}}

@endsection
