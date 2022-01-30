@extends('layouts.app')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif



<form  method="POST" action="{{route('posts.store')}}" enctype="multipart/form-data">

    {{ csrf_field() }}

<div class="form-group">
    <label for="exampleFormControlInput">Title</label>
    <input type="text" name="title" class="form-control" >
</div>
<div class="form-group">
    <label for="cover_image">Cover Image</label>
    <input type="file" name="cover_image" class="form-control">
</div>

<div class="form-group">
    <label for="exampleFormControlTextarea1">Post</label>
    <textarea class="summernote" name="body"></textarea>
</div>


<div class="form-group">
    <label for="magent-link">Magnet Link</label>
    <input type="text" name="magnet_link" class="form-control">
</div>
<div class="form-group">
    <label for="torrent_file">Torrent File</label>
    <input type="file" name="torrent_file" class="form-control">
</div>

<div class="form-group">
    <label for="fileUpload">Subtitles</label>
    <input type="file" name="subfile" class="form-control">
</div>






<input type="submit" value="Submit" class="btn btn-primary">


</form>

<script type="text/javascript">

    $(document).ready(function() {

      $('.summernote').summernote();

    });

</script>
@endsection