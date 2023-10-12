@extends('layouts')


@section('title', 'login page')


@section('content')
    <div class="container col-4 mt-5">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-center">Login</h5>
                @if (Session::has('error'))
                    <p class="text-danger">{{ Session::get('error') }}</p>
                @endif
                <form action="{{ Route('login_post') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group">
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

                    <div class="form-check mt-3">
                        <input type="checkbox" name="checkbox" class="form-check-input" id="checkbox">
                        <label for="checkbox" class="form-check-label">Remember Me</label>
                    </div>

                    <input type="submit" value="Login" class="btn btn-primary mt-3">
                </form>
            </div>
        </div>
    </div>
@endsection
