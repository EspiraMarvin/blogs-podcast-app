@extends('layouts.app')

@section('content')
        <style>
            small{
                color: black;
            }
        </style>

        <div class="mt-2"><h1>Posts</h1></div>
        <div class="toggle mt-4 float-right"></div>

        @if(count($posts) > 0 )
        @foreach($posts as $post)
            <div class="card card-body mt-3">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <img class="embed-responsive" style="width:100%; max-height: 209px" src="/storage/cover_images/{{$post->cover_image}}">
                    </div>
                    <div class="col-md-8 col-sm-8 mt-2">
                    <h3 class=""><a style="text-decoration:none" href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                        @if(!empty($post->audio))
                            <audio role="slider" class="mt-2 col-md-8"
                                   id="player2" preload="none"controls style="width: 100%; background: black; box-sizing: border-box;">
                                <source src="/storage/audio_files/{{$post->audio}}" type="audio/mp3">
                            </audio>
                        @endif<br>

                    <small>By {{$post->user->name}}. Category ({{$post->category->category ?? ''}})</small><br>
                    <small>Written on {{$post->created_at}}</small>
                    </div>
                </div>
            </div>
         @endforeach
        <div class="offset-8">
            {{$posts->links()}}
        </div>
    @else
        <p>No posts Found</p>
    @endif
@endsection

