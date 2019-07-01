@extends('layouts.app')
@section('content')
    <div class="jumbotron text-center">
        <h1>{{$title}}</h1>
        <blockquote class="blockquote">
            <footer class="blockquote-footer">He Zaps, She Zaps, You Zap - Hooray!</footer>
        </blockquote>
    </div>
    <div class="card">
        <div class="card-header">
            <h2>Store, Share, &amp; Get back to work!</h2>
        </div>
        <div class="card-body mx-auto">
            <p>ZapFile was created as an alternative to sharing files.</p>
            <p>The other alternatives might be <b>OKAY</b> but why settle?</p>
            <p>ZapFile makes it easy to share the files <em>you</em> create, with others.</p>
            <p>Its easy, convenient, and fast. So you can get back to work.</p>
            <p>Emails are useful, but often, they have a size limit of 5MB or so.</p>
            <p>Zapfile has a limit of <u>50MB</u>!</p>
            <p>So that's the question: <b><u><em>what are you waiting for!?</em></u></b></p>
            <div class="text-center">
                @auth<a href="#" data-toggle="modal" data-target="#uploadModal" class="btn btn-success">@endauth @guest <a href="#" data-toggle="modal" data-target="#loginModal" class="btn btn-success"> @endguest Zap That File</a>
            </div>
        </div>
    </div>
    @include('inc.login-modal')
    @include('inc.register-modal')
    @include('inc.upload-modal')
@endsection