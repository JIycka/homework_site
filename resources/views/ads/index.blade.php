@extends('layout')

@section('content')
    <h2>Ads:</h2>
    <br>
    @auth
        <p><a href="{{ route('ads.create') }}" type="button" class="btn btn-primary">Create Ad</a></p>
    @endauth
    @forelse($ad as $item)
        <p><a href="{{ route('ads.view', ['id' => $item->id]) }}" type="button"
              class="btn-link">{{$item->title}}</a></p>
        <figure>
            <blockquote class="blockquote">
                <p><h2><div>{{$item->user->name}}</div></h2></p>
                <p><div>{{$item->created_at}}</div></p>
            </blockquote>
        </figure>
        <p><div>{{ $item->description }}</div></p>

        @can('update', $item)
            <p><a href="{{ route('ads.edit', ['id' => $item->id]) }}" type="button"
                  class="btn btn-light">Edit</a>
        @endcan

        @can('delete', $item)
            <form action="{{ route('ads.destroy', ['id' => $item->id]) }}" method="post">
                @method('delete')
                @csrf
                <input type="submit" class="btn btn-light" value="Delete"/></p>
            </form>
        @endcan

    @empty
        <p>No Ads</p>
    @endforelse

    {{  $ad->links() }}
@endsection



