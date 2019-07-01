@extends('layouts.app')
@section('content')
    <div class="jumbotron text-center">
        <h1>{{$title}}</h1>
        <p>This is ZapFile</p>
        @auth <a href="#" data-toggle="modal" data-target="#uploadModal" class="btn btn-success"> @endauth @guest<a href="#" data-toggle="modal" data-target="#loginModal" class="btn btn-success">@endguest Start Zapping!</a>
    </div>
    <div class="card">
        <div class="card-header">
            How to Zap
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">1) <a href="#" data-toggle="modal" data-target="#registerModal">Create an Account</a> or <a href="#" data-toggle="modal" data-target="#loginModal">Login</a></li>
            <li class="list-group-item">2) Click here to @auth<a href="#" data-toggle="modal" data-target="#uploadModal">@endauth @guest <a href="#" data-toggle="modal" data-target="#loginModal"> @endguest Upload Files</a> or go to <a href="/dashboard">your Dashboard</a></li>
            <li class="list-group-item">3) Fill in the fields, choose "Make file private" if you aren't ready to share or uncheck it to share right away. Submit.</li>
            <li class="list-group-item">4) Choose the file you just uploaded and click "Zapfile", copy that URL and give it to everyone you'd like to share with.</li>
        </ul>
    </div>
    @include('inc.login-modal')
    @include('inc.register-modal')
    @include('inc.upload-modal')
@endsection
