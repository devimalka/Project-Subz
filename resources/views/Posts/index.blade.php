@extends('layouts.app')

@section('content')

    @foreach ($posts as $post)

        <div class="card mb-3">
          
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{{Str::words(strip_tags($post->body,10))}}</p>
                <p class="card-text"><small class="text-muted">Uploaded by {{ $post->user->firstname }}</small></p>
                <p class="card-text"><small class="text-muted"><a href="posts/{{$post->id}}">Read more</a></small></p>
            </div>
        </div>

    @endforeach
   


    <div class="pagination">
        {!! $posts->links() !!}
    </div>

@endsection
