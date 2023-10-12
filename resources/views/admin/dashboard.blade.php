@extends('layouts')


@section('title', 'Dashboard Page')


@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">all blog related routes</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><a href="{{ Route('all_blogs') }}">All Blogs</a></li>
                            <li class="list-group-item"><a href="{{ Route('blog_form') }}">Create Blog</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">all category related routes</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><a href="{{ Route('all_categories') }}">All Category</a></li>
                            <li class="list-group-item"><a href="{{ Route('create_category') }}">Create Category</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
