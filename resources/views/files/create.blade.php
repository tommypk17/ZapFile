@extends('layouts.app')

@section('content')
    <h1>Upload File</h1>
    {!!Form::open(['action' => 'FilesController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('description', 'File Description')}}
            {{Form::textarea('description', '', ['class' => 'form-control', 'placeholder' => 'File Description', 'id' => 'article-ckeditor'])}}
        </div>
        <div class="form-group">
            {{Form::label('private', 'Make file private')}}
            {{ Form::hidden('private', 0) }}
            {{ Form::checkbox('private', 1, true)}}
        </div>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
            </div>
            <div class="custom-file">
                {{ Form::file('file', ['class' => 'custom-file-input', 'id' => 'inputGroupFile'])}}
                <label class="custom-file-label" for="inputGroupFile">Choose file</label>
            </div>
        </div>
        <br>
        <div class="form-group">
            {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
        </div>
    {!! Form::close() !!}
@endsection
