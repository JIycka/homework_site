@extends('layout')

@section('content')
    <h1>View {{$ad->title}}</h1>

    <div class="mb-3">
        <span>Title:</span>
        <textarea class="form-control @error('title') is-invalid @enderror" id="title" name="title">{{ old('title', $ad->title) }}</textarea>
    </div>

    <div class="mb-3">
        <span>Description:</span>
        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="10">{{ old('description', $ad->description) }}</textarea>
    </div>

@endsection
