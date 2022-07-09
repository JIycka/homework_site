@extends('layout')

@section('content')
    <h1>Edit {{$ad->title}}</h1>

    <form method="POST" action="{{ route('ads.update', ['ad' => $ad->id]) }}">
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <textarea class="form-control @error('title') is-invalid @enderror" id="title" name="title">{{ old('title', $ad->title) }}</textarea>

            @error('title')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="10">{{ old('description', $ad->description) }}</textarea>

            @error('description')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <input class="btn btn-primary" type="submit" value="Save"/>
        </div>
        @csrf
    </form>
@endsection
