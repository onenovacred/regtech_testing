@extends('layouts.app')

@section('content')
<style>
.blog-card-img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    object-position: center;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
}

.card {
    height: 100%;
    display: flex;
    flex-direction: column;
}

.card-body {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.card-text {
    flex-grow: 1;
}

.btn {
    margin-top: auto;
}
</style>

<div class="container">
    <div class="row">
        @foreach($blogs as $blog)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <img src="{{ $blog->image ? asset('uploads/blog/' . $blog->image) : asset('images/default.png') }}"
                         alt="{{ $blog->title }}"
                         class="card-img-top blog-card-img">
                    <div class="card-body">
                        <h5 class="card-title">{{ Str::limit($blog->title, 50) }}</h5>
                        <p class="card-text">{{ Str::limit($blog->description, 100) }}</p>
                        <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-primary">View Blog</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center">
        {{ $blogs->links() }}
    </div>
</div>
@endsection
