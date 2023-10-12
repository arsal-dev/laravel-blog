@extends('layouts')


@section('title', 'Create Blog Page')


@section('content')
    <div class="container col-6 mt-5">
        <form action="{{ Route('update_blog', $blog->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group m-3">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="{{ old('title', $blog->title) }}"
                    class="form-control">
                @error('title')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group m-3">
                <label for="excerpt">Excerpt</label>
                <textarea name="excerpt" id="excerpt" cols="30" rows="5" class="form-control">{{ old('excerpt', $blog->excerpt) }}</textarea>
                @error('excerpt')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group m-3">
                <label for="body">Body</label>
                <textarea name="body" id="body" cols="30" rows="10" class="form-control">{{ old('body', $blog->body) }}</textarea>
                @error('body')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group m-3">
                <label for="thumbnail">Thumbnail</label>
                <input type="file" name="thumbnail" class="form-control">
                @error('thumbnail')
                    <p class="text-danger">{{ $message }}</p>
                @enderror

                <img src="{{ asset('storage/' . $blog->thumbnail) }}" class="img-thumbnail">
            </div>

            <input type="submit" value="update post" class="btn btn-primary m-3">
        </form>
    </div>
@endsection
