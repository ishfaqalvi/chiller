@extends('web.layout.app')

@section('title')
    ChillerWise | {{ $blog->title }}
@endsection

@section('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/blog-post.css') }}">
@endsection

@section('content')
    <section class="post-banner">
        <img src="{{ asset('assets/web/images/industry-factory.png') }}" alt="banner img" width="100%" height="auto">
    </section>
    <section id="section-template--13" class="page-width">
        <div class="wrapper-container">
            <div class="post-content">
                <h6>{{ $blog->title }}</h6>
                <p>{{ $blog->description }}</p>
                {!! $blog->detail !!}
            </div>
        </div>
    </section>
    <section class="blog-btns">
        <div class="wrapper-container">
            <div class="btns-wrap">
                <div class="prevous-btn">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    @if (isset($previousBlog))
                        <a href="{{ route('web.blogs.show', $previousBlog->id) }}">Prevous Blog Post</a>
                    @else
                        <a href="javascript:;">Prevous Blog Post</a>
                    @endif
                </div>
                <div class="next-btn">
                    @if (isset($nextBlog))
                        <a href="{{ route('web.blogs.show', $nextBlog->id) }}">Next Blog Post</a>
                    @else
                        <a href="javascript:;">Next Blog Post</a>
                    @endif
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                </div>
            </div>
        </div>
    </section>
    <section id="section-template--8" class="page-width">
        <div class="wrapper-container">
            <div class="blog-wrap">
                @foreach ($latestBlogs as $blog)
                <div class="wrapper-item">
                    <a href="{{ route('web.blogs.show',$blog->id) }}" class="img-box">
                        <img class="card-img rounded-0" src="{{ $blog->thumbnail }}" alt="Suresh Dasari Card" width="100%"
                            height="100%">
                    </a>
                    <div class="wrapper-content">
                        <div class="wrapper-content-text">
                            <a href="{{ route('web.blogs.show',$blog->id) }}">
                                <h4 class="card-title">{{ $blog->title }}</h4>
                            </a>
                            <p class="card-text">{{ $blog->description }}</p>
                        </div>
                        <div>
                            <a href="{{ route('web.blogs.show',$blog->id) }}" class="read-more">
                                Read more <i class="fa fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="blog-btn">
                <a href="{{ route('web.blogs.index') }}" class="btn-viewmore">View all blogs</a>
            </div>
        </div>
    </section>
@endsection
