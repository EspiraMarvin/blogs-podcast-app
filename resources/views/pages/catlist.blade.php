@extends('layouts.app')

@section('content')
    <h1>{{$title}}</h1>
    @if(count($catlists) > 0)
       @foreach($catlists as $catlist)
           <ul class="list-group">
               <li class="list-group-item">{{$catlist}}</li>
           </ul>
       @endforeach
    @endif
@endsection
