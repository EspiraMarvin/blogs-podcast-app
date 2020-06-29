@extends('layouts.app')

@section('content')
    <style>
        h5, h6{
            color: black;
        }
    </style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h5>Dashboard</h5></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <div class="row">
                            <span style="display: inline;">
                                <a href="/posts/create" ><button style="height: 40px;border-radius: 5px" class="btn-sm btn-primary">Create Post</button></a>
                                <a href="/categories/create"><button style="height: 40px;border-radius: 5px" class="btn-sm btn-primary">Add Category</button></a>
                                <a href="/listCat"><button style="height: 40px; border-radius: 5px" class="btn-sm btn-primary">Category List</button></a>
                            </span>
                        </div>

                        <h3>Your Blog Posts</h3>
                        @if(isset($posts) > 0 ?? '')
                            <table class="table table-striped">
                                <tr>
                                    <th>Title</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                @foreach($posts as $post)
                                    <tr>
                                        <td>{{$post->title}}</td>
                                        <td><a href="/posts/{{$post->id}}/edit" class="btn btn-success">Edit</a></td>
                                        <td>
                                            <button type="button" class="btn btn-danger br2 btn-xs fs12"
                                                    data-postid="{{$post->id}}" data-toggle="modal" data-target="#delete">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                            <p>You have no posts</p>
                        @endif
                        <div style="text-align: center">
                            {{$posts->links()}}
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal Delete-->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div style="background-color: lightpink" class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalCenter">
                    Delete Confirmation
                </h5>
                <button style="font-size: 30px; margin-top: -30px" type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div style="text-align: center" class="modal-body">
                {!! Form::open(['action' => ['PostsController@doDelete', $post->id ?? ''], 'method'=>'POST','class'=>'float-right'])!!}
                {{Form::hidden('id', isset($post->id) ? $post->id:'' ,['value' =>'','name' => 'id','id'=>'post_id'])}}
                <h6>Are you sure you want to delete this post?</h6>
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button> &nbsp;&nbsp;
                    <input class="btn btn-danger" type="submit" name="SUBMIT" value="Yes Delete" onclick="this.value='Deleting ..';this.disabled='disabled'; this.form.submit();" />
                </div>
                {{Form::hidden('_method','PUT')}}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<!-- /Modal -->
<script>
    $('#delete').on('show.bs.modal', function (event) {

        // console.log('modal opened')
        var button = $(event.relatedTarget)
        var post_id = button.data('postid')
        var modal = $(this)

        modal.find('.modal-body #post_id').val(post_id);
    })

</script>

@endsection
