@extends('layouts.app')

@section('content')
    <style>
        h6 {
            color: black;
        }
    </style>

{{--    <div class="toggle mt-5 float-right"></div>--}}

    <a href="/posts" class="btn btn-danger">Go Back</a>
    <br>
    <h1 class="text-center">{{$post->title}}</h1>
    <div>
    @if(($post->cover_image) != "noimage.jpg")
            <img class="embed-responsive" style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
    </div>
    @endif

    @if(!empty($post->audio))
    <div class="container col-10 mt-3" style="height: 70px;background-color: black">
        <audio role="slider" class="mt-2"
            id="player2" preload="none"controls style="width: 100%; background: black;
            box-sizing: border-box;">
            <source src="/storage/audio_files/{{$post->audio}}" type="audio/mp3">
        </audio>
    </div><br>
    @endif

    <div class="mt-3" id="dark">
        {!!$post->body!!}
    </div>
    <hr>
    <small>Written on {{$post->created_at}} by {{$post->user->name}}. Category ({{$post->category->category}})</small>

        <hr>

        @if(!Auth::guest())
            @if(Auth::user()->id == $post->user_id)
                <a href="/posts/{{$post->id}}/edit" class="btn btn-success">Edit</a>

{{--              deleting (we can't just add a link--}}
{{--                - we need to make a post request and spoof it with a delete that we did with the PUT in update--}}
                <button type="button" class="btn btn-danger br2 btn-xs fs12 float-right" data-toggle="modal" data-target="#delete">Delete</button>
        @endif
    @endif


    <!-- Modal Delete-->
    <div class="modal fade modal" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div style="background-color: lightpink" class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenter">
                        Delete Confirmation
                    </h5>
                    <button style="font-size: 30px; margin-top: -30px" type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div style="text-align: center"class="modal-body">
                    {!! Form::open(['action' => ['PostsController@destroy', $post->id ?? ''], 'method'=>'POST','class'=>'float-right'])!!}
                    {{Form::hidden('_method','DELETE')}}
                    <h6 >Are you sure you want to delete this post?</h6>
                    <div class="modal-footer text-center">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button> &nbsp;&nbsp;
                        <input class="btn btn-danger" type="submit" name="SUBMIT" value="Yes Delete" onclick="this.value='Deleting ..';this.disabled='disabled'; this.form.submit();" />
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <!-- /Modal -->

    <script>
        $('#delete').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget)
            var post_id = button.data('postid')
            var modal = $(this)

            modal.find('.modal-body #post_id').val(post_id);
        })

    </script>
@endsection
