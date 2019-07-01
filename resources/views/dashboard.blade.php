@extends('layouts.app')

@section('content')
<div class="container container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h2>Dashboard</h2>
                    </div>
                    <div class="float-right">
                        <a href="/files/create" class="btn btn-primary">Upload new file</a>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <h3>Your Files</h3>
                        @if(count($files) > 0)
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                @foreach($files as $file)
                                    <tr>
                                        <th><a href="/files/{{$file->unique_id}}">{{$file->title}}</a></th>
                                        <td><a href="/files/{{$file->unique_id}}/edit" class="btn btn-outline-secondary">Edit</a></td>
                                        <td></td>
                                        <td>
                                            {!! Form::open(['action' => ['FilesController@destroy', $file->unique_id], 'method' => 'POST', 'class' => 'pull-right']) !!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('Delete', ['class' => 'btn btn-outline-danger'])}}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                            <p>No Files Uploaded</p>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
