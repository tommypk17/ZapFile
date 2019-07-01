@extends('layouts.app')

@section('content')
    <h1>Edit File</h1>
    {!!Form::open(['action' => ['FilesController@update', $file->unique_id], 'method' => 'POST']) !!}
    <div class="form-group">
        {{Form::label('title', 'Title')}}
        {{Form::text('title', $file->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
    </div>
    <div class="form-group">
        {{Form::label('description', 'File Description')}}
        {{Form::textarea('description', $file->description, ['class' => 'form-control', 'placeholder' => 'File Description', 'id' => 'article-ckeditor'])}}
    </div>
    <div class="form-group">
        {{Form::label('private', 'Make file private')}}
        {{ Form::hidden('private', 0) }}
        {{ Form::checkbox('private', 1, $file->private)}}
    </div>
    {{Form::hidden('_method', 'PUT')}}
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection