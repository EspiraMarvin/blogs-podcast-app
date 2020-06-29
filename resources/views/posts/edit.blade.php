@extends('layouts.app')

@section('content')
    <h1>Edit Post</h1>
    {!! Form::open(['action' => ['PostsController@update',$post->id], 'method' => 'POST','enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        <div class="section">
            <label>Category</label>
            <select class="select2-single form-control" name="category_id">
                <option value="{{$post->category->id}}">{{$post->category->category}}</option>
                @foreach($categories as $cat)
                    <option value="{{$cat->id}}">{{$cat->category}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        {{Form::label('title','Title')}}
        {{Form::text('title',$post->title,['class' => 'form-control', 'placeholder' => 'Title'])}}
    </div>
    <div class="form-group">
        {{Form::label('body','Body')}}
        {{Form::textarea('body',$post->body,['id'=>'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body Text'])}}
    </div>
    <div class="form-group">
        {{Form::label('podcast','Podcast')}}<br>
        {{Form::file('audio',['id'=>'audio'])}}
    </div>
    <div class="form-group">
        {{Form::label('Image','Image')}}<br>
        {{Form::file('cover_image',['id'=>'cover_image'])}}
    </div>
    {{Form::hidden('_method','PUT')}}
    {{Form::submit('Submit', ['class'=>'btn btn-primary','id'=>'sub-btn'])}}
    {!! Form::close() !!}



    <script>
        $("#sub-btn").click(function(e) {
            var audio = document.getElementById('audio');
            var coverimg = document.getElementById("cover_image");

            let audioSize = audio.files[0].size;
            let coverSize = coverimg.files[0].size;

            if (audioSize > 2000000) {
                alert("Audio Size is exceeding 2 Mb");
                e.preventDefault();
            }

            if (coverSize > 2000000) {
                alert("Cover Image Size is exceeding 2 Mb");
                e.preventDefault();
            }
        });
    </script>
@endsection

