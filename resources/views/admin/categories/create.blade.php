@extends('layouts')


@section('title', 'Dashboard Page')


@section('content')
    <div class="container col-6 mt-5">
        <div class="card">
            <div class="card-body">
                <form action="{{ Route('store_category') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="name">Category Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control"
                            placeholder="Enter Category Name">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <input type="submit" value="add category" class="btn btn-primary mt-3">
                </form>
            </div>
        </div>
    </div>
@endsection
