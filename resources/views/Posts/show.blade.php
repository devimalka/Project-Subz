@extends('layouts.app')

@section('content')

<h2 class="text-center">{{$post->title}}</h2>
<img src="{{asset('cover_images/'.$post->cover_image)}}" alt="Cover Image" class="img-fluid w-100">
<p>{!!$post->body!!}</p>
<a class="btn btn-warning bi bi-download" href="/posts/{{$post->id}}/download">Download Subtitle</a>

<a class="btn btn-success" href="/posts/{{$post->id}}/tdownload">Download Torrent</a>

<p>Sub added by {{$post->user->name}}</p>


@if (Auth::id() == $post->user->id)
<button class="btn btn-primary"><i class="fas fa-download"></i><a  href="{{route('posts.edit',$post->id)}}">Edit</button>  </a>
<form action="{{route('posts.destroy',$post->id)}}" method="POST">
    @csrf
    @method('DELETE')
<input type="submit" value="Delete" class="btn btn-primary">
</form>
@endif


@endsection