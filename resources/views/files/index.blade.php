@extends('layouts.app')

@section('content')
<h1>Files</h1>
    @if(count($files) > 0)
        @foreach($files as $file)
            <div class="card card-body bg-light">
                <h3><a href="/files/{{$file->unique_id}}">{{$file->title}}</a></h3>
                <small>Uploaded on {{$file->created_at}} by {{$file->user->name}}</small>
            </div>
        @endforeach
    @else
        <p>No Files Found!</p>
    @endif
@endsection