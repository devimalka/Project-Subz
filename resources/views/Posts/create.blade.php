@extends('layouts.app')

@section('content')



<form  method="POST" action="{{route('posts.store')}}" enctype="multipart/form-data">

    {{ csrf_field() }}

<div class="form-group">
    <label for="exampleFormControlInput">Title</label>
    <input type="text" name="title" class="form-control" >
</div>
<div class="from-group">
    <label for="cover_image">Cover Image</label>
    <input type="file" name="cover_image" class="from-control">
</div>

<div class="form-group">
    <label for="exampleFormControlTextarea1">Post</label>
    <textarea class="summernote" name="body"></textarea>
</div>


<div class="form-group">
    <label for="magent-link">Magnet Link</label>
    <input type="text" name="magnet_link" class="form-control">
</div>
<div class="from-group">
    <label for="torrent_file">Torrent File</label>
    <input type="file" name="torrent_file" class="from-control">
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

<script type="text/javascript">

    $(document).ready(function() {

      $('.summernote').summernote();

    });

</script>
@endsection