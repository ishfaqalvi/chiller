@extends('web.layout.app')

@section('title')
    ChillerWise | Blogs
@endsection

@section('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/blog.css') }}">
@endsection

@section('content')
<section id="section-template--8" class="page-width">
    <div class="wrapper-container">
        @foreach ($blogs as $blog)
        <div class="wrapper-item">
            <a href="{{ route('web.blogs.show', $blog->id) }}" class="img-box">
                <img class="card-img rounded-0" src="{{ $blog->thumbnail }}" alt="Suresh Dasari Card"
                    width="100%" height="100%">
            </a>
            <div class="wrapper-content">
                <div class="wrapper-content-text">
                    <a href="{{ route('web.blogs.show', $blog->id) }}">
                        <h4 class="card-title">
                            {{ $blog->title }}
                        </h4>
                    </a>
                    <p class="card-text">
                        {{ $blog->description }}
                    </p>
                </div>
                <div>
                    <a href="{{ route('web.blogs.show', $blog->id) }}" class="read-more">
                        Read more <i class="fa fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection
