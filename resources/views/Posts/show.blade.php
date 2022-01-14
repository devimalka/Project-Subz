@extends('layouts.app')

@section('content')

<h2>{{$data->title}}</h2>
<a href="/posts/{{$data->id}}/download">download</a>
<p>Sub added by {{$data->user->name}}</p>




@if (Auth::id() == $data->user->id)
<button class="btn btn-alert"><a href="{{route('posts.edit',$data->id)}}">Edit</a></button>  
<form action="{{route('posts.destroy',$data->id)}}" method="POST">
    @csrf
    @method('DELETE')
<input type="submit" value="Delete"></form>
@endif


@endsection