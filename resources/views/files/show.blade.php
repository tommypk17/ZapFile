@extends('layouts.app')

@section('content')
    @if(auth()->user()->id == $file->user_id or !$file->private)
        <a href="/files" class="btn btn-secondary"><i class="fa fa-chevron-left"></i>Back</a>
        <h1>{{$file->title}}</h1>
        <div>
            {!! $file->description !!}
        </div>
        <hr>
        <small>Uploaded on {{$file->created_at}} by {{$file->user->name}}</small>
        <hr>
        <div>
        @if(auth()->user()->id == $file->user_id)
        <a href="/files/{{$file->unique_id}}/edit" class="btn btn-outline-secondary float-left mr-1"> Edit</a>
        {!! Form::open(['action' => ['FilesController@destroy', $file->unique_id], 'method' => 'POST', 'class' => 'pull-right']) !!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger float-right'])}}
        {!! Form::close() !!}
        @endif
            <a id="zapfile-link" class="btn btn-outline-info float-left mr-1">Zap File</a>
            <a class="btn btn-primary float-left mr-1" href="/files/download/{{$file->unique_id}}">Download</a>
        </div>
        <div id="zapfile-link-group" class="form-group"></div>
        <script type="application/javascript">
            $(document).ready(function(){
                $('#zapfile-link').on('click', function(){
                    let html = '            <div class="input-group">\n' +
                        '                <input id="zapfile-link-url" name="zapfile-link-url" type="text" value="'+$(document)[0].URL.replace('/files/', '/files/download/')+'" class="form-control my-2" readonly>\n' +
                        '                <div class="input-group-append my-2">\n' +
                        '                    <button id="btn-copy-url" class="btn btn-outline-success">Copy URL</button>\n' +
                        '                </div>\n' +
                        '            <div>';
                    $('#zapfile-link-group').html(html);
                    $('#btn-copy-url').on('click', function(){
                        $('#zapfile-link-url').select();
                        document.execCommand('copy');
                    });
                });
            });
        </script>
    @else
        <div class="jumbotron">
            <h2 class="text-center">File Not Found!</h2>
            <hr>
            <p class="text-center text-body"><b>This file is either set to private or does not exist</b></p>
        </div>
    @endif
@endsection