@extends('layouts')


@section('title', 'Create Blog Page')


@section('content')
    <div class="container col-6 mt-5">
        <form action="{{ Route('blog_post') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="form-group m-3">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" class="form-control">
                @error('title')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group m-3">
                <label for="excerpt">Excerpt</label>
                <textarea name="excerpt" id="excerpt" cols="30" rows="5" class="form-control">{{ old('excerpt') }}</textarea>
                @error('excerpt')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group m-3">
                <label for="body">Body</label>
                <textarea name="body" id="body" cols="30" rows="10" class="form-control">{{ old('body') }}</textarea>
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
            </div>

            <div class="form-group m-3">
                <select class="form-select" name="category_id">
                    <option selected>Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group m-3">
                <label for="tags">Add Tags (comma-separated)</label>
                <input type="text" class="form-control" id="tags" name="tags" placeholder="html,css,javascript">
            </div>

            <input type="submit" value="create post" class="btn btn-primary m-3">
        </form>
    </div>
@endsection
