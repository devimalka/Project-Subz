@extends('layouts.app')

@section('content')

    @foreach ($posts as $post)

        <div class="card mb-3">
          
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{{ $post->body }}</p>
                <p class="card-text"><small class="text-muted">Uploaded by {{ $post->user->name }}</small></p>
                <p class="card-text"><small class="text-muted"><a href="posts/{{$post->id}}">Read more</a></small></p>
            </div>
        </div>

    @endforeach

@endsection
