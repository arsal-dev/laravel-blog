@extends('layouts')


@section('title', 'register page')


@section('content')
    <div class="container col-4 mt-5">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-center">Register</h5>
                @if (Session::has('error'))
                    <p class="text-danger">{{ Session::get('error') }}</p>
                @endif
                <form action="{{ Route('register_post') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" placeholder="name" class="form-control"
                            value="{{ old('name') }}">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" placeholder="email" class="form-control"
                            value="{{ old('email') }}">
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="password" class="form-control">
                        @error('password')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" id="confirm_password" name="password_confirmation"
                            placeholder="confirm_password" class="form-control">
                    </div>

                    <input type="submit" value="Register" class="btn btn-primary mt-3">
                </form>
            </div>
        </div>
    </div>
@endsection
