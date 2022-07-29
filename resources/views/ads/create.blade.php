@extends('layout')

@section('content')
    <h2>Ads:</h2>
    <form method="post" action="{{ route('ads.store')}}">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <textarea class="form-control @error('title') is-invalid @enderror" id="title" name="title">{{ old('title') }}</textarea>

            @error('title')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="10">{{ old('description') }}</textarea>

            @error('description')
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


