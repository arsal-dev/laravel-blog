@extends('layouts')


@section('title', 'all categories Page')


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
                <a href="{{ Route('create_category') }}" class="text-decoration-none">add category</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">name</th>
                            <th scope="col">create at</th>
                            <th scope="col">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <th scope="row">{{ $category->id }}</th>
                                <th scope="row">{{ $category->name }}</th>
                                <th scope="row">{{ $category->created_at }}</th>
                                <th scope="row"><a class="btn btn-warning"
                                        href="{{ Route('edit_category', $category->id) }}">UPDATE</a>

                                    <form action="{{ Route('delete_category', $category->id) }}" method="POST"
                                        class="d-inline">
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
