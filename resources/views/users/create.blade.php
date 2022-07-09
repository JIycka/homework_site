@extends('layout')

@section('content')
    <form method="post" action="{{ route('users.store') }}">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                   placeholder="John Smith" value="{{ old('name') }}">

            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                   placeholder="name@example.com" value="{{ old('email') }}">

            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                   name="password" placeholder="12345678">

            @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Password Confirmation</label>
            <input type="password_confirmation"
                   class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation"
                   name="password_confirmation" placeholder="12345678">

            @error('password_confirmation')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <input class="btn btn-primary" type="submit" value="Create"/>
        </div>
        @csrf
    </form>
@endsection
