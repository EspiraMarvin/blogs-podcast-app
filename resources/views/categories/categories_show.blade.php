@extends('layouts.app')

@section('content')

    <style>
        small{
            color: black;
        }
    </style>
    <h1>{{$category->category}}</h1>

    @if(count($posts) > 0 )
        @foreach($posts as $post)
            <div class="card card-body">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <h3 class=""><a style="text-decoration: none" href="/posts/{{$post->category_id}}">{{$post->title}}</a></h3>
                        @if(!empty($post->audio))
                            <audio role="slider" class="mt-2 col-md-8"
                                   id="player2" preload="none"controls style="width: 100%; background: black; box-sizing: border-box;">
                                <source src="/storage/audio_files/{{$post->audio}}" type="audio/mp3">
                            </audio>
                        @endif<br>
                        <small class="">By {{$post->user->name}}. Category ({{$post->category->category}})</small><br>
                        <small>Written on {{$post->created_at}}</small>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="offset-5">{{$posts->links()}}</div>
    @else
        <p>No posts Found</p>
    @endif
@endsection


