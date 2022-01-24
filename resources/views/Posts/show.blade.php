@extends('layouts.app')

@section('content')

<h2 class="text-center">{{$post->title}}</h2>
<img src="{{asset('cover_images/'.$post->cover_image)}}" alt="Cover Image" class="img-fluid w-100">
<p>{!!$post->body!!}</p>
<a href="/posts/{{$post->id}}/download">download</a>
<a href="/posts/{{$post->id}}/tdownload">torrent download</a>

<p>Sub added by {{$post->user->name}}</p>



@if (Auth::id() == $post->user->id)
<button class="btn btn-primary"><a href="{{route('posts.edit',$post->id)}}">Edit</a></button>  
<form action="{{route('posts.destroy',$post->id)}}" method="POST">
    @csrf
    @method('DELETE')
<input type="submit" value="Delete" class="btn btn-primary">
</form>
@endif


@endsection