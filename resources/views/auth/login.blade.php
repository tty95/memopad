@extends('layouts.app')

@section('content')

@if (session('message'))
<div class="alert alert-danger text-center">
{{ session('message') }}
</div>
@endif

<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-warning">
<div class="panel-heading text-center">ログイン画面</div>

<div class="panel-body">
<form class="form-horizontal" method="POST" action="{{ route('login') }}">
{{ csrf_field() }}

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
<label for="email" class="col-md-4 control-label">メールアドレス</label>

<div class="col-md-6">
<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

@if ($errors->has('email'))
<span class="help-block">
<strong>{{ $errors->first('email') }}</strong>
</span>
@endif
</div>
</div>

<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
<label for="password" class="col-md-4 control-label">パスワード</label>

<div class="col-md-6">
<input id="password" type="password" class="form-control" name="password" required>

@if ($errors->has('password'))
<span class="help-block">
<strong>{{ $errors->first('password') }}</strong>
</span>
@endif
</div>
</div>

<div class="form-group">
<div class="col-md-8 col-md-offset-4">
<button type="submit" class="btn btn-primary">ログインする</button>

<a class="btn btn-link" href="{{ route('password.request') }}">パスワードを忘れた方はこちら</a>
</div>
</div>
</form>
<a class="btn btn-link" href="{{ route('login.google') }}">googleアカウントを使ってログインする</a>
</div>
</div>
</div>
</div>
</div>
@endsection
