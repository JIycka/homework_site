@foreach($items as $post)
    {{ $post->name }}
    <br> Author: {{ $post->user->name }} <br>

    @foreach($post->tags as $tag)
        {{ $tag->name }}
    @endforeach
    <br>
    <h2>Comments</h2>
    @foreach($post->comments as $comment)
        <p><strong>{{ $comment->feedback }}, {{ $comment->user->name }}</strong></p>
    @endforeach
    <hr>
@endforeach
