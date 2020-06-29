@extends('layouts.app')

@section('content')
    <style>
        card-header{
            color: black;
        }
        h3, h5, h6{
            color: black;
        }
    </style>
<div class="container">
  <div class="row justify-content-center">
   <div class="col-md-8">
       <div class="card">
          <div class="card-header"><a href="dashboard"><h5>Dashboard</h5></a></div>

            <div class="card-body">
               @if (session('status'))
                    <div class="alert alert-success" role="alert">
                         {{ session('status') }}
                    </div>
                @endif

        <h3>Categories List</h3>
            @if(count($categories) > 0 )
            <table class="table table-striped">
                <tr>
                    <th>Title</th>
                    <th></th>
                    <th></th>
                </tr>
                @foreach($categories as $cat)
                    <tr>
                        <td>{{$cat->category}}</td>
                        <td><a href="/categories/{{$cat->id}}/edit" class="btn btn-success">Edit</a></td>
                        <td>
                            <button type="button" class="btn btn-danger br2 btn-xs fs12"
                                    data-catid={{$cat->id}} data-toggle="modal" data-target="#delete">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </table>
                 @else
            <p>You have no posts</p>
                   @endif

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

                {!! Form::open(['action' => ['CategoriesController@doDelete', $cat->id ?? ''], 'method'=>'POST','class'=>'float-right'])!!}
                {{Form::hidden('id', isset($cat->id) ? $cat->id:'' ,['value' =>'','name' => 'id','id'=>'category_id'])}}
                <h6>Are you sure you want to delete this category?</h6>
                <h6>If YES make sure you've deleted posts under this category</h6>
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

        var button = $(event.relatedTarget)
        var cat_id = button.data('catid')
        var modal = $(this)

        modal.find('.modal-body #category_id').val(cat_id);
    })
</script>
@endsection
