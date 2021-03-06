@extends('layouts.app')

@section('content')



<form  method="POST" action="{{route('posts.update',$post->id)}}" enctype="multipart/form-data">

    {{ csrf_field() }}

<div class="form-group">
    <label for="exampleFormControlInput">Title</label>
    <input type="text" name="title" class="form-control" >
</div>

<div class="form-group">
    <label for="exampleFormControlTextarea1">Post</label>
    <textarea name="body" class="form-control" cols="30" rows="10"></textarea>
</div>

<div class="form-group">
    <label for="fileUpload">Subtitles</label>
    <input type="file" name="subfile" class="form-control-file">
</div>

@foreach ($categories as $category)
<div class="form-check">
    <input type="radio" name="category" class="form-check-input" value="{{$category->id}}">
    <label class="form-check-label" for="exampleRadios1">
        {{$category->name}}
      </label>
</div>
    
@endforeach




<input type="submit" value="Submit" class="btn btn-primary">

</form>


    
@endsection