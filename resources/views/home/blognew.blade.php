@extends('layouts.app')
@section('title', 'Blog')
@section('content')
    <div class="container">
        <div class="row mt-2">
            <main role="main" class="m-auto">
                <section id="blog" class="blog">
                    <div class="container">
                          <h1 class="blog-header" style="display:flex;justify-content: center;font-family:'sans-serif';font-weight: 700;">{{$blogDetails->title}}</h1>
                        <div class="row">
                            <div class="col-lg-5 entries mt-4">
                                    <div class="entry-img">
                                        <img src="{{ asset('uploads/blog/'.$blogDetails->image) }}" alt="no image"
                                           style="width:450px;height:600px; object-fit:fill;"
                                             title="{{$blogDetails->title}}" keyword="{{$blogDetails->meta_keyword}}" meta-description="{{$blogDetails->meta_description}}"
                                        />
                                    </div>
                                 <!-- End blog entry -->
                            </div><!-- End blog entries list -->
                            <div class="col-lg-7">
                                <article class="">
                                    <div class="entry-content">
                                        <p>
                                            {!! $blogDetails->description !!}
                                        </p>
                                </article>
                            </div><!-- End blog sidebar -->

                        </div>
                    </div>
                </section>
            </main>
        </div>
    </div>
@endsection
