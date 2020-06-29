@extends('layouts.app')

@section('content')
    <h1>Edit Post</h1>
    {!! Form::open(['action' => ['CategoriesController@update',$category->id], 'method' => 'POST','enctype' => 'multipart/form-data']) !!}

    <div class="form-group">
        {{Form::label('Category','Category')}}
        {{Form::text('category',$category->category,['class' => 'form-control', 'placeholder' => 'Category'])}}
    </div>

    {{Form::hidden('_method','PUT')}}
    {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}

@endsection

