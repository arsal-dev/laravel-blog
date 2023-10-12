@extends('layouts')


@section('title', 'Categories with blog Page')


@section('content')
    <div class="container mt-5">

        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif

        <div class="row">
            <div class="col-8">
                @if (empty($category[0]->blogs))
                    <h4 class="text-center">No Blog Posts Exists!</h4>
                @else
                    @foreach ($category[0]->blogs as $blog)
                        <div class="card mb-5">
                            <a href="{{ Route('show_blog', $blog->id) }}">
                                <img src="{{ asset('storage' . '/' . $blog->thumbnail) }}" class="card-img-top"
                                    alt="{{ $blog->title }}">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">{{ $blog->title }}</h5>
                                <p>{{ $blog->excerpt }}</p>
                                <a href="{{ Route('show_blog', $blog->id) }}" class="btn btn-primary">View Blog</a>
                            </div>
                            <div class="card-footer">
                                <small>Date: {{ $blog->created_at }}</small>
                                <h6>Category: {{ $blog->category->name }}</h6>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-head">Categories</h5>
                        <ul class="list-group">
                            @foreach ($catWBlog as $category)
                                @if ($category->id == $category_id)
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <a href="{{ Route('blogs_with_category', $category->id) }}"
                                                class="text-decoration-none text-secondary">
                                                <div class="fw-bold">{{ $category->name }}</div>
                                            </a>
                                        </div>
                                        <span class="badge bg-primary rounded-pill">{{ count($category->blogs) }}</span>
                                    </li>
                                @else
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <a href="{{ Route('blogs_with_category', $category->id) }}"
                                                class="text-decoration-none">
                                                <div class="fw-bold">{{ $category->name }}</div>
                                            </a>
                                        </div>
                                        <span class="badge bg-primary rounded-pill">{{ count($category->blogs) }}</span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>

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
            </div>
        </div>

    </div>
@endsection
