@extends('layouts')


@section('title', 'Blog Article')


@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <img src="{{ asset('storage' . '/' . $blog->thumbnail) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <small>Date: {{ $blog->created_at }}</small>
                        <h6>category: {{ $blog->category->name }}</h6>
                        <h5 class="card-title">{{ $blog->title }}</h5>
                        <p>{{ $blog->body }}</p>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <x-categories :catWBlog="$catWBlog" />

                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-head">latest Posts</h5>
                        <ul class="list-group">
                            @foreach ($latest as $post)
                                <li class="list-group-item"><a href="{{ Route('show_blog', $post->id) }}"
                                        class="text-decoration-none"><img
                                            src="{{ asset('storage' . '/' . $post->thumbnail) }}" class="img-thumbnail"
                                            width="50px"> {{ $post->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-head">Article Tags</h5>
                        @foreach ($blog->tags as $tagWithBlog)
                            <span><b><a
                                        href="{{ Route('blogs_with_tag', $tagWithBlog->name) }}">{{ $tagWithBlog->name }}</a></b></span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
