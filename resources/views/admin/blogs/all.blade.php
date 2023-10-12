@extends('layouts')


@section('title', 'all blogs Page')


@section('content')
    <div class="container col-6 mt-5">
        <div class="card">
            <div class="card-body">
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ Session::get('success') }}.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">thumbnail</th>
                            <th scope="col">title</th>
                            <th scope="col">excerpt</th>
                            <th scope="col">category</th>
                            <th scope="col">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($blogs as $blog)
                            <tr>
                                <th scope="row">{{ $blog->id }}</th>
                                <th scope="row"><img src="{{ asset('storage/' . $blog->thumbnail) }}"
                                        class="img-thumbnail" width="200px">
                                </th>
                                <th scope="row">{{ $blog->title }}</th>
                                <th scope="row">{{ $blog->excerpt }}</th>
                                <th scope="row">{{ $blog->category->name }}</th>
                                <th scope="row">
                                    <a class="btn btn-warning" href="{{ Route('edit_blog', $blog->id) }}">UPDATE</a>
                                    <form action="{{ Route('delete_blog', $blog->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <input type="submit" value="DELETE" class="btn btn-danger">
                                    </form>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
