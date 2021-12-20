@extends('layouts.app')

@section('content')

<h2>{{$data->title}}</h2>
<a href="{{$data->path}}" download="{{$data->filename}}">download</a>
<p>Sub added by {{$data->user->name}}</p>

@if (Auth::id() == $data->user->id)
<button class="btn btn-alert">edit</button>  
@endif


@endsection