@extends('layouts.app')

@section('content')
{{$user->firstname." ".$user->lastname}}

<ul class="list-group">
    @foreach ($user->post as $item)
    <a href="/posts/{{$item->id}}">    <li class="list-group-item">{{$item->title}}</li>
    </a>    
    @endforeach  
</ul>
  
@endsection