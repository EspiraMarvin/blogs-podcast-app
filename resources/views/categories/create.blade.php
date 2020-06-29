
@extends('layouts.app')

@section('content')

    <h1>Add Category</h1>
    {!! Form::open(['action' => 'CategoriesController@store', 'method' => 'POST','enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('category','Category')}}
        {{Form::text('category','',['class' => 'form-control', 'placeholder' => 'Add Category'])}}
    </div>
    {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}


@endsection

